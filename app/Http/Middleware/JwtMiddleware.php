<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JwtMiddleware extends BaseMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $loginType = strtolower(trim((string) $request->header('Login-Type', 'normal')));
        if (!in_array($loginType, ['normal', 'google', 'facebook'], true)) {
            return response()->json(['status' => 'Authorization Token not found'], 401);
        }

        try {
            // All protected modes require an application token bound to an existing local user.
            // A missing optional provider header never means anonymous access. Provider tokens
            // must be exchanged by the login flow; validation alone does not bind a local identity.
            $user = JWTAuth::parseToken()->authenticate();
            if (!$user) {
                return response()->json(['status' => 'Authorization Token not found'], 401);
            }
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return response()->json(['status' => 'Token is Invalid'], 401);
            } elseif ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return response()->json(['status' => 'Token is Expired'], 401);
            }
            return response()->json(['status' => 'Authorization Token not found'], 401);
        }

        return $next($request);
    }
}
