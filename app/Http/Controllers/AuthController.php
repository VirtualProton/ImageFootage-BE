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
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Google_Client;
use GuzzleHttp\Client;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'signup', 'resendVerificationLink', 'signupV2', 'activeUserAccount', 'verifyMobile', 'resendOtp', 'loginV2', 'socialLoginv2', 'getCountriesList', 'getStatesList', 'getCitiesList']]);
    }
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $validator = \Validator::make(request()->all(), [
            'email'    => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

        $credentials = request(['email', 'password']);
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
            'mobile'     => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

        $user = $request->all();
        $count = User::where('email', '=', $request->input('email'))->count();
        if ($count == 0) {
            $save_data = new User();
            $save_data->user_name   = $request->input('first_name');
            $save_data->email       = $request->input('email');
            $save_data->first_name  = $request->input('first_name');
            $save_data->last_name   = $request->input('last_name');
            $save_data->mobile      = $request->input('mobile');
            $save_data->phone       = $request->input('phoneNumber');
            $save_data->occupation  = $request->input('occupation');
            $save_data->title       = $request->input('occupation');
            $save_data->company     = $request->input('company');
            $save_data->address     = $request->input('address');
            $save_data->city        = $request->input('city');
            $save_data->state       = $request->input('state');
            $save_data->country     = $request->input('country');
            $save_data->postal_code = $request->input('pincode');
            $save_data->password    = Hash::make($request->input('password'));
            $save_data->type        = 'U';
            $save_data->status      = '0';
            $result = $save_data->save();
            if ($result) {
                $cname = $request->input('first_name');
                $cemail = $request->input('email');
                $match_token = sha1(time()) . random_int(111, 999);
                User::where('id', $save_data->id)->update([
                    'email_verify_token' => $match_token,
                    'token_valid_date'   => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . " +" . config('constants.EMAIL_EXPIRY') . " days"))
                ]);
                $cont_url = url('/active_user_account') . '/' . $match_token;

                $data = array('cname' => $cname, 'cemail' => $cemail, 'cont_url' => $cont_url);
                Mail::send('createusermail', $data, function ($message) use ($data) {
                    $message->to($data['cemail'], $data['cname'])->from('admin@imagefootage.com', 'Imagefootage')->subject('Welcome to Image Footage');
                });
                return response()->json(['status' => '1', 'message' => 'Email verification link has been sent to registered email address. Please check.'], 200);
            } else {
                return response()->json(['status' => '0', 'message' => 'Some problem occured.'], 401);
            }
        } else {
            return response()->json(['status' => '0', 'message' => 'User have been already registered'], 200);
        }
    }

    # New socialLogin V2
    public function socialLoginv2(Request $request)
    {
        if ($request->provider == 'google') {

            $client = new Google_Client();
            $client->setClientId(config('constants.google.client_id'));
            $client->setClientSecret(config('constants.google.client_secret'));

            $payload = $client->verifyIdToken($request->token);
            $payload['login_type'] = 'google';
            if ($payload) {
                $count = User::where('email', '=', $payload['email'])->count();
                if ($count > 0) {
                    return response()->json(['status' => true, 'message' => 'Successfully logged in.', 'userdata' => $this->respondWithToken($request->token, $payload)->original], 200);
                }
            }

            $googleUser = new User();

            $googleUser->email         = $request->email;
            $googleUser->first_name    = $request->name;
            $googleUser->user_name     = $request->name;
            $googleUser->gmail_idtoken = $request->idToken;
            $googleUser->profile_photo = $request->image;
            $googleUser->provider      = $request->provider;
            $googleUser->type          = 'U';
            $result = $googleUser->save();
            if ($result) {
                return response()->json(['status' => true, 'message' => 'Successfully logged in.', 'userdata' => $this->respondWithToken($request->token, $payload)->original], 200);
            }
        }
        if ($request->provider == 'facebook') {

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
                $userAccessTokenEndpoint = str_replace([
                    ':request_token',
                    ':data_access_token'
                ], [
                    $request->token,
                    $data['access_token']
                ],
                    config('constants.facebook.user_access_token_endpoint')
                );
                $tokenVerifyResponse = $client->get($userAccessTokenEndpoint);

                $tokenBody = $tokenVerifyResponse->getBody();
                $tokenData = json_decode($tokenBody, true);
                if ($tokenData['data']['is_valid'] && $tokenData['data']['is_valid'] == true) {
                    $count = User::where('email', '=', $request->email)->count();
                    if ($count > 0) {
                        $payload['name']  = $request->first_name;
                        $payload['email'] = $request->email;
                        $payload['login_type'] = 'facebook';
                        return response()->json(['status' => true, 'message' => 'Successfully logged in.', 'userdata' => $this->respondWithToken($request->token, $payload)->original], 200);
                    }
                    $facebookUser = new User();

                    $facebookUser->email      = $request->email;
                    $facebookUser->first_name = $request->first_name;
                    $facebookUser->last_name  = $request->last_name;
                    $facebookUser->user_name  = $request->user_name;
                    $facebookUser->fb_token   = $request->idToken;
                    $facebookUser->provider   = $request->provider;
                    $facebookUser->type       = 'U';
                    $result = $facebookUser->save();
                    if ($result) {
                        $payload['name']  = $request->first_name;
                        $payload['email'] = $request->email;
                        $payload['login_type'] = 'facebook';
                        return response()->json(['status' => true, 'message' => 'Successfully logged in.', 'userdata' => $this->respondWithToken($request->token, $payload)->original], 200);
                    }
                } else {
                    return response()->json(['status' => false, 'message' => 'Invalid facebook token please try again.'], 200);
                }
            }
        }
    }

    public function contactUs(Request $request)
    {
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

        return response()->json(['message' => 'Successfully logged out.']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        $returnData =  $this->respondWithToken(auth()->refresh());
        return response()->json(['status' => true, 'message' => 'Successfully logged in.', 'userdata' => isset($returnData->original) ? $returnData->original : []], 200);
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
    protected function respondWithToken($token, $payload = null)
    {
        if (auth()->user() || !empty($payload)) {
            $image_download = 0;
            $footage_download = 0;
            $music_download = 0;
            $profileCompleted = false;
            $loginType = 'normal';
            if ($payload) {
                $user = User::where('email', $payload['email'])->first();
                if ($user) {
                    $plans = UserPackage::where('user_id', '=', $user->id)->where('package_expiry_date_from_purchage', '>', Now())->whereIn('payment_status', ['Completed', 'Transction Success'])
                        ->get()->toArray();
                    if (!$this->isProfileCompleted($user->id)) {
                        $profileCompleted = true;
                    }
                    $loginType = $payload['login_type'];
                }
            } else {
                $plans = UserPackage::where('user_id', '=', auth()->user()->id)->where('package_expiry_date_from_purchage', '>', Now())->whereIn('payment_status', ['Completed', 'Transction Success'])
                    ->get()->toArray();
                    if (!$this->isProfileCompleted(auth()->user()->id)) {
                        $profileCompleted = true;
                    }
            }
            if (count($plans) > 0) {

                foreach ($plans as $plan) {
                    if ($plan['package_type'] == 'Image') {
                        $image_download = 1;
                    } else if ($plan['package_type'] == 'Footage') {
                        $footage_download = 1;
                    } else if ($plan['package_type'] == 'Music') {
                        $music_download = 1;
                    }
                }
            }
            $authUserObject = auth()->user();
            return response()->json([
                'access_token'      => $token,
                'token_type'        => 'bearer',
                'expires_in'        =>  21,
                'user'              => $authUserObject->first_name ?? $payload['name'],
                'email'             => $authUserObject->email ?? $payload['email'],
                'Utype'             => $authUserObject->id ?? $user->id,
                'image_downlaod'    => $image_download,
                'footage_downlaod'  => $footage_download,
                'music_download'    => $music_download,
                'profile_completed' => $profileCompleted,
                'refresh_token'     => $authUserObject ? auth()->fromUser($authUserObject) : null,
                'login_type'        => $loginType
            ]);
        } else {
            return null;
        }
    }

    # Check logged User profile completed
    private function isProfileCompleted($userId)
    {
        return User::where('id', $userId)
            ->whereNull('country')
            ->whereNull('state')
            ->whereNull('city')
            ->whereNull('address')
            ->exists();
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
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

            if (!$user = JWTAuth::parseToken()->authenticate()) {
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
        $user_id = isset($request->user_id) && !empty($request->user_id) ? $request->user_id: null;
        $email = isset($request->email) ? $request->email : $email;
        if($user_id == null){
            $user = User::where('email', $email)->first();
        } else{
            $user = User::where('email', $email)->where('id', $user_id)->first();
        }

        if (empty($email) || empty($user)) {
            return response()->json(['status' => false, 'message' => 'Email address not found.'], 200);
        }
        if ($user->status == 1) {
            return response()->json(['status' => false, 'message' => 'Your account is already activated.'], 200);
        }
        $match_token              = sha1(time()) . random_int(111, 999);
        $user->email_verify_token = $match_token;
        $user->token_valid_date   = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . " +1 days"));
        $user->save();
        $cont_url = config('app.front_end_url') . 'account-verification/' . $match_token;

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
            'name' => ['required', 'regex:/^[A-Za-z\s]+$/'],
            'password' => ['required']
        ];
        $messages = [
            'email.regex' => 'Please enter a valid email address or mobile number.',
        ];
        $validator = \Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()], 200);
        }
        $checkEmail  = User::where('email', '=', $request->input('email'))->count();
        $checkMobile = User::where('mobile', '=', $request->input('email'))->count();
        if ($checkEmail > 0 || $checkMobile > 0) {
            return response()->json(['status' => false, 'message' => 'User have been already registered.'], 200);
        }
        $emailPattern  = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
        $mobilePattern = '/^\d{10,15}$/';
        $email = '';
        $mobile = '';
        if (preg_match($emailPattern, $request->input('email'))) {
            $email  = $request->input('email');
        } else {
            $mobile = $request->input('email');
        }
        $save_data             = new User();
        $save_data->first_name = $request->input('name');
        $save_data->user_name  = Helper::generateUserName();
        $save_data->email      = $email;
        $save_data->mobile     = $mobile;
        $save_data->password   = Hash::make($request->input('password'));
        $save_data->type       = 'U';
        $save_data->status     = '0';
        $result = $save_data->save();
        if ($result) {
            if (!empty($email)) {
                // send email
                $cname       = $request->input('name');
                $cemail      = $request->input('email');
                $match_token = sha1(time()) . random_int(111, 999);
                User::where('id', $save_data->id)->update([
                    'email_verify_token' => $match_token,
                    'token_valid_date'   => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . " +" . config('constants.EMAIL_EXPIRY') . " hours"))
                ]);
                $cont_url    = config('app.front_end_url') . 'account-verification/' . $match_token;
                $data        = array('cname' => $cname, 'cemail' => $cemail, 'cont_url' => $cont_url);
                Mail::send('createusermail', $data, function ($message) use ($data) {
                    $message->to($data['cemail'], $data['cname'])->from('admin@imagefootage.com', 'Imagefootage')->subject('Welcome to Image Footage');
                });
                $user_data = ['user_id' => $save_data->id, 'is_email' => true, 'email' => $email];
                return response()->json(['status' => true, 'message' => 'Email verification link has been sent to registered email address. Please check.', 'data' => $user_data], 200);
            } else {
                // send sms
                $otp = rand(1000, 9999);
                $update = User::where('id', $save_data->id)->update([
                    'otp'            => $otp,
                    'otp_valid_date' => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . " +" . config('constants.SMS_EXPIRY') . " hours"))
                ]);
                if ($update) {
                    $message  = "Thanks For register with us. To verify your mobile number otp is " . $otp . " \n Thanks \n Imagefootage Team";
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
            return response()->json(['status' => false, 'message' => 'Token not found.'], 200);
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
    public function verifyMobile(Request $request)
    {
        $otp = $request->otp;
        $user_id = $request->user_id;
        if (empty($otp)) {
            return response()->json(['status' => false, 'message' => 'OTP is required.'], 200);
        }
        $user = User::where("otp", $otp)->where('id', $user_id)->first();
        if (empty($user)) {
            return response()->json(['status' => false, 'message' => 'OTP is invalid.'], 200);
        }
        if ($user->otp_valid_date !== null && $user->otp_valid_date < date('Y-m-d H:i:s')) {
            return response()->json(['status' => false, 'message' => 'OTP is expired.'], 200);
        }
        $user->status         = 1;
        $user->otp            = null;
        $user->otp_valid_date = null;
        $save = $user->save();
        if ($save) {
            $user_data = ['user_id' => $user->id];
            return response()->json(['status' => true, 'message' => 'User is verified successfully.', 'data' => $user_data], 200);
        }
        return response()->json(['status' => false, 'message' => 'Some problem occured.'], 401);
    }

    /**
     * Resend otp on mobile
     */
    public function resendOtp(Request $request)
    {
        $mobile = $request->mobile;
        $user_id = isset($request->user_id) && !empty($request->user_id) ? $request->user_id: null;
        if (empty($mobile)) {
            return response()->json(['status' => false, 'message' => 'Mobile number is required.'], 200);
        }
        $otp = rand(1000, 9999);
        if($user_id == null){
            $user = User::where('mobile', $mobile)->first();
        } else{
            $user = User::where('mobile', $mobile)->where('id', $user_id)->first();
        }
        if (empty($user)) {
            return response()->json(['status' => false, 'message' => 'User not found.'], 200);
        }
        $user->otp            = $otp;
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
            'email.regex' => config('messages.login_validation_email'),
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

        # Checked already authenticated by social account
        $userObj = User::where('email', $request->input('email'))->first();
        if (!empty($userObj->gmail_idtoken)) {
            return response()->json(['status' => false, 'message' => 'User has already authenticated by Google, Please try with google login'], 200);
        }
        if (!empty($userObj->fb_token)) {
            return response()->json(['status' => false, 'message' => 'User has already authenticated by Facebook, Please try with facebook login'], 200);
        }

        $usercredentials = [];
        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['status' => false, 'message' => 'Email or password doesn\'t exist'], 200);
        }
        $utype = $this->respondWithToken($token)->original['Utype'];
        $user = User::where('id', $utype)->first();
        if ($user->status == 0) {
            return response()->json(['status' => false, 'message' => 'Account not activated. Please verify your account.'], 200);
        }
        return response()->json(['status' => true, 'message' => 'Successfully logged in.', 'userdata' => $this->respondWithToken($token)->original], 200);
    }

    public function getCountriesList(Request $request)
    {
        $countries = Country::all();
        return response()->json([
            'status' => true,
            'data' => $countries
        ]);
    }

    public function getStatesList(Request $request, $country_id = null)
    {
        if (empty($country_id)) {
            $states = State::all();
        } else {
            $states = State::where('country_id', $country_id)->get();
        }
        return response()->json([
            'status' => true,
            'data' => $states
        ]);
    }

    public function getCitiesList(Request $request, $state_id = null)
    {
        if (empty($state_id)) {
            $cities = City::all();
        } else {
            $cities = City::where('state_id', $state_id)->get();
        }
        return response()->json([
            'status' => true,
            'data' => $cities
        ]);
    }
}
