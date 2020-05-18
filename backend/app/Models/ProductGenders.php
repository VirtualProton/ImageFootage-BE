<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductGenders extends Model
{
    protected $table = 'imagefootage_product_genders';
	protected $primaryKey = 'id';
	protected $fillable = ['name','status','created_at','updated_at'];
}
