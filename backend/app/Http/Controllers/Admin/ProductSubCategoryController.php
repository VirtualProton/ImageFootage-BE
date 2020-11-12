<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use Auth;

class ProductSubCategoryController extends Controller
{
	public function __construct()
	{
        $this->middleware('admin')->except('login','logout');
	}
	
	public function index(){
	   $ProductCategory = new ProductCategory;
	   $all_produstcategory_list=$ProductCategory->where('category_status', 'Active')->get()->toArray();
		return view('admin.product.addproductsubcategory', ['productcategory' => $all_produstcategory_list]);
	}
	public function addProductSubCategory(Request $request){
		$this->validate($request, [
		 	'category'=>'required',
			'sub_category_name'=>'required'
        ]);
		$ProductSubCategory=new ProductSubCategory;
		$ProductSubCategory->category_id=$request->category;
	    $ProductSubCategory->subcategory_name=$request->sub_category_name;
		$ProductSubCategory->subcategory_order=$request->sub_category_order;
		$ProductSubCategory->subcategory_added_by=Auth::guard('admins')->user()->id;
		$ProductSubCategory->subcategory_added_on=date('Y-m-d H:i:s');
		$result=$ProductSubCategory->save();
		if($result){
          // return back()->with('success','Product Subcategory added successfully');
          return redirect('admin/all_product_subcategory/')->with('success','Product Subcategory added successfully');
		}else{
		  return back()->with('warning','Some problem occured.');
		}
	}
	public function productSubCategoryList(){
	  $ProductSubCategory=new ProductSubCategory;
	   $all_produstsubcategory_list=$ProductSubCategory->leftJoin('imagefootage_productcategory', 'imagefootage_productcategory.category_id', '=', 'imagefootage_productsubcategory.category_id')->get()->toArray();
	   //echo '<pre>';
	   //print_r($all_produstsubcategory_list); die();
	   $title = "Product List";
       return view('admin.product.productsubcategorylist', ['productsubcategory' => $all_produstsubcategory_list]);
	}
	public function changeProductStatus($status,$id){
		$result = ProductSubCategory::where('subcategory_id',$id)->update(array('subcategory_status'=>$status));
		if($result){
          return back()->with('success','Product Subcategory status changed successfully.');
		}else{
		  return back()->with('warning','Some problem occured.');
		}
	}
	 public function destroy($id){
		$del_result=ProductSubCategory::find($id)->delete();
		if($del_result){
			return back()->with('success','Product Subcategory deleated successfully.');
		}else{
			 return back()->with('warning','Some problem occured.');
		}
    }
	 public function updateProduct($id)
    {
    	$user = Auth::guard('admins')->user();
        if($user->role['role'] !='Super Admin'){
          return back()->with('success','You dont have acess to edit.');
        }
        
		$ProductCategory = new ProductCategory;
		$all_produstcategory_list=$ProductCategory->where('category_status', 'Active')->get()->toArray();
		$ProductSubCategory=ProductSubCategory::find($id)->toArray();
        return view('admin.product.editproductsubcategory', ['ProductSubCategory' => $ProductSubCategory,'productcategory'=>$all_produstcategory_list]);
    }
	 public function update(Request $request){
		 $this->validate($request, [
		    'category'  => 'required',
            'sub_category_name'   => 'required'
        ]);
		 $update_array=array('subcategory_name'=>$request->sub_category_name,'subcategory_order'=>$request->sub_category_order,
							 'updated_at'=>date('Y-m-d H:i:s')
							 );
		 $result = ProductSubCategory::where('subcategory_id',$request->product_subcategory_id)->update($update_array);
		 if($result){
				// return back()->with('success','Product Subcategory updated successful');
                return redirect('admin/all_product_subcategory/')->with('success','Product Subcategory updated successful');
		 }else{
			    return back()->with('warning','Some problem occured.');
		 }
		       
    }
}
