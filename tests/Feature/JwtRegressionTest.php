<?php
namespace Tests\Feature;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Tests\Support\ReadFixtureConnection;
use Tests\TestCase;

class JwtRegressionTest extends TestCase
{
    private function token()
    {
        $user = new User();
        $user->setRawAttributes(['id' => 700001, 'first_name' => 'Synthetic', 'email' => 'synthetic@example.invalid']);
        return Auth::guard('api')->fromUser($user);
    }

    public function testRealJwtSignatureAndRequiredClaimsRoundTrip()
    {
        $token = $this->token();
        $payload = $this->app['tymon.jwt.manager']->decode(new \Tymon\JWTAuth\Token($token));
        foreach (['iss', 'iat', 'exp', 'nbf', 'sub', 'jti'] as $claim) {
            $this->assertNotNull($payload->get($claim));
        }
        $this->assertSame(700001, $payload->get('sub'));
        $this->assertSame(3600, $payload->get('exp') - $payload->get('iat'));
    }

    public function testInvalidSignatureIsRejectedByActualJwtDecoder()
    {
        $parts = explode('.', $this->token());
        $parts[2] = rtrim(strtr(base64_encode(str_repeat('x', 32)), '+/', '-_'), '=');
        $this->expectException(\Tymon\JWTAuth\Exceptions\TokenInvalidException::class);
        $this->app['tymon.jwt.manager']->decode(new \Tymon\JWTAuth\Token(implode('.', $parts)));
    }

    public function testExpirationIsEnforcedByActualJwtDecoder()
    {
        $token = $this->token();
        Carbon::setTestNow(Carbon::now()->addHours(2));
        $this->expectException(\Tymon\JWTAuth\Exceptions\TokenExpiredException::class);
        $this->app['tymon.jwt.manager']->decode(new \Tymon\JWTAuth\Token($token));
    }

    public function testNormalHeaderMissingTokenHasLegacy401Shape()
    {
        $this->postJson('/api/add_to_cart', [], ['Login-Type' => 'normal'])
            ->assertStatus(401)->assertExactJson(['status' => 'Authorization Token not found']);
    }

    public function testNormalHeaderMalformedTokenIsRejected()
    {
        $this->postJson('/api/add_to_cart', [], ['Login-Type' => 'normal', 'Authorization' => 'Bearer invalid'])
            ->assertStatus(401);
    }

    public function testExpiredTokenHasExistingMiddlewareErrorShape()
    {
        $token = $this->token();
        Carbon::setTestNow(Carbon::now()->addHours(2));
        $this->postJson('/api/add_to_cart', [], ['Login-Type' => 'normal', 'Authorization' => 'Bearer '.$token])
            ->assertStatus(401)->assertExactJson(['status' => 'Token is Expired']);
    }

    public function testRefreshProducesNewTokenAndBlacklistsOldOne()
    {
        $token = $this->token();
        $new = $this->app['tymon.jwt.manager']->refresh(new \Tymon\JWTAuth\Token($token));
        $this->assertNotSame($token, $new);
        $this->expectException(\Tymon\JWTAuth\Exceptions\TokenBlacklistedException::class);
        $this->app['tymon.jwt.manager']->decode(new \Tymon\JWTAuth\Token($token));
    }

    public function testApiLogoutRevokesSuppliedToken()
    {
        ReadFixtureConnection::authentication($this->app);
        $token = $this->token();
        $this->postJson('/api/logout', [], ['Authorization' => 'Bearer '.$token])->assertStatus(200)
            ->assertExactJson(['message' => 'Successfully logged out.']);
        $this->expectException(\Tymon\JWTAuth\Exceptions\TokenBlacklistedException::class);
        $this->app['tymon.jwt.manager']->decode(new \Tymon\JWTAuth\Token($token));
    }

    public function testApiRefreshPreservesNestedResponseContract()
    {
        ReadFixtureConnection::authentication($this->app);
        $token = $this->token();
        $this->postJson('/api/refresh', [], ['Authorization' => 'Bearer '.$token, 'Login-Type' => 'normal'])
            ->assertStatus(200)->assertJsonStructure(['status', 'message', 'userdata' => ['access_token', 'refresh_token', 'token_type']])
            ->assertJson(['status' => true, 'message' => 'Successfully logged in.']);
    }
}
