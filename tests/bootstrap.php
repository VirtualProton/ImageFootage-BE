<?php
require_once __DIR__.'/Support/Isolation.php';
Tests\Support\Isolation::bootstrap();
require_once dirname(__DIR__).'/vendor/autoload.php';
// Works with the existing optimized Composer loader without regenerating vendor metadata.
spl_autoload_register(function ($class) {
    if (strpos($class, 'Tests\\') === 0) {
        $path = __DIR__.'/'.str_replace('\\', '/', substr($class, 6)).'.php';
        if (is_file($path)) {
            require_once $path;
        }
    }
}, true, true);
