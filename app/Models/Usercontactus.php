<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usercontactus extends Model
{
   public $timestamps = false; 
   protected $table = 'imagefootage_usercontactus';
   protected $primaryKey = 'contactus_id';
   protected $fillable = ['contactus_id','contactus_name','contactus_mobileno','contactus_emailid','contactus_message','cart_added_on'];
}
