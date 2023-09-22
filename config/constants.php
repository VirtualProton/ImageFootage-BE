<?php

return [
    'SUPER_ADMIN_ROLE_ID' => [1],
    'GST_VALUE' => env('GST_VALUE', 18),
    'EMAIL_EXPIRY' => env('EMAIL_EXPIRY', 1),
    'SMS_EXPIRY' => env('SMS_EXPIRY', 1),
    'ADMIN_EMAIL' => env('ADMIN_EMAIL', 'admin@imagefootage.com'),
    'GET_PACKAGE_LIST_DATE' => env('GET_PACKAGE_LIST_DATE', date('Y-m-d H:i:s')),
    'footage_size_details' => [
        [
            'type' => 'SD',
            'price' => '10'
        ],
        [
            'type' => 'HD',
            'price' => '20'
        ],
        [
            'type' => '4K',
            'price' => '30'
        ],
        [
            'type' => '5K',
            'price' => '40'
        ],
        [
            'type' => 'Custom',
            'price' => '50'
        ],
    ],
    'music_licence_details' => [
        [
            'licence_type' => "Standard",
            'value' => 'standard',
            'price' => '1000'
        ],
        [
            'licence_type' => "Extended",
            'value' => 'extended',
            'price' => '2000'
        ],
    ],
    'INVOICE_PREFIX' => 'IF',
    'GSTIN_VALUE' => 'AMCPR8180N',
    'PAN_VALUE' => '36AMCPR8180N1Z3',
    'SAC_CODE' => '997339',
    'QI_ADDRESS' => 'Hyderabad - Telangana'
];
