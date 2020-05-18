<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductLocations extends Model
{
    public $timestamps = false;
    protected $table = 'imagefootage_product_locations';
	protected $primaryKey = 'id';
	protected $fillable = ['name','status','created_at','updated_at'];
}
