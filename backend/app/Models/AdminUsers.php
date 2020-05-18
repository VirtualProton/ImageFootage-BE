<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminUsers extends Model
{
    protected $table = 'imagefootage_adminusers';
	protected $fillable = ['admin_name','admin_password','admin_email','admin_mobile','admin_address','admin_created_at','admin_lastlogin','admin_type','admin_status','created_at','updated_at'];
}
