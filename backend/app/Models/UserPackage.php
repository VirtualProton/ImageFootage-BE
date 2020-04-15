<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class UserPackage extends Model
{
    protected $table = 'imagefootage_user_package';

    public function downloads(){
        return $this->hasMany(UserProductDownload::class,'package_id', 'id');
    }
    public function user(){
        return $this->hasOne(User::class,'id', 'user_id');
    }



}
