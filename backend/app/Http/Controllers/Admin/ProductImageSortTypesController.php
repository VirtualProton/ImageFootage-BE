<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ImageSortTypes;

class ProductImageSortTypesController extends Controller
{
   public function addImageSortTypes(){
	   return view('admin.product.addimagesorttypes');
   }
   public function addImageSortTypesProcess(Request $request){
		$this->validate($request, [
		 	'product_sort_type'=>'required'
        ]);
		$ImageSortTypes=new ImageSortTypes;
		$ImageSortTypes->name =$request->product_sort_type;
		$ImageSortTypes->created_at=date('Y-m-d H:i:s');
		$result=$ImageSortTypes->save();
		if($result){
		  	 return back()->with('success','Product Sort Type is added successfully');
		}else{
			 return back()->with('warning','Some problem occured.');
		}	
	
   }
   public function ImageSortTypesList(){
	   $ImageSortTypes = new ImageSortTypes;
	   $productcolor_list=$ImageSortTypes->get()->toArray();
	   return view('admin.product.imagesorttypeslist', ['pcolorlist' => $productcolor_list]);
   }
   public function changeImageSortTypeStatus($status,$id){
	  	$result = ImageSortTypes::where('id',$id)->update(array('status'=>$status));
		if($result){
          return back()->with('success','Product sort type status changed successful');
		}else{
		  return back()->with('warning','Some problem occured.');
  		}
  }
   public function deleteImageSortTypes($id){
	  $del_result=ImageSortTypes::find($id)->delete();
	  if($del_result){
			return back()->with('success','Product sort type deleated successfully');
		}else{
			 return back()->with('warning','Some problem occured.');
		}
  }
  public function editImageSortTypes($id){
	  $ImageSortTypes = new ImageSortTypes;
	  $staticpage_data=$ImageSortTypes->where('id',$id)->get()->toArray();
	  return view('admin.product.editproductsorttype', ['page' => $staticpage_data]);
  }
  public function updateImageSortTypes(Request $request){
	   $this->validate($request, [
		 	'product_sort_type'=>'required'
        ]);
	 $update_array=array('name'=>$request->product_sort_type);
		$result = ImageSortTypes::where('id',$request->id)->update($update_array);
		if($result){
				return back()->with('success','Product sort type updated successful');
		 }else{
			    return back()->with('warning','Some problem occured.');
		 }
  }
}
