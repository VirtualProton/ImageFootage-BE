<?php
namespace Tests\Feature;

use App\Http\Controllers\ElasticSearchController;
use App\Http\Controllers\MediaController;
use Elasticsearch\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SearchMediaRegressionTest extends TestCase
{
    /** @dataProvider searchResponses */
    public function testElasticSearchControllerContractAndQuery($hits)
    {
        $client = \Mockery::mock(Client::class);
        $client->shouldReceive('search')->once()->with(['index' => 'elasticsearch', 'body' => ['query' => ['match' => ['search' => 'synthetic mountains']]]])
            ->andReturn(['hits' => ['hits' => $hits]]);
        $this->app->instance(Client::class, $client);
        $this->getJson('/api/search/synthetic%20mountains')->assertStatus(200)
            ->assertExactJson(['status' => 'success', 'message' => 'List of elastic search words', 'data' => $hits]);
    }

    public function searchResponses() { return [[[]], [[['_id' => 'phase2-1', '_source' => ['search' => 'synthetic mountains']]]]]; }

    public function testSearchIndexFailureHasExistingErrorContract()
    {
        $client = \Mockery::mock(Client::class);
        $client->shouldReceive('index')->once()->andThrow(new \RuntimeException('Synthetic outage'));
        $response = (new ElasticSearchController($client))->storeNewWorld(Request::create('/', 'POST', ['search_field' => 'synthetic words']));
        $this->assertSame(500, $response->getStatusCode());
        $this->assertSame(['error' => 'Failed to store the document.'], $response->getData(true));
    }

    public function testKeywordVariantsHaveObservedOrder()
    {
        $controller = new ElasticSearchController(\Mockery::mock(Client::class));
        $this->assertSame(['synthetic', 'synthetic blue', 'synthetic blue sky', 'blue', 'blue sky', 'sky'], $controller->generateVariants('synthetic blue sky'));
    }

    /** @dataProvider unsafeDownloads */
    public function testDownloadProxyRejectsMissingAndNonHttpUrlsWithoutNetwork($url, $message)
    {
        $response = (new MediaController())->downloadProxy(Request::create('/', 'POST', $url === null ? [] : ['url' => $url]));
        $this->assertSame(400, $response->getStatusCode());
        $this->assertSame($message, $response->getContent());
    }

    public function unsafeDownloads()
    {
        return [[null, 'Missing url parameter'], ['file:///etc/passwd', 'Invalid URL'], ['ftp://phase2.invalid/file', 'Invalid URL'], ['../private', 'Invalid URL']];
    }

    public function testLocalStorageFixtureRoundTripAndMissingFile()
    {
        $disk = Storage::disk('local');
        $path = 'phase2-synthetic.txt';
        $this->assertTrue($disk->put($path, 'Synthetic media fixture'));
        $this->assertSame('Synthetic media fixture', $disk->get($path));
        $this->assertFalse($disk->exists('phase2-missing.txt'));
        $this->assertTrue($disk->delete($path));
        $this->assertFalse($disk->exists($path));
    }

    public function testInterventionGdResizesSyntheticImageAndRejectsInvalidInput()
    {
        $image = \Intervention\Image\ImageManagerStatic::canvas(8, 4, '#ff0000');
        $png = (string) $image->encode('png');
        $resized = \Intervention\Image\ImageManagerStatic::make($png)->resize(4, 2);
        $this->assertSame(4, $resized->width());
        $this->assertSame(2, $resized->height());
        $this->assertSame('image/png', $resized->mime());
        $this->expectException(\Intervention\Image\Exception\NotReadableException::class);
        \Intervention\Image\ImageManagerStatic::make('not an image');
    }
}
