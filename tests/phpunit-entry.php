<?php
if (getenv('PHASE2_RUNNER') !== '1' || getenv('APP_ENV') !== 'testing') {
    fwrite(STDERR, "Use php tests/run.php; direct execution is refused.\n");
    exit(2);
}
define('PHPUNIT_COMPOSER_INSTALL', dirname(__DIR__).'/vendor/autoload.php');
require PHPUNIT_COMPOSER_INSTALL;
PHPUnit\TextUI\Command::main();
