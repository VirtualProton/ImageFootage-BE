<?php
namespace Tests\Support;

// SQL compilation/delegation observer only. Does not emulate transactions or execute SQL.
class ObservedConnection extends \Illuminate\Database\MySqlConnection
{
    public $writes = [];
    public $reads = [];
    public $rows = [];
    public $affected = 1;

    public function __construct($app)
    {
        parent::__construct(function () { throw new \RuntimeException('Unexpected PDO request refused.'); }, 'imagefootage_phase2_test');
        $app['db']->purge('mysql');
        $app['config']->set('database.connections.mysql.driver', 'phase2-observer');
        $app['db']->extend('phase2-observer', function () { return $this; });
    }

    public function select($query, $bindings = [], $useReadPdo = true)
    {
        $this->reads[] = compact('query', 'bindings');
        return $this->rows;
    }

    public function affectingStatement($query, $bindings = [])
    {
        if (stripos(ltrim($query), 'update ') !== 0) {
            throw new \RuntimeException('Only explicit UPDATE observation is allowed.');
        }
        $this->writes[] = compact('query', 'bindings');
        return $this->affected;
    }
}
