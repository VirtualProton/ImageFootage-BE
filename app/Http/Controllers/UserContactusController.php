<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

use Mail;
use Image;
use File;

use App\Models\City;
use App\Models\User;
use App\Models\State;
use App\Models\Country;
use App\Models\Contributor;
use App\Models\Usercontactus;
use App\Models\ProductImages;

use Aws\S3\S3Client;
use Aws\S3\MultipartUploader;
use Aws\Exception\MultipartUploadException;

use App\Http\TnnraoSms\TnnraoSms;
use App\Mail\ChangePassword;
use App\Helpers\Helper;

class UserContactusController extends Controller
{
    public function submitContactUs(Request $request){
        $validator = \Validator::make(request()->all(), [
            'user_name' => 'required|min:2',
            'mobile_number' => 'required|digits:10',
            'user_email' => 'required|email', 
            'user_subject' => 'required',
            'user_message' => 'required'
        ]);

        if ($validator->fails()) {    
            return response()->json(['status' => false, 'message' => $validator->messages()], 200);
        }
        if(!Helper::disposableEmailCheck($request->input('user_email'))) {
            return response()->json([
                'status' => false,
                'message' => 'Disposable email addresses are not allowed.'
            ]);
        }
        $name=$request->user_name; 
        $mobile=$request->mobile_number;
        $user_email=$request->user_email;
        $user_message=$request->user_message;
        $user_subject=$request->user_subject;
        $Usercontactus=new Usercontactus;
        $Usercontactus->contactus_name=$name;
        $Usercontactus->contactus_mobileno=$mobile;
        $Usercontactus->contactus_emailid=$user_email;
        $Usercontactus->contactus_subject=$user_subject;
        $Usercontactus->contactus_message=$user_message;
        $Usercontactus->cart_added_on=date('Y-m-d H:i:s');
        $result=$Usercontactus->save();
		$sm='info@imagefootage.com';
        if($result){
			 $data = array('name'=>$name,'mobile'=>$mobile,'email'=>$user_email,'user_message'=>$user_message,'user_subject'=>$user_subject);
				 Mail::send('contactusmailbody',$data,function($message) use($data,$sm) {
                 $email_to = config('constants.ADMIN_EMAIL');
				 $message->to($email_to,'Image Footage')
                     ->from($sm,'Admin Imagefootage')
                     ->subject('Contact us request from Image Footage');
			 });
            return response()->json([
                'status' => true,
                'message' => 'Your message has been sent successfully.'
            ], 200);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Some problem occured.'
            ], 200);
        }
    }
	public function uchangepassword(Request $request){
		$old_pass=$request->old_pass;
		$password=$request->password;
		$cpassword=$request->cpassword;
		$user_id=$request->userid;
		if(!isset($old_pass) && empty($old_pass)){
			 return response()->json(['status'=>'0','message' => 'Old Password is required.'], 200);
		}
		if(!isset($password) && empty($password)){
			 return response()->json(['status'=>'0','message' => 'Password is required.'], 200);
		}
		if(!isset($cpassword) && empty($cpassword)){
			 return response()->json(['status'=>'0','message' => 'Confirm Password is required.'], 200);
		}
		if($password!=$cpassword){
			  return response()->json(['status'=>'0','message' => 'Password and Confirm Password must match.'], 200);
		}
        $user = User::where('id','=',$user_id)->first();
        if(empty($user)){
            return response()->json(['status'=>'0','message' => 'User not found.'], 404);
        }
		$email= $user->email;
		$name= $user->first_name;
		$credentials = ['email'=>$email, 'password'=>$old_pass];
          if (!$token = auth()->attempt($credentials)) {
                return response()->json(['status'=>'0','message' => 'Old Password is wrong.'], 200);
            }else{
                $result=User::where('id',$user_id)->update(['password'=>Hash::make($password)]);
                if($result){
                        $content = array('name' => $name, 'email' => $email);
                        Mail::to($content['email'])->send(new ChangePassword($content));
                        return response()->json(['status'=>'1','message' => 'Password changed successfully.'], 200);
                }else{
                        return response()->json(['status'=>'0','message' => 'Some problem occured'], 200);
                }
	        }
	}

    public function getCountyStatesCityList(){
        ini_set('max_execution_time',0);
        $county_list = Country::get()->toArray();
        return json_encode($county_list);
    }
    public function getCountyStatesList($country){
        ini_set('max_execution_time',0);
        $state_list = State::where('country_id',$country)->get()->toArray();
        return json_encode($state_list);
    }
    public function getStateCityList($state){
        ini_set('max_execution_time',0);
        $cities_list = City::where('state_id',$state)->get()->toArray();
        return json_encode($cities_list);
    }
    public function contributorSignup(Request $request){
        ini_set('max_execution_time',0);
        $data = $request->all();
        $contributor_data =json_decode($data['Info'],true);
        $file= $data['image'];

        /*$this->validate($request, [
              'contributor_name'=>'required',
             'contributor_email'   => 'required',
             'contributor_password' => 'required',
             'contributor_confirm_password' => 'required|same:contributor_password',
             'contributor_idproof'=>'required|file',
             'contributor_type'=>'required'
         ]); */
        $record = Contributor::orWhere('contributor_memberid',$contributor_data['contributor_name'])
            ->orWhere('contributor_email',$contributor_data['contributor_email'])
            ->count();
        if($record==0){
            $contributor = new Contributor;
            $contributor->contributor_memberid = $contributor_data['contributor_fname'];
            $contributor->contributor_name=$contributor_data['contributor_fname']." ".$contributor_data['contributor_lname'];
            $contributor->contributor_email = $contributor_data['contributor_email'];
            $contributor->contributor_mobile = $contributor_data['contributor_mobile'];
            $contributor->contributor_password= Hash::make($contributor_data['contributor_password']);
            //$contributor->contributor_password=md5($pass);
            if($contributor_data['contributor_type']=='sale'){
                $contributor->contributor_type = "For Sale";
            }else{
                $contributor->contributor_type = "Donor";
            }
            $contributor->contributor_added_on = date('Y-m-d H:i:s');
            //$contributor->contributor_addedby=Auth::guard('admins')->user()->id;
            $contributor->contributor_accountholder=$contributor_data['bank_holder_name'];
            $contributor->contributor_banknumber=$contributor_data['bank_account_number'];
            $contributor->contributor_ifsc=$contributor_data['ifsc_number'];
            $contributor->contributor_bank=$contributor_data['bank_name'];
            $otp = rand(100000,999999);
            $key = rand(10000000,99999999);
            $hkey = Hash::make($key);
            $contributor->email_verification = $hkey;
            $contributor->contributor_otp = $otp;
            if($file) {
                $name = time().$file->getClientOriginalName();
                $files2bucketemp= $file->getPathName();
                $file_path = 'image/contributor/';
                $destinationPath = public_path($file_path);
                //$image->move($destinationPath, $name);
                $s3Client = new S3Client([
                    /*'profile' => 'default',*/
                    'region' => 'us-east-2',
                    'version' => '2006-03-01'
                ]);
                // Use multipart upload
                $finelname= $file_path.$name;
                $source = $files2bucketemp;
                $uploader = new MultipartUploader($s3Client, $source, [
                    'bucket' => 'imgfootage',
                    'key' => $finelname,
                ]);

                try {
                    $fileupresult = $uploader->upload();
                    $name = $fileupresult['ObjectURL'];
                    $contributor->contributor_idproof =$name;
                } catch (MultipartUploadException $e) {
                    echo $e->getMessage() . "\n";
                }
            }
            $result = $contributor->save();
            if($result){
                $cont_url= url('emailVerification?key='.$hkey);
                $data = array('cname'=>$contributor_data['contributor_fname']." ".$contributor_data['contributor_lname'],'cemail'=>$contributor_data['contributor_email'],'cont_url'=>$cont_url);
                Mail::send('email.frontverifycontributor', $data, function($message) use($data) {
                    $message->to($data['cemail'],$data['cname'])->subject('Welcome to Image Footage')->from('admin@imagefootage.com', 'Imagefootage');
                });
                $message = "Thanks For register with us as contributor. To verify your mobile number otp is ".$otp." \n Thanks \n Imagefootage Team";
                $smsClass = new TnnraoSms;
                $smsClass->sendSms($message,$contributor_data['contributor_mobile']);
                return response()->json(['status'=>'1','message' => 'Successfully registered.Please verify your email and Mobile Number'], 200);
            }else{
                return response()->json(['status'=>'0','message' => 'Not registered'], 200);
            }
        }else{
            return response()->json(['status'=>'0','message' => 'Username Or Email already registerd !!!.Please Try another.'], 200);
        }
    }

    public function resendOtp(Request $request){
        $data = $request->all();
        $otp = rand(100000,999999);
        $update = Contributor::where('contributor_email',$data['email'])
            ->where('contributor_mobile',$data['mobile'])
            ->update(['contributor_otp'=>$otp]);
        if($update){
            $message = "Thanks For register with us as contributor. To verify your mobile number otp is ".$otp." \n Thanks \n Imagefootage Team";
            $smsClass = new TnnraoSms;
            $smsClass->sendSms($message,$data['mobile']);
            return response()->json(['status'=>'1','message' => 'Otp Again send on your mobile. Please verify !!!'], 200);
        }else{
            return response()->json(['status'=>'0','message' => 'Error in sending otp again !!!'], 200);
        }

    }

    public function verifyOtp(Request $request){
        $data = $request->all();
        $otp  = Contributor::select('contributor_otp','contributor_id')
            ->where('contributor_email',$data['email'])
            ->where('contributor_mobile',$data['mobile'])
            ->first();
        if($otp['contributor_otp']== $data['otp']['otp']){
            Contributor::where('contributor_id',$otp['contributor_id'])
                ->update(['is_mobile_verified'=>1]);
            return response()->json(['status'=>'1','message' => 'Your mobile number verified successfully !!!'], 200);
        }else{
            return response()->json(['status'=>'0','message' => 'Please enter correct otp !!!'], 200);
        }

    }

    public function emailVerification(Request $request){
        $data = $request->all();
        if(isset($data['key']) && !empty($data['key'])){
            $otp  =  Contributor::select('contributor_id')
                ->where('email_verification',$data['key'])
                ->first();
            if(isset($otp['contributor_id']) && $otp['contributor_id']>0){
                Contributor::where('email_verification',$data['key'])
                    ->update(['is_email_verified'=>1]);
                //return response()->json(['status'=>'1','message' => 'Your email ID verified successfully !!!'], 200);
                return view('emailVerify', ['status' => 1,'message'=>'Your Email ID Verified Successfully !!!']);
            }else{
                //return response()->json(['status'=>'10','message' => 'Your email ID not verified !!!'], 200);
                return view('emailVerify', ['status' => 0,'message'=>'Your Email ID Not Verified !!!']);
            }

        }

    }
	public function forResetPassword(Request $request){

        $validator = \Validator::make($request->all(), [
            'email' => 'required|email',
            'otp' => 'required',
            'password' => 'required|min:6|required_with:cpassword|same:cpassword',
            'cpassword' => 'required|min:6',
        ])->setAttributeNames(
            ['cpassword' => 'confirm password']
        );

        if ($validator->fails()) {    
            return response()->json($validator->messages(), 200);
        }


        $email=$request->email;
        $otp=$request->otp;
        $password=$request->password;
        $cpassword=$request->cpassword;
		//  if(!isset($password) && empty($password)){
		// 	 return response()->json(['status'=>'0','message' => 'Password is required.'], 200);
		//  }
		//  if(!isset($cpassword) && empty($cpassword)){
		// 	 return response()->json(['status'=>'0','message' => 'Confirm Password is required.'], 200);
		//  }
		//  if($password!=$cpassword){
		// 	  return response()->json(['status'=>'0','message' => 'Password and Confirm Password must match.'], 200);
		//  }
		 $check_otp=User::where('email',$email)->where('otp',$otp)->first();
                  
        if(isset($check_otp) && !empty($check_otp)){
         $result=User::where('email',$email)->update(['password'=>Hash::make($password),'otp'=>NULL]);
            // $result=User::where('email',$email)->update(['password'=>Hash::make($password)]);
            if($result){
                return response()->json(['status'=>'1','message' => 'Password changed successfully !!!'], 200);
            }else{
                return response()->json(['status'=>'0','message' => 'Some problem occured'], 200);	
            }
        }else{
            return response()->json(['status'=>'0','message' => 'Wrong OTP'], 200);			 
        }	
	}
}
