<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    public $timestamps = false; 
    protected $table = 'imagefootage_promotion';
    protected $primaryKey = 'id';
	protected $fillable = ['event_name','date_start','date_end','item','description','status','created_at','update_at'];

}