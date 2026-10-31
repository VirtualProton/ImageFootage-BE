<?php
namespace Tests\Support;

use Illuminate\Support\Facades\DB;
use Tests\TestCase;

abstract class MySqlTestCase extends TestCase
{
    protected $sql;

    protected function setUp(): void
    {
        parent::setUp();
        if (!Isolation::$mysql['enabled']) {
            $this->markTestSkipped('BLOCKED: dedicated MySQL fixture not enabled; see phase-2/02_TEST_ENVIRONMENT.md.');
        }
        try {
            $this->sql = DB::connection('mysql');
            $this->sql->getPdo();
        } catch (\PDOException $exception) {
            $this->sql = null;
            $this->markTestSkipped('BLOCKED: loopback-only MySQL fixture unavailable (credentials/details withheld).');
        }
        $this->assertSame('imagefootage_phase2_test', $this->sql->selectOne('select database() as name')->name);
        $currentUser = $this->sql->selectOne('select current_user() as name')->name;
        $this->assertSame('phase2_test', explode('@', $currentUser)[0], 'Unexpected DB principal; refusing fixture writes.');
        $this->assertSame(0, (int) $this->sql->selectOne('select count(*) as n from information_schema.events where event_schema = database()')->n,
            'Test schema must not contain scheduled events.');
        $this->assertSame(0, (int) $this->sql->selectOne('select count(*) as n from information_schema.triggers where trigger_schema = database()')->n,
            'Unreviewed triggers are forbidden in fixture schema.');
        foreach (['promo_codes', 'imagefootage_performa_invoices', 'imagefootage_performa_invoice_items'] as $table) {
            $metadata = $this->sql->selectOne('select engine as engine from information_schema.tables where table_schema = database() and table_name = ?', [$table]);
            if (!$metadata) {
                $this->markTestSkipped('BLOCKED: empty schema-only fixture missing required application table '.$table.'.');
            }
            $this->assertSame('InnoDB', $metadata->engine, 'Rollback requires transactional tables.');
            $this->assertSame(0, $this->sql->table($table)->count(), 'Refusing nonempty fixture table; never use customer data.');
        }
        $this->sql->beginTransaction();
    }

    protected function tearDown(): void
    {
        try {
            if ($this->sql) {
                while ($this->sql->transactionLevel() > 0) {
                    $this->sql->rollBack();
                }
            }
        } finally {
            parent::tearDown();
        }
    }

    protected function invoice(array $changes = [])
    {
        $invoice = new \App\Models\Invoice();
        $invoice->forceFill(array_merge(['user_id' => 700001, 'invoice_name' => 'PHASE2-700001',
            'created' => '2026-10-29 12:00:00', 'modified' => '2026-10-29 12:00:00',
            'tax' => '18.00', 'total' => '118.00', 'status' => 0, 'proforma_type' => 1], $changes));
        $invoice->save();
        return $invoice;
    }
}
