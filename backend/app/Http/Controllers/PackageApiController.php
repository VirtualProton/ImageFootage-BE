<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use Auth;
class PackageApiController extends Controller
{
  public function packageList(){
	   $package = new Package;
	   $all_package_list=$package->get()->toArray();
	    echo json_encode(["status"=>"success",'data'=>$all_package_list]);
	   //return view('admin.package.packagelist', ['package' => $all_package_list]);
  }
  public function changePackageStatus($status,$id){
	  	$result = Package::where('package_id',$id)->update(array('package_status'=>$status));
		if($result){
          return back()->with('success','Package status changed successful');
		}else{
		  return back()->with('warning','Some problem occured.');
  		}
  }
  public function updatePackage($id){
	   $package = new Package;
	   $package_data=$package->where('package_id',$id)->get()->toArray();
	   return view('admin.package.editpackage', ['package' => $package_data]);
  }
  public function editPackage(Request $request){
	  $this->validate($request, [
		 	'package_name'=>'required',
			'package_price'=>'required',
			'package_description'=>'required',
			'package_products_count'=>'required',
			'package_type'=>'required',
			'package_expiry'=>'required'
        ]);
		$update_array=array('package_plan'=>$request->package_plan,'package_name'=>$request->package_name,
							 'package_price'=>$request->package_price,
		 					 'package_description'=>$request->package_description,
							 'package_products_count'=>$request->package_products_count,
							 'package_type'=>$request->package_type,
							 'package_expiry'=>$request->package_expiry,
							 'package_permonth_download'=>$request->package_month_count,
							 'package_pcarry_forward'=>$request->products_carry_forward,
							 'package_expiry_yearly'=>$request->package_expiry_year,
							 'updated_at'=>date('Y-m-d H:i:s')
							 );
		$result = Package::where('package_id',$request->package_id)->update($update_array);
		if($result){
				return back()->with('success','Package updated successful');
		 }else{
			    return back()->with('warning','Some problem occured.');
		 }
  }
  public function deletePackage($id){
	  $del_result=Package::find($id)->delete();
	  if($del_result){
			return back()->with('success','Package deleated successfully');
		}else{
			 return back()->with('warning','Some problem occured.');
		}
  }
}
