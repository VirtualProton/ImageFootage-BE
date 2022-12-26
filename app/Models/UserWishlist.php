<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserWishlist extends Model
{
	public $timestamps = false; 
    protected $table = 'imagefootage_wishlist';
	protected $primaryKey = 'wishlist_id';
	protected $fillable = ['wishlist_product','wishlist_user_id','folder_name','wishlist_added_on'];    
}
