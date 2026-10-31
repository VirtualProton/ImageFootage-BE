<?php
namespace Tests\Support;

use RuntimeException;

final class Isolation
{
    public static $root;
    public static $mysql;
    public static $mongo;

    public static function databaseSettings($kind, array $options)
    {
        if (!in_array($kind, ['mysql', 'mongo'], true) || !in_array($options['ENABLED'] ?? '0', ['0', '1'], true)) {
            throw new RuntimeException('Unrecognized test database configuration.');
        }
        $defaultPort = $kind === 'mysql' ? 3307 : 27018;
        $settings = [
            'enabled' => ($options['ENABLED'] ?? '0') === '1',
            'host' => $options['HOST'] ?? '127.0.0.1',
            'port' => (int) ($options['PORT'] ?? $defaultPort),
            'database' => $options['DATABASE'] ?? 'imagefootage_phase2_test',
            'username' => $options['USERNAME'] ?? 'phase2_test',
            'password' => $options['PASSWORD'] ?? '',
        ];
        if ($settings['host'] !== '127.0.0.1' || $settings['database'] !== 'imagefootage_phase2_test'
            || $settings['username'] !== 'phase2_test' || $settings['port'] !== $defaultPort
            || ($settings['enabled'] && $settings['password'] === '')) {
            throw new RuntimeException('Unsafe '.$kind.' test configuration refused (values withheld).');
        }
        return $settings;
    }

    public static function bootstrap()
    {
        if (getenv('APP_ENV') !== 'testing' || getenv('PHASE2_RUNNER') !== '1') {
            throw new RuntimeException('Use php tests/run.php; APP_ENV must be testing.');
        }
        $disabled = array_map('trim', explode(',', ini_get('disable_functions')));
        foreach (['curl_exec', 'curl_multi_exec', 'fsockopen', 'pfsockopen', 'stream_socket_client', 'mail', 'proc_open', 'exec', 'shell_exec', 'system', 'passthru', 'popen'] as $function) {
            if (!in_array($function, $disabled, true)) {
                throw new RuntimeException('External side effects are not disabled; use the isolated runner.');
            }
        }
        if (filter_var(ini_get('allow_url_fopen'), FILTER_VALIDATE_BOOLEAN)) {
            throw new RuntimeException('URL fopen must be disabled before tests start.');
        }
        foreach (['mysql', 'mongo'] as $kind) {
            $options = [];
            foreach (['ENABLED', 'HOST', 'PORT', 'DATABASE', 'USERNAME', 'PASSWORD'] as $key) {
                $value = getenv('PHASE2_'.strtoupper($kind).'_'.$key);
                if ($value !== false) {
                    $options[$key] = $value;
                }
            }
            self::${$kind} = self::databaseSettings($kind, $options);
        }
        self::$root = sys_get_temp_dir().'/imagefootage-phase2-'.bin2hex(random_bytes(8));
        foreach (['', '/environment', '/bootstrap', '/public', '/storage/app/public', '/storage/framework/views', '/storage/framework/cache/data', '/storage/framework/sessions', '/storage/logs', '/fonts'] as $suffix) {
            if (!mkdir(self::$root.$suffix, 0700, true) && !is_dir(self::$root.$suffix)) {
                throw new RuntimeException('Cannot create private test workspace.');
            }
        }
        file_put_contents(self::$root.'/environment/.env.testing', "APP_ENV=testing\n");
        $safe = [
            'APP_ENV' => 'testing', 'APP_DEBUG' => 'false', 'APP_NAME' => 'Phase2Regression',
            'APP_URL' => 'http://phase2.invalid', 'FRONT_END_URL' => 'http://phase2.invalid',
            'APP_KEY' => 'base64:'.base64_encode(str_repeat('T', 32)),
            'JWT_SECRET' => str_repeat('phase2-synthetic-key-', 4), 'JWT_TTL' => '60',
            'LOG_CHANNEL' => 'single', 'CACHE_DRIVER' => 'array', 'MAIL_DRIVER' => 'array',
            'QUEUE_CONNECTION' => 'sync', 'SESSION_DRIVER' => 'array', 'BCRYPT_ROUNDS' => '4',
            'FILESYSTEM_DRIVER' => 'local', 'FILESYSTEM_CLOUD' => 'local',
            'RANDOM_PATH_FOR_LOGS' => 'phase2-logs', 'SMS_ENABLED' => 'false',
            'AWS_EC2_METADATA_DISABLED' => 'true', 'AWS_ACCESS_KEY_ID' => 'phase2',
            'AWS_SECRET_ACCESS_KEY' => 'phase2', 'AWS_BUCKET' => 'phase2-invalid',
            'PDF_BROWSERLESS_URL' => '', 'PDF_BROWSERLESS_TOKEN' => '',
            'KEYRAZORID' => 'rzp_test_phase2', 'KEYRAZORSECRET' => 'phase2-synthetic-secret',
            'APP_CONFIG_CACHE' => self::$root.'/bootstrap/config.php',
            'APP_ROUTES_CACHE' => self::$root.'/bootstrap/routes.php',
            'APP_EVENTS_CACHE' => self::$root.'/bootstrap/events.php',
            'APP_SERVICES_CACHE' => self::$root.'/bootstrap/services.php',
            'APP_PACKAGES_CACHE' => self::$root.'/bootstrap/packages.php',
        ];
        foreach ($safe as $key => $value) {
            putenv($key.'='.$value);
            $_ENV[$key] = $_SERVER[$key] = $value;
        }
        foreach (['http', 'https', 'ftp', 'ftps'] as $wrapper) {
            if (in_array($wrapper, stream_get_wrappers(), true)) {
                stream_wrapper_unregister($wrapper);
            }
        }
        date_default_timezone_set('UTC');
    }

    public static function configure($app)
    {
        if ($app->environment() !== 'testing') {
            throw new RuntimeException('Application environment is not testing.');
        }
        $mysql = self::$mysql;
        $mongo = self::$mongo;
        $mysqlConfig = [
            'driver' => 'mysql', 'host' => $mysql['host'], 'port' => $mysql['enabled'] ? $mysql['port'] : 1,
            'database' => $mysql['database'], 'username' => $mysql['username'], 'password' => $mysql['password'],
            'charset' => 'utf8mb4', 'collation' => 'utf8mb4_unicode_ci', 'prefix' => '', 'strict' => false,
            'options' => [\PDO::ATTR_TIMEOUT => 2],
        ];
        $app['config']->set('database', [
            'default' => 'mysql', 'connections' => [
                'mysql' => $mysqlConfig,
                'mongodb' => ['driver' => 'mongodb', 'host' => $mongo['host'],
                    'port' => $mongo['enabled'] ? $mongo['port'] : 1, 'database' => $mongo['database'],
                    'username' => $mongo['username'], 'password' => $mongo['password'],
                    'options' => ['database' => $mongo['database'], 'serverSelectionTimeoutMS' => 1000]],
            ],
            'redis' => ['client' => 'predis', 'default' => ['host' => '127.0.0.1', 'port' => 1, 'database' => 15]],
        ]);
        $app['config']->set('app.url', 'http://phase2.invalid');
        $app['config']->set('app.front_end_url', 'http://phase2.invalid');
        $app['config']->set('app.timezone', 'UTC');
        date_default_timezone_set('UTC');
        $app['config']->set('view.compiled', self::$root.'/storage/framework/views');
        $app['config']->set('logging', ['default' => 'single', 'channels' => [
            'single' => ['driver' => 'single', 'path' => self::$root.'/storage/logs/tests.log'],
            'quotationlog' => ['driver' => 'single', 'path' => self::$root.'/storage/logs/quotation.log'],
        ]]);
        $app['config']->set('filesystems', ['default' => 'local', 'cloud' => 'local', 'disks' => [
            'local' => ['driver' => 'local', 'root' => self::$root.'/storage/app'],
            'public' => ['driver' => 'local', 'root' => self::$root.'/storage/app/public'],
        ]]);
        $app['config']->set('services', ['sms' => ['provider' => 'msg91']]);
        $app['config']->set('aws', []);
        $app['config']->set('thirdparty', []);
        $app['config']->set('payumoney', ['KEY' => 'phase2', 'SALT' => 'phase2', 'MODE' => 'TEST',
            'key' => 'phase2', 'salt' => 'phase2', 'mode' => 'test']);
        foreach (['google', 'facebook'] as $provider) {
            $app['config']->set('constants.'.$provider, []);
        }
        $app['config']->set('constants.GST_VALUE', 18);
        $app['config']->set('payments', ['keyRazorId' => 'rzp_test_phase2', 'keyRazorSecret' => 'phase2-synthetic-secret',
            'atomRequestKey' => 'phase2', 'atomResponseKey' => 'phase2', 'login' => 'phase2',
            'mode' => 'Test', 'password' => 'phase2', 'clientcode' => 'phase2', 'atomprodId' => 'phase2']);
        $app['config']->set('dompdf.options', ['isRemoteEnabled' => false, 'fontDir' => self::$root.'/fonts',
            'fontCache' => self::$root.'/fonts', 'tempDir' => self::$root, 'chroot' => self::$root]);
    }
}
