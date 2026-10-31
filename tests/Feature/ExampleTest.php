<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExistingAdminLoginPageIsPublic()
    {
        // routes/web.php has /admin/login; there is no unconditional root route.
        $response = $this->get('/admin/login');

        $response->assertStatus(200);
        $response->assertSee('password');
    }

    public function testRootIsAbsentWithTheIsolatedNonRootLogRoute()
    {
        $this->get('/')->assertStatus(404);
    }
}
