<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\SignUpRequest;
use App\Models\User;
use App\Models\Contributor;
use App\Models\UserPackage;
use Illuminate\Support\Facades\Hash;
use CORS;
use JWTAuth;
use Razorpay\Api\Plan;
use Tymon\JWTAuth\Exceptions\JWTException;
use Mail;


class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware('auth:api', ['except' => ['login', 'signup','socialLogin']]);
    }
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $validator = \Validator::make(request()->all(), [
            'email' => 'required',
            'password' => 'required',          
        ]);

        if ($validator->fails()) {    
            return response()->json($validator->messages(), 200);
        }

        $credentials = request(['email', 'password']);
        // print_r($credentials); die;
        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Email or password does\'t exist'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function contributorLogin()
    {
        $credentials = request(['email', 'password']);
        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Email or password does\'t exist'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function signup(SignUpRequest $request)
    {
        $validator = \Validator::make($request->all(), [
            'first_name' => 'required',
            //'last_name' => 'required',
            //'occupation' => 'required',
            //'company' => 'required',
            'mobile' => 'required',
            //'country' => 'required',
           // 'state' => 'required',
           // 'city' => 'required',
           // 'address' => 'required',
           // 'pincode' => 'required',
           
        ]);

        
        if ($validator->fails()) {    
            return response()->json($validator->messages(), 200);
        }  
        
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
            $save_data->status = '0';
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
				$cname=$request->input('first_name');
				$cemail=$request->input('email');
				$cont_url=url('/active_user_account').'/'.$cemail;
			 
			 $data = array('cname'=>$cname,'cemail'=>$cemail,'cont_url'=>$cont_url);
				 Mail::send('createusermail', $data, function($message) use($data) {
				 $message->to($data['cemail'],$data['cname'])->from('admin@imagefootage.com', 'Imagefootage')  ->subject('Welcome to Image Footage');
			 }); 
                 return response()->json(['status'=>'1','message' => 'Successfully registered','userdata'=>$usercredentials], 200);
            } else {
                return response()->json(['status'=>'0','message' => 'Some problem occured.'], 401);
            }
        }else{
            return response()->json(['status'=>'0','message' => 'User have been already registered'], 200);
        }
    }
	public function socialLogin(Request $request){
        $count = User::where('email','=',$request['userData']['email'])->count();
		if($count >0){
			
			//$res = User::where('email','=',$request['userData']['email'])->first()->toArray();
		 	//return $res;
            $credentials = ['email'=> $request['userData']['email'],'password'=>'123456'];
		   	//$credentials = ['email'=> $request['userData']['email']];
            $token = auth()->attempt($credentials);
            return $this->respondWithToken($token);
		}else{
		    if($request['userData']['provider']=='google'){
                $save_data = new User();
                //$save_data->user_name = $request['userData']['name'];
                $save_data->email = $request['userData']['email'];
                $save_data->first_name = $request['userData']['name'];
				$save_data->user_name = $request['userData']['name'];
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
            }else  if($request['userData']['provider']=='facebook'){
				 $save_data = new User();
                //$save_data->user_name = $request['userData']['name'];
                $save_data->email = $request['userData']['email'];
                $save_data->first_name = $request['userData']['name'];
                $save_data->user_name = $request['userData']['name'];
                $save_data->password = Hash::make('123456');
                $save_data->fb_token = $request['userData']['token'];
                $save_data->profile_photo = $request['userData']['image'];
                $save_data->provider = $request['userData']['provider'];
                $save_data->type = 'U';
                $result = $save_data->save();
                if($result){
                    $credentials = ['email'=> $request['userData']['email'],'password'=>'123456'];
                    $token = auth()->attempt($credentials);
                    return $this->respondWithToken($token);
                   //$res = User::where('email','=',$request['userData']['email'])->first()->toArray();
                   //return $res;
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
        if(auth()->user()) {
                $plans = UserPackage::where('user_id','=',auth()->user()->id)->where('package_expiry_date_from_purchage','>',Now())->whereIn('payment_status',['Completed','Transction Success'])
                         ->get()->toArray();
                $image_download=0;
                $footage_download=0;
                if(count($plans)>0){

                    foreach($plans as $plan){
                        if($plan['package_type']=='Image'){
                            $image_download=1;
                        }else if($plan['package_type']=='Footage'){
                            $footage_download=1;
                        }
                    }
                }
                return response()->json([
                    'access_token' => $token,
                    'token_type' => 'bearer',
                    'expires_in' =>  20,
                    'user' => auth()->user()->first_name,
                    'Utype' => auth()->user()->id,
                    'image_downlaod'=>$image_download,
                    'footage_downlaod'=>$footage_download

                ]);
            } else {
                return null;
            }
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
