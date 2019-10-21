<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usercart extends Model
{
	public $timestamps = false; 
    protected $table = 'imagefootage_usercart';
	protected $primaryKey = 'cart_id';
	protected $fillable = ['cart_product_id','cart_product_type','cart_added_by','cart_added_on'];
    
}
