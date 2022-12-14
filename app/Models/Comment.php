<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
   protected $table = 'imagefootage_comments';
   protected $primaryKey = 'id';

   public function agent(){
        return $this->hasOne(Account::class,'id', 'agent_id');
    }

    public function admin(){
        return $this->hasOne(Admin::class,'id', 'created_by');
    }
   
}
