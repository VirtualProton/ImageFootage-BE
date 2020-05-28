<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Auth;

class ProductCategoryController extends Controller
{
	public function __construct()
	{
        $this->middleware('admin')->except('login','logout');
	}

    public function index(){
		return view('admin.product.addproductcategory');
	}
	public function createCategory(Request $request){
		$this->validate($request, [
		 	'category_name'=>'required'
        ]);
		if(ProductCategory::where('category_name',$request->category_name)->exists()){
		  return back()->with('warning','Product Category name allready exists.');
		  exit();
		}
		$ProductCategory=new ProductCategory;
		$ProductCategory->category_name=$request->category_name;
		$ProductCategory->category_keywords=$request->category_keywords;
	    $ProductCategory->category_order=$request->category_order;
		$ProductCategory->category_added_by=Auth::guard('admins')->user()->id;
        $ProductCategory->is_display_home = $request->display;
		$ProductCategory->category_added_on=date('Y-m-d H:i:s');
		$result=$ProductCategory->save();
		if($result){
          return back()->with('success','Product Category added successfully');
		}else{
		  return back()->with('warning','Some problem occured.');
		}
	}
	public function productCategoryList(){
	   $ProductCategory = new ProductCategory;
	   $all_produstcategory_list=$ProductCategory->all()->toArray();
	   $title = "Product List";
       return view('admin.product.productcategorylist', ['productcategory' => $all_produstcategory_list]);
	}
	public function changeProductStatus($status,$id){
		$result = ProductCategory::where('category_id',$id)->update(array('category_status'=>$status));
		if($result){
          return back()->with('success','Product Category status changed successfully.');
		}else{
		  return back()->with('warning','Some problem occured.');
		}
	}
	 public function destroy($id){
		$del_result=ProductCategory::find($id)->delete();
		if($del_result){
			return back()->with('success','Product Category deleated successfully.');
		}else{
			 return back()->with('warning','Some problem occured.');
		}
    }
	 public function updateProduct($id)
    {
		$productcategory=ProductCategory::find($id)->toArray();
        return view('admin.product.editproductcategory', ['productcategory' => $productcategory]);
    }
	 public function editProductCategory(Request $request){
		$this->validate($request, [
            'category_name'   => 'required'
        ]);
		 $update_array=array('category_name'=>$request->category_name,
		 					 'category_keywords'=>$request->category_keywords,
		 					 'category_order'=>$request->category_order,
                             'is_display_home'=>$request->display,
							 'updated_at'=>date('Y-m-d H:i:s')
							 );
		 $result = ProductCategory::where('category_id',$request->product_category_id)->update($update_array);
		
		 if($result){
				return back()->with('success','Product Category updated successful');
		 }else{
			    return back()->with('warning','Some problem occured.');
		 }
		       
    }
}
