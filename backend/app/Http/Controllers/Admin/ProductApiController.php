<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\ApiQuota;
use Auth;
class ProductApiController extends Controller
{
   public function addApiQuota(){
	    return view('admin.package.apiquota');
  }
  public function insertApiQuota(Request $request){
	   $this->validate($request, [
		 	'api_provider'=>'required',
			'api_amount'=>'required'
        ]);
		$ApiQuota=new ApiQuota;
		$ApiQuota->api_provider =$request->api_provider;
		$ApiQuota->api_amount =$request->api_amount;
		$result=$ApiQuota->save();
		if($result){
		  	 return back()->with('success','Api Quota created successful');
		}else{
			 return back()->with('warning','Some problem occured.');
		}	
  }
  public function apiQuotaList(){
	   $ApiQuota = new ApiQuota;
	   $all_package_list=$ApiQuota->get()->toArray();
	   return view('admin.package.apiquotalist', ['package' => $all_package_list]);
  }
  public function changePackageStatus($status,$id){
	  	$result = Package::where('package_id',$id)->update(array('package_status'=>$status));
		if($result){
          return back()->with('success','Package status changed successful');
		}else{
		  return back()->with('warning','Some problem occured.');
  		}
  }
  public function updateApiQuata($id){
	   $ApiQuota = new ApiQuota;
	   $package_data=$ApiQuota->where('api_id',$id)->get()->toArray();
	   return view('admin.package.editapiquata', ['package' => $package_data]);
  }
  public function editApiQuata(Request $request){
	  $this->validate($request, [
		 	'api_provider'=>'required',
			'api_amount'=>'required'
        ]);
		$update_array=array('api_provider'=>$request->api_provider,'api_amount'=>$request->api_amount,'updated_at'=>date('Y-m-d H:i:s'));
		$result = ApiQuota::where('api_id',$request->api_id)->update($update_array);
		if($result){
				return back()->with('success','API Quata updated successful');
		 }else{
			    return back()->with('warning','Some problem occured.');
		 }
  }
  public function deleteapiquata($id){
	  $del_result=ApiQuota::find($id)->delete();
	  if($del_result){
			return back()->with('success','API quata deleated successfully');
		}else{
			 return back()->with('warning','Some problem occured.');
		}
  }
}
