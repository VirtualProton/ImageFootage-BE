<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    public $timestamps = false; 
    protected $table = 'wishlist_folder';
	protected $primaryKey = 'id';
	protected $fillable = ['userid','folder_name'];
}
