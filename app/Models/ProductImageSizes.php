<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImageSizes extends Model
{
    protected $table = 'imagefootage_product_image_sizes';
	protected $primaryKey = 'id';
	protected $fillable = ['name','status','created_at','updated_at'];
}
