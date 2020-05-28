<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductGenders;

class ProductGenderController extends Controller
{
	public function __construct()
	{
        $this->middleware('admin')->except('login','logout');
	}
   public function addProductGender(){
	   return view('admin.product.addproductgender');
   }
   public function addProductColorProcess(Request $request){
	   
		$this->validate($request, [
		 	'product_gender_name'=>'required'
        ]);
		$ProductGenders=new ProductGenders;
		$ProductGenders->name =$request->product_gender_name;
		$ProductGenders->created_at=date('Y-m-d H:i:s');
		$result=$ProductGenders->save();
		if($result){
		  	 return back()->with('success','Product gender added successful');
		}else{
			 return back()->with('warning','Some problem occured.');
		}	
	
   }
   public function ProductGendersList(){
	   $ProductGenders = new ProductGenders;
	   $productcolor_list=$ProductGenders->get()->toArray();
	   return view('admin.product.productgenderlist', ['pcolorlist' => $productcolor_list]);
   }
   public function changeGenderStatus($status,$id){
	  	$result = ProductGenders::where('id',$id)->update(array('status'=>$status));
		if($result){
          return back()->with('success','Product gender status changed successful');
		}else{
		  return back()->with('warning','Some problem occured.');
  		}
  }
   public function deletePgenderPage($id){
	  $del_result=ProductGenders::find($id)->delete();
	  if($del_result){
			return back()->with('success','Product gender deleated successfully');
		}else{
			 return back()->with('warning','Some problem occured.');
		}
  }
  public function editProduCtgender($id){
	  $ProductGenders = new ProductGenders;
	  $staticpage_data=$ProductGenders->where('id',$id)->get()->toArray();
	  return view('admin.product.editproductgender', ['page' => $staticpage_data]);
  }
  public function updateProductGender(Request $request){
	   $this->validate($request, [
		 	'product_gender_name'=>'required'
        ]);
	 $update_array=array('name'=>$request->product_gender_name );
		$result = ProductGenders::where('id',$request->id)->update($update_array);
		if($result){
				return back()->with('success','Product gender updated successful');
		 }else{
			    return back()->with('warning','Some problem occured.');
		 }
  }
}
