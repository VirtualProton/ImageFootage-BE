<?php
namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Illuminate\Support\Facades\Route;
use Google_Client;
use GuzzleHttp\Client;

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
        try {
            if ($request->header('Login-Type') == 'normal') {
                $user = JWTAuth::parseToken()->authenticate();
            }
            // google
            if ($request->header('Login-Type') == 'google') {
                $tokenString = $request->header('Authorization');
                $token = null;
                if (isset($tokenString) && !empty($tokenString)) {
                    $tokenParts  = explode(" ", $tokenString);
                    $token       = $tokenParts[1];
                }

                $client = new Google_Client();
                $client->setClientId(config('constants.google.client_id'));
                $client->setClientSecret(config('constants.google.client_secret'));

                if (empty($token) || is_null($token)) {
                    return response()->json(['status' => 'Google Token not found'], 401);
                }

                $payload = $client->verifyIdToken($token);
                if (!$payload) {
                    return response()->json(['status' => 'Google token is Invalid'], 401);
                }
            }

            // facebook
            if ($request->header('Login-Type') == 'facebook') {
                $client = new Client();
                $getAppAccessTokenEndpoint = str_replace([
                    ':facebook_client_id',
                    ':facebook_client_secret'
                ], [
                    config('constants.facebook.client_id'),
                    config('constants.facebook.client_secret')
                ],
                    config('constants.facebook.app_access_token_endpoint')
                );
                $response = $client->get($getAppAccessTokenEndpoint);

                $body = $response->getBody();
                $data = json_decode($body, true);

                if ($data['access_token']) {
                    $tokenString = $request->header('Authorization');
                    $tokenParts  = explode(" ", $tokenString);
                    $token       = $tokenParts[1];

                    $userAccessTokenEndpoint = str_replace([
                        ':request_token',
                        ':data_access_token'
                    ], [
                        $token,
                        $data['access_token']
                    ],
                        config('constants.facebook.user_access_token_endpoint')
                    );
                    $tokenVerifyResponse = $client->get($userAccessTokenEndpoint);

                    $tokenBody = $tokenVerifyResponse->getBody();
                    $tokenData = json_decode($tokenBody, true);

                    if (!$tokenData['data']['is_valid'] && $tokenData['data']['is_valid'] != true) {
                        return response()->json(['status' => 'Facebook token is Invalid'], 401);
                    }
                }
            }
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return response()->json(['status' => 'Token is Invalid'],401);
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return response()->json(['status' => 'Token is Expired'],401);
            }else{
                return response()->json(['status' => 'Authorization Token not found'],401);
            }
        }
        return $next($request);
    }
}
