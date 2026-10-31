<?php
// Always start a fresh process: PHP network/process restrictions cannot be safely set at runtime.
$root = dirname(__DIR__);
$environment = [];
foreach (['PATH', 'Path', 'SystemRoot', 'SYSTEMROOT', 'WINDIR', 'TEMP', 'TMP', 'COMSPEC', 'PATHEXT'] as $key) {
    if (getenv($key) !== false) {
        $environment[$key] = getenv($key);
    }
}
foreach (getenv() as $key => $value) {
    if (strpos($key, 'PHASE2_') === 0) {
        $environment[$key] = $value;
    }
}
$environment['APP_ENV'] = 'testing';
$environment['PHASE2_RUNNER'] = '1';
$disabled = 'curl_exec,curl_multi_exec,fsockopen,pfsockopen,stream_socket_client,stream_socket_server,mail,exec,shell_exec,system,passthru,proc_open,popen,pcntl_exec';
$command = [PHP_BINARY, '-d', 'memory_limit=512M', '-d', 'allow_url_fopen=0', '-d', 'disable_functions='.$disabled,
    __DIR__.'/phpunit-entry.php', '--configuration', $root.'/phpunit.xml'];
foreach (array_slice($argv, 1) as $argument) {
    if (preg_match('/^(--(configuration|bootstrap|env|no-configuration|process-isolation)|-c)/', $argument)) {
        fwrite(STDERR, "Refusing test bootstrap/configuration overrides.\n");
        exit(2);
    }
    $command[] = $argument;
}
$process = proc_open($command, [0 => STDIN, 1 => STDOUT, 2 => STDERR], $pipes, $root, $environment);
if (!is_resource($process)) {
    fwrite(STDERR, "Unable to start isolated regression runner.\n");
    exit(2);
}
exit(proc_close($process));
