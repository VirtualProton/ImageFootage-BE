<?php
namespace Tests\Integration;

use Illuminate\Support\Facades\DB;
use Tests\Support\MySqlTestCase;
use Tests\Support\Isolation;

class SqlConcurrencyQueueIntegrationTest extends MySqlTestCase
{
    public function testSecondRealConnectionCannotUpdateLockedInvoiceBeforeRollback()
    {
        $invoice = $this->invoice();
        // Commit synthetic row only after the base class has positively checked the empty disposable schema.
        $this->sql->commit();
        $other = new \PDO('mysql:host=127.0.0.1;port=3307;dbname=imagefootage_phase2_test;charset=utf8mb4',
            'phase2_test', Isolation::$mysql['password'], [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);
        $this->assertNotSame((int) $this->sql->selectOne('select connection_id() as id')->id, (int) $other->query('select connection_id()')->fetchColumn());
        $other->exec('SET SESSION innodb_lock_wait_timeout=1');
        try {
            $this->sql->beginTransaction();
            $this->sql->table('imagefootage_performa_invoices')->where('id', $invoice->id)->lockForUpdate()->first();
            $blocked = false;
            try {
                $statement = $other->prepare('update imagefootage_performa_invoices set status=1 where id=?');
                $statement->execute([$invoice->id]);
            } catch (\PDOException $exception) {
                $this->assertSame(1205, (int) $exception->errorInfo[1]);
                $blocked = true;
            }
            $this->assertTrue($blocked);
            $this->sql->rollBack();
            $statement = $other->prepare('update imagefootage_performa_invoices set status=1 where id=?');
            $statement->execute([$invoice->id]);
            $this->assertSame(1, $statement->rowCount());
        } finally {
            while ($this->sql->transactionLevel()) { $this->sql->rollBack(); }
            $statement = $other->prepare('delete from imagefootage_performa_invoices where id=?');
            $statement->execute([$invoice->id]);
        }
        // Engine locking primitive, not a claim that current payment handler acquires this lock.
    }

    public function testLegacyInvoiceNumberHasNoUniqueConstraintInVerifiedFixture()
    {
        $this->invoice(['invoice_name' => 'PHASE22-DUPLICATE']);
        $this->invoice(['invoice_name' => 'PHASE22-DUPLICATE']);
        $this->assertSame(2, $this->sql->table('imagefootage_performa_invoices')->where('invoice_name', 'PHASE22-DUPLICATE')->count());
        $primary = $this->sql->select("show index from imagefootage_performa_invoices where Key_name='PRIMARY'");
        $this->assertNotEmpty($primary);
        // Observed schema behavior; duplicate-number prevention is not certified.
    }

    public function testActualDatabaseQueueReservationReleaseRetryAndAcknowledgement()
    {
        $queue = new \Illuminate\Queue\DatabaseQueue($this->sql, 'jobs', 'phase22', 90);
        $queue->setContainer($this->app);
        $id = $queue->pushRaw(json_encode(['job' => 'Tests\\Support\\FixtureQueuedJob@fire', 'data' => ['fixture' => 'phase22']]));
        $first = $queue->pop('phase22');
        $this->assertSame((string) $id, (string) $first->getJobId());
        $this->assertSame(1, $first->attempts());
        $first->release(0);
        $retried = $queue->pop('phase22');
        $this->assertSame(2, $retried->attempts());
        $retried->fire();
        $this->assertTrue($retried->isDeleted());
        $this->assertSame(0, $this->sql->table('jobs')->count());
    }

    public function testFailedJobProviderPersistsSyntheticFailureWithoutWorker()
    {
        $provider = new \Illuminate\Queue\Failed\DatabaseFailedJobProvider($this->app['db'], 'mysql', 'failed_jobs');
        $provider->log('mysql', 'phase22', json_encode(['displayName' => 'Synthetic failure']), new \RuntimeException('Synthetic isolated queue failure'));
        $row = $this->sql->table('failed_jobs')->first();
        $this->assertSame('phase22', $row->queue);
        $this->assertContains('Synthetic isolated queue failure', $row->exception);
        $this->assertSame(1, count($provider->all()));
    }
}
