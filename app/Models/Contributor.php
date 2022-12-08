<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contributor extends Model
{
	 protected $table = 'imagefootage_contributor';
	 protected $primaryKey = 'contributor_id';
	 protected $fillable = ['contributor_memberid','contributor_name','contributor_email','contributor_otp','contributor_password','contributor_idproof','contributor_type','contributor_last_login','contributor_added_on','contributor_status','created_at','updated_at','contributor_addedby','contributor_accountholder','contributor_banknumber','contributor_ifsc','contributor_bank'];
}
