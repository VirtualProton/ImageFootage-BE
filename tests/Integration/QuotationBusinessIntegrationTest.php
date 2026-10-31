<?php
namespace Tests\Integration;

use App\Models\Common;
use App\Models\Invoice;
use Tests\Support\BusinessFixtures;
use Tests\Support\MySqlTestCase;
use Tests\Support\GatewayTransport;
use Tests\Support\UploadSink;

class QuotationBusinessIntegrationTest extends MySqlTestCase
{
    use BusinessFixtures;

    protected function setUp(): void
    {
        parent::setUp();
        $this->businessFixtures();
    }

    protected function createQuotation(array $changes = [])
    {
        $this->expectQuotationLink();
        $response = (new Common())->save_proforma($this->quotationRequest($changes));
        $this->assertSame('1', $response->getData(true)['this']['statuscode'], json_encode($response->getData(true)));
        return Invoice::orderBy('id', 'desc')->firstOrFail();
    }

    public function testActualCustomQuotationPersistsCustomerCreatorMoneyPdfAndMail()
    {
        $invoice = $this->createQuotation();
        $this->assertSame(700001, (int) $invoice->user_id);
        $this->assertSame(700002, (int) $invoice->created_by);
        $this->assertRegExp('/^\d{7}$/', $invoice->invoice_name);
        $this->assertSame('118.00', $invoice->total);
        $this->assertSame('18.00', $invoice->tax);
        $this->assertCount(1, $invoice->items);
        $this->assertSame('100.00', $invoice->items[0]->subtotal);
        $this->assertSame('Synthetic Customer', $invoice->user->first_name);
        $this->assertCount(1, $this->mailTransport->messages());
        $mail = $this->mailTransport->messages()->first();
        $this->assertSame(['synthetic@example.invalid'], array_keys($mail->getTo()));
        $this->assertSame('Quotation ('.$invoice->invoice_name.')', $mail->getSubject());
        $attachments = array_values(array_filter($mail->getChildren(), function ($child) { return $child->getContentType() === 'application/pdf'; }));
        $this->assertCount(1, $attachments);
        $this->assertSame('%PDF-', substr($attachments[0]->getBody(), 0, 5));
        $this->assertSame('%PDF-', substr(UploadSink::$uploads[0]['bytes'], 0, 5));
        $this->assertContains('http://phase2.invalid/artifacts/quotation/', $invoice->quotation_url);
    }

    public function testMissingCustomerDoesNotWriteQuotationOrCallProvider()
    {
        $before = Invoice::count();
        $response = (new Common())->save_proforma($this->quotationRequest(['uid' => 999999]));
        $this->assertSame('0', $response->getData(true)['this']['statuscode']);
        $this->assertSame($before, Invoice::count());
        $this->assertSame([], GatewayTransport::$requests);
        $this->assertCount(0, $this->mailTransport->messages());
    }

    public function testConversionUsesExistingInvoiceIdentityAndRealAttachmentPipeline()
    {
        $invoice = $this->createQuotation();
        $response = (new Common())->create_invoice($invoice->id, 700001, 'PHASE2-PO', '2026-10-29', 'chq',
            ['gst' => '07SYNTHETIC0000Z', 'pan' => 'SYNTH0000X', 'phone' => '0000000000', 'currency' => 'INR', 'payment_method' => 'chq']);
        $this->assertSame('1', $response->getData(true)['resp']['statuscode']);
        $loaded = Invoice::findOrFail($invoice->id);
        $this->assertSame(2, (int) $loaded->proforma_type);
        $this->assertSame($invoice->invoice_name, $loaded->invoice_name);
        $this->assertSame('118.00', $loaded->total);
        $this->assertCount(2, $this->mailTransport->messages());
        $this->assertSame('Invoice ('.$invoice->invoice_name.')', $this->mailTransport->messages()->last()->getSubject());
        $this->assertCount(2, UploadSink::$uploads);
    }

    public function testEditingReadsPersistedSyntheticItemsAndReplacementCancelsOldLink()
    {
        $first = $this->createQuotation();
        $data = (new Common())->getQuotationData($first->id);
        $this->assertNotEmpty($data);
        GatewayTransport::respond('POST', '/v1/payment_links/plink_phase22/cancel', ['id' => 'plink_phase22', 'status' => 'cancelled']);
        $this->expectQuotationLink('plink_phase22_replacement');
        $response = (new Common())->save_proforma($this->quotationRequest(['old_quotation' => $first->id]));
        $this->assertSame('1', $response->getData(true)['this']['statuscode']);
        $this->assertSame(3, (int) Invoice::findOrFail($first->id)->status);
        $this->assertSame(2, Invoice::count());
        $new = Invoice::orderBy('id', 'desc')->firstOrFail();
        $this->assertNotSame($first->id, $new->id);
        $this->assertCount(1, $new->items);
        $this->assertSame(700002, (int) $new->created_by);
    }

    public function testRealExpiryCancelsOnlyDueQuotationAndRepeatedRunHasNoSecondEffect()
    {
        $invoice = $this->createQuotation();
        $deadline = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        Invoice::where('id', $invoice->id)->update(['cancelled_on' => $deadline]);
        GatewayTransport::respond('POST', '/v1/payment_links/plink_phase22/cancel', ['id' => 'plink_phase22', 'status' => 'cancelled']);
        $command = new \App\Console\Commands\QuotationDeactive();
        $command->handle();
        $command->handle();
        $loaded = Invoice::findOrFail($invoice->id);
        $this->assertSame(3, (int) $loaded->status);
        $this->assertSame($deadline, $loaded->cancel_date);
        $this->assertCount(2, GatewayTransport::$requests); // one create, one cancel
    }

    public function testActualDiscountRecalculatesAndPersistsTwoDecimalSyntheticGstExample()
    {
        $promo = \App\Models\PromoCode::create(['name' => 'PHASE22-TEN', 'type' => 'flat', 'discount' => '10.00', 'total_applied_code' => 0]);
        $invoice = $this->createQuotation(['promo_code_id' => $promo->id, 'promoCode' => 'PHASE22-TEN']);
        $this->assertSame('106.20', $invoice->total);
        $this->assertSame('16.20', $invoice->tax);
        $this->assertSame('10.00', number_format($invoice->discount_amount, 2, '.', ''));
        $this->assertSame(1, (int) \App\Models\PromoCode::findOrFail($promo->id)->total_applied_code);
    }

    public function testStorageBoundaryFailureIsReportedAfterRealQuotationAndMailPersist()
    {
        UploadSink::$fail = true;
        $this->expectQuotationLink();
        $response = (new Common())->save_proforma($this->quotationRequest());
        $this->assertSame('0', $response->getData(true)['this']['statuscode']);
        $this->assertSame(1, Invoice::count());
        $this->assertCount(1, $this->mailTransport->messages());
        $this->assertNull(Invoice::first()->quotation_url);
        // Characterization of partial side effects, not approval of retry/idempotency behavior.
    }

    public function testMissingInvoiceReturnsExplicit422WithoutNotification()
    {
        $response = (new Common())->create_invoice(999999, 700001, '', '2026-10-29', 'chq',
            ['gst' => '', 'pan' => '', 'phone' => '0000000000', 'currency' => 'INR', 'payment_method' => 'chq']);
        $this->assertSame(422, $response->getStatusCode());
        $this->assertCount(0, $this->mailTransport->messages());
        $this->assertSame([], GatewayTransport::$requests);
    }
}
