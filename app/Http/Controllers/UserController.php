<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;
use App\Models\Usercontactus;
use Illuminate\Support\Facades\DB;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Mail;
use Image;
use File;
use App\Http\TnnraoSms\TnnraoSms;
use App\Models\Contributor;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Auth;
use App\Mail\ChangeMobileMail;
use App\Mail\ChangeAddressEmail;
use Carbon\Carbon;
use App\Models\ProductsDownload;
use App\Models\UserPackage;
use App\Models\UserProductDownload;
use App\Models\Usercart;
use App\Models\ImageFootageWishlist;

class UserController extends Controller
{
    public function userProfile($id)
    {

        $send_data = [];
        $userlist = User::where('id', $id)
            ->with('country')
            ->with('state')
            ->with('city')
            ->with([
                'plans' => function ($query) {
                    $query->whereIn('payment_status', ['Completed', 'Transction Success'])
                        ->where(['status' => 1])
                        ->whereRaw('package_products_count > downloaded_product')
                        ->whereDate('package_expiry_date_from_purchage', '>=', Carbon::today())
                        ->orderBy('id', 'desc')
                        ->select('id', 'package_name', 'package_description', 'user_id', 'package_price', 'package_type', 'package_products_count', 'downloaded_product', 'transaction_id', 'created_at as updated_at', 'package_expiry_date_from_purchage', 'invoice', 'order_type','package_plan','footage_tier','pacage_size')
                        ->with(['downloads' => function ($down_query) {
                            $down_query->select('id', 'product_id', 'user_id', 'package_id', 'product_name', 'product_size', 'downloaded_date', 'download_url', 'product_poster', 'product_thumb', 'web_type');
                        }])
                        ->with(['licence' => function ($down_query) {
                            $down_query->select('id', 'licence_name', 'description', 'product_type', 'slug');
                        }]);

                }
            ])
            ->get()->toArray();

        if (count($userlist) > 0) {
            foreach ($userlist as $user) {
                $send_data['id'] = $user['id'];
                $send_data['first_name'] = $user['first_name'];
                $send_data['last_name'] = $user['last_name'];
                $send_data['title'] = $user['title'];
                $send_data['email'] = $user['email'];
                $send_data['user_name'] = $user['user_name'];
                $send_data['contact_owner'] = $user['contact_owner'];
                $send_data['mobile'] = $user['mobile'];
                $send_data['phone'] = $user['phone'];
                $send_data['address'] = $user['address'];
                $send_data['status'] = $user['status'];
                $send_data['type'] = $user['type'];
                $send_data['postal_code'] = $user['postal_code'];
                $send_data['plans'] = $user['plans'];
                $send_data['city'] = $user['city'];
                $send_data['state'] = $user['state'];
                $send_data['country'] = $user['country'];
                $send_data['address2'] = $user['address2'];
                $send_data['company'] = $user['company'];
                $send_data['gst']    = $user['gst'];

                $image_download = 0;
                $footage_download = 0;
                $music_download = 0;
                foreach ($user['plans'] as $plan) {
                    if ($plan['package_type'] == 'Image') {
                        $image_download = 1;
                    } else if ($plan['package_type'] == 'Footage') {
                        $footage_download = 1;
                    } else if ($plan['package_type'] == 'Music') {
                        $music_download = 1;
                    }
                }
                $send_data['image_download'] = $image_download;
                $send_data['footage_download'] = $footage_download;
                $send_data['music_download'] = $music_download;
            }
            return '{"status":"1","message":"","data":' . json_encode($send_data) . '}';
        } else {
            return '{"status":"0","message":"Some problem occured.","data":"[]"}';
        }
    }

    # My Plan
    public function myPlan(Request $request)
    {
        $send_data = [];
        $range       = $request->input('range', 'today');

        $startDate = null;
        $endDate   = null;

        switch ($range) {
            case 'today':
                $startDate = Carbon::today()->startOfDay();
                $endDate = Carbon::today()->endOfDay();
                break;
            case 'last_week':
                $startDate = Carbon::today()->subWeek()->startOfWeek();
                $endDate = Carbon::today()->subWeek()->endOfWeek();
                break;
            case 'last_month':
                $startDate = Carbon::today()->subMonth()->startOfMonth();
                $endDate = Carbon::today()->subMonth()->endOfMonth();
                break;
            case 'custom':
                $startDate = $request->input('start_date');
                $endDate = $request->input('end_date');
                break;
        }
        $userlist = UserPackage::whereIn('payment_status', ['Completed', 'Transction Success'])
            ->where('user_id', $request->user_id);

        if ($range !== 'all') {
            $userlist->whereDate('created_at', '>=', $startDate)
                    ->whereDate('created_at', '<=', $endDate);
        }

        $userlist = $userlist->orderBy('id', 'desc')
            ->select('id', 'package_name', 'package_description', 'user_id', 'package_price', 'package_type', 'package_products_count', 'downloaded_product', 'transaction_id', 'created_at as updated_at', 'package_expiry_date_from_purchage', 'invoice', 'status', 'footage_tier','order_type')
            ->with('licence')
            ->paginate(5)
            ->toArray();
            return ['status' => 1, 'message' => 'Plan details fetched successfully.', 'data' => $userlist];

    }
    public function getUserAddress(Request $request)
    {
        $id = $request->Utype;
        $userlist = User::select('first_name', 'last_name', 'address', 'city', 'state', 'country', 'postal_code','company','gst','mobile','email')->where('id', $id)->with(['country','city','state'])->first();
        return '{"status":"1","message":"","data":' . json_encode($userlist) . '}';
    }
    public function contributorProfile($id)
    {
        $User = new Contributor();
        $userlist = $User->where('contributor_id', $id)->get()->toArray();

        if (count($userlist) > 0) {
            return '{"status":"1","message":"","data":' . json_encode($userlist) . '}';
        } else {
            return '{"status":"0","message":"Some problem occured.","data":"[]"}';
        }
    }

    /*public function validUser(Request $request){
        $count = User::where('email','=',$request['user_email'])
            ->count();
        if($count>0){
            $result = ['status'=>1,'message'=>'success'];
        }else{
            $result = ['status'=>0,'message'=>'Email Not Found.'];
        }
        return response()->json($result);
    }*/
    public static function validUser(Request $request)
    {
        if (empty($request['email']['user_email'])) {
            return response()->json(['status' => false, 'message' => 'Email is required.'], 200);
        }
        $count = User::where('email', '=', $request['email']['user_email'])->count();
        if ($count > 0) {
            $randnum = rand(1000, 10000);
            $sm = $request['email']['user_email'];

            $token = str_random(60);
            $findUser = DB::table('password_resets')->where('email', $request['email']['user_email'])->limit(1)->first();
            if($findUser) {
                DB::table('password_resets')->where('email', $request['email']['user_email'])->update([
                    'token' => $token,
                    'created_at' => date('Y-m-d h:i:s'),
                ]);
            }
            else {
                DB::table('password_resets')->insert([
                    'email' => $request['email']['user_email'],
                    'token' => $token,
                    'created_at' => Carbon::now()
                ]);
            }
            $urltoken = base64_encode(json_encode(['email'=>$request['email']['user_email'], 'token'=>$token]));
            $url = config('app.front_end_url') . "resetpassword/" .$urltoken ;
            $data = array('url' => $url, 'email' => $request['email']['user_email']);
            Mail::send('email.forgotpasswordadmin', $data, function ($message) use ($data) {
                $message->to($data['email'], '')->subject('Imagefootage Forget Password')
                    ->from('admin@imagefootage.com', 'Imagefootage');
            });
            $user = User::where('email', $request['email']['user_email'])->first();
            $user_data = ['user_id' => $user->id, 'email' => $user->email, 'mobile' => $user->mobile];
            $result = ['status' => 1, 'message' => 'Check your email for reset password link.', 'data' => $user_data];
        } else {
            $result = ['status' => 0, 'message' => 'Email Not Found.'];
        }
        return response()->json($result);
    }
    public function validMobileUser(Request $request)
    {
        if (empty($request['mobile']['user_mobile'])) {
            return response()->json(['status' => false, 'message' => 'Mobile number is required.'], 200);
        }

        $user = User::where('mobile', '=', $request['mobile']['user_mobile'])->first();
        if ($user) {
            if (!config('constants.sms_enabled')) {
                if($user->email){
                    // Assuming $user is an instance of your User model
                    $request->merge([
                        'email' => [
                            'user_email' => $user->email,
                        ],
                    ]);

                    $this->validUser($request);
                    return response()->json(['status' => true, 'code' => 200, 'message' => "Check your email for reset password link."], 200);
                }else if(isset($request['mobile']['email']) && !empty($request['mobile']['email'])){
                    $checkEmailExist = User::where('email',$request['mobile']['email'])->exists();
                    if($checkEmailExist){
                        return response()->json(['status' => false, 'code' => 422, 'message' => "Email already exists. Please try with another email."], 200);
                    }
                    $user->email = $request['mobile']['email'];
                    $user->save();
                    $request->merge([
                        'email' => [
                            'user_email' => $user->email,
                        ],
                    ]);
                    $this->validUser($request);
                    return response()->json(['status' => true, 'code' => 200, 'message' => "Check your email for reset password link."], 200);
                }else{
                    return response()->json(['status' => false, 'code' => 422, 'message' => "The administrator has disabled SMS functionality at this time, so please use your email address instead of your phone number."], 200);
                }
            }
            $otp = rand(100000, 999999);
            $update = User::where('mobile', $request['mobile']['user_mobile'])->update(['otp' => $otp]);
            if ($update) {

                $randnum = rand(1000, 10000);
                $sm = $request['mobile']['user_mobile'];
                $user = User::where('mobile', $request['mobile']['user_mobile'])->first();
                $user->otp = $randnum;
                $user->otp_valid_date = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . " +" . config('constants.SMS_EXPIRY') . " hours"));

                $token = str_random(60);
                $findUser = DB::table('password_resets')->where('email', $request['mobile']['user_mobile'])->limit(1)->first();
                if($findUser) {
                    DB::table('password_resets')->where('email', $request['mobile']['user_mobile'])->update([
                        'token' => $token,
                        'created_at' => date('Y-m-d h:i:s'),
                    ]);
                }
                else {
                    DB::table('password_resets')->insert([
                        'email' => $request['mobile']['user_mobile'],
                        'token' => $token,
                        'created_at' => Carbon::now()
                    ]);
                }

                $urltoken = base64_encode(json_encode(['email'=>$request['mobile']['user_mobile'], 'token'=>$token]));
                $user_data = ['user_id' => $user->id, 'email' => $user->email, 'mobile' => $user->mobile,'token'=>$urltoken];
                $result = ['status' => 1, 'message' => "Your otp for forgot password is send on your registered mobile number. Please check.", 'data' => $user_data];
                $user->save();
                $message = "Your otp for forgot password is " . $otp . " \n Thanks \n Imagefootage Team";
                $smsClass = new TnnraoSms;
                $smsClass->sendSms($message, $request['mobile']['user_mobile']);
                return response()->json($result, 200);
            } else {
                return response()->json(['status' => '0', 'message' => 'Error in sending otp again !!!'], 200);
            }
        } else {
            return response()->json(['status' => 0, 'message' => 'Mobile Number Not Found.']);
        }
    }
    public function requestChangePassword(Request $request)
    {
        $count = User::where('mobile', '=', $request['mobile'])->where('otp', '=', $request['user_otp'])->count();
        if ($count > 0) {
            $update = User::where('mobile', $request['user_mobile'])->update(['password' => Hash::make($request['user_password'])]);
            if ($update) {
                return response()->json(['status' => '1', 'message' => ' Password Succesfully changed, Please Log In using new password'], 200);
            } else {
                return response()->json(['status' => '0', 'message' => 'Some problem occured !!!'], 200);
            }
        } else {
            return response()->json(['status' => 0, 'message' => 'Enter correct otp.']);
        }
    }
    public function userOrders($id)
    {
        if ($id > 0) {
            $OrderData = Orders::with(['items' => function ($query) {
                $query->with('product');
            }])
                ->where('user_id', '=', $id)
                ->whereIn('order_status', ['Completed', 'Transction Success'])
                ->orderBy('id', 'desc')
                ->get()->toArray();
            echo json_encode(['status' => "success", 'data' => $OrderData]);
        } else {
            echo json_encode(['status' => "fail", 'data' => '', 'message' => 'Some error happened']);
        }
    }

    # Purchase history
    public function purchaseHistory(Request $request)
    {
        $userId      = $request->user_id;
        $mediaType   = $request->media_type;
        $licenseType = $request->license_type;
        $range       = $request->input('range', 'today');

        $startDate = null;
        $endDate   = null;

        switch ($range) {
            case 'today':
                $startDate = Carbon::today()->startOfDay();
                $endDate = Carbon::today()->endOfDay();
                break;
            case 'last_week':
                $startDate = Carbon::today()->subWeek()->startOfWeek();
                $endDate = Carbon::today()->subWeek()->endOfWeek();
                break;
            case 'last_month':
                $startDate = Carbon::today()->subMonth()->startOfMonth();
                $endDate = Carbon::today()->subMonth()->endOfMonth();
                break;
            case 'custom':
                $startDate = $request->input('start_date');
                $endDate = $request->input('end_date');
                break;
        }

        if ($request->user_id) {
            $orderData = Orders::with(['items'])
                ->with(['items.licence'])
                ->where('user_id', '=', $userId)
                ->whereIn('order_status', ['Completed', 'Transction Success']);
                if ($range !== 'all') {
                    $orderData->whereDate('order_date', '>=', $startDate)
                            ->whereDate('order_date', '<=', $endDate);
                }
                $orderData=  $orderData->whereHas('items', function ($productquery) use ($mediaType,$licenseType) {
                    if ($mediaType != 'All') {
                        $productquery->where('product_type', $mediaType);
                    }
                })
                ->whereHas('items', function ($query) use ($licenseType) {
                    if ($licenseType != 'All') {
                        $query->where('footage_tier', $licenseType);
                    }
                })
                ->orderBy('id', 'desc')

                ->paginate(5)
                ->toArray();

            return json_encode(['status' => "success", 'data' => $orderData]);

        } else {
            return json_encode(['status' => "fail", 'data' => '', 'message' => 'Some error happened']);
        }
    }

    # Download history
    public function downloadHistory(Request $request)
    {
        $userId      = $request->user_id;
        $mediaType   = $request->media_type;
        $licenseType = $request->license_type;
        $range       = $request->input('range', 'today');
        $startDate = null;
        $endDate   = null;

        switch ($range) {
            case 'today':
                $startDate = Carbon::today()->startOfDay();
                $endDate = Carbon::today()->endOfDay();
                break;
            case 'last_week':
                $startDate = Carbon::today()->subWeek()->startOfWeek();
                $endDate = Carbon::today()->subWeek()->endOfWeek();
                break;
            case 'last_month':
                $startDate = Carbon::today()->subMonth()->startOfMonth();
                $endDate = Carbon::today()->subMonth()->endOfMonth();
                break;
            case 'custom':
                $startDate = $request->input('start_date');
                $endDate = $request->input('end_date');
                break;
        }

        if ($request->user_id) {

            $downloads = ProductsDownload::with(['product'])
                ->with('licence')
                ->where('user_id', '=', $userId);
                if ($range !== 'all') {
                    $downloads->whereDate('created_at', '>=', $startDate)
                            ->whereDate('created_at', '<=', $endDate);
                }
                if ($mediaType != 'All') {
                    $downloads->where('product_type', $mediaType);
                }
                
            $downloads = $downloads->whereHas('licence', function ($query) use ($licenseType) {
                    if ($licenseType != 'All') {
                        $query->where('id', $licenseType);
                    }
                });
            $downloads = $downloads->orderBy('id', 'desc')
                ->paginate(5)
                ->toArray();
                
            echo json_encode(['status' => "success", 'data' => $downloads]);
        } else {
            echo json_encode(['status' => "fail", 'data' => '', 'message' => 'Some error happened']);
        }
    }

    public function update_profile(Request $request)
    {
        $data = $request->all();

        $validator = \Validator::make($request->profileData ?? [], [
            'email' => 'required|unique:imagefootage_users,email,' . $data['tokenData']['Utype'],
            'mobile' => 'required|unique:imagefootage_users,mobile,' . $data['tokenData']['Utype'],
        ], [
            'mobile.unique' => 'The mobile no has already been taken.',
        ]
    );

        if ($validator->fails()) {
            return response()->json(["message" => $validator->errors()->first()], 200);
        }
        $token = $request->header('Authorization');

        // Assuming the token is in the format 'Bearer YOUR_ACCESS_TOKEN'
        $token = str_replace('Bearer ', '', $token);

        if (count($data['profileData']) > 0 && count($data['tokenData']) > 0) {
            $userlist = User::where('id', '=', $data['tokenData']['Utype'])
                ->select('id', 'first_name', 'last_name', 'mobile', 'email', 'user_name', 'phone', 'address', 'country', 'state', 'city', 'postal_code', 'address2')
                ->with('country')
                ->with('state')
                ->with('city')
                ->first();
            if (empty($userlist)) {
                echo json_encode(['status' => "fail", 'message' => 'Profile not found', 'data' => '']);
            }
            $panNumber = '';
            if(isset($data['profileData']['gst']) && !empty($data['profileData']['gst'])){
                $panNumber = $this->extractPanFromGst($data['profileData']['gst']);
            }
            $update_data = [
                'first_name' => $data['profileData']['first_name'],
                'mobile' => $data['profileData']['mobile'],
                'address' => $data['profileData']['address'],
                'country' => $data['profileData']['country'],
                'state' => $data['profileData']['state'],
                'city' => $data['profileData']['city'],
                'postal_code' => $data['profileData']['pincode'],
                'address2' => $data['profileData']['address2'] ?? $userlist['address2'],
                'company' => $data['profileData']['company'] ?? '',
                'email' => $data['profileData']['email'] ?? '',
                'gst'  => $data['profileData']['gst'] ?? '',
                'pan'  =>$panNumber
            ];
            if (empty($userlist['country'])) {
                $update_data['country'] = $data['profileData']['country'];
            }
            $update = User::where('id', '=', $data['tokenData']['Utype'])->update($update_data);

            if ($userlist['mobile'] != $data['profileData']['mobile']) {
                $content = array('name' => $userlist->first_name, 'email' => $userlist->email);
                Mail::to($content['email'])->send(new ChangeMobileMail($content));
            }

            if ($userlist['state'] != $data['profileData']['state'] || $userlist['city'] != $data['profileData']['city']) {
                $content = array('name' => $userlist->first_name, 'email' => $userlist->email);
                Mail::to($content['email'])->send(new ChangeAddressEmail($content));
            }
           $user_data=User::where('id',$data['tokenData']['Utype'])->with('country')->with('state')->with('city')->first();


            $result = clone $userlist;
            $result = $result->toArray();
            echo json_encode(['status' => "success", 'message' => 'Profile updated successfully.', 'data' => $user_data,'user_data'=>$this->respondWithToken($token)]);
        } else {
            echo json_encode(['status' => "fail", 'message' => 'Some error happened', 'data' => '']);
        }
    }


    /**
     * Active user account
     */
    public function activeUserAccount($token = "")
    {
        // return redirect(env("FRONT_END_URL") . "account-activated/$email");
        return redirect(env("FRONT_END_URL") . "account-verification/$token");
    }

    /**
     * Delete user account
     */
    public function deleteUserAccount($user_id, Request $request)
    {
        try {
            if ($user_id) {
                $userToDelete = User::find($user_id);
                if ($userToDelete) {
                    DB::beginTransaction();
                    try {
                        UserPackage::where('user_id',$user_id)->delete();
                        UserProductDownload::where('user_id',$user_id)->delete();
                        Orders::where('user_id',$user_id)->delete();
                        DB::table('imagefootage_performa_invoices')->where('user_id',$user_id)->delete();
                        DB::table('imagefootage_performa_invoice_items')->where('user_id',$user_id)->delete();
                        Usercart::where('cart_added_by',$user_id)->delete();
                        DB::table('plan_subscriptions')->where('user_id',$user_id)->delete();
                        DB::table('user_paid_payments')->where('user_id',$user_id)->delete();
                        DB::table('imagefootage_users_wishlist')->where('user_id',$user_id)->delete();
                        $userToDelete->delete();
                        DB::commit();

                    } catch (\Exception $e) {
                        DB::rollBack();
                        return response()->json(["success" => false, "message" => "User not found. Please try again later."], 200);
                    }
                    return response()->json(["success" => true, "message" => "User deleted successfully."], 200);
                } else {
                    throw new Exception("User not found. Please try again later.");
                }
            } else {
                throw new Exception("Invalid user id. Please try again later.");
            }
        } catch (\Exception $e) {
            return response()->json(['error' => true, "message" => $e->getMessage()], 200);
        }
    }

    /**
     * Get the list of user packages which is best match for the requested amount of images.
     */
    public function getAvailablePackageList(Request $request)
    {
        $getUserPackages = UserPackage::whereIn('payment_status', ['Completed', 'Transction Success'])
            ->where(['status' => 1, 'user_id' => $request->user_id, 'package_type' => 'Image'])
            ->whereRaw('package_products_count > downloaded_product')
            ->whereDate('package_expiry_date_from_purchage', '>=', Carbon::today())
            ->orderBy('id', 'desc')
            ->select('id', 'package_name', 'package_description', 'user_id', 'package_price', 'package_type', 'package_products_count', 'downloaded_product', 'transaction_id', 'created_at as updated_at', 'package_expiry_date_from_purchage', 'invoice', 'order_type')->get();

        if ($getUserPackages->isNotEmpty()) {
            $checkAlreadyDownloadedImage = ProductsDownload::where('user_id', 208)
                ->whereIn('id_media', $request->imageIds)
                ->distinct('id_media')
                ->pluck('id_media')->count();

            $finalPackagelist = [];
            $setHighestCountPackage = ['available_balance' => 0]; // Initialize to null before the loop
            foreach ($getUserPackages as $package) {
                $availableBalance = $package->package_products_count - $package->downloaded_product;
                if (($availableBalance) > ($request->downloadCount - $checkAlreadyDownloadedImage)) {
                    $finalPackagelist[] = $package->toArray();
                } else {
                    if (($availableBalance >= $setHighestCountPackage['available_balance'])) {
                        $setHighestCountPackage = [
                            'package_name' => $package->package_name,
                            'available_balance' => $availableBalance,
                        ];
                    }
                }
            }
            if (isset($finalPackagelist) && $finalPackagelist) {
                return response()->json(['status' => true, 'data' => $finalPackagelist]);
            } else {
                return response()->json(['status' => true, 'data' => "No suitable package is available for your requirement. Currently, you have a " . $setHighestCountPackage['available_balance'] . " images package with the highest available compared to your requirement. Please update your selection and use the " . $setHighestCountPackage['package_name'] . " plan to download."]);
            }
        } else {
            return response()->json(["success" => false, "message" => "At the moment, there are no packages associated with your account. To get started, consider acquiring a package."], 200);
        }
    }

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
            return [
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
            ];
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

    public function extractPanFromGst($gstNumber) {

        // Define the regular expression pattern for extracting PAN from GST
        $pattern = '/[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[0-9]{1}[A-Z]{1}[0-9]{1}/';

        // Match the pattern in the GST number
        preg_match($pattern, $gstNumber, $matches);

        // Extracted PAN number is in the first match
        if (!empty($matches)) {
            return substr($matches[0], 2, 10); // Extract the PAN part (characters 3 to 12)
        }

        // If no match is found, return null or handle accordingly
        return null;
    }
}
