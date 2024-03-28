<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageFootageFilter extends Model
{
    protected $table = 'imagefootage_filters';
    protected $primaryKey = 'id';

    public function options(){
        return $this->hasMany(ImageFootageFilterOption::class,'filter_id', 'id');
    }
}
