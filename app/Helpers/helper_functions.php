<?php

use App\Models\User;
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
    $request = request()->all();
    $type = 'Image';
    if (isset($request['productType'])) {
        if ($request['productType'] == 1) {
            $type = 'Image';
        } else if ($request['productType'] == 2) {
            $type = 'Footage';
        } else if ($request['productType'] == 3) {
            $type = 'Music';
        }
    }
    if (isset($request['type'])) {
        if ($request['type'] == 'Image' || $request['type'] == 'image') {
            $type = 'Image';
        } else if ($request['type'] == 'Footage' || $request['type'] == 'footage') {
            $type = 'Footage';
        } else if ($request['type'] == 'Music' || $request['type'] == 'music') {
            $type = 'Music';
        }
    }
    if (Auth::check()) {
        $user = Auth::user();
        $check_plan = check_user_plan_count($user->id, $type);
        $count = $check_plan['count'];
        $is_premium = $check_plan['is_premium'];
        $check_pricing = get_price_const($count);
        if ($is_premium) {
            $api_key    = config('thirdparty.pond5_five.api_key');
            $api_secret = config('thirdparty.pond5_five.api_secret');
            $url        = config('thirdparty.pond5_five.api_url');
        } else if ($check_pricing == 4) {
            $api_key    = config('thirdparty.pond5_four.api_key');
            $api_secret = config('thirdparty.pond5_four.api_secret');
            $url        = config('thirdparty.pond5_four.api_url');
        } else if ($check_pricing == 3) {
            $api_key    = config('thirdparty.pond5_three.api_key');
            $api_secret = config('thirdparty.pond5_three.api_secret');
            $url        = config('thirdparty.pond5_three.api_url');
        } else if ($check_pricing == 2) {
            $api_key    = config('thirdparty.pond5_two.api_key');
            $api_secret = config('thirdparty.pond5_two.api_secret');
            $url        = config('thirdparty.pond5_two.api_url');
        } else {
            $api_key    = config('thirdparty.pond5.api_key');
            $api_secret = config('thirdparty.pond5.api_secret');
            $url        = config('thirdparty.pond5.api_url');
        }

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

function check_user_plan_count($user_id, $type) {
    $user = User::find($user_id);
    $getPlan = $user->plans->where('package_type', $type)->where('status', 1)->first();

    $count = $is_premium = 0;
    if ($getPlan) {
        $is_premium = $getPlan->is_premium;
        $count = $getPlan->package_products_count;
    }
    return [
        'count' => $count,
        'is_premium' => $is_premium
    ];
}

function get_price_const($count) {
    $sizing = [
        1 => 1,
        2 => "5_99",
        3 => "100_499",
        4 => "500_999",
    ];

    if ($count > 999) {
        return 4;
    }

    if ($count >= 1 && $count <= 4) {
        return 1;
    }

    foreach ($sizing as $key => $range) {
        if (is_numeric($range)) {
            if ($count == $range) {
                return $key;
            }
        } else {
            list($min, $max) = explode('_', $range);
            if ($count >= $min && $count <= $max) {
                return $key;
            }
        }
    }

    return null;
}