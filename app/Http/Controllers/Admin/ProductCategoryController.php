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
		 	'category_name' => 'required',
		 	'product_id'    => 'required',
		 	'image_path'    => 'required'
        ]);
		if(ProductCategory::where('category_name',$request->category_name)->exists()){
		  return back()->with('warning','Product Category name already exists.');
		  exit();
		}
		$ProductCategory                    = new ProductCategory;
		$ProductCategory->category_name     = $request->category_name;
		$ProductCategory->category_keywords = $request->category_keywords;
	    $ProductCategory->category_order    = $request->category_order;
		$ProductCategory->category_added_by = Auth::guard('admins')->user()->id;
        $ProductCategory->is_display_home   =  $request->display;
		$ProductCategory->category_added_on = date('Y-m-d H:i:s');
		$ProductCategory->product_id        = $request->product_id;
		$ProductCategory->image_path        = $request->image_path;
        $ProductCategory->category_slug     = preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower(trim($request->category_name)));
        $ProductCategory->type              =  1;//1 is for image set the dynamic value when getting from admin
		$result=$ProductCategory->save();
		if($result){
		  return redirect('admin/all_product_category/')->with('success','Product Category added successfully');

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
			return back()->with('success','Product Category deleted successfully.');
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
		$productcategory=ProductCategory::find($id)->toArray();
        return view('admin.product.editproductcategory', ['productcategory' => $productcategory]);
    }
	 public function editProductCategory(Request $request){
		$this->validate($request, [
            'category_name' => 'required',
            'product_id'    => 'required',
            'image_path'    => 'required'
        ]);
		 $update_array=array('category_name'     => $request->category_name,
		 					 'category_keywords' => $request->category_keywords,
		 					 'category_order'    => $request->category_order,
                             'is_display_home'   => $request->display,
							 'product_id'        => $request->product_id,
							 'image_path'        => $request->image_path,
							 'updated_at'        => date('Y-m-d H:i:s')
							 );
		 $result = ProductCategory::where('category_id',$request->product_category_id)->update($update_array);

		 if($result){
		  		return redirect('admin/all_product_category/')->with('success','Product Category updated successful');
		 }else{
			    return back()->with('warning','Some problem occured.');
		 }

    }
}
