<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    protected $table = 'promo_codes';
    protected $fillable = [
        'name', 'type', 'max_usage', 'valid_upto_type', 'valid_till_date', 'status'
    ];

    public $timestamps = false;
}
