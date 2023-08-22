<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageFootageWishlist extends Model
{
    protected $table = "imagefootage_wishlists";
    protected $fillable = ['id', 'name'];

    public function products() {
        return $this->belongsToMany(Product::class, 'imagefootage_wishlist_products', 'wishlist_id', 'product_id')->withPivot('type');
    }
}
