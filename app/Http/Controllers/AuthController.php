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
use App\Helpers\Helper;
use App\Http\TnnraoSms\TnnraoSms;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware('auth:api', ['except' => ['login', 'signup','socialLogin', 'resendVerificationLink', 'signupV2', 'activeUserAccount', 'verifyMobile', 'resendOtp', 'loginV2']]);
    }
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function test()
    {
        echo "test"; exit();
    }
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
                $cname=$request->input('first_name');
				$cemail=$request->input('email');
                $match_token = sha1(time()).random_int(111, 999);
                User::where('id', $save_data->id)->update([
                    'email_verify_token' => $match_token,
                    'token_valid_date' => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . " +". config('constants.EMAIL_EXPIRY') ." days"))
                ]);
				$cont_url=url('/active_user_account').'/'.$match_token;

                $data = array('cname'=>$cname,'cemail'=>$cemail,'cont_url'=>$cont_url);
                    Mail::send('createusermail', $data, function($message) use($data) {
                    $message->to($data['cemail'],$data['cname'])->from('admin@imagefootage.com', 'Imagefootage')  ->subject('Welcome to Image Footage');
                });
                 return response()->json(['status'=>'1','message' => 'Email verification link has been sent to registered email address. Please check.'], 200);
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

    public function delete_user_profile($id)
    {
        dd('test');
        $delagent = User::find($id);
        $delagent->delete();
        return response()->json(['message' => 'Successfully deleted the User']);
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

    public function resendVerificationLink(Request $request, $email = null)
    {
        $user_id = $request->user_id;
        $email = isset($request->email) ? $request->email : $email;
        $user = User::where('email', $email)->where('id', $user_id)->first();
        if (empty($email) || empty($user)) {
            return response()->json(['status' => false, 'message' => 'Email address not found.'], 404);
        }
        if($user->status == 1){
            return response()->json(['status' => false, 'message' => 'Your account is already activated.'], 200);
        }
        $match_token = sha1(time()) . random_int(111, 999);
        $user->email_verify_token = $match_token;
        $user->token_valid_date = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . " +1 days"));
        $user->save();
        $cont_url = url('/active_user_account') . '/' . $match_token;

        $data = array('cname' => $user->first_name, 'cemail' => $user->email, 'cont_url' => $cont_url);
        Mail::send('createusermail', $data, function ($message) use ($data) {
            $message->to($data['cemail'], $data['cname'])->from('admin@imagefootage.com', 'Imagefootage')->subject('Welcome to Image Footage');
        });
        $user_data = ['user_id' => $user->id];
        return response()->json(['status' => true, 'message' => 'Email verification link has been sent to registered email address. Please check.', 'data' => $user_data], 200);
    }



    /**For new updated designs modules */


public function signupV2(Request $request)
{
    $rules = [
        'email' => [
            'required',
            'regex:/^([a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$|^(\d{10,15})$/',
        ],
        'name' => ['required'],
        'password' => ['required']
    ];
    $messages = [
        'email.regex' => 'Please enter a valid email address or mobile number.',
    ];
    $validator = \Validator::make($request->all(), $rules, $messages);
    if ($validator->fails()) {
        return response()->json(['status' => false, 'message' => $validator->errors()], 200);
    }
    $checkEmail = User::where('email', '=', $request->input('email'))->count();
    $checkMobile = User::where('mobile', '=', $request->input('email'))->count();
    if ($checkEmail > 0 || $checkMobile > 0) {
        return response()->json(['status' => false, 'message' => 'User have been already registered'], 200);
    }
    $emailPattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
    $mobilePattern = '/^\d{10,15}$/';
    $email = '';
    $mobile = '';
    if (preg_match($emailPattern, $request->input('email'))) {
        $email = $request->input('email');
    } else {
        $mobile = $request->input('email');
    }
    $save_data = new User();
    $save_data->first_name = $request->input('name');
    $save_data->user_name = Helper::generateUserName();
    $save_data->email = $email;
    $save_data->mobile = $mobile;
    $save_data->password = Hash::make($request->input('password'));
    $save_data->type = 'U';
    $save_data->status = '0';
    $result = $save_data->save();
    if ($result) {
        if (!empty($email)) {
            // send email
            $cname = $request->input('name');
            $cemail = $request->input('email');
            $match_token = sha1(time()) . random_int(111, 999);
            User::where('id', $save_data->id)->update([
                'email_verify_token' => $match_token,
                'token_valid_date' => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . " +" . config('constants.EMAIL_EXPIRY') . " hours"))
            ]);
            $cont_url = url('/active_user_account') . '/' . $match_token;
            $data = array('cname' => $cname, 'cemail' => $cemail, 'cont_url' => $cont_url);
            Mail::send('createusermail', $data, function ($message) use ($data) {
                $message->to($data['cemail'], $data['cname'])->from('admin@imagefootage.com', 'Imagefootage')->subject('Welcome to Image Footage');
            });
            $user_data = ['user_id' => $save_data->id, 'is_email' => true, 'email' => $email];
            return response()->json(['status' => true, 'message' => 'Email verification link has been sent to registered email address. Please check.', 'data' => $user_data], 200);
        } else {
            // send sms
            $otp = rand(100000, 999999);
            $update = User::where('id', $save_data->id)->update([
                'otp' => $otp,
                'otp_valid_date' => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . " +" . config('constants.SMS_EXPIRY') . " hours"))
            ]);
            if ($update) {
                $message = "Thanks For register with us. To verify your mobile number otp is " . $otp . " \n Thanks \n Imagefootage Team";
                $smsClass = new TnnraoSms;
                $smsClass->sendSms($message, $mobile);
                $user_data = ['user_id' => $save_data->id, 'is_email' => false, 'mobile' => $mobile];
                return response()->json(['status' => true, 'message' => 'OTP sent to your registered mobile number. Please verify.', 'data' => $user_data], 200);
            }
        }
    }
    return response()->json(['status' => false, 'message' => 'Some problem occured.'], 401);
}

    /**
     * Active user account
     */
    public function activeUserAccount($token = "")
    {
        $user = User::where("email_verify_token", $token)->first();
        if (empty($user) || $token == "" || $token == null) {
            return response()->json(['status' => false, 'message' => 'Token not found.'], 404);
        }
        if ($user->token_valid_date < date('Y-m-d H:i:s')) {
            return response()->json(['status' => false, 'message' => 'Link is expired.'], 200);
        }
        $user->status = 1;
        $user->email_verify_token = null;
        $user->token_valid_date = null;
        $save = $user->save();
        if ($save) {
            $user_data = ['user_id' => $user->id];
            return response()->json(['status' => true, 'message' => 'User activated successfully.', 'data' => $user_data], 200);
        }
        return response()->json(['status' => false, 'message' => 'Some problem occured.'], 401);
    }

    /**
     * Verify otp send on mobile
     */
    public function verifyMobile (Request $request) {
        $otp = $request->otp;
        $user_id = $request->user_id;
        if (empty($otp)) {
            return response()->json(['status' => false, 'message' => 'OTP is required.'], 200);
        }
        $user = User::where("otp", $otp)->where('id', $user_id)->first();
        if (empty($user)) {
            return response()->json(['status' => false, 'message' => 'User not found.'], 404);
        }
        if ($user->otp_valid_date < date('Y-m-d H:i:s')) {
            return response()->json(['status' => false, 'message' => 'OTP is expired.'], 200);
        }
        $user->status = 1;
        $user->otp = null;
        $user->otp_valid_date = null;
        $save = $user->save();
        if ($save) {
            $user_data = ['user_id' => $user->id];
            return response()->json(['status' => true, 'message' => 'User activated successfully.', 'data' => $user_data], 200);
        }
        return response()->json(['status' => false, 'message' => 'Some problem occured.'], 401);
    }

    /**
     * Resend otp on mobile
     */
    public function resendOtp (Request $request) {
        $mobile = $request->mobile;
        $user_id = $request->user_id;
        if (empty($mobile)) {
            return response()->json(['status' => false, 'message' => 'Mobile number is required.'], 200);
        }
        $otp = rand(100000, 999999);
        $user  = User::where('mobile', $mobile)->where('id', $user_id)->first();
        if (empty($user)) {
            return response()->json(['status' => false, 'message' => 'User not found.'], 404);
        }
        if($user->status == 1){
            return response()->json(['status' => false, 'message' => 'Your account is already activated.'], 200);
        }
        $user->otp = $otp;
        $user->otp_valid_date = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . " +" . config('constants.SMS_EXPIRY') . " hours"));
        $update = $user->save();
        if ($update) {
            $user_data = ['user_id' => $user->id];
            $message = "Thanks For register with us. To verify your mobile number otp is " . $otp . " \n Thanks \n Imagefootage Team";
            $smsClass = new TnnraoSms;
            $smsClass->sendSms($message, $mobile);
            return response()->json(['status' => true, 'message' => 'OTP again sent on your registered mobile number. Please verify.', 'data' => $user_data], 200);
        }
        return response()->json(['status' => false, 'message' => 'Some problem occured.'], 401);
    }

    public function loginV2(Request $request)
    {
        $rules = [
            'email' => [
                'required',
                'regex:/^([a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$|^(\d{10,15})$/',
            ],
            'password' => ['required']
        ];
        $messages = [
            'email.regex' => 'Please enter a valid email address or mobile number.',
        ];
        $validator = \Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()], 200);
        }
        $emailPattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
        if (preg_match($emailPattern, $request->input('email'))) {
            $credentials = ['email' => $request->input('email'), 'password' => $request->input('password')];
        } else {
            $credentials = ['mobile' => $request->input('email'), 'password' => $request->input('password')];
        }
        $usercredentials = [];
        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['status' => false, 'message' => 'Email or password does\'t exist'], 401);
        }
        return response()->json(['status' => true, 'message' => 'Successfully logged in.', 'userdata' => $this->respondWithToken($token)->original], 200);
    
    }

}
