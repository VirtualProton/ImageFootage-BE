<?php

namespace App\Http\Middleware;

use Closure;

class CORS
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
        $environment    = app()->environment();
        $allowedOrigins = config("cors.allowed_origins.{$environment}", []);

        if (in_array($request->header('Origin'), $allowedOrigins)) {
            header("Access-Control-Allow-Origin: " . $request->header('Origin'));
        }

        // ALLOW OPTIONS METHOD
        $headers = [
            'Access-Control-Allow-Methods'     => 'POST, GET, OPTIONS, PUT, DELETE',
            'Access-Control-Allow-Headers'     => 'Content-Type, X-Auth-Token, Origin, Authorization, responseType, Login-Type',
            'Access-Control-Allow-Credentials' => 'true',
        ];

        if ($request->getMethod() == "OPTIONS") {
            //The client-side application can set only headers allowed in Access-Control-Allow-Headers
            return response()->json('OK', 200, $headers);
        }

        $response = $next($request);

        foreach ($headers as $key => $value) {
            $response->header($key, $value);
        }

        return $response;
    }
}
