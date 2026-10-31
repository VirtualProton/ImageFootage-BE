<?php
namespace Tests\Integration;

use App\Models\Common;
use App\Models\Invoice;
use Tests\Support\BusinessFixtures;
use Tests\Support\Fixtures;
use Tests\Support\GatewayTransport;
use Tests\Support\MySqlTestCase;
use Tests\Support\UploadSink;

class PaymentPersistenceIntegrationTest extends MySqlTestCase
{
    use BusinessFixtures;

    protected function setUp(): void
    {
        parent::setUp();
        $this->businessFixtures();
    }

    private function quotation()
    {
        $this->expectQuotationLink();
        $response = (new Common())->save_proforma($this->quotationRequest());
        $this->assertSame('1', $response->getData(true)['this']['statuscode']);
        return Invoice::firstOrFail();
    }

    private function providerCallback($invoice, $status = 'paid', array $overrides = [])
    {
        GatewayTransport::respond('GET', '/v1/payment_links/plink_phase22', array_merge(['id' => 'plink_phase22',
            'reference_id' => 'QTN-'.$invoice->invoice_name, 'amount' => 11800, 'amount_paid' => 11800, 'currency' => 'INR', 'status' => $status], $overrides));
        return Fixtures::callback(['razorpay_payment_link_id' => 'plink_phase22',
            'razorpay_payment_link_reference_id' => 'QTN-'.$invoice->invoice_name, 'razorpay_payment_link_status' => $status]);
    }

    public function testActualPaidConversionAndSequentialReplayDoNotDuplicateMailOrArtifacts()
    {
        $invoice = $this->quotation();
        $data = $this->providerCallback($invoice);
        GatewayTransport::respond('POST', '/v1/payment_links', ['id' => 'plink_phase22_invoice', 'short_url' => 'http://phase2.invalid/invoice-link', 'status' => 'created']);
        $this->get('/api/razorpayInvoiceResponse?'.http_build_query($data))->assertStatus(302);
        $loaded = Invoice::findOrFail($invoice->id);
        $this->assertSame(1, (int) $loaded->status);
        $this->assertSame(2, (int) $loaded->proforma_type);
        $this->assertCount(2, $this->mailTransport->messages());
        $this->assertCount(2, UploadSink::$uploads);
        $data = $this->providerCallback($invoice);
        $this->get('/api/razorpayInvoiceResponse?'.http_build_query($data))->assertStatus(302);
        $this->assertSame(1, Invoice::count());
        $this->assertSame(1, $this->sql->table('imagefootage_performa_invoice_items')->count());
        $this->assertCount(2, $this->mailTransport->messages());
        $this->assertCount(2, UploadSink::$uploads);
        $this->assertSame([], GatewayTransport::$responses);
    }

    public function testInvalidSignatureLeavesRealInvoiceAndNotificationsUnchanged()
    {
        $invoice = $this->quotation();
        $data = Fixtures::callback(['razorpay_payment_link_id' => 'plink_phase22', 'razorpay_payment_link_reference_id' => 'QTN-'.$invoice->invoice_name]);
        $data['razorpay_signature'] = 'invalid';
        $this->get('/api/razorpayInvoiceResponse?'.http_build_query($data))->assertStatus(302);
        $this->assertSame(0, (int) Invoice::findOrFail($invoice->id)->status);
        $this->assertCount(1, $this->mailTransport->messages());
        $this->assertCount(1, GatewayTransport::$requests);
    }

    public function testRealExpiredQuotationPaidCallbackDoesNotConvertOrNotifyAgain()
    {
        $invoice = $this->quotation();
        Invoice::where('id', $invoice->id)->update(['status' => 3]);
        $data = $this->providerCallback($invoice);
        $this->get('/api/razorpayInvoiceResponse?'.http_build_query($data))->assertStatus(302);
        $loaded = Invoice::findOrFail($invoice->id);
        $this->assertSame(3, (int) $loaded->status);
        $this->assertSame(1, (int) $loaded->proforma_type);
        $this->assertSame('Transction Success', $loaded->payment_status);
        $this->assertCount(1, $this->mailTransport->messages());
    }

    /** @dataProvider financialMismatches */
    public function testRealPersistenceRejectsMismatchedFinancialIdentity($field, $value)
    {
        $invoice = $this->quotation();
        $data = $this->providerCallback($invoice, 'paid', [$field => $value]);
        GatewayTransport::respond('POST', '/v1/payment_links', ['id' => 'plink_phase22_invoice', 'short_url' => 'http://phase2.invalid/invoice-link', 'status' => 'created']);
        $this->get('/api/razorpayInvoiceResponse?'.http_build_query($data))->assertStatus(302);
        $loaded = Invoice::findOrFail($invoice->id);
        $this->assertSame(['paid' => false, 'converted' => false, 'mail_count' => 1],
            ['paid' => (int) $loaded->status === 1, 'converted' => (int) $loaded->proforma_type === 2, 'mail_count' => $this->mailTransport->messages()->count()],
            'LEGACY-PAY-01: real SQL/fulfillment confirms the existing mismatch finding.');
    }

    public function financialMismatches() { return [['amount', 1], ['currency', 'USD'], ['reference_id', 'QTN-unrelated']]; }

    public function testRealPersistencePreservesPaidStateAgainstPendingResponse()
    {
        $invoice = $this->quotation();
        Invoice::where('id', $invoice->id)->update(['status' => 1, 'payment_status' => 'Transction Success', 'proforma_type' => 2, 'invoice_url' => 'http://phase2.invalid/existing.pdf']);
        $data = $this->providerCallback($invoice, 'pending');
        $this->get('/api/razorpayInvoiceResponse?'.http_build_query($data))->assertStatus(302);
        $this->assertSame(1, (int) Invoice::findOrFail($invoice->id)->status, 'LEGACY-PAY-02: real SQL paid-state downgrade; provider backward-state reachability still conditional.');
    }
}
