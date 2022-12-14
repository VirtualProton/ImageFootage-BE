<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPeoples extends Model
{
    public $timestamps = false; 
    protected $table = 'imagefootage_product_peoples';
	protected $primaryKey = 'id';
	protected $fillable = ['name','status','created_at','updated_at'];
}
