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

class UserController extends Controller
{
   public function userProfile($id){

	   $userlist= User::with('country')
                        ->with('state')
                        ->with('city')
                        ->where('id',$id)
                        //->select()
                        ->get()->toArray();

	    if(count($userlist)>0){
				return '{"status":"1","message":"","data":'.json_encode($userlist).'}';
	   }else{
				return '{"status":"0","message":"Some problem occured.","data":"[]"}';
	   }
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
        $count = User::where('email','=',$request['email']['user_email'])->count();
		if($count>0){
			$randnum=rand(1000,10000);
			$update_array=array('otp'=>$randnum);
		    $result = User::where('email',$request['email']['user_email'])->update($update_array);
			$url=url('resetpassword').'?ran='.$randnum.'&em='.$request['email']['user_email'];
			$data = array('url'=>$url,'email'=>$request['email']['user_email']);
				 Mail::send('forgotpassword', $data, function($message) use($data,$request['email']['user_email']) {
				 	$message->to($request['email']['user_email'],'Image Footage')->subject('Image Footage Forgot Password');
				  });
            $result = ['status'=>1,'message'=>'success'];
        }else{
            $result = ['status'=>0,'message'=>'Email Not Found.'];
        }
        return response()->json($result);
    }

    public function userOrders($id){
        if($id>0){
            $OrderData = Orders::with('items')
                ->where('user_id','=',$id)
                ->whereIn('order_status',['Completed','Transction Success'])
                ->orderBy('id','desc')
                ->get()->toArray();
            echo json_encode(['status'=>"success",'data'=>$OrderData]);
        }else{
            echo json_encode(['status'=>"fail",'data'=>'','message'=>'Some error happened']);
        }

    }

}
