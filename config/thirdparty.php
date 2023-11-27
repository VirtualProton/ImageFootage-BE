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
        'home_categories' => ''
    ],
    'pond5' => [
        'api_key' => env('POND5_API_KEY', 'cJ70pBIk119'),
        'api_secret' => env('POND5_API_SECRET', 'j5weLX518rMP119'),
        'api_url' => env('POND5_URL','https://api-reseller.pond5.com'),
        'home_categories' => ''
    ]
];
