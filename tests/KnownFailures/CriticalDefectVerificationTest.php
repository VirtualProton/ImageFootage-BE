<?php
namespace Tests\KnownFailures;

use App\Http\Middleware\Admin as AdminMiddleware;
use App\Models\Admin;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tests\Support\ReadFixtureConnection;
use Tests\TestCase;

class CriticalDefectVerificationTest extends TestCase
{
    /** @dataProvider missingOrUnknownLoginTypes */
    public function testActualProtectedRouteRejectsUnauthenticatedHeaderVariants(array $headers)
    {
        // Real route, middleware and controller. Missing URL exits before any fetch.
        $route = app('router')->getRoutes()->match(Request::create('/api/download-proxy', 'POST'));
        $this->assertContains('jwt.verify', $route->gatherMiddleware());
        $response = $this->postJson('/api/download-proxy', [], $headers);
        $this->assertSame(401, $response->getStatusCode(), 'LEGACY-AUTH-01: real protected route reaches URL validation without authentication.');
    }

    public function missingOrUnknownLoginTypes()
    {
        return ['missing' => [[]], 'unknown' => [['Login-Type' => 'unknown']], 'case variant' => [['Login-Type' => 'NORMAL']]];
    }

    public function testValidSignedTokenForMissingIdentityMustNotReachProtectedController()
    {
        ReadFixtureConnection::authentication($this->app);
        $user = new User();
        $user->setRawAttributes(['id' => 900099]); // fixture provider has no such identity
        $token = Auth::guard('api')->fromUser($user);
        $response = $this->postJson('/api/download-proxy', [], ['Login-Type' => 'normal', 'Authorization' => 'Bearer '.$token]);
        $this->assertSame(401, $response->getStatusCode(), 'LEGACY-AUTH-01: cryptographically valid token is insufficient when its local identity does not exist.');
    }

    public function testExistingAdminSessionIsRejectedWhenRetrievedAccountIsDisabled()
    {
        ReadFixtureConnection::authentication($this->app, true);
        $guard = Auth::guard('admins');
        // Represents a previously issued session; actual SessionGuard reloads the row via its provider.
        $this->withSession([$guard->getName() => 700001]);
        $this->assertSame('I', $guard->user()->admin_status);
        $response = (new AdminMiddleware())->handle(Request::create('/admin/dashboard'), function () {
            return response('protected admin handler reached', 200);
        });
        $this->assertSame(302, $response->getStatusCode(), 'LEGACY-AUTH-02: existing disabled account session passes Admin middleware.');
    }

    /** @dataProvider nestedModelKinds */
    public function testNestedSerializedModelsDoNotExposePasswordFields($kind)
    {
        $identity = $kind === 'user' ? new User() : new Admin();
        $identity->setRawAttributes(['id' => 700001, 'name' => 'Synthetic', 'password' => 'phase2-synthetic-hash', 'remember_token' => 'phase2-synthetic-remember']);
        $invoice = new Invoice();
        $invoice->setRawAttributes(['id' => 700002, 'invoice_name' => 'PHASE2-SERIALIZATION']);
        $invoice->setRelation($kind === 'user' ? 'user' : 'creator', $identity);
        $payload = response()->json(['invoice' => $invoice])->getData(true);
        $nested = $payload['invoice'][$kind === 'user' ? 'user' : 'creator'];
        $this->assertSame(700001, $nested['id']);
        // Primitive model test; an actual public route serving nested Admin has not been established.
        $this->assertArrayNotHasKey('password', $nested, 'LEGACY-AUTH-03: nested Eloquent serialization includes password field.');
        $this->assertArrayNotHasKey('remember_token', $nested, 'LEGACY-AUTH-03: authentication secrets must not serialize.');
    }

    public function nestedModelKinds() { return [['user'], ['admin']]; }
}
