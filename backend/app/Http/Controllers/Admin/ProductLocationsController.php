<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductLocations;

class ProductLocationsController extends Controller
{
   public function addProductLocation(){
	   return view('admin.product.addproductlocation');
   }
   public function addProductLocationsProcess(Request $request){
	   
		$this->validate($request, [
		 	'product_locations_name'=>'required'
        ]);
		$ProductLocations=new ProductLocations;
		$ProductLocations->name =$request->product_locations_name;
		$ProductLocations->created_at=date('Y-m-d H:i:s');
		$result=$ProductLocations->save();
		if($result){
		  	 return back()->with('success','Product location added successful');
		}else{
			 return back()->with('warning','Some problem occured.');
		}	
	
   }
   public function ProductLocationsList(){
	   $ProductLocations = new ProductLocations;
	   $productcolor_list=$ProductLocations->get()->toArray();
	   return view('admin.product.productlocationslist', ['pcolorlist' => $productcolor_list]);
   }
   public function changeLocationsStatus($status,$id){
	  	$result = ProductLocations::where('id',$id)->update(array('status'=>$status));
		if($result){
          return back()->with('success','Product location status changed successful');
		}else{
		  return back()->with('warning','Some problem occured.');
  		}
  }
   public function deleteProductLocation($id){
	  $del_result=ProductLocations::find($id)->delete();
	  if($del_result){
			return back()->with('success','Product location deleated successfully');
		}else{
			 return back()->with('warning','Some problem occured.');
		}
  }
  public function editProductLocations($id){
	  $ProductLocations = new ProductLocations;
	  $staticpage_data=$ProductLocations->where('id',$id)->get()->toArray();
	  return view('admin.product.editProductLocations', ['page' => $staticpage_data]);
  }
  public function updateProductLocations(Request $request){
	   $this->validate($request, [
		 	'product_locations_name'=>'required'
        ]);
	 $update_array=array('name'=>$request->product_locations_name);
		$result = ProductLocations::where('id',$request->id)->update($update_array);
		if($result){
				return back()->with('success','Product location updated successful');
		 }else{
			    return back()->with('warning','Some problem occured.');
		 }
  }
}
