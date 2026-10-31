<?php
namespace Tests\Feature;

use App\Http\Middleware\Admin as AdminMiddleware;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tests\Support\CallbackStore;
use Tests\Support\Fixtures;
use Tests\Support\GatewayTransport;
use Tests\Support\ReadFixtureConnection;
use Tests\TestCase;

class RemediationRegressionTest extends TestCase
{
    /** @dataProvider validHeaders */
    public function testLocalJwtIdentityWorksWithSupportedHeaderVariants(array $headers)
    {
        ReadFixtureConnection::authentication($this->app);
        $user = new User(); $user->setRawAttributes(['id' => 700001]);
        $headers['Authorization'] = 'Bearer '.Auth::guard('api')->fromUser($user);
        // Real protected route reaches its missing-URL validation, after authentication.
        $this->postJson('/api/download-proxy', [], $headers)->assertStatus(400);
        $this->assertSame([], GatewayTransport::$requests);
    }
    public function validHeaders() { return [[[]], [['Login-Type' => 'normal']], [['Login-Type' => 'NORMAL']], [['Login-Type' => 'google']], [['Login-Type' => 'facebook']]]; }

    /** @dataProvider providerHeaders */
    public function testRawProviderOrMissingTokensCannotBypassLocalIdentity($type, $token)
    {
        $headers = ['Login-Type' => $type];
        if ($token !== null) { $headers['Authorization'] = 'Bearer '.$token; }
        $this->postJson('/api/download-proxy', [], $headers)->assertStatus(401);
        $this->assertSame([], GatewayTransport::$requests);
    }
    public function providerHeaders() { return [['google', null], ['facebook', null], ['google', 'synthetic-provider-token'], ['facebook', 'synthetic-provider-token']]; }

    public function testActiveAdminMiddlewarePreservesApiIdentityAndAllowsHandler()
    {
        ReadFixtureConnection::authentication($this->app);
        Auth::guard('admins')->attempt(['email' => 'synthetic@example.invalid', 'password' => 'SyntheticPassword42']);
        $apiUser = new User(); $apiUser->setRawAttributes(['id' => 700009]);
        Auth::guard('api')->setUser($apiUser);
        $response = (new AdminMiddleware())->handle(Request::create('/admin/dashboard'), function () { return response('allowed', 200); });
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame(700009, Auth::guard('api')->id());
        $this->assertTrue(Auth::guard('admins')->check());
    }

    /** @dataProvider serializedKinds */
    public function testDirectAndCollectionSerializationHideSecretsAndPreserveIdentity($kind)
    {
        $model = $kind === 'user' ? new User() : new Admin();
        $model->setRawAttributes(['id' => 700001, 'email' => 'synthetic@example.invalid', 'password' => 'synthetic-hash', 'remember_token' => 'synthetic-remember']);
        if ($kind === 'user') { $model->setRawAttributes(array_merge($model->getAttributes(), ['gmail_idtoken' => 'synthetic-google', 'fb_token' => 'synthetic-facebook', 'otp' => '000000', 'email_verify_token' => 'synthetic-verification'])); }
        $payload = response()->json(['direct' => $model, 'collection' => new \Illuminate\Database\Eloquent\Collection([$model])])->getData(true);
        foreach ([$payload['direct'], $payload['collection'][0]] as $row) {
            $this->assertSame(['id' => 700001, 'email' => 'synthetic@example.invalid'], $row);
        }
    }
    public function serializedKinds() { return [['user'], ['admin']]; }

    /** @dataProvider invalidLinkIdentity */
    public function testFetchedAndStoredLinkIdentityMismatchHasNoEffects($source, $field, $value)
    {
        $expected = ['id' => 'plink_phase2', 'reference_id' => 'QTN-7000001', 'status' => 'paid', 'amount' => 11800, 'currency' => 'INR'];
        $stored = $expected; $fetched = $expected;
        if ($source === 'stored') { $stored[$field] = $value; } else { $fetched[$field] = $value; }
        $store = new CallbackStore(['payment_response' => json_encode($stored), 'proforma_type' => 1, 'invoice_url' => null]); $store->install();
        $creator = \Mockery::mock(\App\Models\Common::class); $creator->shouldNotReceive('create_invoice', 'create_invoice_subscription');
        $this->app->instance(\App\Models\Common::class, $creator);
        GatewayTransport::respond('GET', '/v1/payment_links/plink_phase2', $fetched);
        $this->get('/api/razorpayInvoiceResponse?'.http_build_query(Fixtures::callback()))->assertStatus(302);
        $this->assertSame([], $store->writes);
        \Illuminate\Support\Facades\Mail::assertNothingSent();
    }
    public function invalidLinkIdentity() { return [['fetched', 'id', 'plink_other'], ['stored', 'id', 'plink_other'], ['stored', 'reference_id', 'INV-7000001'], ['stored', 'id', null], ['fetched', 'reference_id', null]]; }
}
