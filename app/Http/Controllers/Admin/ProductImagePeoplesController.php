<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductPeoples;

class ProductImagePeoplesController extends Controller
{
	public function __construct()
	{
        $this->middleware('admin')->except('login','logout');
	}
   public function addProductImageSize(){
	   return view('admin.product.addproductpeoples');
   }
   public function addProductPeoplesProcess(Request $request){
	   
		$this->validate($request, [
		 	'product_imagepeople_name'=>'required'
        ]);
		$ProductPeoples=new ProductPeoples;
		$ProductPeoples->name =$request->product_imagepeople_name;
		$ProductPeoples->created_at=date('Y-m-d H:i:s');
		$result=$ProductPeoples->save();
		if($result){
		  	 return back()->with('success','Product image people is added successfully');
		}else{
			 return back()->with('warning','Some problem occured.');
		}	
	
   }
   public function ProductPeoplesList(){
	   $ProductPeoples = new ProductPeoples;
	   $productcolor_list=$ProductPeoples->get()->toArray();
	   return view('admin.product.productpeopleslist', ['pcolorlist' => $productcolor_list]);
   }
   public function changeProductPeoplesStatus($status,$id){
	  	$result = ProductPeoples::where('id',$id)->update(array('status'=>$status));
		if($result){
          return back()->with('success','Product image people status changed successful');
		}else{
		  return back()->with('warning','Some problem occured.');
  		}
  }
   public function deleteProductPeoples($id){
	  $del_result=ProductPeoples::find($id)->delete();
	  if($del_result){
			return back()->with('success','Product image people deleated successfully');
		}else{
			 return back()->with('warning','Some problem occured.');
		}
  }
  public function editProductPeoples($id){
	  $ProductPeoples = new ProductPeoples;
	  $staticpage_data=$ProductPeoples->where('id',$id)->get()->toArray();
	  return view('admin.product.editproductpeoples', ['page' => $staticpage_data]);
  }
  public function updateProductPeoples(Request $request){
	   $this->validate($request, [
		 	'product_peoples'=>'required'
        ]);
	 $update_array=array('name'=>$request->product_peoples);
		$result = ProductPeoples::where('id',$request->id)->update($update_array);
		if($result){
				return back()->with('success','Product people updated successful');
		 }else{
			    return back()->with('warning','Some problem occured.');
		 }
  }
}
