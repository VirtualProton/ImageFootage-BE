<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductOrientations extends Model
{
    public $timestamps = false; 
    protected $table = 'imagefootage_product_orientations';
	protected $primaryKey = 'id';
	protected $fillable = ['name','status','created_at','updated_at'];
}
