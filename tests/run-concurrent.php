<?php
// Supervisor only: children use the unchanged restricted runner and synthetic provider/mail/storage sinks.
// Usage: php tests/run-concurrent.php <private manifest> <evidence.json>
set_exception_handler(function ($e) { fwrite(STDERR, 'Concurrent fixture verification failed ('.get_class($e).'); private details withheld.'.PHP_EOL); exit(2); });
$private = json_decode(file_get_contents($argv[1]), true);
$workspace = realpath($private['workspace']);
if (!$workspace || strpos(str_replace('\\', '/', $workspace), str_replace('\\', '/', realpath(sys_get_temp_dir())).'/imagefootage-phase22-') !== 0) { throw new RuntimeException('Unsafe directory'); }
$pdo = new PDO('mysql:host=127.0.0.1;port=3307;dbname=imagefootage_phase2_test', 'root', $private['root_password'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
if (strtolower(rtrim(str_replace('\\', '/', $pdo->query('select @@datadir')->fetchColumn()), '/')) !== strtolower(str_replace('\\', '/', $workspace).'/mysql-data')) { throw new RuntimeException('Unsafe runtime'); }
$tables = $pdo->query('show tables')->fetchAll(PDO::FETCH_COLUMN);
foreach ($tables as $table) {
    if (!preg_match('/^[a-zA-Z0-9_]+$/', $table) || (int) $pdo->query('select count(*) from `'.$table.'`')->fetchColumn() !== 0) { throw new RuntimeException('Fixture must start empty'); }
}
$start = function ($directory, $job, $status, $completed) use ($argv, $workspace) {
    $env = getenv(); $env['PHASE2_CALLBACK_WORKSPACE'] = $workspace; $env['PHASE2_CALLBACK_DIRECTORY'] = $directory;
    $env['PHASE2_CALLBACK_JOB'] = $job; $env['PHASE2_CALLBACK_STATUS'] = $status; $env['PHASE2_CALLBACK_COMPLETED'] = $completed ? '1' : '0';
    $process = proc_open([PHP_BINARY, __DIR__.'/run-real.php', $argv[1], __DIR__.'/Fixtures/ConcurrentCallbackWorkerTest.php',
        '--log-junit', $directory.'/'.$job.'.xml'], [0 => ['pipe', 'r'], 1 => ['file', $directory.'/'.$job.'.log', 'w'], 2 => ['file', $directory.'/'.$job.'.err', 'w']], $pipes, dirname(__DIR__), $env);
    if (!is_resource($process)) { throw new RuntimeException('Worker unavailable'); }
    fclose($pipes[0]); return $process;
};
$finish = function ($process) {
    $deadline = microtime(true) + 45;
    do {
        $status = proc_get_status($process);
        if (!$status['running']) { proc_close($process); if ($status['exitcode'] !== 0) { throw new RuntimeException('Worker failed'); } return; }
        usleep(50000);
    } while (microtime(true) < $deadline);
    proc_terminate($process); proc_close($process); throw new RuntimeException('Worker timed out');
};
$results = []; $processes = [];
try {
    foreach ([['duplicate-paid', 'paid', 'paid', false], ['completed-paid-pending', 'paid', 'pending', true], ['completed-failed-paid', 'cancelled', 'paid', true]] as [$name, $a, $b, $completed]) {
        $directory = $workspace.'/callbacks-'.bin2hex(random_bytes(6)); mkdir($directory, 0700);
        $finish($start($directory, 'seed', 'paid', $completed));
        $invoice = json_decode(file_get_contents($directory.'/invoice.json'), true);
        $pdo->beginTransaction();
        $lock = $pdo->prepare('select id from imagefootage_performa_invoices where id = ? for update'); $lock->execute([$invoice['id']]);
        $processes = [$start($directory, 'a', $a, $completed), $start($directory, 'b', $b, $completed)];
        $deadline = microtime(true) + 25; $overlap = false;
        do {
            if (is_file($directory.'/a.ready') && is_file($directory.'/b.ready')) {
                $ids = [(int) file_get_contents($directory.'/a.ready'), (int) file_get_contents($directory.'/b.ready')];
                $waits = $pdo->query('select trx_mysql_thread_id from information_schema.innodb_trx where trx_state = "LOCK WAIT"')->fetchAll(PDO::FETCH_COLUMN);
                $overlap = count(array_intersect($ids, array_map('intval', $waits))) === 2;
                if ($overlap) { break; }
            }
            usleep(100000);
        } while (microtime(true) < $deadline);
        $pdo->commit();
        foreach ($processes as $process) { $finish($process); } $processes = [];
        if (!$overlap) { throw new RuntimeException('Actual simultaneous lock wait not established'); }
        $row = $pdo->query('select status, payment_status, proforma_type from imagefootage_performa_invoices')->fetch(PDO::FETCH_ASSOC);
        $totals = ['mail' => 0, 'uploads' => 0];
        foreach (['a', 'b'] as $job) { $r = json_decode(file_get_contents($directory.'/'.$job.'.result'), true); foreach ($totals as $key => &$value) { $value += $r[$key]; } unset($value); }
        $expected = $completed ? 0 : 1;
        $invoiceCount = (int) $pdo->query('select count(*) from imagefootage_performa_invoices')->fetchColumn();
        $items = (int) $pdo->query('select count(*) from imagefootage_performa_invoice_items')->fetchColumn();
        if ((int) $row['status'] !== 1 || $row['payment_status'] !== 'Transction Success' || (int) $row['proforma_type'] !== 2
            || $totals !== ['mail' => $expected, 'uploads' => $expected] || $invoiceCount !== 1 || $items !== 1) { throw new RuntimeException('Concurrent invariant failed'); }
        $results[] = ['scenario' => $name, 'status' => 'PASS', 'simultaneous_sql_lock_waits' => 2,
            'invoice_count' => $invoiceCount, 'item_count' => $items, 'callback_notifications' => $totals['mail'], 'callback_artifacts' => $totals['uploads'], 'final_state' => $row];
        foreach (array_reverse($tables) as $table) { $pdo->exec('delete from `'.$table.'`'); }
    }
} finally {
    if ($pdo->inTransaction()) { $pdo->rollBack(); }
    foreach ($processes as $process) { if (is_resource($process)) { proc_terminate($process); proc_close($process); } }
    // Only the positively identified, initially empty, dedicated schema is cleaned.
    foreach (array_reverse($tables) as $table) { $pdo->exec('delete from `'.$table.'`'); }
}
file_put_contents($argv[2], json_encode(['scenarios' => $results, 'all_passed' => count($results) === 3,
    'scope' => 'Actual concurrent PHP callbacks, MySQL row locks, Common conversion, Dompdf and synthetic Swift/cloud/provider sinks; no crash-recovery exactly-once claim.'], JSON_PRETTY_PRINT));
echo 'Concurrent scenarios: '.count($results).' PASS'.PHP_EOL;
