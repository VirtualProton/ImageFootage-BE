<?php

namespace App\Http\Controllers;

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
}
