<?php

return [
    'panthermedia' => [
        'api_key' => env('PANTHERMEDIA_API_KEY', '80b310f4750374158b8dfb065ee9d0753481a050c68798033bc74efb60718349'),
        'api_secret' => env('PANTHERMEDIA_API_SECRET', 'fd9f2adce5715dc1309be4b3af1c77226ffa430fa42b7bfb5528546404cc56bb'),
        'timestamp' => env('PANTHERMEDIA_TIMESTAMP',null),
        'nonce' => env('PANTHERMEDIA_NONCE','imagefootage'),
        'algo' => env('PANTHERMEDIA_ALGO','sha1'),
        'access_key' => env('PANTHERMEDIA_ACCESS_KEY',null),
        'api_url' => env('PANTHERMEDIA_URL','https://rest.panthermedia.net'),
        'home_categories' => '',
        'current_per_page_limit' => 80
    ],
    'pond5' => [
        'api_key' => env('POND5_API_KEY', 'dCQwSilX2526'),
        'api_secret' => env('POND5_API_SECRET', '4VBSj259I13e2526'),
        'api_url' => env('POND5_URL', 'https://reseller-preprod.pond5.com'),
        'home_categories' => '',
        'current_per_page_limit' => 100,
        'use_similar_products_length' => env('USE_SIMILAR_PRODUCTS_LENGTH', true),
        'similar_products_length' => env('SIMILAR_PRODUCTS_LENGTH', 9),
        'similar_products_keyword_length' => env('SIMILAR_PRODUCTS_KEYWORD_LENGTH', 3),
    ],
    'pond5_two' => [
        'api_key' => env('POND5_API_KEY_TWO', 'nuEE079t2527'),
        'api_secret' => env('POND5_API_SECRET_TWO', '1cWBgj2bg8Y02527'),
        'api_url' => env('POND5_URL_TWO', 'https://reseller-preprod.pond5.com'),
        'home_categories' => '',
        'current_per_page_limit' => 100,
    ],
    'pond5_three' => [
        'api_key' => env('POND5_API_KEY_THREE', 'L0tkq3dh2528'),
        'api_secret' => env('POND5_API_SECRET_THREE', '6ii13rzMF0cg2528'),
        'api_url' => env('POND5_URL_THREE', 'https://reseller-preprod.pond5.com'),
        'home_categories' => '',
        'current_per_page_limit' => 100,
    ],
    'pond5_four' => [
        'api_key' => env('POND5_API_KEY_FOUR', 'Z734H8522529'),
        'api_secret' => env('POND5_API_SECRET_FOUR', '4NtqwuLl8thF2529'),
        'api_url' => env('POND5_URL_FOUR', 'https://reseller-preprod.pond5.com'),
        'home_categories' => '',
        'current_per_page_limit' => 100,
    ],
    'pond5_five' => [
        'api_key' => env('POND5_API_KEY_FIVE', 'VrWcw4Mb2530'),
        'api_secret' => env('POND5_API_SECRET_FIVE', 'apXNabIURif22530'),
        'api_url' => env('POND5_URL_FIVE', 'https://reseller-preprod.pond5.com'),
        'home_categories' => '',
        'current_per_page_limit' => 100,
    ],
];
