<?php
namespace Tests\Support;

// Deliberately only SELECT fixtures. This tests HTTP/guard contracts, never SQL correctness.
class ReadFixtureConnection extends \Illuminate\Database\MySqlConnection
{
    public $queries = [];
    private $fixture;

    public function __construct(callable $fixture)
    {
        parent::__construct(function () {
            throw new \RuntimeException('Unconfigured database operation forbidden in mocked-persistence tests.');
        }, 'imagefootage_phase2_test');
        $this->fixture = $fixture;
    }

    public function select($query, $bindings = [], $useReadPdo = true)
    {
        $this->queries[] = compact('query', 'bindings');
        return call_user_func($this->fixture, $query, $bindings);
    }

    public static function authentication($app, $disabled = false)
    {
        $password = password_hash('SyntheticPassword42', PASSWORD_BCRYPT, ['cost' => 4]);
        $connection = new self(function ($query, $bindings) use ($password, $disabled) {
            if (strpos($query, '`imagefootage_user_package`') !== false) {
                return [];
            }
            if (strpos($query, '`imagefootage_users`') !== false && strpos($query, 'exists(') !== false) {
                return [(object) ['exists' => 0]];
            }
            if (preg_match('/`imagefootage_(admins|users)`/', $query, $match)) {
                if (!in_array('synthetic@example.invalid', $bindings, true) && !in_array(700001, $bindings, false)) {
                    return [];
                }
                return [(object) ['id' => 700001, 'email' => 'synthetic@example.invalid', 'password' => $password,
                    'first_name' => 'Synthetic', 'name' => 'Synthetic Admin', 'last_name' => 'Fixture',
                    'admin_status' => $disabled ? 'I' : 'A', 'role_id' => 1, 'department_id' => 1,
                    'remember_token' => null, 'status' => '1']];
            }
            throw new \RuntimeException('Unconfigured SELECT fixture; review test persistence boundary.');
        });
        $app['db']->purge('mysql');
        $app['config']->set('database.connections.mysql.driver', 'phase2-fixture');
        $app['db']->extend('phase2-fixture', function () use ($connection) { return $connection; });
        return $connection;
    }
}
