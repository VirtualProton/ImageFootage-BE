<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductImageTypes;

class ProductImageTypesController extends Controller
{
   public function addProductImageType(){
	   return view('admin.product.addproductimagetypes');
   }
   public function addProductImageTypesProcess(Request $request){
	   
		$this->validate($request, [
		 	'product_imagetype_name'=>'required'
        ]);
		$ProductImageTypes=new ProductImageTypes;
		$ProductImageTypes->name =$request->product_imagetype_name;
		$ProductImageTypes->created_at=date('Y-m-d H:i:s');
		$result=$ProductImageTypes->save();
		if($result){
		  	 return back()->with('success','Product image type is added successfully');
		}else{
			 return back()->with('warning','Some problem occured.');
		}	
	
   }
   public function productImageTypesList(){
	   $ProductImageTypes = new ProductImageTypes;
	   $productcolor_list=$ProductImageTypes->get()->toArray();
	   return view('admin.product.productimagetypeslist', ['pcolorlist' => $productcolor_list]);
   }
   public function changeProductImageTypesStatus($status,$id){
	  	$result = ProductImageTypes::where('id',$id)->update(array('status'=>$status));
		if($result){
          return back()->with('success','Product image type status changed successful');
		}else{
		  return back()->with('warning','Some problem occured.');
  		}
  }
   public function deleteProductImageTypes($id){
	  $del_result=ProductImageTypes::find($id)->delete();
	  if($del_result){
			return back()->with('success','Product image type deleated successfully');
		}else{
			 return back()->with('warning','Some problem occured.');
		}
  }
  public function editProductImageTypes($id){
	  $ProductImageTypes = new ProductImageTypes;
	  $staticpage_data=$ProductImageTypes->where('id',$id)->get()->toArray();
	  return view('admin.product.editProductImageTypes', ['page' => $staticpage_data]);
  }
  public function updateProductImageTypes(Request $request){
	   $this->validate($request, [
		 	'product_image_type_name'=>'required'
        ]);
	 $update_array=array('name'=>$request->product_image_type_name);
		$result = ProductImageTypes::where('id',$request->id)->update($update_array);
		if($result){
				return back()->with('success','Product image type updated successful');
		 }else{
			    return back()->with('warning','Some problem occured.');
		 }
  }
}
