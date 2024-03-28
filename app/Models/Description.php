<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Description extends Model
{
    protected $table = 'imagefootage_description';
	protected $primaryKey = 'id';
	protected $fillable = ['user_id','description','created_at','updated_at'];
}
