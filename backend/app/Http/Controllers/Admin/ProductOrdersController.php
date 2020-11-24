<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\Common;
use App\Models\User;
use Auth;
class ProductOrdersController extends Controller
{
	public function __construct()
	{
        $this->middleware('admin')->except('login','logout');
	}
   public function index(){

   		$user = Auth::guard('admins')->user();
   		// echo "<pre>"; print_r($user->state); die;
	   $all_orders_list= Orders::with(['items'=>function($query){
                   $query->select('order_id','product_id','product_name','product_web','standard_size','standard_price','product_thumb');
           }])->with('user')
          ->with('country')
          ->with('state')
          ->with('city')
          ->orderBy('id','desc')
          ->get()->toArray();
          // echo "<pre>";print_r($all_orders_list); die;
   		if($user->department['department'] == 'Sales'){

   			$all_orders_list= Orders::with(['items'=>function($query){
                   $query->select('order_id','product_id','product_name','product_web','standard_size','standard_price','product_thumb');
           }])->with('user')
          ->with('country')
          ->with('state')
          ->with('city')
          ->where('bill_state', $user->state)
          ->orderBy('id','desc')
          ->get()->toArray();
		   }
		   //echo "<pre>";
		   //print_r($all_orders_list); die;
	   return view('admin.orders.orderlist', ['orderlists' => $all_orders_list]);
       // $this->User = new User;
       // $userlist = $this->User->getUserData();
       // return view('admin.orders.index',compact('userlist'));
       //return view('admin.orders.orderlist');
  }
    public function userOrderList($id){
         return view('admin.orders.orderlist',compact('id'));
    }

  public function userListapi($id){
      $all_orders_list= Orders::with(['items'=>function($query){
          $query->select('order_id','product_id','product_name','product_web','standard_size','standard_price','product_thumb');
      }])->with('user')
          ->with('country')
          ->with('state')
          ->with('city')
          ->where('user_id',$id)
          ->orderBy('id','desc')
          ->get()->toArray();
      return response()->json($all_orders_list);
  }
  public function addPackage(Request $request){
	   $this->validate($request, [
		 	'package_name'=>'required',
			'package_price'=>'required',
			'package_description'=>'required',
			'package_products_count'=>'required',
			'package_type'=>'required',
			'package_expiry'=>'required'
        ]);
		$package=new Package;
		$package->package_plan =$request->package_plan;
		$package->package_name =$request->package_name;
	    $package->package_price=$request->package_price;
		$package->package_description=$request->package_description;
		$package->package_products_count=$request->package_products_count;
		$package->package_type=$request->package_type;
		$package->package_added_on=date('Y-m-d H:i:s');
		$package->package_expiry=$request->package_expiry;
		$package->package_permonth_download =$request->package_month_count;
		$package->package_pcarry_forward =$request->products_carry_forward;
		$package->package_addedby=Auth::guard('admins')->user()->id;
		$result=$package->save();
		if($result){
		  	 return back()->with('success','Package created successful');
		}else{
			 return back()->with('warning','Some problem occured.');
		}	
  }
  public function packageList(){
	   $package = new Package;
	   $all_package_list=$package->get()->toArray();
	   return view('admin.package.packagelist', ['package' => $all_package_list]);
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
