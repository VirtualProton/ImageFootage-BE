<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductColors;

class ProductColorController extends Controller
{
	public function __construct()
	{
        $this->middleware('admin')->except('login','logout');
	}
   public function addProductColor(){
	   return view('admin.product.addproductcolor');
   }
   public function addProductColorProcess(Request $request){
	   
		$this->validate($request, [
		 	'product_color_name'=>'required'
        ]);
		$ProductColors=new ProductColors;
		$ProductColors->name =$request->product_color_name;
		$ProductColors->created_at=date('Y-m-d H:i:s');
		$result=$ProductColors->save();
		if($result){
		  	 return back()->with('success','Product color added successful');
		}else{
			 return back()->with('warning','Some problem occured.');
		}	
	
   }
   public function productColorsList(){
	   $ProductColors = new ProductColors;
	   $productcolor_list=$ProductColors->get()->toArray();
	   return view('admin.product.productcolorlist', ['pcolorlist' => $productcolor_list]);
   }
   public function changePackageStatus($status,$id){
	  	$result = ProductColors::where('id',$id)->update(array('status'=>$status));
		if($result){
          return back()->with('success','Product color status changed successful');
		}else{
		  return back()->with('warning','Some problem occured.');
  		}
  }
   public function deletePcolorPage($id){
	  $del_result=ProductColors::find($id)->delete();
	  if($del_result){
			return back()->with('success','Product color deleated successfully');
		}else{
			 return back()->with('warning','Some problem occured.');
		}
  }
  public function editProduCtcolor($id){
	  $ProductColors = new ProductColors;
	  $staticpage_data=$ProductColors->where('id',$id)->get()->toArray();
	  return view('admin.product.editproductcolor', ['page' => $staticpage_data]);
  }
  public function updateProductColor(Request $request){
	   $this->validate($request, [
		 	'product_color_name'=>'required'
        ]);
	 $update_array=array('name'=>$request->product_color_name );
		$result = ProductColors::where('id',$request->id)->update($update_array);
		if($result){
				return back()->with('success','Product Color updated successful');
		 }else{
			    return back()->with('warning','Some problem occured.');
		 }
  }
}
