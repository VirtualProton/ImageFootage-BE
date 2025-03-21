<?php

namespace App\Http\Controllers;

use App\Models\ImageFootageFilter;
use Illuminate\Http\Request;
use App\Models\Usercontactus;
use App\Models\ProductColors;
use App\Models\ProductGenders;
use App\Models\ProductEthinicities;
use App\Models\ProductLocations;
use App\Models\ProductImageSizes;
use App\Models\ProductImageTypes;
use App\Models\ProductPeoples;
use App\Models\ProductOrientations;
use App\Models\ImageSortTypes;

class FiltersController extends Controller {
   public function getAllFilters(){
	   $productColors=new ProductColors;
	   $productcolor_list=$productColors->where('status','1')->get()->toArray();
	   $productGenders=new ProductGenders;
	   $productGenderList=$productGenders->where('status','1')->get()->toArray();
	   $productEthinicities=new ProductEthinicities;
	   $productEthinicitiesList=$productEthinicities->where('status','1')->get()->toArray();
	   $productLocations=new ProductLocations;
	   $productLocationsList=$productLocations->where('status','1')->get()->toArray();
	   $productImageSizes=new ProductImageSizes;
	   $productImageSizessList=$productImageSizes->where('status','1')->get()->toArray();
	   $productImageTypes=new ProductImageTypes;
	   $productImageTypesList=$productImageTypes->where('status','1')->get()->toArray();
	   $productPeoples=new ProductPeoples;
	   $productPeoplesList=$productPeoples->where('status','1')->get()->toArray();
	   $productOrientations=new ProductOrientations;
	   $productOrientationslist=$productOrientations->where('status','1')->get()->toArray();
	   $imageSortTypes=new ImageSortTypes;
	   $productSortTypelist=$imageSortTypes->where('status','1')->get()->toArray();
	  
	   
	   $filters=array();
	   foreach($productcolor_list as $key=>$val){
		   $filters['product_colors'][]=array('pcolor_id'=>$val['id'],'pcolor_name'=>$val['name']);
	   }
	   foreach($productGenderList as $key=>$val){
		   $filters['product_gender'][]=array('gender_id'=>$val['id'],'gender_name'=>$val['name']);
	   }
	   foreach($productEthinicitiesList as $key=>$val){
		   $filters['product_ethinicities'][]=array('ethinicity_id'=>$val['id'],'ethinicity_name'=>$val['name']);
	   }
	   foreach($productLocationsList as $key=>$val){
		   $filters['product_locations'][]=array('location_id'=>$val['id'],'location_name'=>$val['name']);
	   }
	   foreach($productImageSizessList as $key=>$val){
		   $filters['product_imagesizes'][]=array('imagesize_id'=>$val['id'],'imagesize_name'=>$val['name']);
	   }
	   foreach($productImageTypesList as $key=>$val){
		   $filters['product_imagetypes'][]=array('imagetype_id'=>$val['id'],'imagetype_name'=>$val['name']);
	   }
	   foreach($productPeoplesList as $key=>$val){
		   $filters['product_peoples'][]=array('people_id'=>$val['id'],'people_name'=>$val['name']);
	   }
	   foreach($productOrientationslist as $key=>$val){
		   $filters['product_orientations'][]=array('orientation_id'=>$val['id'],'orientation_name'=>$val['name']);
	   }
	   foreach($productSortTypelist as $key=>$val){
		   $filters['product_sorttype'][]=array('sorttype_id'=>$val['id'],'sorttype_name'=>$val['name']);
	   }

	   if(isset($filters) && !empty($filters)){
		   echo '{"status":"1","message":"","data":'.json_encode($filters,true).'}';
	   }else{
		   echo '{"status":"0","message":"No data found.","data":""}';
	   }
   }
   public function submitContactUs(Request $request){
	   $name=$request->user_name;
	   $mobile=$request->mobile_number;
	   $user_email=$request->user_email;
	   $user_message=$request->user_message;
	   $Usercontactus=new Usercontactus;
	   $Usercontactus->contactus_name=$name;
	   $Usercontactus->contactus_mobileno=$mobile;
	   $Usercontactus->contactus_emailid=$user_email;
	   $Usercontactus->contactus_message=$user_message;
	   $Usercontactus->cart_added_on=date('Y-m-d H:i:s');
	   $result=$Usercontactus->save();
	   if($result){
				echo '{"status":"1","message":"Contact us subbmitted successfully"}';
	   }else{
				echo '{"status":"0","message":"Some problem occured."}';
	   }
   }

   public function getAllFiltersV2(Request $request) {
		$type = $request->type;
		$filters = ImageFootageFilter::select('id', 'name', 'value', 'filter_type', 'default_filter_type', 'has_multiple_values')
						->with(['options' => function($query) {
							$query->select('id', 'filter_id', 'option_name', 'value', 'is_group_value')
								->where('status', 'active')
								->orderBy('sort_order', 'asc');
						}])
						->when(!empty($type), function($query) use ($type) {
							return $query->where('type', $type);
						})
						->where('status', 'active')
						->orderBy('sort_order', 'asc')
						->get();
		if(isset($filters) && !empty($filters)){
			echo '{"status":"1","message":"","data":'.json_encode($filters,true).'}';
		}else{
			echo '{"status":"0","message":"No data found.","data":""}';
		}
   }
}
