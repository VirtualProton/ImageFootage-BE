<?php

use Illuminate\Support\Facades\Auth;

function jsonResponse($status, $message, $statusCode = 200) {
    return response()->json([
        'error' => $status, // true for showing error
        'message' => $message,
    ], $statusCode);
}

function generate_custom_url($path) {
    $environment = app()->environment();

    if (config('urlconfig.secure.' . $environment)) {
        return secure_url($path);
    }

    return url($path);
}

function get_pond5_api_version() {
    if (Auth::check()) {
        $api_key    = config('thirdparty.pond5.api_key');
        $api_secret = config('thirdparty.pond5.api_secret');
        $url        = config('thirdparty.pond5.api_url');

        return [
            'api_key'    => $api_key,
            'api_secret' => $api_secret,
            'url'        => $url
        ];
    } else {
        $api_key    = config('thirdparty.pond5.api_key');
        $api_secret = config('thirdparty.pond5.api_secret');
        $url        = config('thirdparty.pond5.api_url');

        return [
            'api_key'    => $api_key,
            'api_secret' => $api_secret,
            'url'        => $url
        ];
    }
}