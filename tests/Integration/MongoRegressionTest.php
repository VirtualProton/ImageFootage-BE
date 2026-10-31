<?php
namespace Tests\Integration;

use App\Models\ImageFilterValue;
use Tests\Support\MongoTestCase;

class MongoRegressionTest extends MongoTestCase
{
    public function testDocumentCreateRetrieveAndObjectIdMapping()
    {
        $model = $this->document();
        $loaded = ImageFilterValue::find($model->id);
        $this->assertSame('PHASE2-1', $loaded->api_product_id);
        $this->assertSame((string) $model->getOriginal('_id'), (string) $loaded->id);
    }

    public function testDocumentUpdateIsPersisted()
    {
        $model = $this->document();
        $model->attributes = ['color' => 'green'];
        $model->save();
        $this->assertSame('green', ImageFilterValue::find($model->id)->attributes['color']);
    }

    public function testNestedFilterAndSortUseActualMongoDb()
    {
        $this->document(1);
        $this->document(2);
        $this->assertSame(['PHASE2-1'], ImageFilterValue::where('attributes.color', 'red')->pluck('api_product_id')->all());
        $this->assertSame(['PHASE2-2', 'PHASE2-1'], ImageFilterValue::orderBy('product_id', 'desc')->pluck('api_product_id')->all());
    }

    public function testTimestampSerializationPreservesCalendarValue()
    {
        $model = $this->document();
        $loaded = ImageFilterValue::find($model->id);
        $this->assertSame('2026-10-29 12:00:00', $loaded->created_at->format('Y-m-d H:i:s'));
        $this->assertNotEmpty(json_decode($loaded->toJson(), true)['created_at']);
    }

    public function testMissingDocumentReturnsNull()
    {
        $this->assertNull(ImageFilterValue::find('000000000000000000000001'));
    }

    public function testRawAggregationOverSyntheticProducts()
    {
        $this->document(1);
        $this->document(2);
        $result = $this->collection->aggregate([['$group' => ['_id' => '$product_main_type', 'count' => ['$sum' => 1]]]])->toArray();
        $this->assertSame(2, $result[0]['count']);
    }
}
