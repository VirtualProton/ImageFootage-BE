<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modules extends Model
{
    protected $table = 'imagefootage_modules';

public function submodules()
{
    return $this->hasMany(Modules::class, 'parent_module_id');
}

public function parentmodules()
{
    return $this->belongsTo(Modules::class, 'parent_module_id');
}


}
