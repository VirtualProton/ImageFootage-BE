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
        
        $searchType = 'prefix_based';
        
        if ($searchType == 'prefix_based') {
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
            
        } else {
          $params = [
                'index' => 'elasticsearch', 
                'body' => [
                    'suggest' => [
                        'suggestion' => [
                            'prefix' => $query, // Set the prefix to your query
                            'completion' => [
                                'field'  => 'suggest_field',
                                'size'   => 10 // Adjust the size as needed
                            ]
                        ]
                    ]
                ]
            ];
            
            $response = $this->elasticsearch->search($params);
        
            return response()->json([
                'status' => 'success',
                'message' => __('List of elastic search words'),
                'data' => $response['suggest']['suggestion'],
            ], 200);
        }
    }

    public function storeNewWorld(Request $request)
    {
        $searchTerm = $request->input('search_field');
        $variants = $this->generateVariants($searchTerm); // Implement a function to generate variants
        $params = [
            'index' => 'elasticsearch',
            'body' => [
                'search' => $searchTerm,
                'suggest_field' => [
                    'input' => $variants, // Store an array of input values (variants)
                ],
            ],
        ];

        try {
            $response = $this->elasticsearch->index($params);
            return response()->json(['id' => $response['_id']]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to store the document.'], 500);
        }
    }
    
    function generateVariants($searchTerm) {
    // Split the search term into individual words
    $words = explode(' ', $searchTerm);

    // Initialize an array to store variants
    $variants = [];

    // Generate variants by combining individual words
    for ($i = 0; $i < count($words); $i++) {
        $variant = '';
        for ($j = $i; $j < count($words); $j++) {
            $variant .= ($j > $i ? ' ' : '') . $words[$j];
            $variants[] = $variant;
        }
    }

    return $variants;
}

}
