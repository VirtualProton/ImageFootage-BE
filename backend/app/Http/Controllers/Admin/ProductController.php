<?php

namespace App\Http\Controllers\Admin;
use Aws\S3\S3Client;
use Aws\Exception\AwsException;
use Aws\S3\MultipartUploader;
use Aws\Exception\MultipartUploadException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use App\Models\Contributor;
use App\Models\ProductImages;
use App\Models\ProductColors;
use App\Models\ProductGenders;
use App\Models\ProductImageTypes;
use App\Models\ProductImageSizes;
use App\Models\ProductAgeWises;
use App\Models\ProductEthinicities;
use App\Models\ProductLocations;
use App\Models\ProductFilters;
use App\Models\ProductPeoples;
use App\Models\ImageResolution;
use App\Models\ProductOrientations;
use App\Models\ImageSortTypes;
use App\Http\PantherMedia\ImageApi;
use App\Http\Pond5\FootageApi;
use DB;
use Auth;
use Image;
use File;
use Mail;


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
		$productEthinicities=new ProductEthinicities;
		$all_productethinicities_list=$productEthinicities->where('status', '1')->get()->toArray();
		$productLocations=new ProductLocations;
		$all_productlocations_list=$productLocations->where('status', '1')->get()->toArray();
		$productPeoples=new ProductPeoples;
		$all_productPeoples_list=$productPeoples->where('status', '1')->get()->toArray();
		$imageResolution=new ImageResolution;
		$all_productresolution_list=$imageResolution->where('status', '1')->get()->toArray();
		$productOrientations= new ProductOrientations;
		$all_productorientations_list=$productOrientations->where('status', '1')->get()->toArray();
		$imageSortTypes=new ImageSortTypes;
		$all_isorttypes_list=$imageSortTypes->where('status', '1')->get()->toArray();
		$title = "Add Product";
        return view('admin.product.addproduct', ['productcategory' => $all_produstcategory_list,
		'productsubcategory'=>$all_produstsubcategory_list,'contributor'=>$all_contributor_list,'pcolorlist'=>$all_produstcolors_list,'productGenders'=>$all_productgender_list,'productimagetypes'=>$all_productimagetypes_list,'productimagesize'=>$all_productimagesize_list,'productagewises'=>$all_productagewises_list,'productethinicities'=>$all_productethinicities_list,'productlocations'=>$all_productlocations_list,'productPeoples'=>$all_productPeoples_list,'imageResolution'=>$all_productresolution_list,'productOrientations'=>$all_productorientations_list,'imageSortTypes'=>$all_isorttypes_list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){
		$image = $request->file('product_image');
		$name = time().'.'.$image->getClientOriginalExtension();
		
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
			 /* for filters */
			 $product_color=$request->product_color;
			 if(isset($product_color) && !empty($product_color)){
				 foreach($product_color as $key=>$pc){
					   $productFilters=new ProductFilters;
					   $productFilters->filter_product_id=$last_id;
					   $productFilters->filter_type='product_color';
					   $productFilters->filter_type_id=$pc;
					   $productFilters->filter_added_by=Auth::guard('admins')->user()->id;
					   $productFilters->filter_added_on=date('Y-m-d H:i:s');
					   $result=$productFilters->save();
				 }
			 }
		 	 $product_gender=$request->product_gender;
			 if(isset($product_gender) && !empty($product_gender)){
				   foreach($product_gender as $key=>$pg){
					   $productFilters=new ProductFilters;
					   $productFilters->filter_product_id=$last_id;
					   $productFilters->filter_type='product_gender';
					   $productFilters->filter_type_id=$pg;
					   $productFilters->filter_added_by=Auth::guard('admins')->user()->id;
					   $productFilters->filter_added_on=date('Y-m-d H:i:s');
					   $result=$productFilters->save();
				   }
			 }
		 	 $product_glow_type=$request->product_glow_type;
			 if(isset($product_glow_type) && !empty($product_glow_type)){
				  foreach($product_glow_type as $key=>$pgt){
					   $productFilters=new ProductFilters;
					   $productFilters->filter_product_id=$last_id;
					   $productFilters->filter_type='product_glow_type';
					   $productFilters->filter_type_id=$pgt;
					   $productFilters->filter_added_by=Auth::guard('admins')->user()->id;
					   $productFilters->filter_added_on=date('Y-m-d H:i:s');
					   $result=$productFilters->save();
				  }
			 }
		 	 $product_image_size=$request->product_image_size;
			 if(isset( $product_image_size) && !empty( $product_image_size)){
				  foreach($product_image_size as $key=>$pis){
					   $productFilters=new ProductFilters;
					   $productFilters->filter_product_id=$last_id;
					   $productFilters->filter_type='product_image_size';
					   $productFilters->filter_type_id=$pis;
					   $productFilters->filter_added_by=Auth::guard('admins')->user()->id;
					   $productFilters->filter_added_on=date('Y-m-d H:i:s');
					   $result=$productFilters->save();
				  }
			 }
		 	 $product_image_age=$request->product_image_age;
			 if(isset($product_image_age) && !empty($product_image_age)){
				  foreach($product_image_age as $key=>$pia){
					   $productFilters=new ProductFilters;
					   $productFilters->filter_product_id=$last_id;
					   $productFilters->filter_type='product_image_age';
					   $productFilters->filter_type_id=$pia;
					   $productFilters->filter_added_by=Auth::guard('admins')->user()->id;
					   $productFilters->filter_added_on=date('Y-m-d H:i:s');
					   $result=$productFilters->save();
				  }
			 }
			  $product_locations=$request->product_locations;
			 if(isset($product_locations) && !empty($product_locations)){
				  foreach($product_locations as $key=>$loc){
					   $productFilters=new ProductFilters;
					   $productFilters->filter_product_id=$last_id;
					   $productFilters->filter_type='product_locations';
					   $productFilters->filter_type_id=$loc;
					   $productFilters->filter_added_by=Auth::guard('admins')->user()->id;
					   $productFilters->filter_added_on=date('Y-m-d H:i:s');
					   $result=$productFilters->save();
				  }
			 }
			  $product_ethinicities=$request->product_ethinicities;
			 if(isset($product_ethinicities) && !empty($product_ethinicities)){
				  foreach($product_ethinicities as $key=>$eth){
					   $productFilters=new ProductFilters;
					   $productFilters->filter_product_id=$last_id;
					   $productFilters->filter_type='product_ethinicities';
					   $productFilters->filter_type_id=$eth;
					   $productFilters->filter_added_by=Auth::guard('admins')->user()->id;
					   $productFilters->filter_added_on=date('Y-m-d H:i:s');
					   $result=$productFilters->save();
				  }
			 }
			 $product_peoples=$request->product_peoples;
			 if(isset($product_peoples) && !empty($product_peoples)){
				  foreach($product_peoples as $key=>$peop){
					   $productFilters=new ProductFilters;
					   $productFilters->filter_product_id=$last_id;
					   $productFilters->filter_type='product_peoples';
					   $productFilters->filter_type_id=$peop;
					   $productFilters->filter_added_by=Auth::guard('admins')->user()->id;
					   $productFilters->filter_added_on=date('Y-m-d H:i:s');
					   $result=$productFilters->save();
				  }
			 }
			 
			 
			  $product_orientations=$request->product_orientations;
			 if(isset($product_orientations) && !empty($product_orientations)){
				  foreach($product_ethinicities as $key=>$eth){
					   $productFilters=new ProductFilters;
					   $productFilters->filter_product_id=$last_id;
					   $productFilters->filter_type='product_orientations';
					   $productFilters->filter_type_id=$eth;
					   $productFilters->filter_added_by=Auth::guard('admins')->user()->id;
					   $productFilters->filter_added_on=date('Y-m-d H:i:s');
					   $result=$productFilters->save();
				  }
			 }
			  $product_resolution=$request->product_resolution;
			 if(isset($product_resolution) && !empty($product_resolution)){
				  foreach($product_resolution as $key=>$eth){
					   $productFilters=new ProductFilters;
					   $productFilters->filter_product_id=$last_id;
					   $productFilters->filter_type='product_resolution';
					   $productFilters->filter_type_id=$eth;
					   $productFilters->filter_added_by=Auth::guard('admins')->user()->id;
					   $productFilters->filter_added_on=date('Y-m-d H:i:s');
					   $result=$productFilters->save();
				  }
			 }
			  $product_sort_types=$request->product_sort_types;
			 if(isset($product_sort_types) && !empty($product_sort_types)){
				  foreach($product_sort_types as $key=>$eth){
					   $productFilters=new ProductFilters;
					   $productFilters->filter_product_id=$last_id;
					   $productFilters->filter_type='product_sort_types';
					   $productFilters->filter_type_id=$eth;
					   $productFilters->filter_added_by=Auth::guard('admins')->user()->id;
					   $productFilters->filter_added_on=date('Y-m-d H:i:s');
					   $result=$productFilters->save();
				  }
			 }
			 
			 /* end filters */
			 
			 
			 if($last_id < 10){
				 $last_id='00'.$last_id;
			 }else if($last_id < 100){
				 $last_id='0'.$last_id;
			 }
			 if($request->hasFile('product_image')) {
				$image = $request->file('product_image');
				$name = time().'.'.$image->getClientOriginalExtension();
				$files2bucketemp= $image->getPathName();
				$file_path='';
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
				//$image->move($destinationPath, $name);
				$s3Client = new S3Client([
					/*'profile' => 'default',*/
					'region' => 'us-east-2',
					'version' => '2006-03-01'
				]);
				// Use multipart upload
				//print_r($files2bucketemp);
				//exit();
				$finelname=$file_path.$name;
				$source = $files2bucketemp;
				$uploader = new MultipartUploader($s3Client, $source, [
					'bucket' => 'imgfootage',
					'key' => $finelname,
				]);
				
				try {
					$fileupresult = $uploader->upload();
				} catch (MultipartUploadException $e) {
					echo $e->getMessage() . "\n";
				}
    		 }
			 $productid=strtolower($firstThreeCharacters.$firstThreeCharactersType.$last_id);
			 $product_update = Product::find($last_id);
			 $product_update->product_id=$productid;
			 $product_update->product_main_image=$fileupresult['ObjectURL'];
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
		$imageResolution=new ImageResolution;
		$all_productresolution_list=$imageResolution->where('status', '1')->get()->toArray();
		$productOrientations= new ProductOrientations;
		$all_productorientations_list=$productOrientations->where('status', '1')->get()->toArray();
		$imageSortTypes=new ImageSortTypes;
		$all_isorttypes_list=$imageSortTypes->where('status', '1')->get()->toArray();
		$productFilters=new ProductFilters;
		$product_color_array=$productFilters->where('filter_type','product_color')->where('filter_product_id',$id)->get()->toArray();
		$productEthinicities=new ProductEthinicities;
		$all_productethinicities_list=$productEthinicities->where('status', '1')->get()->toArray();
		$productLocations=new ProductLocations;
		$all_productlocations_list=$productLocations->where('status', '1')->get()->toArray();
		$productPeoples=new ProductPeoples;
		$all_productPeoples_list=$productPeoples->where('status', '1')->get()->toArray();
		$filtercolourarray=array();
		foreach($product_color_array as $key=>$val){
			$filtercolourarray[]=$val['filter_type_id'];
		}
		$product_gender_array=$productFilters->where('filter_type','product_gender')->where('filter_product_id',$id)->get()->toArray();
		$filtergenderarray=array();
		foreach($product_gender_array as $key=>$val){
			$filtergenderarray[]=$val['filter_type_id'];
		}
		$product_glow_type_array=$productFilters->where('filter_type','product_glow_type')->where('filter_product_id',$id)->get()->toArray();
		$filterglowarray=array();
		foreach($product_glow_type_array as $key=>$val){
			$filterglowarray[]=$val['filter_type_id'];
		}
		$product_image_size_array=$productFilters->where('filter_type','product_image_size')->where('filter_product_id',$id)->get()->toArray();
		$filterimgsizearray=array();
		foreach($product_image_size_array as $key=>$val){
			$filterimgsizearray[]=$val['filter_type_id'];
		}
		$product_image_age_array=$productFilters->where('filter_type','product_image_age')->where('filter_product_id',$id)->get()->toArray();
		$filterimgagearray=array();
		foreach($product_image_age_array as $key=>$val){
			$filterimgagearray[]=$val['filter_type_id'];
		}
		$product_ethinicities_array=$productFilters->where('filter_type','product_ethinicities')->where('filter_product_id',$id)->get()->toArray();
		$filterethinicitiesarray=array();
		foreach($product_ethinicities_array as $key=>$val){
			$filterethinicitiesarray[]=$val['filter_type_id'];
		}
		$product_locations_array=$productFilters->where('filter_type','product_locations')->where('filter_product_id',$id)->get()->toArray();
		$filterlocationsarray=array();
		foreach($product_locations_array as $key=>$val){
			$filterlocationsarray[]=$val['filter_type_id'];
		}
		$product_peoples_array=$productFilters->where('filter_type','product_peoples')->where('filter_product_id',$id)->get()->toArray();
		$filterpeoplessarray=array();
		foreach($product_peoples_array as $key=>$val1){
			$filterpeoplessarray[]=$val1['filter_type_id'];
		}
		
		
		$product_orientations_array=$productFilters->where('filter_type','product_orientations')->where('filter_product_id',$id)->get()->toArray();
		$filterproductorientationsarray=array();
		foreach($product_orientations_array as $key=>$val1){
			$filterproductorientationsarray[]=$val1['filter_type_id'];
		}
		$product_resolution_array=$productFilters->where('filter_type','product_resolution')->where('filter_product_id',$id)->get()->toArray();
		$filterresolutionarray=array();
		foreach($product_resolution_array as $key=>$val1){
			$filterresolutionarray[]=$val1['filter_type_id'];
		}
		$product_sort_types_array=$productFilters->where('filter_type','product_sort_types')->where('filter_product_id',$id)->get()->toArray();
		$filtersort_typessarray=array();
		foreach($product_sort_types_array as $key=>$val1){
			$filtersort_typessarray[]=$val1['filter_type_id'];
		}	
		
		
        return view('admin.product.editproduct', ['product' => $product,'productcategory' => $all_produstcategory_list,'productsubcategory'=>$all_produstsubcategory_list,'contributor'=>$all_contributor_list,'pcolorlist'=>$all_produstcolors_list,'productGenders'=>$all_productgender_list,'productimagetypes'=>$all_productimagetypes_list,'productimagesize'=>$all_productimagesize_list,'productagewises'=>$all_productagewises_list,'product_gender_array'=>$filtergenderarray,'product_color_array'=>$filtercolourarray,'product_glow_type_array'=>$filterglowarray,'product_image_size_array'=>$filterimgsizearray,'product_image_age_array'=>$filterimgagearray,'productethinicities'=>$all_productethinicities_list,'productlocations'=>$all_productlocations_list,'filterethinicitiesarray'=>$filterethinicitiesarray,'filterlocationsarray'=>$filterlocationsarray,'productPeoples'=>$all_productPeoples_list,'filterpeoplessarray'=>$filterpeoplessarray,'imageResolution'=>$all_productresolution_list,'productOrientations'=>$all_productorientations_list,'imageSortTypes'=>$all_isorttypes_list,'filterproductorientationsarray'=>$filterproductorientationsarray,'filterresolutionarray'=>$filterresolutionarray,'filtersort_typessarray'=>$filtersort_typessarray]);
    }

   public function productsList(){
	   $product = new Product;
	   //$all_produst_list=$product->all()->toArray();
	   $all_produst_list=$product->leftJoin('imagefootage_productcategory', 'imagefootage_productcategory.category_id', '=', 'imagefootage_products.product_category')->leftJoin('imagefootage_productsubcategory', 'imagefootage_productsubcategory.subcategory_id', '=', 'imagefootage_products.product_subcategory')->leftJoin('imagefootage_productimages', 'imagefootage_productimages.image_product_id', '=', 'imagefootage_products.id')->distinct()->get()->toArray();
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
				$name = time().'.'.$image->getClientOriginalExtension();
				$files2bucketemp= $image->getPathName();
				$file_path='';
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
				//$image->move($destinationPath, $name);
				$s3Client = new S3Client([
					/*'profile' => 'default',*/
					'region' => 'us-east-2',
					'version' => '2006-03-01'
				]);
				// Use multipart upload
				$finelname=$file_path.$name;
				$source = $files2bucketemp;
				$uploader = new MultipartUploader($s3Client, $source, [
					'bucket' => 'imgfootage',
					'key' => $finelname,
				]);
				
				try {
					$fileupresult = $uploader->upload();
				} catch (MultipartUploadException $e) {
					echo $e->getMessage() . "\n";
				}
    		 
			  $image = $request->file('product_image');
			  $file = $request->file('product_image');
			  //$name = time().'.'.$image->getClientOriginalExtension();
			  $name=$fileupresult['ObjectURL'];
			  $update_array['product_main_image']=$fileupresult['ObjectURL'];
		 	  $data = getimagesize($file);
 		 	  $dimenctions = $data[0].'x'.$data[1];
			  $update_array['product_size']=$dimenctions;
			  $productimages=new ProductImages;
			 $update_image=array('image_name'=>$name);
			 $result = ProductImages::where('image_product_id',$request->product_id)->update($update_image);
		 }
		 $product_id=$request->product_id;
		 $result = Product::where('id',$request->product_id)->update($update_array);
		 if($result){
			 /* for filters */
			 $del_result=ProductFilters::where('filter_product_id',$request->product_id)->delete();
			 if($del_result){
			 $product_color=$request->product_color;
			 if(isset($product_color) && !empty($product_color)){
				 foreach($product_color as $key=>$pc){
					   $productFilters=new ProductFilters;
					   $productFilters->filter_product_id=$product_id;
					   $productFilters->filter_type='product_color';
					   $productFilters->filter_type_id=$pc;
					   $productFilters->filter_added_by=Auth::guard('admins')->user()->id;
					   $productFilters->filter_added_on=date('Y-m-d H:i:s');
					   $result=$productFilters->save();
				 }
			 }
		 	 $product_gender=$request->product_gender;
			 if(isset($product_gender) && !empty($product_gender)){
				   foreach($product_gender as $key=>$pg){
					   $productFilters=new ProductFilters;
					   $productFilters->filter_product_id=$product_id;
					   $productFilters->filter_type='product_gender';
					   $productFilters->filter_type_id=$pg;
					   $productFilters->filter_added_by=Auth::guard('admins')->user()->id;
					   $productFilters->filter_added_on=date('Y-m-d H:i:s');
					   $result=$productFilters->save();
				   }
			 }
		 	 $product_glow_type=$request->product_glow_type;
			 if(isset($product_glow_type) && !empty($product_glow_type)){
				  
				  foreach($product_glow_type as $key=>$pgt){
					  $productFilters=new ProductFilters;
					   $productFilters->filter_product_id=$product_id;
					   $productFilters->filter_type='product_glow_type';
					   $productFilters->filter_type_id=$pgt;
					   $productFilters->filter_added_by=Auth::guard('admins')->user()->id;
					   $productFilters->filter_added_on=date('Y-m-d H:i:s');
					   $result=$productFilters->save();
				  }
			 }
		 	 $product_image_size=$request->product_image_size;
			 if(isset( $product_image_size) && !empty( $product_image_size)){
				  
				  foreach($product_image_size as $key=>$pis){
					   $productFilters=new ProductFilters;
					   $productFilters->filter_product_id=$product_id;
					   $productFilters->filter_type='product_image_size';
					   $productFilters->filter_type_id=$pis;
					   $productFilters->filter_added_by=Auth::guard('admins')->user()->id;
					   $productFilters->filter_added_on=date('Y-m-d H:i:s');
					   $result=$productFilters->save();
				  }
			 }
		 	 $product_image_age=$request->product_image_age;
			 if(isset($product_image_age) && !empty($product_image_age)){
				  foreach($product_image_age as $key=>$pia){
					   $productFilters=new ProductFilters;
					   $productFilters->filter_product_id=$product_id;
					   $productFilters->filter_type='product_image_age';
					   $productFilters->filter_type_id=$pia;
					   $productFilters->filter_added_by=Auth::guard('admins')->user()->id;
					   $productFilters->filter_added_on=date('Y-m-d H:i:s');
					   $result=$productFilters->save();
				  }
			 }
			 $product_locations=$request->product_locations;
			 if(isset($product_locations) && !empty($product_locations)){
				  foreach($product_locations as $key=>$loc){
					   $productFilters=new ProductFilters;
					   $productFilters->filter_product_id=$product_id;
					   $productFilters->filter_type='product_locations';
					   $productFilters->filter_type_id=$loc;
					   $productFilters->filter_added_by=Auth::guard('admins')->user()->id;
					   $productFilters->filter_added_on=date('Y-m-d H:i:s');
					   $result=$productFilters->save();
				  }
			 }
			  $product_ethinicities=$request->product_ethinicities;
			 if(isset($product_ethinicities) && !empty($product_ethinicities)){
				  foreach($product_ethinicities as $key=>$eth){
					   $productFilters=new ProductFilters;
					   $productFilters->filter_product_id=$product_id;
					   $productFilters->filter_type='product_ethinicities';
					   $productFilters->filter_type_id=$eth;
					   $productFilters->filter_added_by=Auth::guard('admins')->user()->id;
					   $productFilters->filter_added_on=date('Y-m-d H:i:s');
					   $result=$productFilters->save();
				  }
			 }
			 $product_peoples=$request->product_peoples;
			 if(isset($product_peoples) && !empty($product_peoples)){
				  foreach($product_peoples as $key=>$peop){
					   $productFilters=new ProductFilters;
					   $productFilters->filter_product_id=$product_id;
					   $productFilters->filter_type='product_peoples';
					   $productFilters->filter_type_id=$peop;
					   $productFilters->filter_added_by=Auth::guard('admins')->user()->id;
					   $productFilters->filter_added_on=date('Y-m-d H:i:s');
					   $result=$productFilters->save();
				  }
			 }
			  $product_orientations=$request->product_orientations;
			 if(isset($product_orientations) && !empty($product_orientations)){
				  foreach($product_ethinicities as $key=>$eth){
					   $productFilters=new ProductFilters;
					   $productFilters->filter_product_id=$product_id;
					   $productFilters->filter_type='product_orientations';
					   $productFilters->filter_type_id=$eth;
					   $productFilters->filter_added_by=Auth::guard('admins')->user()->id;
					   $productFilters->filter_added_on=date('Y-m-d H:i:s');
					   $result=$productFilters->save();
				  }
			 }
			  $product_resolution=$request->product_resolution;
			 if(isset($product_resolution) && !empty($product_resolution)){
				  foreach($product_resolution as $key=>$eth){
					   $productFilters=new ProductFilters;
					   $productFilters->filter_product_id=$product_id;
					   $productFilters->filter_type='product_resolution';
					   $productFilters->filter_type_id=$eth;
					   $productFilters->filter_added_by=Auth::guard('admins')->user()->id;
					   $productFilters->filter_added_on=date('Y-m-d H:i:s');
					   $result=$productFilters->save();
				  }
			 }
			  $product_sort_types=$request->product_sort_types;
			 if(isset($product_sort_types) && !empty($product_sort_types)){
				  foreach($product_sort_types as $key=>$eth){
					   $productFilters=new ProductFilters;
					   $productFilters->filter_product_id=$product_id;
					   $productFilters->filter_type='product_sort_types';
					   $productFilters->filter_type_id=$eth;
					   $productFilters->filter_added_by=Auth::guard('admins')->user()->id;
					   $productFilters->filter_added_on=date('Y-m-d H:i:s');
					   $result=$productFilters->save();
				  }
			 }
			 }
			 /* end filters */
			 

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
				 //File::delete($destinationPath.$request->file_name);
				//$image->move($destinationPath, $name);
				
				$imgarray=explode('https://imgfootage.s3.us-east-2.amazonaws.com/',$request->product_url);
				$s3img=str_replace('%2F','/',$imgarray[1]);
				$bucket = 'imgfootage';
				$keyname = $s3img;
				try {	
					$s3 = new S3Client([
						'version' => '2006-03-01',
						'region'  => 'us-east-2'
					]);
					
					// Delete an object from the bucket.
					$result=$s3->deleteObject([
						'Bucket' => $bucket,
						'Key'    => $keyname
					]);
					} catch (S3Exception $e) {
							echo $e->getMessage() . "\n";
					}
				
				
				
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
				//File::delete($product_url);
			$imgarray=explode('https://imgfootage.s3.us-east-2.amazonaws.com/',$product['product_main_image']);
			$s3img=str_replace('%2F','/',$imgarray[1]);
			$bucket = 'imgfootage';
			$keyname = $s3img;
			try {	
				$s3 = new S3Client([
					'version' => '2006-03-01',
					'region'  => 'us-east-2'
				]);
				
				// Delete an object from the bucket.
				$result=$s3->deleteObject([
					'Bucket' => $bucket,
					'Key'    => $keyname
				]);
				} catch (S3Exception $e) {
    					echo $e->getMessage() . "\n";
				}
				
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

  public function getproduct($product_id){
	$products = DB::table('imagefootage_products')
		->select('product_id','product_title','product_main_image','product_vertical','product_price_small','product_price_medium'
		,'product_price_large','product_price_extralarge')
        ->where('product_id',$product_id);
        
     $crm_products = DB::table('imagefootage_crm_products')
            ->select('product_code','name','thumbnail_image','type','small_size','medium_size','large_size','x_large_size')
            ->where('product_code',$product_id)
            ->union($products)
            ->get()
			->toArray();
		
	 if(count($crm_products)==0){
		    $imageMedia = new ImageApi();
			$product_details = $imageMedia->get_media_info($product_id);
			$prices = $imageMedia->getPriceFromList($product_details);
			dd($prices);
	 }else{
		 return json_encode($crm_products);
	 }   		
         
  }

}  