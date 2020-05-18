<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAgeWises extends Model
{
    protected $table = 'imagefootage_product_age_wises';
	protected $primaryKey = 'id';
	protected $fillable = ['name','status','created_at','updated_at'];
}
