<?php
namespace Tests\KnownFailures;

use App\Http\Middleware\JwtMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tests\Support\ReadFixtureConnection;
use Tests\TestCase;

// Deliberately red: security invariants, not approved legacy behavior. Do not blanket-skip.
class SecurityInvariantTest extends TestCase
{
    public function testMissingLoginTypeMustNotBypassJwtProtection()
    {
        $middleware = $this->app->make(JwtMiddleware::class);
        $response = $middleware->handle(Request::create('/api/download', 'POST'), function () { return response('protected handler reached', 200); });
        $this->assertSame(401, $response->getStatusCode(), 'LEGACY-AUTH-01: missing Login-Type reaches next without token validation.');
    }

    public function testDisabledAdminMustNotRetainAdminSession()
    {
        ReadFixtureConnection::authentication($this->app, true);
        $this->from('/admin/login')->post('/admin/authenticate', ['email' => 'synthetic@example.invalid', 'password' => 'SyntheticPassword42']);
        $this->assertFalse(Auth::guard('admins')->check(), 'LEGACY-AUTH-02: disabled-admin branch logs out the default guard instead of admins.');
    }

    public function testAuthenticatedMeResponseMustNotExposePasswordHash()
    {
        ReadFixtureConnection::authentication($this->app);
        $user = new \App\Models\User();
        $user->setRawAttributes(['id' => 700001]);
        $token = Auth::guard('api')->fromUser($user);
        $response = $this->postJson('/api/me', [], ['Authorization' => 'Bearer '.$token]);
        $response->assertStatus(200);
        $this->assertArrayNotHasKey('password', $response->json(), 'LEGACY-AUTH-03: User hidden fields are commented; /api/me serializes password hashes.');
    }
}
