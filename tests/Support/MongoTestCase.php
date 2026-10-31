<?php
namespace Tests\Support;

use Tests\TestCase;

abstract class MongoTestCase extends TestCase
{
    protected $collection;
    protected $inserted = [];

    protected function setUp(): void
    {
        parent::setUp();
        if (!Isolation::$mongo['enabled']) {
            $this->markTestSkipped('BLOCKED: dedicated MongoDB fixture not enabled; see phase-2/02_TEST_ENVIRONMENT.md.');
        }
        try {
            $db = $this->app['db']->connection('mongodb')->getMongoDB();
            $db->command(['ping' => 1])->toArray();
        } catch (\MongoDB\Driver\Exception\ConnectionException $exception) {
            $this->markTestSkipped('BLOCKED: loopback-only MongoDB fixture unavailable (details withheld).');
        }
        $this->assertSame('imagefootage_phase2_test', $db->getDatabaseName());
        $names = [];
        foreach ($db->listCollections() as $collection) {
            $names[] = $collection->getName();
        }
        if (!in_array('image_filter_values', $names, true)) {
            $this->markTestSkipped('BLOCKED: precreated empty image_filter_values collection required; tests do not create schemas.');
        }
        $this->collection = $db->selectCollection('image_filter_values');
        $this->assertSame(0, $this->collection->countDocuments(), 'Refusing nonempty MongoDB fixture; customer data is forbidden.');
    }

    protected function document($number = 1, $explicitTimestamp = true)
    {
        $model = new \App\Models\ImageFilterValue();
        $id = new \MongoDB\BSON\ObjectId(sprintf('%024x', 700000 + $number));
        $this->inserted[] = $id;
        $model->forceFill(['_id' => $id, 'api_product_id' => 'PHASE2-'.$number,
            'product_id' => 700000 + $number, 'product_main_type' => 'Image',
            'attributes' => ['color' => $number === 1 ? 'red' : 'blue'], 'options' => ['size' => 'large']]);
        if ($explicitTimestamp) {
            // Legacy freshTimestamp() calls time(), which Carbon::setTestNow does not freeze.
            $model->created_at = \Carbon\Carbon::parse('2026-10-29 12:00:00', 'UTC');
            $model->updated_at = \Carbon\Carbon::parse('2026-10-29 12:00:00', 'UTC');
        }
        $model->save();
        return $model;
    }

    protected function tearDown(): void
    {
        try {
            if ($this->collection && $this->inserted) {
                $this->collection->deleteMany(['_id' => ['$in' => $this->inserted]]);
            }
        } finally {
            parent::tearDown();
        }
    }
}
