<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    protected $table = 'imagefootage_userinfo';
	protected $primaryKey = 'id';
	protected $fillable = ['user_id','partner','whitelist','blacklist','frozen','allow_certi','enable_subs_multi','preferred_contact_method','created_at','updated_at'];


	public function getUserInfo($user_id=NULL){
        // if($user_id==''){
        // return UserInfo::get()->toArray();
        // }else{
        //  return UserInfo::where('user_id','=',$user_id)->first()->toArray();
        // }

		if($user_id==''){
			return UserInfo::get()->toArray();
			}else{
				$userinfo = UserInfo::where('user_id','=',$user_id)->first();
				if($userinfo) {
					return $userinfo->toArray();
				}
				return;
			}
    }
}
