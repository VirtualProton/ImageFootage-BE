<?php
namespace Tests\Feature;

use App\Models\Common;
use Illuminate\Support\Facades\DB;
use Tests\Support\CallbackStore;
use Tests\Support\Fixtures;
use Tests\Support\GatewayTransport;
use Tests\Support\ReadFixtureConnection;
use Tests\TestCase;

class CriticalDefectControlsTest extends TestCase
{
    public function testNormalHeaderStillRejectsNoTokenOnTheSameProtectedRoute()
    {
        $this->postJson('/api/download-proxy', [], ['Login-Type' => 'normal'])->assertStatus(401);
        $this->assertSame([], GatewayTransport::$requests);
    }

    public function testIndependentControllerAuthStillProtectsMeWithoutLoginType()
    {
        $this->postJson('/api/me', [])->assertStatus(401);
    }

    public function testCallbackFixtureHonorsInvoicePredicatesAndSelectedColumns()
    {
        $store = new CallbackStore();
        $store->install();
        $this->assertNull(DB::table('imagefootage_performa_invoices')->where('invoice_name', 'unrelated')->first());
        $row = DB::table('imagefootage_performa_invoices')->select('id', 'status')->where('invoice_name', '7000001')->first();
        $this->assertSame(['id' => 700001, 'status' => 0], (array) $row);
        $this->assertSame(0, DB::table('imagefootage_performa_invoices')->where('invoice_name', 'unrelated')->update(['status' => 1]));
        $this->assertSame([], $store->writes);
    }

    public function testMatchingFinancialIdentityReachesInvoiceCreationBoundary()
    {
        $store = new CallbackStore(['proforma_type' => 1, 'invoice_url' => null]);
        $store->install();
        $common = \Mockery::mock(Common::class);
        $common->shouldReceive('create_invoice')->once()->with(700001, 700002, '', \Mockery::type('string'), 'online', \Mockery::type('array'));
        $this->app->instance(Common::class, $common);
        GatewayTransport::respond('GET', '/v1/payment_links/plink_phase2', ['id' => 'plink_phase2', 'status' => 'paid',
            'amount' => 11800, 'amount_paid' => 11800, 'currency' => 'INR', 'reference_id' => 'QTN-7000001']);
        $this->get('/api/razorpayInvoiceResponse?'.http_build_query(Fixtures::callback()))->assertStatus(302);
        $this->assertSame(1, $store->invoice['status']);
    }

    public function testInvalidSignatureCannotFetchOrFulfillUnconvertedQuotation()
    {
        $store = new CallbackStore(['proforma_type' => 1, 'invoice_url' => null]);
        $store->install();
        $common = \Mockery::mock(Common::class);
        $common->shouldNotReceive('create_invoice', 'create_invoice_subscription');
        $this->app->instance(Common::class, $common);
        $data = array_merge(Fixtures::callback(), ['razorpay_signature' => 'invalid']);
        $this->get('/api/razorpayInvoiceResponse?'.http_build_query($data))->assertStatus(302);
        $this->assertSame([], $store->writes);
        $this->assertSame([], GatewayTransport::$requests);
    }

    public function testValidSignatureWithUnknownLocalReferenceCannotWriteAnInvoice()
    {
        $store = new CallbackStore();
        $store->install();
        $data = Fixtures::callback(['razorpay_payment_link_reference_id' => 'QTN-unknown']);
        GatewayTransport::respond('GET', '/v1/payment_links/plink_phase2', ['id' => 'plink_phase2', 'status' => 'paid',
            'amount' => 11800, 'currency' => 'INR', 'reference_id' => 'QTN-unknown']);
        $this->get('/api/razorpayInvoiceResponse?'.http_build_query($data))->assertStatus(302);
        $this->assertSame([], $store->writes);
    }

    public function testApiMeWithValidTokenPreservesNonSecretIdentityFields()
    {
        ReadFixtureConnection::authentication($this->app);
        $user = new \App\Models\User();
        $user->setRawAttributes(['id' => 700001]);
        $token = \Illuminate\Support\Facades\Auth::guard('api')->fromUser($user);
        $this->postJson('/api/me', [], ['Authorization' => 'Bearer '.$token])->assertStatus(200)
            ->assertJson(['id' => 700001, 'first_name' => 'Synthetic', 'email' => 'synthetic@example.invalid']);
    }
}
