<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductEthinicities;

class ProductEthinicitiesController extends Controller
{
   public function addProductGender(){
	   return view('admin.product.addproductethinicities');
   }
   public function addProductEthinicitiesProcess(Request $request){
	   
		$this->validate($request, [
		 	'product_ethinicities_name'=>'required'
        ]);
		$ProductEthinicities=new ProductEthinicities;
		$ProductEthinicities->name =$request->product_ethinicities_name;
		$ProductEthinicities->created_at=date('Y-m-d H:i:s');
		$result=$ProductEthinicities->save();
		if($result){
		  	 return back()->with('success','Product ethinicities added successful');
		}else{
			 return back()->with('warning','Some problem occured.');
		}	
	
   }
   public function ProductEthinicitiesList(){
	   $ProductEthinicities = new ProductEthinicities;
	   $productcolor_list=$ProductEthinicities->get()->toArray();
	   return view('admin.product.productethinicitieslist', ['pcolorlist' => $productcolor_list]);
   }
   public function changeEthinicitiesStatus($status,$id){
	  	$result = ProductEthinicities::where('id',$id)->update(array('status'=>$status));
		if($result){
          return back()->with('success','Product gender ethinicities changed successful');
		}else{
		  return back()->with('warning','Some problem occured.');
  		}
  }
   public function deletePethinicitiesPage($id){
	  $del_result=ProductEthinicities::find($id)->delete();
	  if($del_result){
			return back()->with('success','Product ethinicities deleated successfully');
		}else{
			 return back()->with('warning','Some problem occured.');
		}
  }
  public function editProductEthinicities($id){
	  $ProductEthinicities = new ProductEthinicities;
	  $staticpage_data=$ProductEthinicities->where('id',$id)->get()->toArray();
	  return view('admin.product.editproductethinicities', ['page' => $staticpage_data]);
  }
  public function updateProductEthinicities(Request $request){
	   $this->validate($request, [
		 	'product_ethinicities_name'=>'required'
        ]);
	 $update_array=array('name'=>$request->product_ethinicities_name);
		$result = ProductEthinicities::where('id',$request->id)->update($update_array);
		if($result){
				return back()->with('success','Product ethinicities updated successful');
		 }else{
			    return back()->with('warning','Some problem occured.');
		 }
  }
}
