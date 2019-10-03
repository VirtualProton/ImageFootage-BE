<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Auth;
use Image;
use File;
use Mail;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use App\Models\Contributor;
use App\Models\ProductImages;
use App\Models\ProductColors;
use App\Models\ProductGenders;
use App\Models\ProductImageTypes;
use App\Models\ProductImageSizes;
use App\Models\ProductAgeWises;
use App\Models\ProductFilters;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
		$contributor=new Contributor;
		$all_contributor_list=$contributor->where('contributor_status', 'Active')->get()->toArray();
		$ProductCategory = new ProductCategory;
	    $all_produstcategory_list=$ProductCategory->where('category_status', 'Active')->get()->toArray();
		$ProductSubCategory= new ProductSubCategory;
		$all_produstsubcategory_list=$ProductSubCategory->where('subcategory_status', 'Active')->get()->toArray();
		$productColors=new ProductColors;
		$all_produstcolors_list=$productColors->where('status', '1')->get()->toArray();
		$productGenders=new ProductGenders;
		$all_productgender_list=$productGenders->where('status', '1')->get()->toArray();
		$productImageTypes=new ProductImageTypes;
		$all_productimagetypes_list=$productImageTypes->where('status', '1')->get()->toArray();
		$productImageSizes=new ProductImageSizes;
		$all_productimagesize_list=$productImageSizes->where('status', '1')->get()->toArray();
		$productAgeWises=new ProductAgeWises;
		$all_productagewises_list=$productAgeWises->where('status', '1')->get()->toArray();
		$title = "Add Product";
        return view('admin.product.addproduct', ['productcategory' => $all_produstcategory_list,
		'productsubcategory'=>$all_produstsubcategory_list,'contributor'=>$all_contributor_list,'pcolorlist'=>$all_produstcolors_list,'productGenders'=>$all_productgender_list,'productimagetypes'=>$all_productimagetypes_list,'productimagesize'=>$all_productimagesize_list,'productagewises'=>$all_productagewises_list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){
		 $this->validate($request, [
		 	'product_title'=>'required',
            'owner_name'   => 'required',
            'product_category' => 'required',
			'product_sub_category' => 'required',
			'product_vertical'=>'required',
			'prodect_keywords'=>'required',
			'release_details'=>'required',
			'product_type'=>'required',
			'product_image'=>'required|file'
        ]);
		 $product = new Product;
		 $productimages=new ProductImages;
		 $file = $request->file('product_image');
		 $data = getimagesize($file);
 		 $dimenctions = $data[0].'x'.$data[1];
		 //Get the first three characters using substr.
		 $firstThreeCharacters = substr($request->owner_name, 0, 3);
		 $firstThreeCharactersType = substr($request->product_type, 0, 3);
		 $productid=$firstThreeCharacters.$firstThreeCharactersType;
         $product->product_id =$productid;
		 $product->product_title=$request->product_title;
		 $product->product_category=$request->product_category;
		 $product->product_subcategory=$request->product_sub_category;
		 $product->product_owner=$request->owner_name;
		 $product->product_title=$request->product_title;
		 $product->product_vertical=$request->product_vertical;
		 $product->product_keywords=$request->prodect_keywords;
		 $product->product_thumbnail=$request->product_thumbnail;
		 $product->product_size=$dimenctions;
		 $product->product_release_details=$request->release_details;
		 $product->product_price_small=$request->Price_small;
		 $product->product_price_medium=$request->price_medium;
		 $product->product_price_large=$request->price_large;
		 $product->product_price_extralarge=$request->price_extra_large;
		 $product->product_main_type=$request->product_type;
		 $product->product_added_by=Auth::guard('admins')->user()->id;
		 if(isset($request->sub_product_type) && !empty($request->sub_product_type)){
		 	$product->product_sub_type=$request->sub_product_type;
		 }
		 $product->product_added_on=date('Y-m-d');
		 $result=$product->save();
		 $last_id=$product->id;
		 if($result){
			 if($last_id < 10){
				 $last_id='00'.$last_id;
			 }else if($last_id < 100){
				 $last_id='0'.$last_id;
			 }
			 if($request->hasFile('product_image')) {
				$image = $request->file('product_image');
				$name = time().'.'.$image->getClientOriginalExtension();
				$file_path='/uploads/';
				if($request->product_type=='Image'){
					if($request->sub_product_type=='Vector'){
						$file_path.='image/vector/';
					}else if($request->sub_product_type=='Illustrator'){
						$file_path.='image/illustrator/';
					}else{
						$file_path.='image/photo/';
					}

				}else if($request->product_type=='Footage'){
					$file_path.='footage/';
				}else if($request->product_type=='Editorial'){
					if($request->sub_product_type=='Vector'){
						$file_path.='editorial/vector/';
					}else if($request->sub_product_type=='Illustrator'){
						$file_path.='editorial/illustrator/';
					}else{
						$file_path.='editorial/photo/';
					}
				}
				$destinationPath = public_path($file_path);
				$image->move($destinationPath, $name);
				/* for thumbnail image */
				/*if($request->product_type=='Image' || $request->product_type=='Editorial' ){

					$input['imagename'] ='thumbnail_'.$name;
					$destinationPath1 = public_path($file_path.'thumb');
					$img = Image::make($request->file('product_image')->getRealPath());
					$img->resize(100, 100, function ($constraint) {
						$constraint->aspectRatio();
					})->save($destinationPath1.'/'.$input['imagename']);
					//$destinationPath = public_path('/images');
					//$image->move($destinationPath, $input['imagename']);

				}*/
				/* end */
    		 }
			 $productid=strtolower($firstThreeCharacters.$firstThreeCharactersType.$last_id);
			 $product_update = Product::find($last_id);
			 $product_update->product_id=$productid;
			 $product_update->product_main_image=$name;
			 $product_update->save();
			 
			 $productimages->image_name=$name;
			 $productimages->image_product_id=$last_id;
			 $productimages->image_added_on=date('Y-m-d H:i:s');
			 $productimages->image_added_by=Auth::guard('admins')->user()->id;
			 $productimages->save();
			 
			 return back()->with('success','Product Upload successful');
		 }else{
			 return back()->with('warning','Some problem occured.');
		 }
    }
    public function updateProduct($id)
    {   $contributor=new Contributor;
		$all_contributor_list=$contributor->where('contributor_status', 'Active')->get()->toArray();
		$product=Product::find($id)->toArray();
		$ProductCategory = new ProductCategory;
	    $all_produstcategory_list=$ProductCategory->where('category_status', 'Active')->get()->toArray();
		$ProductSubCategory= new ProductSubCategory;
		$all_produstsubcategory_list=$ProductSubCategory->where('subcategory_status', 'Active')->get()->toArray();
		$productColors=new ProductColors;
		$all_produstcolors_list=$productColors->where('status', '1')->get()->toArray();
		$productGenders=new ProductGenders;
		$all_productgender_list=$productGenders->where('status', '1')->get()->toArray();
		$productImageTypes=new ProductImageTypes;
		$all_productimagetypes_list=$productImageTypes->where('status', '1')->get()->toArray();
		$productImageSizes=new ProductImageSizes;
		$all_productimagesize_list=$productImageSizes->where('status', '1')->get()->toArray();
		$productAgeWises=new ProductAgeWises;
		$all_productagewises_list=$productAgeWises->where('status', '1')->get()->toArray();
        return view('admin.product.editproduct', ['product' => $product,'productcategory' => $all_produstcategory_list,'productsubcategory'=>$all_produstsubcategory_list,'contributor'=>$all_contributor_list,'pcolorlist'=>$all_produstcolors_list,'productGenders'=>$all_productgender_list,'productimagetypes'=>$all_productimagetypes_list,'productimagesize'=>$all_productimagesize_list,'productagewises'=>$all_productagewises_list]);
    }

   public function productsList(){
	   $product = new Product;
	   //$all_produst_list=$product->all()->toArray();
	   $all_produst_list=$product->leftJoin('imagefootage_productcategory', 'imagefootage_productcategory.category_id', '=', 'imagefootage_products.product_category')->leftJoin('imagefootage_productsubcategory', 'imagefootage_productsubcategory.subcategory_id', '=', 'imagefootage_products.product_subcategory')->leftJoin('imagefootage_productimages', 'imagefootage_productimages.image_product_id', '=', 'imagefootage_products.id')->get()->toArray();
	   $title = "Product List";
       return view('admin.product.productlist', ['products' => $all_produst_list]);
   }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeProductStatus($status,$id){
		$result = Product::where('id',$id)->update(array('product_status'=>$status));
		if($result){
          return back()->with('success','Product status changed successful');
		}else{
		  return back()->with('warning','Some problem occured.');
		}
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request){
		 $this->validate($request, [
            'owner_name'   => 'required',
            'product_category' => 'required',
			'product_sub_category' => 'required',
			'product_vertical'=>'required',
			'prodect_keywords'=>'required',
			'release_details'=>'required',
			'product_type'=>'required',
			'product_title'=>'required'
        ]);
		//echo '<pre>';
		 $update_array=array('product_title'=>$request->product_title,'product_category'=>$request->product_category,
		 					 'product_subcategory'=>$request->product_sub_category,
							 'product_owner'=>$request->owner_name,
							 'product_title'=>$request->product_title,
							 'product_vertical'=>$request->product_vertical,
							 'product_keywords'=>$request->prodect_keywords,
							 'product_thumbnail'=>$request->product_thumbnail,
							 'product_release_details'=>$request->release_details,
							 'product_price_small'=>$request->Price_small,
							 'product_price_medium'=>$request->price_medium,
							 'product_price_large'=>$request->price_large,
							 'product_price_extralarge'=>$request->price_extra_large,
							 'product_main_type'=>$request->product_type,
							 'updated_at'=>date('Y-m-d H:i:s')
							 );
		 if(isset($request->sub_product_type) && !empty($request->sub_product_type)){
		 				$update_array['product_sub_type']=$request->sub_product_type;
		 }
		 if($request->hasFile('product_image')) {
			 
			 $image = $request->file('product_image');
			  $file = $request->file('product_image');
			  $name = time().'.'.$image->getClientOriginalExtension();
			  $update_array['product_main_image']=$name;
		 	  $data = getimagesize($file);
 		 	  $dimenctions = $data[0].'x'.$data[1];
			  $update_array['product_size']=$dimenctions;
			  $productimages=new ProductImages;
			 $update_image=array('image_name'=>$name);
			 $result = ProductImages::where('image_product_id',$request->product_id)->update($update_image);
		 }
		 $result = Product::where('id',$request->product_id)->update($update_array);
		 if($result){
			 if($request->hasFile('product_image')) {
				$file_path='/uploads/';
				if($request->product_type=='Image'){
					if($request->sub_product_type=='Vector'){
						$file_path.='image/vector/';
					}else if($request->sub_product_type=='Illustrator'){
						$file_path.='image/illustrator/';
					}else{
						$file_path.='image/photo/';
					}
					
				}else if($request->product_type=='Footage'){
					$file_path.='footage/';
				}else if($request->product_type=='Editorial'){
					if($request->sub_product_type=='Vector'){
						$file_path.='editorial/vector/';
					}else if($request->sub_product_type=='Illustrator'){
						$file_path.='editorial/illustrator/';
					}else{
						$file_path.='editorial/photo/';
					}
				}
				$destinationPath = public_path($file_path);
				 File::delete($destinationPath.$request->file_name);
				$image->move($destinationPath, $name);
			 }
				return back()->with('success','Product updated successful');
		 }else{
			    return back()->with('warning','Some problem occured.');
		 }
		       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
		$product=Product::find($id)->toArray();
		
		$product_url='';
		if($product['product_main_type'] =='Image'){
			if($product['product_sub_type'] =='Vector'){
				$product_url='uploads/image/vector/'.$product['product_main_image'];
			}else if($product['product_sub_type'] =='Photo'){
				$product_url='uploads/image/photo/'.$product['product_main_image'];
			}else if($product['product_sub_type'] =='Illustrator'){
				$product_url='uploads/image/illustrator/'.$product['product_main_image'];
			}
		}else if($product['product_main_type'] =='Footage'){
			$product_url='uploads/footage/'.$product['product_main_image'];
		}else if($product['product_main_type'] =='Editorial'){
			if($product['product_sub_type'] =='Vector'){
				$product_url='uploads/editorial/vector/'.$product['product_main_image'];
			}else if($product['product_sub_type'] =='Photo'){
				$product_url='uploads/editorial/photo/'.$product['product_main_image'];
			}else if($product['product_sub_type'] =='Illustrator'){
				$product_url='uploads/editorial/illustrator/'.$product['product_main_image'];
			}
		}
		$del_result=Product::find($id)->delete();
		$del_result=ProductImages::where('image_product_id',$id)->delete();
		if($del_result){
			if(isset($product['product_main_image']) && !empty($product['product_main_image'])){
				File::delete($product_url);
			}
			return back()->with('success','Product deleated successfully');
		}else{
			 return back()->with('warning','Some problem occured.');
		}
    }
	public function get_relatedsubcat(Request $request){
		$catid=$request->prod_id;
		$prod_subcat=$request->prod_subcat;
		$ProductSubCategory= new ProductSubCategory;
		$all_produstsubcategory_list=$ProductSubCategory->where('category_id', $catid)->get()->toArray();
		//print_r($all_produstsubcategory_list);
		$subcat_o='<option>--Select Subcategory--</option>';
		$selected='';
		foreach($all_produstsubcategory_list as $key=>$subcat){
			if(isset($prod_subcat) && !empty($prod_subcat)){
				if($subcat['subcategory_id']==$prod_subcat){
					$selected=' selected="selected"';
				}else{
					$selected='';
				}
			}
			$subcat_o.='<option value="'.$subcat['subcategory_id'].'" '.$selected.'>'.$subcat['subcategory_name'].'</option>';
		}
		echo $subcat_o;
	}
	public function viewproduct($id){
		$product_details=Product::find($id)->leftJoin('imagefootage_productcategory', 'imagefootage_productcategory.category_id', '=', 'imagefootage_products.product_category')->leftJoin('imagefootage_productsubcategory', 'imagefootage_productsubcategory.subcategory_id', '=', 'imagefootage_products.product_subcategory')->get()->toArray();
		return view('admin.product.viewproduct', ['product' => $product_details]);
	}
	public function html_email() {
      $data = array('name'=>"srinivas");
      Mail::send('mail', $data, function($message) {
         $message->to('srinivas@conceptualpictures.com', 'conceptualpictures')->subject
            ('Laravel HTML Testing Mail');
         $message->from('aksrinivas49@gmail.com','aksrinivas49');
      });
      echo "HTML Email Sent. Check your inbox.";
   }
   public function ajaxProductVerify(Request $request){
	   $message=$request->message;
	   $update_array=array("product_verification"=>$request->type);
	   if(isset($message) && !empty($message)){
		   $update_array['product_rejectod_reason']=$request->message;
	   }
	   $result = Product::where('id',$request->prod_id)->update($update_array);
	   if($result){
		   echo 'Product status changed success.';
	   }else{
		   echo 'Some problem occured.';
	   }
   }
   //api functions
   public function productListApi(){
	   $product = new Product;
	   //$all_produst_list=$product->all()->toArray();
	   $all_produst_list=$product->leftJoin('imagefootage_productcategory', 'imagefootage_productcategory.category_id', '=', 'imagefootage_products.product_category')->leftJoin('imagefootage_productsubcategory', 'imagefootage_productsubcategory.subcategory_id', '=', 'imagefootage_products.product_subcategory')->leftJoin('imagefootage_productimages', 'imagefootage_productimages.image_product_id', '=', 'imagefootage_products.id')->get()->toArray();
	   return json_encode($all_produst_list);
   }
}