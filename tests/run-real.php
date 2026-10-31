<?php
// Explicit opt-in wrapper for the positively identified disposable runtimes created for Phase 2.2.
if (empty($argv[1])) { fwrite(STDERR, "Usage: php tests/run-real.php <private-runtime-manifest> [PHPUnit options]\n"); exit(2); }
$private = json_decode(file_get_contents($argv[1]), true);
set_exception_handler(function ($exception) {
    fwrite(STDERR, 'Verified local test runtime unavailable or unsafe ('.get_class($exception).'); credentials withheld.' . PHP_EOL);
    exit(2);
});
$workspace = realpath($private['workspace']);
if (!$workspace || strpos(str_replace('\\', '/', $workspace), str_replace('\\', '/', realpath(sys_get_temp_dir())).'/imagefootage-phase22-') !== 0) {
    throw new RuntimeException('Unsafe runtime directory refused.');
}
$pdo = new PDO('mysql:host=127.0.0.1;port=3307;dbname=imagefootage_phase2_test', 'phase2_test', $private['mysql_password']);
if (strtolower(rtrim(str_replace('\\', '/', $pdo->query('select @@datadir')->fetchColumn()), '/')) !== strtolower(str_replace('\\', '/', $workspace).'/mysql-data')) {
    throw new RuntimeException('MySQL runtime identity mismatch.');
}
$mongo = new MongoDB\Driver\Manager('mongodb://127.0.0.1:27018/admin', ['username' => 'phase22_admin', 'password' => $private['mongo_admin_password'], 'serverSelectionTimeoutMS' => 2000]);
$options = $mongo->executeCommand('admin', new MongoDB\Driver\Command(['getCmdLineOpts' => 1]))->toArray()[0];
if (strtolower(str_replace('\\', '/', $options->parsed->storage->dbPath)) !== strtolower(str_replace('\\', '/', $workspace).'/mongo-data') || $options->parsed->net->bindIp !== '127.0.0.1') {
    throw new RuntimeException('MongoDB runtime identity/bind address mismatch.');
}
$environment = getenv();
$environment['PHASE2_MYSQL_ENABLED'] = $environment['PHASE2_MONGO_ENABLED'] = '1';
$environment['PHASE2_MYSQL_PASSWORD'] = $private['mysql_password'];
$environment['PHASE2_MONGO_PASSWORD'] = $private['mongo_password'];
$command = array_merge([PHP_BINARY, __DIR__.'/run.php'], array_slice($argv, 2));
$process = proc_open($command, [0 => STDIN, 1 => STDOUT, 2 => STDERR], $pipes, dirname(__DIR__), $environment);
if (!is_resource($process)) { throw new RuntimeException('Unable to start isolated test runner.'); }
exit(proc_close($process));
