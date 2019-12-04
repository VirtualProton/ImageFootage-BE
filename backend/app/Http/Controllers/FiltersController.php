<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usercontactus;
use App\Models\ProductColors;

class FiltersController extends Controller {
   public function getAllFilters(){
	   $productColors=new ProductColors;
	   $productcolor_list=$productColors->where('status','1')->get()->toArray();
	   echo '<pre>';
	   $filters=array();
	   foreach($productcolor_list as $key=>$val){
		   $filters['product_colors'][]=array('pcolor_id'=>$val['id'],'pcolor_name'=>$val['name']);
	   }
	   print_r($filters);
   }
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
}
