<?php

function jsonResponse($status, $message, $statusCode = 200) {
    return response()->json([
        'error' => $status, // true for showing error
        'message' => $message,
    ], $statusCode);
}