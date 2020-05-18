<?php
namespace App\Http\Controllers\Admin;
use Aws\S3\S3Client;
use Aws\Exception\AwsException;
use Aws\S3\MultipartUploader;
use Aws\Exception\MultipartUploadException;
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
use App\Models\ProductEthinicities;
use App\Models\ProductLocations;
use App\Models\ProductFilters;
use App\Models\ProductPeoples;
use App\Models\ImageResolution;
use App\Models\ProductOrientations;
use App\Models\ImageSortTypes;
//use Excel;

class ProductBulkUploadController extends Controller
{
   public function uploadCSV(){
	   $contributor=new Contributor;
	   $all_contributor_list=$contributor->where('contributor_status', 'Active')->get()->toArray();
	   return view('admin.product.uploadproductscsv',['contributor'=>$all_contributor_list]);
   }
   public function importCSV(Request $request){
		 /* $this->validate($request, [
		  'product_csv'  => 'required|mimes:csv'
		 ]);*/
		$owner_name=$request->owner_name;
     	$path = $request->file('product_csv')->getRealPath();
		$data = array_map('str_getcsv', file($path));
		$csv_data = array_slice($data, 0, 2);
		//echo '<pre>';
		//print_r($csv_data);exit();
		$i=0;
		foreach($csv_data as $key=>$val){
		 	$product = new Product;
		 	$productimages=new ProductImages;
			if($i !=0){
				$product_cat=$val[0];
				$product_subcat=$val[1];
				$product_title=$val[2];
				$product_vertical=$val[3];
				$product_keywords=$val[4];
				$product_size=$val[5];
				$product_main_image=$val[6];
				$product_release_details=$val[7];
				$product_price_small=$val[8];
				$product_price_medium=$val[9];
				$product_pricelarge=$val[10];
				$product_priexlarge=$val[11];
				$product_main_type=$val[12];
				$product_sub_type=$val[13];
				$other_product_urls=$val[14];
				//Get the first three characters using substr.
				$firstThreeCharacters = substr($owner_name, 0, 3);
				$firstThreeCharactersType = substr($product_main_type, 0, 3);
				$productid=$firstThreeCharacters.$firstThreeCharactersType;
				$product->product_id =$productid;
				$product->product_title=$product_title;
				$product->product_category=$product_cat;
			    $product->product_subcategory=$product_subcat;
				$product->product_owner=$owner_name;
				$product->product_title=$product_title;
				$product->product_vertical=$product_vertical;
				$product->product_keywords=$product_keywords;
				//$product->product_thumbnail=$request->product_thumbnail;
			    $product->product_size=$product_size;
				$product->product_release_details=$product_release_details;
				$product->product_price_small=$product_price_small;
				$product->product_price_medium=$product_price_medium;
				$product->product_price_large=$product_pricelarge;
				$product->product_price_extralarge=$product_priexlarge;
				$product->product_main_type=$product_main_type;
				$product->product_added_by=Auth::guard('admins')->user()->id;
				if(isset($product_sub_type) && !empty($product_sub_type)){
					$product->product_sub_type=$product_sub_type;
				}
				$product->product_added_on=date('Y-m-d');
				$result=$product->save();
				$last_id=$product->id;
				if($result){
					/* for filters */
					 $product_color=explode(',',$val[15]);
					 if(isset($product_color) && !empty($product_color)){
						 foreach($product_color as $pc){
							   $productFilters=new ProductFilters;
							   $productFilters->filter_product_id=$last_id;
							   $productFilters->filter_type='product_color';
							   $productFilters->filter_type_id=$pc;
							   $productFilters->filter_added_by=Auth::guard('admins')->user()->id;
							   $productFilters->filter_added_on=date('Y-m-d H:i:s');
							   $result=$productFilters->save();
						 }
					 }
					 $product_gender=explode(',',$val[16]);
					 if(isset($product_gender) && !empty($product_gender)){
						   foreach($product_gender as $pg){
							   $productFilters=new ProductFilters;
							   $productFilters->filter_product_id=$last_id;
							   $productFilters->filter_type='product_gender';
							   $productFilters->filter_type_id=$pg;
							   $productFilters->filter_added_by=Auth::guard('admins')->user()->id;
							   $productFilters->filter_added_on=date('Y-m-d H:i:s');
							   $result=$productFilters->save();
						   }
					 }
					 $product_glow_type=explode(',',$val[17]);
					 if(isset($product_glow_type) && !empty($product_glow_type)){
						  foreach($product_glow_type as $pgt){
							   $productFilters=new ProductFilters;
							   $productFilters->filter_product_id=$last_id;
							   $productFilters->filter_type='product_glow_type';
							   $productFilters->filter_type_id=$pgt;
							   $productFilters->filter_added_by=Auth::guard('admins')->user()->id;
							   $productFilters->filter_added_on=date('Y-m-d H:i:s');
							   $result=$productFilters->save();
						  }
					 }
					 $product_image_size=explode(',',$val[18]);
					 if(isset( $product_image_size) && !empty( $product_image_size)){
						  foreach($product_image_size as $pis){
							   $productFilters=new ProductFilters;
							   $productFilters->filter_product_id=$last_id;
							   $productFilters->filter_type='product_image_size';
							   $productFilters->filter_type_id=$pis;
							   $productFilters->filter_added_by=Auth::guard('admins')->user()->id;
							   $productFilters->filter_added_on=date('Y-m-d H:i:s');
							   $result=$productFilters->save();
						  }
					 }
					 $product_image_age=explode(',',$val[19]);
					 if(isset($product_image_age) && !empty($product_image_age)){
						  foreach($product_image_age as $pia){
							   $productFilters=new ProductFilters;
							   $productFilters->filter_product_id=$last_id;
							   $productFilters->filter_type='product_image_age';
							   $productFilters->filter_type_id=$pia;
							   $productFilters->filter_added_by=Auth::guard('admins')->user()->id;
							   $productFilters->filter_added_on=date('Y-m-d H:i:s');
							   $result=$productFilters->save();
						  }
					 }
					  $product_locations=explode(',',$val[21]);
					 if(isset($product_locations) && !empty($product_locations)){
						  foreach($product_locations as $loc){
							   $productFilters=new ProductFilters;
							   $productFilters->filter_product_id=$last_id;
							   $productFilters->filter_type='product_locations';
							   $productFilters->filter_type_id=$loc;
							   $productFilters->filter_added_by=Auth::guard('admins')->user()->id;
							   $productFilters->filter_added_on=date('Y-m-d H:i:s');
							   $result=$productFilters->save();
						  }
					 }
					  $product_ethinicities=explode(',',$val[20]);
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
					 $product_peoples=explode(',',$val[22]);
					 if(isset($product_peoples) && !empty($product_peoples)){
						  foreach($product_peoples as $peop){
							   $productFilters=new ProductFilters;
							   $productFilters->filter_product_id=$last_id;
							   $productFilters->filter_type='product_peoples';
							   $productFilters->filter_type_id=$peop;
							   $productFilters->filter_added_by=Auth::guard('admins')->user()->id;
							   $productFilters->filter_added_on=date('Y-m-d H:i:s');
							   $result=$productFilters->save();
						  }
					 }
					 
					 
					  $product_orientations=explode(',',$val[24]);
					 if(isset($product_orientations) && !empty($product_orientations)){
						  foreach($product_orientations as $key=>$eth){
							   $productFilters=new ProductFilters;
							   $productFilters->filter_product_id=$last_id;
							   $productFilters->filter_type='product_orientations';
							   $productFilters->filter_type_id=$eth;
							   $productFilters->filter_added_by=Auth::guard('admins')->user()->id;
							   $productFilters->filter_added_on=date('Y-m-d H:i:s');
							   $result=$productFilters->save();
						  }
					 }
					  $product_resolution=explode(',',$val[23]);
					 if(isset($product_resolution) && !empty($product_resolution)){
						  foreach($product_resolution as $eth){
							   $productFilters=new ProductFilters;
							   $productFilters->filter_product_id=$last_id;
							   $productFilters->filter_type='product_resolution';
							   $productFilters->filter_type_id=$eth;
							   $productFilters->filter_added_by=Auth::guard('admins')->user()->id;
							   $productFilters->filter_added_on=date('Y-m-d H:i:s');
							   $result=$productFilters->save();
						  }
					 }
					  $product_sort_types=explode(',',$val[25]);
					 if(isset($product_sort_types) && !empty($product_sort_types)){
						  foreach($product_sort_types as $eth){
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
					 
					 $productid=strtolower($firstThreeCharacters.$firstThreeCharactersType.$last_id);
					 $product_update = Product::find($last_id);
					 $product_update->product_id=$productid;
					 $product_update->product_main_image=$val[6];
					 $product_update->save();
					 
					 $productimages->image_name=$val[6];
					 $productimages->image_product_id=$last_id;
					 $productimages->image_added_on=date('Y-m-d H:i:s');
					 $productimages->image_added_by=Auth::guard('admins')->user()->id;
					 $productimages->save();
					 if(isset($val[14]) && !empty($val[14])){
						 $other_images=explode(',',$val[14]);
						 foreach($other_images as $prod){
							 $productimages=new ProductImages;
							 $productimages->image_name=$prod;
							 $productimages->image_product_id=$last_id;
							 $productimages->image_added_on=date('Y-m-d H:i:s');
							 $productimages->image_added_by=Auth::guard('admins')->user()->id;
							 $productimages->save();
						 }
					 }
				}
			}
			$i++;
		}
     return back()->with('success','Products imported successfully.');
    }

}
