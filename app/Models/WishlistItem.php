<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WishlistItem extends Model
{
    public $timestamps = false; 
    protected $table = 'wishlist_folder_itmes';
	protected $primaryKey = 'id';
	protected $fillable = ['wishlist_folder_id','item'];
}
