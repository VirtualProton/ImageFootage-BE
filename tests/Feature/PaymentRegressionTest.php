<?php
namespace Tests\Feature;

use App\Http\Controllers\PaymentController;
use App\Models\Common;
use Illuminate\Http\Request;
use Tests\Support\CallbackStore;
use Tests\Support\Fixtures;
use Tests\Support\GatewayTransport;
use Tests\TestCase;

class PaymentRegressionTest extends TestCase
{
    /** @dataProvider linkStatuses */
    public function testSignedPaymentLinkCallbackStatusMapping($gatewayStatus, $status, $paymentStatus)
    {
        $store = new CallbackStore();
        $store->install();
        GatewayTransport::respond('GET', '/v1/payment_links/plink_phase2', ['id' => 'plink_phase2', 'reference_id' => 'QTN-7000001', 'status' => $gatewayStatus, 'amount' => 11800, 'currency' => 'INR']);
        $response = (new PaymentController())->razorpayInvoiceResponse(Request::create('/api/razorpayInvoiceResponse', 'GET', Fixtures::callback()));
        $this->assertSame('http://phase2.invalid/#/signin', $response->getTargetUrl());
        $this->assertSame($status, $store->invoice['status']);
        $this->assertSame($paymentStatus, $store->invoice['payment_status']);
        $this->assertCount(1, GatewayTransport::$requests);
        $this->assertSame([], GatewayTransport::$responses);
    }

    public function linkStatuses()
    {
        return [['paid', 1, 'Transction Success'], ['created', 0, 'Pending'], ['partially_paid', 0, 'Pending'],
            ['pending', 0, 'Pending'], ['expired', 3, 'Failed'], ['cancelled', 3, 'Failed'], ['unexpected', 3, 'Failed']];
    }

    /** @dataProvider invalidCallbacks */
    public function testInvalidOrMissingSignatureNeverFetchesOrWrites($changes)
    {
        $store = new CallbackStore();
        $store->install();
        $data = array_merge(Fixtures::callback(), $changes);
        (new PaymentController())->razorpayInvoiceResponse(Request::create('/api/razorpayInvoiceResponse', 'GET', $data));
        $this->assertSame([], GatewayTransport::$requests);
        $this->assertSame([], $store->writes);
    }

    public function invalidCallbacks()
    {
        return [[['razorpay_signature' => 'bad']], [['razorpay_signature' => null]],
            [['razorpay_payment_link_id' => null]], [['razorpay_payment_link_reference_id' => 'QTN-tampered']]];
    }

    public function testLatePaidQuotationRemainsCancelledAndDoesNotConvert()
    {
        $store = new CallbackStore(['proforma_type' => 1, 'invoice_url' => null, 'status' => 3]);
        $store->install();
        $common = \Mockery::mock(Common::class);
        $common->shouldNotReceive('create_invoice');
        $this->app->instance(Common::class, $common);
        GatewayTransport::respond('GET', '/v1/payment_links/plink_phase2', ['id' => 'plink_phase2', 'reference_id' => 'QTN-7000001', 'status' => 'paid']);
        (new PaymentController())->razorpayInvoiceResponse(Request::create('/', 'GET', Fixtures::callback()));
        $this->assertSame(3, $store->invoice['status']);
        $this->assertSame('Transction Success', $store->invoice['payment_status']);
    }

    public function testSequentialReplaysDoNotRequestAnotherConversionWhenPersistenceReportsAlreadyConverted()
    {
        $store = new CallbackStore();
        $store->install();
        $common = \Mockery::mock(Common::class);
        $common->shouldNotReceive('create_invoice', 'create_invoice_subscription');
        $this->app->instance(Common::class, $common);
        for ($i = 0; $i < 2; $i++) {
            GatewayTransport::respond('GET', '/v1/payment_links/plink_phase2', ['id' => 'plink_phase2', 'reference_id' => 'QTN-7000001', 'status' => 'paid']);
            (new PaymentController())->razorpayInvoiceResponse(Request::create('/', 'GET', Fixtures::callback()));
        }
        $this->assertSame(1, $store->invoice['status']);
        $this->assertCount(1, $store->writes); // Completed replay performs no second write.
        \Illuminate\Support\Facades\Mail::assertNothingSent();
    }

    public function testUnconvertedPaidQuotationDelegatesToExistingInvoiceCreator()
    {
        $store = new CallbackStore(['proforma_type' => 1, 'invoice_url' => null]);
        $store->install();
        $common = \Mockery::mock(Common::class);
        $common->shouldReceive('create_invoice')->once()->with(700001, 700002, '', \Mockery::type('string'), 'online', \Mockery::on(function ($data) {
            return $data['currency'] === 'INR' && $data['payment_method'] === 'online';
        }));
        $this->app->instance(Common::class, $common);
        GatewayTransport::respond('GET', '/v1/payment_links/plink_phase2', ['id' => 'plink_phase2', 'reference_id' => 'QTN-7000001', 'status' => 'paid']);
        (new PaymentController())->razorpayInvoiceResponse(Request::create('/', 'GET', Fixtures::callback()));
        $this->assertSame(1, $store->invoice['status']);
    }

    public function testGatewayFailureDoesNotWritePaymentState()
    {
        $store = new CallbackStore();
        $store->install();
        GatewayTransport::respond('GET', '/v1/payment_links/plink_phase2', ['error' => ['code' => 'SERVER_ERROR', 'description' => 'Synthetic outage']], 500);
        (new PaymentController())->razorpayInvoiceResponse(Request::create('/', 'GET', Fixtures::callback()));
        $this->assertSame([], $store->writes);
        $this->assertCount(1, GatewayTransport::$requests);
    }

    public function testRetryAfterGatewayFailureCanProcessSyntheticPaidResponse()
    {
        $store = new CallbackStore();
        $store->install();
        GatewayTransport::respond('GET', '/v1/payment_links/plink_phase2', ['error' => ['code' => 'SERVER_ERROR', 'description' => 'Synthetic outage']], 500);
        GatewayTransport::respond('GET', '/v1/payment_links/plink_phase2', ['id' => 'plink_phase2', 'reference_id' => 'QTN-7000001', 'status' => 'paid']);
        $controller = new PaymentController();
        $controller->razorpayInvoiceResponse(Request::create('/', 'GET', Fixtures::callback()));
        $this->assertSame([], $store->writes);
        $controller->razorpayInvoiceResponse(Request::create('/', 'GET', Fixtures::callback()));
        $this->assertSame(1, $store->invoice['status']);
        $this->assertCount(1, $store->writes);
        $this->assertCount(2, GatewayTransport::$requests);
    }
}
