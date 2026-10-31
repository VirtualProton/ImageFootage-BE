<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;

trait CreatesApplication
{
    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->useEnvironmentPath(\Tests\Support\Isolation::$root.'/environment');
        $app->loadEnvironmentFrom('.env.testing');
        $app->useStoragePath(\Tests\Support\Isolation::$root.'/storage');
        $app->instance('path.public', \Tests\Support\Isolation::$root.'/public');
        $app->afterBootstrapping(\Illuminate\Foundation\Bootstrap\LoadConfiguration::class, function ($app) {
            \Tests\Support\Isolation::configure($app);
        });

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }
}
