<?php
namespace Tests\Unit;

use Tests\Support\Isolation;
use Tests\TestCase;

class IsolationTest extends TestCase
{
    /** @dataProvider unsafeSettings */
    public function testDatabaseGuardRefusesUnsafeConfiguration($kind, array $settings)
    {
        $this->expectException(\RuntimeException::class);
        Isolation::databaseSettings($kind, $settings);
    }

    public function unsafeSettings()
    {
        return [
            ['mysql', ['HOST' => 'db.production.invalid']], ['mysql', ['DATABASE' => 'imagefootage']],
            ['mysql', ['USERNAME' => 'root']], ['mysql', ['PORT' => 3306]],
            ['mongo', ['HOST' => 'localhost']], ['mongo', ['DATABASE' => 'admin']],
            ['mongo', ['PORT' => 27017]], ['mysql', ['ENABLED' => '1']],
        ];
    }

    public function testApplicationUsesOnlyPrivateTestStorageAndDiscardTransports()
    {
        $this->assertSame('testing', app()->environment());
        $this->assertSame(Isolation::$root.'/storage', storage_path());
        $this->assertSame(Isolation::$root.'/public', public_path());
        $this->assertSame('array', config('mail.driver'));
        $this->assertSame('array', config('cache.default'));
        $this->assertNotContains('https', stream_get_wrappers());
        $this->assertContains('curl_exec', explode(',', ini_get('disable_functions')));
        $this->assertContains('proc_open', explode(',', ini_get('disable_functions')));
        $this->assertSame('127.0.0.1', config('database.connections.mysql.host'));
    }
}
