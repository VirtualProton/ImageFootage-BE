<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageSortTypes extends Model
{
    public $timestamps = false; 
    protected $table = 'imagefootage_product_sort_types';
	protected $primaryKey = 'id';
	protected $fillable = ['name','status','created_at','updated_at'];
}
