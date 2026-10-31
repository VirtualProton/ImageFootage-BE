<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();
        \Tests\Support\GatewayTransport::install();
        \Carbon\Carbon::setTestNow(\Carbon\Carbon::parse('2026-10-29 12:00:00', 'UTC'));
        \Illuminate\Support\Facades\Mail::fake();
        \Illuminate\Support\Facades\Queue::fake();
        $this->app->instance(\App\Services\Sms\SmsService::class, \Mockery::mock(\App\Services\Sms\SmsService::class));
        $this->app->instance(\Elasticsearch\Client::class, \Mockery::mock(\Elasticsearch\Client::class));
    }

    protected function tearDown(): void
    {
        \Carbon\Carbon::setTestNow();
        try {
            parent::tearDown();
        } finally {
            \Mockery::close();
        }
    }
}
