<?php

namespace App\Http\Controllers;

use App\Models\ProductImages;
use Aws\Exception\MultipartUploadException;
use Aws\S3\MultipartUploader;
use Aws\S3\S3Client;
use Illuminate\Http\Request;
use App\Models\Usercontactus;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Mail;
use Image;
use File;
use App\Http\TnnraoSms\TnnraoSms;
use App\Models\Contributor;

class UserContactusController extends Controller
{
   public function submitContactUs(Request $request){
	   $name=$request->user_name;
	   $mobile=$request->mobile_number;
	   $user_email=$request->user_email;
	   $user_message=$request->user_message;
	   $Usercontactus=new Usercontactus;
	   $Usercontactus->contactus_name=$name;
	   $Usercontactus->contactus_mobileno=$mobile;
	   $Usercontactus->contactus_emailid=$user_email;
	   $Usercontactus->contactus_message=$user_message;
	   $Usercontactus->cart_added_on=date('Y-m-d H:i:s');
	   $result=$Usercontactus->save();
	   if($result){
				echo '{"status":"1","message":"Contact us subbmitted successfully"}';
	   }else{
				echo '{"status":"0","message":"Some problem occured."}';
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

		//echo 'here'; exit();
		$user = Contributor::where('contributor_email', '=', $request->contributor_email)->first();
		
if ($user === null) {
			$chars = "abcdefghijkmnopqrstuvwxyz023456789"; 
			srand((double)microtime()*1000000); 
			$i = 0; 
			$pass = '' ; 
			while ($i <= 7) { 
				$num = rand() % 33; 
				$tmp = substr($chars, $num, 1); 
				$pass = $pass . $tmp; 
				$i++; 
			} 
			
		 $contributor = new Contributor;
		 $file = $request->file('contributor_idproof');
		 $cemail='';
		 $cemail='';
		 //Get the first three characters using substr.
		 $firstThreeCharacters = substr($request->contributor_name, 0, 3);
		 $firstThreeCharactersType = substr($request->contributor_type, 0, 3);
		 $contributorid=$firstThreeCharacters.$firstThreeCharactersType;
		 $cname=$request->contributor_name;
		 $cemail=$request->contributor_email;
         $contributor->contributor_memberid =$contributorid;
		 $contributor->contributor_name=$request->contributor_name;
		 $contributor->contributor_email=$request->contributor_email;
		 $contributor->contributor_mobile=$request->contributor_mobile;
		 $contributor->contributor_password=md5($request->contributor_password);
		 //$contributor->contributor_password=md5($pass);
		 $contributor->contributor_type=$request->contributor_type;
		 $contributor->contributor_added_on=date('Y-m-d H:i:s');
		 //$contributor->contributor_addedby=Auth::guard('admins')->user()->id;
		 $contributor->contributor_accountholder=$request->bank_holder_name;
		 $contributor->contributor_banknumber=$request->bank_account_number;
		 $contributor->contributor_ifsc=$request->ifsc_number;
		 $contributor->contributor_bank=$request->bank_name;
		 $result=$contributor->save();
		 $last_id=$contributor->contributor_id;
		 if($result){
			 if($last_id < 10){
				 $last_id='00'.$last_id;
			 }else if($last_id < 100){
				 $last_id='0'.$last_id;
			 }
			 if($request->hasFile('contributor_idproof')) {
				$image = $request->file('contributor_idproof');
				$name = time().'.'.$image->getClientOriginalExtension();
				$file_path='/uploads/idproof/';
				$destinationPath = public_path($file_path);
				$image->move($destinationPath, $name);	
    		 }
			 $contributorid=strtolower($firstThreeCharacters.$firstThreeCharactersType.$last_id);
			 $contributor_update = Contributor::find($last_id);
			 $contributor_update->contributor_memberid=$contributorid;
			 $contributor_update->contributor_idproof=$name;
			 $contributor_update->save();
			 //$body="Dear ".$cname.",</br>";
			 //$body.="Please click the below link for activate your contributor account</br>";
			 //$body.='OTP:- '.$pass.'<br>';
			 $cont_url=url('admin/contributorotpvalidate/').'/'.$last_id;
			 //$body.='<a href="'.$cont_url.'">Click here to verify account</a>';
			 //$body.="Thanks & Regards,<br>Image Footage Team.";
			 $data = array('cname'=>$cname,'cemail'=>$cemail,'pass'=>$pass,'cont_url'=>$cont_url);
				 Mail::send('createcontributor', $data, function($message) use($data) {
				 $message->to($data['cemail'],$data['cname'])->subject('Welcome to Image Footage');
			 });
			 return response()->json(['status'=>'1','message' => 'Successfully registered'], 200);
			 //return back()->with('success','Contributor added successful');
		 }else{
			  return response()->json(['status'=>'0','message' => 'Some problem occured.'], 401);
			 //return back()->with('warning','Some problem occured.');
		 }
  
}else{
	 return response()->json(['status'=>'0','message' => 'Given email-id is allready exist.'], 401);
}

	
	}

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
                     $contributor->contributor_bank =$name;
                 } catch (MultipartUploadException $e) {
                     echo $e->getMessage() . "\n";
                 }
            }

             $result = $contributor->save();
             if($result){
                 $cont_url= url('emailVerification?key='.$hkey);
                 $data = array('cname'=>$contributor_data['contributor_fname']." ".$contributor_data['contributor_lname'],'cemail'=>$contributor_data['contributor_email'],'cont_url'=>$cont_url);
                 Mail::send('email.frontverifycontributor', $data, function($message) use($data) {
                     $message->to($data['cemail'],$data['cname'])->subject('Welcome to Image Footage');
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

}
