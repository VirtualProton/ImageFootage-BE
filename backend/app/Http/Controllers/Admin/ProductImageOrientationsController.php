<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductOrientations;

class ProductImageOrientationsController extends Controller
{
	public function __construct()
	{
        $this->middleware('admin')->except('login','logout');
	}
   public function addProductOrientations(){
	   return view('admin.product.addproductorientations');
   }
   public function addProductOrientationsProcess(Request $request){
	   
		$this->validate($request, [
		 	'product_orientations'=>'required'
        ]);
		$ProductOrientations=new ProductOrientations;
		$ProductOrientations->name =$request->product_orientations;
		$ProductOrientations->created_at=date('Y-m-d H:i:s');
		$result=$ProductOrientations->save();
		if($result){
		  	 return back()->with('success','Product orientation is added successfully');
		}else{
			 return back()->with('warning','Some problem occured.');
		}	
	
   }
   public function ProductOrientationsList(){
	   $ProductOrientations = new ProductOrientations;
	   $productcolor_list=$ProductOrientations->get()->toArray();
	   return view('admin.product.productorientationslist', ['pcolorlist' => $productcolor_list]);
   }
   public function changeProductOrientationsStatus($status,$id){
	  	$result = ProductOrientations::where('id',$id)->update(array('status'=>$status));
		if($result){
          return back()->with('success','Product orientation status changed successful');
		}else{
		  return back()->with('warning','Some problem occured.');
  		}
  }
   public function deleteProductOrientations($id){
	  $del_result=ProductOrientations::find($id)->delete();
	  if($del_result){
			return back()->with('success','Product orientation deleated successfully');
		}else{
			 return back()->with('warning','Some problem occured.');
		}
  }
  public function editProductOrientations($id){
	  $ProductOrientations = new ProductOrientations;
	  $staticpage_data=$ProductOrientations->where('id',$id)->get()->toArray();
	  return view('admin.product.editproductorientations', ['page' => $staticpage_data]);
  }
  public function updateProductOrientations(Request $request){
	   $this->validate($request, [
		 	'product_orientation'=>'required'
        ]);
	 $update_array=array('name'=>$request->product_orientation);
		$result = ProductOrientations::where('id',$request->id)->update($update_array);
		if($result){
				return back()->with('success','Product orientation updated successful');
		 }else{
			    return back()->with('warning','Some problem occured.');
		 }
  }
}
