<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class ImageFilterValue extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'image_filter_values';

    protected $fillable = [
        'api_product_id',
        'attributes'
    ];
}
