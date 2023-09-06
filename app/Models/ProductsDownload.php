<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductsDownload extends Model
{
    protected $table = 'imagefootage_users_products_download';

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
