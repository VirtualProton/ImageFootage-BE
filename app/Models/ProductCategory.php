<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
     protected $table = 'imagefootage_productcategory';
	 protected $primaryKey = 'category_id';
	 protected $fillable = ['category_name','category_order','category_added_by','category_status','category_added_on','created_at','updated_at','category_keywords','product_id','image_path'];
}
