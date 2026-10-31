<?php
namespace Tests\Integration;

use Illuminate\Support\Facades\Auth;
use Tests\Support\BusinessFixtures;
use Tests\Support\MySqlTestCase;

class AuthenticationPersistenceIntegrationTest extends MySqlTestCase
{
    use BusinessFixtures;

    protected function setUp(): void
    {
        parent::setUp();
        $this->businessFixtures();
        Auth::guard('admins')->logout();
    }

    public function testActualSqlAdminAndApiAuthenticationUseSeparateGuards()
    {
        $this->post('/admin/authenticate', ['email' => 'creator@example.invalid', 'password' => 'SyntheticPassword42'])->assertRedirect('admin/dashboard');
        $this->assertSame(700002, (int) Auth::guard('admins')->id());
        $this->postJson('/api/login', ['email' => 'synthetic@example.invalid', 'password' => 'SyntheticPassword42'])
            ->assertStatus(200)->assertJson(['email' => 'synthetic@example.invalid', 'Utype' => 700001, 'token_type' => 'bearer']);
        $this->assertSame(700002, (int) Auth::guard('admins')->id());
        $this->assertSame(700001, (int) Auth::guard('api')->id());
    }

    public function testDisabledAdminCannotRetainRealSqlAuthenticatedSession()
    {
        $this->sql->table('imagefootage_admins')->where('id', 700002)->update(['admin_status' => 'I']);
        $this->from('/admin/login')->post('/admin/authenticate', ['email' => 'creator@example.invalid', 'password' => 'SyntheticPassword42']);
        $this->assertFalse(Auth::guard('admins')->check(), 'LEGACY-AUTH-02: inactive-admin guard retention confirmed with real SQL.');
    }
    public function testPreviouslyIssuedSessionIsDeniedAfterRealSqlDeactivationAndApiGuardSurvives()
    {
        $this->post('/admin/authenticate', ['email' => 'creator@example.invalid', 'password' => 'SyntheticPassword42'])->assertRedirect('admin/dashboard');
        $guard = Auth::guard('admins');
        $sessionName = $guard->getName();
        $session = session($sessionName);
        $this->assertSame(700002, (int) $session);
        $apiUser = \App\Models\User::findOrFail(700001);
        Auth::guard('api')->setUser($apiUser);
        $this->sql->table('imagefootage_admins')->where('id', 700002)->update(['admin_status' => 'I']);
        // A new request resolves the session identity again instead of retaining a test-cached model.
        $apiGuard = Auth::guard('api');
        $manager = new \Illuminate\Auth\AuthManager($this->app);
        $manager->extend('jwt', function () use ($apiGuard) { return $apiGuard; });
        Auth::swap($manager);
        Auth::guard('api')->setUser($apiUser);
        $guard = Auth::guard('admins');
        $this->get('/admin/dashboard')->assertRedirect('/admin/login');
        $this->assertFalse($guard->check());
        $this->assertNull(session($sessionName));
        $this->assertSame(700001, (int) Auth::guard('api')->id());
    }

}
