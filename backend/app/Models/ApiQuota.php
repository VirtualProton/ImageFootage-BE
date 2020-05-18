<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiQuota extends Model
{
     protected $table = 'imagefootage_api';
	 protected $primaryKey = 'api_id';
	 protected $fillable = ['api_provider','api_amount'];
}
