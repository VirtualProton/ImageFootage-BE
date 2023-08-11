<?php

$environment = env('APP_ENV');
if ($environment  == 'local') {
    return [
        'keyRazorId' => env('LOCAL_KEYRAZORID', 'rzp_test_TcSjfuF7EzPHev'),
        'keyRazorSecret' => env('LOCAL_KEYRAZORSECRET', 'ZzP8Z9Z1dYUYykBPkgYlpGS6'),
        'atomRequestKey' => env('LOCAL_ATOMREQUESTKEY', '3a1575abc728e8ccf9'),
        'atomResponseKey' => env('LOCAL_ATOMRESPONSEKEY', '43af4ba2fbd68d327e'),
        'login' => env('LOCAL_LOGIN', '106640'),
        'mode' => env('LOCAL_MODE', 'live'),
        'password' => env('LOCAL_PASSWORD', '33719eef'),
        'clientcode' => env('LOCAL_CLIENTCODE', '007'),
        'atomprodId' => env('LOCAL_ATOMPRODID', 'CONCEPTUAL')
    ];
} elseif ($environment  == 'development') {

    return [
        'keyRazorId' => env('STAGING_KEYRAZORID', 'rzp_test_TcSjfuF7EzPHev'),
        'keyRazorSecret' => env('STAGING_KEYRAZORSECRET', 'ZzP8Z9Z1dYUYykBPkgYlpGS6'),
        'atomRequestKey' => env('STAGING_ATOMREQUESTKEY', '3a1575abc728e8ccf9'),
        'atomResponseKey' => env('STAGING_ATOMRESPONSEKEY', '43af4ba2fbd68d327e'),
        'login' => env('STAGING_LOGIN', '106640'),
        'mode' => env('STAGING_MODE', 'live'),
        'password' => env('STAGING_PASSWORD', '33719eef'),
        'clientcode' => env('STAGING_CLIENTCODE', '007'),
        'atomprodId' => env('STAGING_ATOMPRODID', 'CONCEPTUAL')
    ];
} else {

    return [
        'keyRazorId' => env('PRODUCTION_KEYRAZORID', 'rzp_test_TcSjfuF7EzPHev'),
        'keyRazorSecret' => env('PRODUCTION_KEYRAZORSECRET', 'ZzP8Z9Z1dYUYykBPkgYlpGS6'),
        'atomRequestKey' => env('PRODUCTION_ATOMREQUESTKEY', '3a1575abc728e8ccf9'),
        'atomResponseKey' => env('PRODUCTION_ATOMRESPONSEKEY', '43af4ba2fbd68d327e'),
        'login' => env('PRODUCTION_LOGIN', '106640'),
        'mode' => env('PRODUCTION_MODE', 'live'),
        'password' => env('PRODUCTION_PASSWORD', '33719eef'),
        'clientcode' => env('PRODUCTION_CLIENTCODE', '007'),
        'atomprodId' => env('PRODUCTION_ATOMPRODID', 'CONCEPTUAL')
    ];
}
