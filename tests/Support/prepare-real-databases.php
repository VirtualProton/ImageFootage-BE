<?php
// Operator setup for NEW, private, positively identified local runtimes only. Never loads .env.
if (PHP_SAPI !== 'cli' || empty($argv[1])) { throw new RuntimeException('Private runtime manifest required.'); }
$private = json_decode(file_get_contents($argv[1]), true);
set_exception_handler(function ($exception) {
    fwrite(STDERR, 'Disposable provisioning failed ('.get_class($exception).'); inspect fixture/schema step without exposing credentials.' . PHP_EOL);
    exit(1);
});
$workspace = realpath($private['workspace']);
$temp = realpath(sys_get_temp_dir());
if (!$workspace || strpos(str_replace('\\', '/', $workspace), str_replace('\\', '/', $temp).'/imagefootage-phase22-') !== 0) {
    throw new RuntimeException('Refusing non-disposable runtime directory.');
}
require dirname(__DIR__, 2).'/vendor/autoload.php';
try {
    $pdo = new PDO('mysql:host=127.0.0.1;port=3307;charset=utf8mb4', 'root', $private['root_password'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (PDOException $exception) {
    $pdo = new PDO('mysql:host=127.0.0.1;port=3307;charset=utf8mb4', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
}
$actual = $pdo->query('select @@datadir')->fetchColumn();
if (strtolower(rtrim(str_replace('\\', '/', $actual), '/')) !== strtolower(str_replace('\\', '/', $workspace).'/mysql-data')) {
    throw new RuntimeException('MySQL data directory does not identify this disposable runtime.');
}
if ((int) $pdo->query("select count(*) from information_schema.schemata where schema_name='imagefootage_phase2_test'")->fetchColumn() !== 0) {
    if (!in_array('--reset-disposable', $argv, true)) {
        throw new RuntimeException('Existing test schema; explicit --reset-disposable and verified data directory required.');
    }
    // Literal target, after exact private-data-directory validation above; never a computed database name.
    $pdo->exec('DROP DATABASE imagefootage_phase2_test');
    $pdo->exec("DROP USER IF EXISTS 'phase2_test'@'127.0.0.1'");
}
$pdo->exec("CREATE DATABASE imagefootage_phase2_test CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
$pdo->exec("CREATE USER 'phase2_test'@'127.0.0.1' IDENTIFIED BY ".$pdo->quote($private['mysql_password']));
$pdo->exec("GRANT SELECT, INSERT, UPDATE, DELETE ON imagefootage_phase2_test.* TO 'phase2_test'@'127.0.0.1'");
$pdo->exec("ALTER USER 'root'@'localhost' IDENTIFIED BY ".$pdo->quote($private['root_password']));
$pdo = new PDO('mysql:host=127.0.0.1;port=3307;dbname=imagefootage_phase2_test;charset=utf8mb4', 'root', $private['root_password'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
$pdo->exec("SET SESSION sql_mode='NO_ENGINE_SUBSTITUTION'");
$connection = new Illuminate\Database\MySqlConnection($pdo, 'imagefootage_phase2_test', '', ['prefix' => '', 'charset' => 'utf8mb4', 'collation' => 'utf8mb4_unicode_ci']);
$container = new Illuminate\Container\Container();
$container->instance('db.schema', $connection->getSchemaBuilder());
$container->instance('db', new class($connection) {
    private $connection;
    public function __construct($connection) { $this->connection = $connection; }
    public function connection() { return $this->connection; }
    public function __call($method, $arguments) { return $this->connection->$method(...$arguments); }
});
Illuminate\Support\Facades\Facade::setFacadeApplication($container);
$names = [
    '2023_08_08_052444_create_promo_codes_table.php',
    '2023_08_08_051827_create_imagefootage_performa_invoices_table.php',
    '2023_08_08_051827_create_imagefootage_performa_invoice_items_table.php',
    '2023_08_08_051827_create_imagefootage_admins_table.php',
    '2023_08_08_051827_create_imagefootage_users_table.php',
    '2023_08_08_051827_create_imagefootage_api_table.php',
    '2023_08_08_051827_create_imagefootage_products_table.php',
    '2023_08_08_051827_create_countries_table.php',
    '2023_08_08_051827_create_states_table.php',
    '2023_08_08_051827_create_cities_table.php',
    '2023_08_08_051827_create_email_templates_table.php',
    '2023_08_08_051827_create_imagefootage_user_package_table.php',
    '2023_08_08_051827_create_jobs_table.php',
    '2024_03_22_104400_create_failed_jobs_table.php',
    '2024_04_17_000001_add_currency_to_imagefootage_performa_invoices_table.php',
    '2024_01_24_081406_add_column_extra_details_in_performa_invoice_items.php',
    '2024_03_11_121651_create_column_vendor_code_in_users_table.php',
    '2026_04_28_100000_add_discount_amount_to_imagefootage_performa_invoices_table.php',
    '2026_04_29_170000_add_package_extended_expiry_data_to_imagefootage_user_package_table.php',
];
foreach ($names as $name) {
    $file = dirname(__DIR__, 2).'/database/migrations/'.$name;
    $source = file_get_contents($file);
    preg_match('/class\s+(\w+)\s+extends\s+Migration/', $source, $match);
    require_once $file;
    (new $match[1]())->up();
}
// Explicit fixture-only schema deltas used by current Product code; production migrations are unchanged.
// Later historical product migrations perform unrelated data rewrites, so they are not run wholesale.
$schema = $connection->getSchemaBuilder();
$schema->table('imagefootage_products', function ($table) {
    $table->integer('adult_content')->nullable();
    $table->string('slug')->nullable();
    $table->integer('is_premium')->nullable();
    $table->text('search_terms')->nullable();
    $table->dateTime('expired_date')->nullable();
});
$mongo = new MongoDB\Driver\Manager('mongodb://127.0.0.1:27018', ['serverSelectionTimeoutMS' => 2000]);
$mongo->executeCommand('admin', new MongoDB\Driver\Command(['createUser' => 'phase22_admin', 'pwd' => $private['mongo_admin_password'], 'roles' => ['root']]));
$mongo = new MongoDB\Driver\Manager('mongodb://127.0.0.1:27018/admin', ['username' => 'phase22_admin', 'password' => $private['mongo_admin_password'], 'serverSelectionTimeoutMS' => 2000]);
$options = $mongo->executeCommand('admin', new MongoDB\Driver\Command(['getCmdLineOpts' => 1]))->toArray()[0];
if (strtolower(str_replace('\\', '/', $options->parsed->storage->dbPath)) !== strtolower(str_replace('\\', '/', $workspace).'/mongo-data')) {
    throw new RuntimeException('MongoDB data directory does not identify disposable runtime.');
}
$mongo->executeCommand('imagefootage_phase2_test', new MongoDB\Driver\Command(['createUser' => 'phase2_test', 'pwd' => $private['mongo_password'], 'roles' => [['role' => 'readWrite', 'db' => 'imagefootage_phase2_test']]]));
$mongo->executeCommand('imagefootage_phase2_test', new MongoDB\Driver\Command(['create' => 'image_filter_values']));
file_put_contents($workspace.'/schema-provenance.json', json_encode(['migrations' => $names, 'fixture_only_product_columns' => ['adult_content', 'slug', 'is_premium', 'search_terms', 'expired_date'], 'mysql_version' => $pdo->query('select version()')->fetchColumn(), 'mongo_version' => $mongo->executeCommand('admin', new MongoDB\Driver\Command(['buildInfo' => 1]))->toArray()[0]->version], JSON_PRETTY_PRINT));
echo "Disposable schema/accounts ready; credentials withheld.\n";
