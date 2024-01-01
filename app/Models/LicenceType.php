<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LicenceType extends Model
{
    protected $table = "licence_type";
    protected $fillable = ['id', 'licence_name','description','product_type','version'];

}
