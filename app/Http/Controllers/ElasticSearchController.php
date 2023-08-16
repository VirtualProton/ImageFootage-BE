<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Elasticsearch\Client;

class ElasticSearchController extends Controller
{
    protected $elasticsearch;

    public function __construct(Client $client)
    {
        $this->elasticsearch = $client;
    }

    public function search($query)
    {
        $params = [
            'index' => 'elasticsearch',
            'body'  => [
                'query' => [
                    'match' => [
                        'search' => $query,
                    ],
                ],
            ],
        ];

        $response = $this->elasticsearch->search($params);

        return response()->json([
            'status' => 'success',
            'message' => __('List of elastic search words'),
            'data' => $response['hits']['hits'],
        ], 200);
    }

    public function storeNewWorld(Request $request)
    {
        $params = [
            'index' => 'elasticsearch',
            'body'  => [
                'search' => $request->input('search_field'),
            ],
        ];

        try {
            $response = $this->elasticsearch->index($params);
            return response()->json(['id' => $response['_id']]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to store the document.'], 500);
        }
    }
}
