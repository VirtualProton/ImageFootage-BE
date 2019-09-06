<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSubCategory extends Model
{
     protected $table = 'imagefootage_productsubcategory';
	 protected $primaryKey = 'subcategory_id';
	 protected $fillable = ['category_id','subcategory_name','subcategory_order','subcategory_added_by','subcategory_added_on','subcategory_status','created_at','updated_at'];
}
