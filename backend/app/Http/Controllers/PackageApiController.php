<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\UserPackage;
use Auth;
class PackageApiController extends Controller
{
  public function packageList(){
       $all_package_list = Package::get()->groupBy('package_plan')->toArray();
       $packagelist = [];
	   if(count($all_package_list)>0){
           $packagelist['download_pack'] = $all_package_list['1'];
           foreach($all_package_list['2'] as $eachpacage){
                if($eachpacage['package_expiry_yearly']==0){
                    $packagelist['monthly_pack'][] = $eachpacage;
                    //array_push( );
                }else{
                    $packagelist['yearly_pack'][] = $eachpacage;
                   // array_push();
                }
           }
           echo json_encode(["status"=>"success",'data'=>$packagelist]);
       }
  }


}
