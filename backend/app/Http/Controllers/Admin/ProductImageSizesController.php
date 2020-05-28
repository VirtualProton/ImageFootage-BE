<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductImageSizes;

class ProductImageSizesController extends Controller
{
	public function __construct()
	{
        $this->middleware('admin')->except('login','logout');
	}
   public function addProductImageSize(){
	   return view('admin.product.addproductimagesizes');
   }
   public function addProductImageSizesProcess(Request $request){
	   
		$this->validate($request, [
		 	'product_imagesize_name'=>'required'
        ]);
		$ProductImageSizes=new ProductImageSizes;
		$ProductImageSizes->name =$request->product_imagesize_name;
		$ProductImageSizes->created_at=date('Y-m-d H:i:s');
		$result=$ProductImageSizes->save();
		if($result){
		  	 return back()->with('success','Product image size is added successfully');
		}else{
			 return back()->with('warning','Some problem occured.');
		}	
	
   }
   public function ProductImageSizesList(){
	   $ProductImageSizes = new ProductImageSizes;
	   $productcolor_list=$ProductImageSizes->get()->toArray();
	   return view('admin.product.productimagesizeslist', ['pcolorlist' => $productcolor_list]);
   }
   public function changeProductImageSizesStatus($status,$id){
	  	$result = ProductImageSizes::where('id',$id)->update(array('status'=>$status));
		if($result){
          return back()->with('success','Product image size status changed successful');
		}else{
		  return back()->with('warning','Some problem occured.');
  		}
  }
   public function deleteProductImageSizes($id){
	  $del_result=ProductImageSizes::find($id)->delete();
	  if($del_result){
			return back()->with('success','Product image size deleated successfully');
		}else{
			 return back()->with('warning','Some problem occured.');
		}
  }
  public function editProductImageSizes($id){
	  $ProductImageSizes = new ProductImageSizes;
	  $staticpage_data=$ProductImageSizes->where('id',$id)->get()->toArray();
	  return view('admin.product.editProductImageSizes', ['page' => $staticpage_data]);
  }
  public function updateProductImageSizes(Request $request){
	   $this->validate($request, [
		 	'product_image_size_name'=>'required'
        ]);
	 $update_array=array('name'=>$request->product_image_size_name);
		$result = ProductImageSizes::where('id',$request->id)->update($update_array);
		if($result){
				return back()->with('success','Product image size updated successful');
		 }else{
			    return back()->with('warning','Some problem occured.');
		 }
  }
}
