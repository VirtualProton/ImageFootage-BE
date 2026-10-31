<?php
namespace Tests\KnownFailures;

use App\Http\Controllers\PaymentController;
use Illuminate\Http\Request;
use Tests\Support\CallbackStore;
use Tests\Support\Fixtures;
use Tests\Support\GatewayTransport;
use Tests\TestCase;

class PaymentInvariantTest extends TestCase
{
    /** @dataProvider mismatchedPayment */
    public function testPaidCallbackMustValidateFinancialIdentity($amount, $currency, $reference)
    {
        $store = new CallbackStore();
        $store->install();
        GatewayTransport::respond('GET', '/v1/payment_links/plink_phase2', ['id' => 'plink_phase2', 'status' => 'paid', 'amount' => $amount, 'currency' => $currency, 'reference_id' => $reference]);
        (new PaymentController())->razorpayInvoiceResponse(Request::create('/', 'GET', Fixtures::callback()));
        $this->assertNotSame(1, $store->invoice['status'], 'LEGACY-PAY-01: paid provider response accepted without comparing amount/currency/reference.');
    }

    public function mismatchedPayment()
    {
        return ['amount' => [1, 'INR', 'QTN-7000001'], 'currency' => [11800, 'USD', 'QTN-7000001'],
            'reference' => [11800, 'INR', 'QTN-unrelated']];
    }

    public function testOutOfOrderPendingCallbackMustNotDowngradePaidInvoice()
    {
        $store = new CallbackStore(['status' => 1, 'payment_status' => 'Transction Success']);
        $store->install();
        GatewayTransport::respond('GET', '/v1/payment_links/plink_phase2', ['id' => 'plink_phase2', 'reference_id' => 'QTN-7000001', 'status' => 'created']);
        (new PaymentController())->razorpayInvoiceResponse(Request::create('/', 'GET', Fixtures::callback()));
        $this->assertSame(1, $store->invoice['status'], 'LEGACY-PAY-02: stale/pending response downgrades paid invoice state.');
    }
}
