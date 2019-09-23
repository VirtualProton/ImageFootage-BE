<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'imagefootage_products';
	protected $primaryKey = 'id';
	protected $fillable = ['product_id','product_category','product_subcategory','product_owner','product_title','product_vertical','product_keywords','product_thumbnail','product_main_image','product_release_details','product_price_small','product_price_medium','product_price_large','product_price_extralarge','product_status','product_main_type','product_sub_type','product_added_on','updated_at','product_added_by','product_size','product_verification','product_rejectod_reason'];
}
