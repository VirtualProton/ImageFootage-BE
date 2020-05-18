<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageResolution extends Model
{
     public $timestamps = false; 
    protected $table = 'imagefootage_product_image_resolutions';
	protected $primaryKey = 'id';
	protected $fillable = ['name','status','created_at','updated_at'];
}
