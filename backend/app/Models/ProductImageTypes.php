<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImageTypes extends Model
{
    protected $table = 'imagefootage_product_image_types';
	protected $primaryKey = 'id';
	protected $fillable = ['name','status','created_at','updated_at'];
}
