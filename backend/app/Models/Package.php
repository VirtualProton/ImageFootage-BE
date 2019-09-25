<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
     protected $table = 'imagefootage_packages';
	 protected $primaryKey = 'package_id';
	 protected $fillable = ['package_name','package_price','package_description','package_products_count','package_type','package_added_on','package_expiry','package_addedby','package_status'];
}
