<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\SignUpRequest;
use App\Models\User;
use App\Models\Contributor;
use Illuminate\Support\Facades\Hash;
use CORS;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;



class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware('auth:api', ['except' => ['login', 'signup','fbLogin']]);
    }
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);
        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Email or password does\'t exist'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function signup(SignUpRequest $request)
    {
		$user = $request->all();
		$count = User::where('email','=',$request->input('email'))->count();
		if($count==0) {
            $save_data = new User();
            $save_data->user_name = $request->input('first_name');
            $save_data->email = $request->input('email');
            $save_data->first_name = $request->input('first_name');
            $save_data->last_name = $request->input('last_name');
            $save_data->mobile = $request->input('mobile');
            $save_data->phone = $request->input('phoneNumber');
            $save_data->occupation = $request->input('occupation');
            $save_data->title = $request->input('occupation');
            $save_data->company = $request->input('company');
            $save_data->address = $request->input('address');
            $save_data->city = $request->input('city');
            $save_data->state = $request->input('state');
            $save_data->country = $request->input('country');
            $save_data->postal_code = $request->input('pincode');
            $save_data->password = Hash::make($request->input('password'));
            $save_data->type = 'U';
            //$save_data->password =  bcrypt($request->input('password'));
            $result = $save_data->save();
            //User::create($request->all());
            if ($result) {
                $credentials = ['email'=>$request->input('email'),'password'=>$request->input('password')];
                $token = auth()->attempt($credentials);
                $usercredentials = ['access_token' => $token,
                    'token_type' => 'bearer',
                    'expires_in' => auth()->factory()->getTTL() * 60,
                    'user' => auth()->user()->first_name,
                    'Utype' => auth()->user()->id
                ];
                 return response()->json(['status'=>'1','message' => 'Successfully registered','userdata'=>$usercredentials], 200);
            } else {
                return response()->json(['status'=>'0','message' => 'Some problem occured.'], 401);
            }
        }else{
            return response()->json(['status'=>'0','message' => 'User has been already registered'], 200);
        }
    }
	public function fbLogin(Request $request){
        $count = User::where('email','=',$request['userData']['email'])->count();
		if($count >0){
			//$res = User::where('email','=',$request->input('email'))->first()->toArray();
		 	//return $res;
            $credentials = ['email'=> $request['userData']['email'],'password'=>'123456'];
            $token = auth()->attempt($credentials);
            return $this->respondWithToken($token);
		}else{
		    if($request['userData']['provider']=='google'){
                $save_data = new User();
                //$save_data->user_name = $request['userData']['name'];
                $save_data->email = $request['userData']['email'];
                $save_data->first_name = $request['userData']['name'];
                $save_data->password = Hash::make('123456');
                $save_data->gmail_idtoken = $request['userData']['idToken'];
                $save_data->profile_photo = $request['userData']['image'];
                $save_data->provider = $request['userData']['provider'];
                $save_data->type = 'U';
                $result = $save_data->save();
                if($result){
                    $credentials = ['email'=> $request['userData']['email'],'password'=>'123456'];
                    $token = auth()->attempt($credentials);
                    return $this->respondWithToken($token);
                }
            }


			//return response()->json(['error' => 'Please register to login.'], 401);
		}
       
	}
	public function contactUs(Request $request){
	}

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' =>  20,
            'user' => auth()->user()->first_name,
            'Utype' => auth()->user()->id
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return response()->json(compact('token'));
    }

    public function getAuthenticatedUser()
    {
        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }

        return response()->json(compact('user'));
    }


}
