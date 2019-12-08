<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\SignUpRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use CORS;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware('auth:api', ['except' => ['login', 'signup']]);
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
        $save_data = new User();
		$save_data->user_name=$request->input('name');
		$save_data->email =  $request->input('email');
        $save_data->first_name = $request->input('first_name');
		$save_data->last_name = $request->input('last_name');
		$save_data->mobile = $request->input('mobile');
		$save_data->phone = $request->input('phone');
		$save_data->occupation = $request->input('occupation');
		$save_data->title = $request->input('title');
		$save_data->company = $request->input('company');
		$save_data->address = $request->input('address');
		$save_data->city = $request->input('city');
		$save_data->state = $request->input('state');
		$save_data->country = $request->input('country');
		$save_data->postal_code = $request->input('pincode');
		$save_data->password=Hash::make($request->input('password'));
		$save_data->type = 'U';
        //$save_data->password =  bcrypt($request->input('password'));
        $result=$save_data->save();
        //User::create($request->all());
		if($result){
			 return response()->json(['success' => 'Successfully registered'], 200);
		}else{
			return response()->json(['error' => 'Some problem occured.'], 401);
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
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()->first_name,
            'Utype' => auth()->user()->id
        ]);
    }


}
