<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminUsers extends Model
{
    protected $table = 'imgf_adminusers';
	protected $primaryKey = 'admin_id';
	protected $fillable = ['admin_name','admin_password','admin_email','admin_mobile','admin_address','admin_created_at','admin_lastlogin','admin_type','admin_status','created_at','updated_at'];
}
