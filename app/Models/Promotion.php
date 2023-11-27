<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    public $timestamps = true; 
    protected $table = 'imagefootage_promotion';
    protected $primaryKey = 'id';
	protected $fillable = ['event_name','media_url','event_des','status','created_at','update_at','page_type','desktop_banner_image','mobile_banner_image','media_type','product_name'];
}