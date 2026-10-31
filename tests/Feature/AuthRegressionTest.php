<?php
namespace Tests\Feature;

use Illuminate\Support\Facades\Auth;
use Tests\Support\ReadFixtureConnection;
use Tests\TestCase;

class AuthRegressionTest extends TestCase
{
    public function testAdminValidationRejectsMissingFieldsBeforeDatabaseAccess()
    {
        $this->postJson('/admin/authenticate', [])->assertStatus(422)->assertJsonValidationErrors(['email', 'password']);
    }

    public function testAdminValidationRejectsMalformedEmailAndShortPassword()
    {
        $this->postJson('/admin/authenticate', ['email' => 'invalid', 'password' => '123'])->assertStatus(422);
    }

    public function testSuccessfulAdminLoginCreatesOnlyTheAdminSession()
    {
        ReadFixtureConnection::authentication($this->app);
        $this->post('/admin/authenticate', ['email' => 'synthetic@example.invalid', 'password' => 'SyntheticPassword42'])
            ->assertRedirect('admin/dashboard');
        $this->assertTrue(Auth::guard('admins')->check());
        $this->assertFalse(Auth::guard('api')->check());
        $this->assertSame(700001, session(Auth::guard('admins')->getName()));
    }

    public function testWrongAdminPasswordDoesNotAuthenticate()
    {
        ReadFixtureConnection::authentication($this->app);
        $this->from('/admin/login')->post('/admin/authenticate', ['email' => 'synthetic@example.invalid', 'password' => 'IncorrectPassword'])
            ->assertRedirect('/admin/login');
        $this->assertFalse(Auth::guard('admins')->check());
        $this->assertTrue(session()->has('warning'));
    }

    public function testAdminLogoutClearsAdminAuthentication()
    {
        ReadFixtureConnection::authentication($this->app);
        Auth::guard('admins')->attempt(['email' => 'synthetic@example.invalid', 'password' => 'SyntheticPassword42']);
        $this->get('/admin/logout')->assertRedirect('admin/login');
        $this->assertFalse(Auth::guard('admins')->check());
    }

    public function testGuestCannotOpenAdminDashboard()
    {
        $this->get('/admin/dashboard')->assertRedirect('/admin/login');
    }

    public function testObservedApiValidationUsesHttp200AndFieldErrors()
    {
        $this->postJson('/api/login', [])->assertStatus(200)->assertJsonStructure(['email', 'password']);
    }

    public function testApiIncorrectPasswordPreservesErrorContract()
    {
        ReadFixtureConnection::authentication($this->app);
        $this->postJson('/api/login', ['email' => 'synthetic@example.invalid', 'password' => 'IncorrectPassword'])
            ->assertStatus(401)->assertExactJson(['error' => "Email or password does't exist"]);
    }

    public function testApiSuccessfulLoginPreservesFieldsAndMisspellings()
    {
        ReadFixtureConnection::authentication($this->app);
        $response = $this->postJson('/api/login', ['email' => 'synthetic@example.invalid', 'password' => 'SyntheticPassword42']);
        $response->assertStatus(200)->assertJsonStructure(['access_token', 'token_type', 'expires_in', 'user', 'email',
            'Utype', 'image_downlaod', 'footage_downlaod', 'music_download', 'profile_completed', 'refresh_token', 'login_type']);
        $this->assertSame('bearer', $response->json('token_type'));
        $this->assertSame(21, $response->json('expires_in')); // observed legacy API field, not JWT TTL seconds
        $this->assertFalse(Auth::guard('admins')->check());
        $this->assertCount(3, explode('.', $response->json('access_token')));
    }
}
