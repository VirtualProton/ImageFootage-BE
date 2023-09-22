<?php

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