<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'states';
    public function city(){
        return $this->hasMany(City::class,'state_id', 'id');
    }
}
