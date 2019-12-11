<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usercontactus;
use App\Models\Country;
use App\Models\State;
use App\Models\City;

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
}
