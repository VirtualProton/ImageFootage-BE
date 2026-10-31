<?php
namespace Tests\KnownFailures;

use App\Models\Common;
use Tests\Support\CallbackStore;
use Tests\Support\Fixtures;
use Tests\Support\GatewayTransport;
use Tests\TestCase;

class PaymentDefectVerificationTest extends TestCase
{
    /** @dataProvider mismatchedFinancialIdentity */
    public function testMatchingLinkIdButMismatchedFinancialIdentityCannotFulfill($field, $wrongValue)
    {
        $store = new CallbackStore(['proforma_type' => 1, 'invoice_url' => null]);
        $store->install();
        $delegations = 0;
        $creator = \Mockery::mock(Common::class);
        $creator->shouldReceive('create_invoice')->andReturnUsing(function () use (&$delegations) { $delegations++; });
        $this->app->instance(Common::class, $creator);
        $payload = array_merge(['id' => 'plink_phase2', 'status' => 'paid', 'amount' => 11800,
            'amount_paid' => 11800, 'currency' => 'INR', 'reference_id' => 'QTN-7000001'], [$field => $wrongValue]);
        GatewayTransport::respond('GET', '/v1/payment_links/plink_phase2', $payload);
        $this->get('/api/razorpayInvoiceResponse?'.http_build_query(Fixtures::callback()))->assertRedirect('http://phase2.invalid/#/signin');
        $this->assertCount(1, GatewayTransport::$requests);
        $violations = [];
        if ($store->writes) { $violations[] = 'invoice payment state written'; }
        if ($delegations !== 0) { $violations[] = 'invoice fulfillment delegated'; }
        $this->assertSame([], $violations, 'LEGACY-PAY-01: real routed callback accepts mismatched fetched transaction identity.');
    }

    public function mismatchedFinancialIdentity()
    {
        return ['amount' => ['amount', 1], 'currency' => ['currency', 'USD'], 'reference' => ['reference_id', 'QTN-unrelated']];
    }

    /** @dataProvider nonFinalResponses */
    public function testConsistentlySignedNonPaidResponseCannotOverwriteCompletedInvoice($status)
    {
        $store = new CallbackStore(['status' => 1, 'payment_status' => 'Transction Success', 'payment_mode' => 'Razorpay']);
        $store->install();
        GatewayTransport::respond('GET', '/v1/payment_links/plink_phase2', ['id' => 'plink_phase2', 'status' => $status,
            'amount' => 11800, 'currency' => 'INR', 'reference_id' => 'QTN-7000001']);
        $callback = Fixtures::callback(['razorpay_payment_link_status' => $status]);
        $this->get('/api/razorpayInvoiceResponse?'.http_build_query($callback))->assertStatus(302);
        $this->assertSame(['status' => 1, 'payment_status' => 'Transction Success'],
            array_intersect_key($store->invoice, ['status' => true, 'payment_status' => true]),
            'LEGACY-PAY-02: signed/fetched status agree, but completed local payment is downgraded. Provider reachability is separately unverified.');
    }

    public function nonFinalResponses() { return [['created'], ['pending'], ['expired'], ['cancelled']]; }
}
