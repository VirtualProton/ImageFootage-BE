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

        //print_r($request->all()); die;
        try {
            if ($request->header('Login-Type') == 'normal') {
                $user = JWTAuth::parseToken()->authenticate();
            }
            // google
            if ($request->header('Login-Type') == 'google') {
                $tokenString = $request->header('Authorization');
                $tokenParts  = explode(" ", $tokenString);
                $token       = $tokenParts[1];

                $client = new Google_Client();
                $client->setClientId(config('constants.google.client_id'));
                $client->setClientSecret(config('constants.google.client_secret'));

                $payload = $client->verifyIdToken($token);
                if (!$payload) {
                    return response()->json(['status' => 'Google token is Invalid'], 401);
                }
            }

            // facebook
            if ($request->header('Login-Type') == 'facebook') {
                $client = new Client();
                $response = $client->get("https://graph.facebook.com/oauth/access_token?client_id=".config('constants.facebook.client_id')."&client_secret=".config('constants.facebook.client_secret')."&grant_type=client_credentials");

                $body = $response->getBody();
                $data = json_decode($body, true);

                if ($data['access_token']) {
                    $tokenString = $request->header('Authorization');
                    $tokenParts  = explode(" ", $tokenString);
                    $token       = $tokenParts[1];

                    $tokenVerifyResponse = $client->get("https://graph.facebook.com/debug_token?input_token=".$token."&access_token=".$data['access_token']);

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
