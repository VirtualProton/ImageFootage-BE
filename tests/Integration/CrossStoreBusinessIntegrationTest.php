<?php
namespace Tests\Integration;

use App\Models\Product;
use App\Models\ImageFilterValue;
use Illuminate\Support\Facades\DB;
use Tests\Support\Isolation;
use Tests\Support\MySqlTestCase;

class CrossStoreBusinessIntegrationTest extends MySqlTestCase
{
    private $collection;

    protected function setUp(): void
    {
        parent::setUp();
        if (!Isolation::$mongo['enabled']) { $this->markTestSkipped('BLOCKED: real MongoDB required for Product cross-store integration.'); }
        $this->collection = DB::connection('mongodb')->getMongoDB()->selectCollection('image_filter_values');
        $this->assertSame(0, $this->collection->countDocuments(), 'Refusing nonempty cross-store fixture collection.');
        DB::table('imagefootage_api')->insert(['api_slug' => 'panther_media_image', 'api_flag' => 'PH', 'created_at' => now(), 'updated_at' => now()]);
    }

    private function media()
    {
        return ['items' => ['media' => [[
            'id' => 770022, 'title' => 'Synthetic blue mountains', 'description' => 'Synthetic image',
            'preview_no_wm' => 'http://phase2.invalid/thumb.png', 'preview_high' => 'http://phase2.invalid/main.png',
            'preview_high_no_wm' => 'http://phase2.invalid/main.png', 'width' => 10, 'height' => 5,
            'keywords' => 'synthetic,blue', 'date' => '2026-10-01', 'people_number' => 0, 'orientation' => 'horizontal',
            'license' => 'Synthetic', 'type' => 'photo', 'collection' => 'synthetic', 'author-username' => 'fixture',
            'spx' => 0, 'isolated' => 'no',
        ]]]];
    }

    public function testActualProductImportCoordinatesSqlMongoAndRepeatedImportDoesNotDuplicate()
    {
        $product = new Product();
        $product->savePantherMediaImage($this->media(), 700001, ['search' => 'synthetic']);
        $this->assertSame(1, DB::table('imagefootage_products')->where('api_product_id', 770022)->count());
        $document = ImageFilterValue::where('api_product_id', 770022)->firstOrFail();
        $this->assertSame('Image', $document->product_main_type);
        $this->assertSame(DB::table('imagefootage_products')->where('api_product_id', 770022)->value('product_id'), $document->product_id);
        $product->savePantherMediaImage($this->media(), 700001, ['search' => 'synthetic']);
        $this->assertSame(1, ImageFilterValue::where('api_product_id', 770022)->count());
        $this->assertSame(1, DB::table('imagefootage_products')->where('api_product_id', 770022)->count());
    }

    public function testActualSqlFailureBeforeMongoWriteLeavesNoDocument()
    {
        $bad = $this->media();
        $bad['items']['media'][0]['title'] = ['not-a-scalar'];
        $failed = false;
        try { (new Product())->savePantherMediaImage($bad, 700001); }
        catch (\Throwable $exception) { $failed = true; }
        $this->assertTrue($failed);
        $this->assertSame(0, $this->collection->countDocuments());
        $this->assertSame(0, DB::table('imagefootage_products')->where('api_product_id', 770022)->count());
    }

    public function testMongoFailureLeavesSqlWriteAndRetryCreatesOnlyPartialDocument()
    {
        // Actual driver write failure: BSON encoding refuses recursive PHP input. No server mutation/schema change.
        $bad = $this->media();
        $cycle = [];
        $cycle['self'] = &$cycle;
        $bad['items']['media'][0]['people_number'] = &$cycle;
        $failed = false;
        try { (new Product())->savePantherMediaImage($bad, 700001); }
        catch (\Throwable $exception) { $failed = true; }
        $this->assertTrue($failed, 'Expected a real MongoDB BSON serialization failure.');
        $this->assertSame(1, DB::table('imagefootage_products')->where('api_product_id', 770022)->count());
        $this->assertSame(0, $this->collection->countDocuments());
        (new Product())->savePantherMediaImage($this->media(), 700001);
        $document = ImageFilterValue::where('api_product_id', 770022)->firstOrFail();
        $this->assertSame(DB::table('imagefootage_products')->where('api_product_id', 770022)->value('product_id'), $document->product_id);
        $this->assertSame('Image', $document->product_main_type); // Historical case name retained for baseline traceability.
    }

    public function testActualProductSearchCombinesMongoFilterSqlCategoryAndPagination()
    {
        (new Product())->savePantherMediaImage($this->media(), 700001, ['search' => 'synthetic']);
        $keyword = ['productType' => ['id' => 1], 'category_id' => 700001, 'pagenumber' => 1, 'limit' => 10, 'search' => 'mountains'];
        $filter = ['orientation' => ['value' => 'horizontal']];
        $response = (new Product())->getProductsData($keyword, $filter)->getData(true);
        $this->assertSame(1, $response['total_count']);
        $this->assertSame('Synthetic blue mountains', $response['data'][0]['product_title']);
        $this->assertSame(770022, (int) decrypt($response['data'][0]['api_product_id'], true));
        $this->assertContains('detail/770022/2/Image', $response['data'][0]['url']);
        $empty = (new Product())->getProductsData($keyword, ['orientation' => ['value' => 'vertical']])->getData(true);
        $this->assertSame(0, $empty['total_count']);
        $this->assertSame([], $empty['data']);
        $keyword['pagenumber'] = 2;
        $keyword['limit'] = 1;
        $page = (new Product())->getProductsData($keyword, $filter)->getData(true);
        $this->assertSame(1, $page['total_count']);
        $this->assertSame([], $page['data']);
    }

    public function testRetryMustRestoreCompleteCrossStoreProductIdentity()
    {
        $bad = $this->media();
        $cycle = [];
        $cycle['self'] = &$cycle;
        $bad['items']['media'][0]['people_number'] = &$cycle;
        try { (new Product())->savePantherMediaImage($bad, 700001); } catch (\Throwable $exception) {}
        $this->assertSame(1, DB::table('imagefootage_products')->where('api_product_id', 770022)->count());
        (new Product())->savePantherMediaImage($this->media(), 700001);
        $document = ImageFilterValue::where('api_product_id', 770022)->firstOrFail();
        $this->assertSame(['product_id' => DB::table('imagefootage_products')->where('api_product_id', 770022)->value('product_id'), 'product_main_type' => 'Image'],
            ['product_id' => $document->product_id, 'product_main_type' => $document->product_main_type],
            'LEGACY-DATA-01: retry repairs attributes but omits SQL/Mongo identity after partial write.');
    }

    protected function tearDown(): void
    {
        try {
            if ($this->collection) { $this->collection->deleteMany(['api_product_id' => 770022]); }
        } finally { parent::tearDown(); }
    }
}
