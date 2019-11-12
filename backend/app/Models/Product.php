<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Product extends Model
{
    protected $table = 'imagefootage_products';
	protected $primaryKey = 'id';
	protected $fillable = ['product_id','product_category','product_subcategory','product_owner','product_title','product_vertical','product_keywords','product_thumbnail','product_main_image','product_release_details','product_price_small','product_price_medium','product_price_large','product_price_extralarge','product_status','product_main_type','product_sub_type','product_added_on','updated_at','product_added_by','product_size','product_verification','product_rejectod_reason','product_editedby'];

    public function getProducts($keyword){
        if($keyword['productType']['id']=='1'){
            $type='Image';
        }else if($keyword['productType']['id']=='2'){
            $type='Footage';
        }else{
            $type='Editorial';
        }
        $serach = $keyword['search'];
        $data =Product::where('product_main_type','=',$type)
                ->orWhere('product_id','=',$serach)
                ->orWhere('product_title','LIKE', '%'. $serach .'%')
                ->orwhere('product_keywords','LIKE','%'. $serach .'%')
                ->get()
                ->toArray();
        return  $data;
    }

    public function getProductDetail($media_id,$type){
        $data =Product::where('product_main_type','=',$type)
                ->Where('product_id','=',$media_id)
                ->get()
                ->toArray();
        return  $data;    
    }
	public function adminAllProductList(){
		  $all_produst_list=Product::leftJoin('imagefootage_productcategory', 'imagefootage_products.product_category', '=','imagefootage_productcategory.category_id')->leftJoin('imagefootage_productsubcategory', 'imagefootage_products.product_subcategory', '=','imagefootage_productsubcategory.subcategory_id' )->leftJoin('imagefootage_productimages', 'imagefootage_products.id', '=','imagefootage_productimages.image_product_id')->get()->toArray();
		  return $all_produst_list;
		 
	}

}
