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
use Exception;
use Illuminate\Support\Facades\Hash;
use App;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Auth;
use App\Mail\ChangeMobileMail;

class UserController extends Controller
{
   public function userProfile($id){

	   $send_data = [];
        $userlist= User::where('id',$id)
                    ->with('country')
                    ->with('state')
                    ->with('city')
                    ->with(['plans'=> function ($query) {
                        $query->whereIn('payment_status',['Completed','Transction Success'])
                            //->whereRaw('package_products_count > downloaded_product')
                            ->orderBy('id', 'desc')
                            ->select('id', 'package_name','package_description', 'user_id', 'package_price', 'package_type', 'package_products_count', 'downloaded_product', 'transaction_id', 'created_at as updated_at', 'package_expiry_date_from_purchage', 'invoice')
                            ->with(['downloads' => function($down_query){
                                $down_query->select('id', 'product_id', 'user_id', 'package_id', 'product_name', 'product_size', 'downloaded_date', 'download_url', 'product_poster', 'product_thumb', 'web_type');
                            }]);
                        }
                    ]) 
                    ->get()->toArray();
       
        if(count($userlist)>0){
	          foreach($userlist as $user){
                  $send_data['first_name'] =$user['first_name'];
                  $send_data['last_name'] =$user['last_name'];
                  $send_data['title'] =$user['title'];
                  $send_data['email'] =$user['email'];
                  $send_data['user_name'] =$user['user_name'];
                  $send_data['contact_owner'] =$user['contact_owner'];
                  $send_data['mobile'] =$user['mobile'];
                  $send_data['phone'] =$user['phone'];
                  $send_data['address'] =$user['address'];
                  $send_data['status'] =$user['status'];
                  $send_data['type'] =$user['type'];
                  $send_data['postal_code'] =$user['postal_code'];
                  $send_data['plans'] =$user['plans'];
                  $send_data['city'] =$user['city'];
                  $send_data['state'] =$user['state'];
                  $send_data['country'] =$user['country'];

                  $image_download=0;
                  $footage_download=0;
                  foreach($user['plans'] as $plan){
                      if($plan['package_type']=='Image'){
                          $image_download=1;
                      }else if($plan['package_type']=='Footage'){
                          $footage_download=1;
                      }
                  }
                  $send_data['image_download'] = $image_download;
                  $send_data['footage_download'] = $footage_download;
              }
                return '{"status":"1","message":"","data":'.json_encode($send_data).'}';
	   }else{
				return '{"status":"0","message":"Some problem occured.","data":"[]"}';
	   }
   }
   public function getUserAddress(Request $request){
	   $id=$request->Utype;
	   $userlist=User::select('first_name','last_name','address','city','state','country','postal_code')->where('id',$id)->first();
	   return '{"status":"1","message":"","data":'.json_encode($userlist).'}';
	   
   }
   public function contributorProfile($id){
	   $User=new Contributor();
	   $userlist=$User->where('contributor_id',$id)->get()->toArray();
	   
	    if(count($userlist)>0){
				return '{"status":"1","message":"","data":'.json_encode($userlist).'}';
	   }else{
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
    public function validUser(Request $request){
        $hostname = \Request::server('HTTP_REFERER');
        $count = User::where('email','=',$request['email']['user_email'])->count();
		if($count>0){
            $randnum=rand(1000,10000);
			$sm=$request['email']['user_email'];
			$update_array=array('otp'=>$randnum);
		    $result = User::where('email',$request['email']['user_email'])->update($update_array);
			// $url = 'https://imagefootage.com/resetpassword/'.$randnum.'/'.$request['email']['user_email'];
            $url = $hostname."/resetpassword/".$randnum."/".$request['email']['user_email'];
            $data = array('url'=>$url,'email'=>$request['email']['user_email']);
			Mail::send('email.forgotpasswordadmin', $data, function($message) use($data) {
                     $message->to($data['email'], '')->subject('Image Footage Forget Password')
                        ->from('admin@imagefootage.com', 'Imagefootage');
				  });
            $result = ['status'=>1,'message'=>'Check your email for reset password link.'];
        }else{
            $result = ['status'=>0,'message'=>'Email Not Found.'];
        }
        return response()->json($result);
    }
	public function validMobileUser(Request $request){
        $hostname = \Request::server('HTTP_REFERER');
		$count = User::where('mobile','=',$request['mobile']['user_mobile'])->count();
		if($count>0){
			$otp = rand(100000,999999);
			$update = User::where('mobile',$request['mobile']['user_mobile'])->update(['otp'=>$otp]);
			if($update){

                $randnum=rand(1000,10000);
                $sm=$request['mobile']['user_mobile'];
                $update_array=array('otp'=>$randnum);
                $user = User::where('mobile',$request['mobile']['user_mobile'])->first();
                $user->otp = $randnum;
                // $url = 'https://imagefootage.com/resetpassword/'.$randnum.'/'.$request['email']['user_email'];
                $url = $hostname."/resetpassword/".$randnum."/".$user->email;
                $data = array('url'=>$url,'email'=>$user->email);
                Mail::send('email.forgotpasswordadmin', $data, function($message) use($data) {
                        $message->to($data['email'], '')->subject('Image Footage Forget Password')
                            ->from('admin@imagefootage.com', 'Imagefootage');
                    });
                $maskEmail = Helper::obfuscate_email($user->email);
                $result = ['status'=>1,'message'=>"Check your email for reset password link ($maskEmail)."];
                $user->save();
				// $message = "Your otp for forgot password is ".$otp." \n Thanks \n Imagefootage Team";
				// $smsClass = new TnnraoSms;
				// $smsClass->sendSms($message,$request['mobile']['user_mobile']);
				return response()->json($result, 200);
			}else{
				return response()->json(['status'=>'0','message' => 'Error in sending otp again !!!'], 200);
			}
		}else{
			return response()->json(['status'=>0,'message'=>'Mobile Number Not Found.']);
		}
	}
	public function requestChangePassword(Request $request){
		$count = User::where('mobile','=',$request['mobile'])->where('otp','=',$request['user_otp'])->count();
		if($count>0){
			$update = User::where('mobile',$request['user_mobile'])->update(['password'=>Hash::make($request['user_password'])]);
			if($update){
				return response()->json(['status'=>'1','message' => ' Password Succesfully changed, Please Log In using new password'], 200);
			}else{
				return response()->json(['status'=>'0','message' => 'Some problem occured !!!'], 200);
			}
			
		}else{
			return response()->json(['status'=>0,'message'=>'Enter correct otp.']);
		}
		
	}
    public function userOrders($id){
        if($id>0){
            $OrderData = Orders::with(['items'=>function($query){
                    $query->with('product');
                }])
                ->where('user_id','=',$id)
                ->whereIn('order_status',['Completed','Transction Success'])
                ->orderBy('id','desc')
                ->get()->toArray();
            echo json_encode(['status'=>"success",'data'=>$OrderData]);
        }else{
            echo json_encode(['status'=>"fail",'data'=>'','message'=>'Some error happened']);
        }

    }

    public function update_profile(Request $request)
    {
        $data = $request->all();

        $validator = \Validator::make($request->profileData ?? [], [
            'mobile' => 'required|unique:imagefootage_users,mobile,' . $data['tokenData']['Utype'],
            'mobile' => 'required|unique:imagefootage_users,phone,' . $data['tokenData']['Utype'],
        ]);

        if ($validator->fails()) {
            return response()->json(["error" => $validator->messages()], 200);
        }

        if (count($data['profileData']) > 0 && count($data['tokenData']) > 0) {
            $userlist = User::where('id', '=', $data['tokenData']['Utype'])
            ->select('id', 'first_name', 'last_name', 'mobile', 'email', 'user_name', 'phone', 'address', 'country', 'state', 'city', 'postal_code', 'address2')
            ->with('country')
            ->with('state')
            ->with('city')
            ->first();
            $update_data = [
                'first_name' => $data['profileData']['first_name'],
                'mobile' => $data['profileData']['mobile'],
                'phone' => $data['profileData']['phone'],
                'address' => $data['profileData']['address'],
                'state' => $data['profileData']['state'],
                'city' => $data['profileData']['city'],
                'postal_code' => $data['profileData']['pincode'],
                'address2' => $data['profileData']['address2'] ?? '',
            ];
            if (empty($userlist['country'])) {
                $update_data['country'] = $data['profileData']['country'];
            }
            $update = User::where('id', '=', $data['tokenData']['Utype'])->update($update_data);

            if ($userlist['mobile'] != $data['profileData']['mobile']) {
                $content = array('name' => $userlist->first_name, 'email' => $userlist->email);
                Mail::to($content['email'])->send(new ChangeMobileMail($content));
            }

            $result = clone $userlist;
            $result = $result->toArray();
            echo json_encode(['status' => "success", 'data' => $result]);
        } else {
            echo json_encode(['status' => "fail", 'data' => '', 'message' => 'Some error happened']);
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
            $user = auth('api')->user();
    
            if($user->id == $user_id){
                $userToDelete = User::find($user->id);
                if($userToDelete){
                    $userToDelete->delete();
                    return response()->json(["success"=>true, "message"=> "User deleted successfully."], 200);
                } else {
                    throw new Exception("User not found. Please try again later.");
                }
            } else {
                throw new Exception("Invalid user id. Please try again later.");
            }
        } catch (\Exception $e) {
            return response()->json(['error'=>true, "message"=> $e->getMessage()], 200);
        }

    }

}
