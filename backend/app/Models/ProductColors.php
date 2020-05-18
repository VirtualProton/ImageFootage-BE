<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductColors extends Model
{
    protected $table = 'imagefootage_product_colors';
	protected $primaryKey = 'id';
	protected $fillable = ['name','status','created_at','updated_at'];
}
