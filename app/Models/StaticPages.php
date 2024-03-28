<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaticPages extends Model
{
     protected $table = 'imagefootage_staticpages';
	 protected $primaryKey = 'page_id';
	 protected $fillable = ['page_title','page_url','page_meta_desc','page_meta_keywords','page_slug','page_content','page_added_on','page_added_by','image_status'];
}
