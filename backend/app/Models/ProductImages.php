<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImages extends Model
{
    protected $table = 'imagefootage_productimages';
	 protected $primaryKey = 'image_id';
	 protected $fillable = ['image_name','product_id','image_added_on','image_added_by','image_status'];
}
