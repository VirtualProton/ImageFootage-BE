<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ImageFootageWishlist extends Model
{
    use SoftDeletes;

    protected $table = "imagefootage_wishlists";
    protected $fillable = ['id', 'name'];

    public function products() {
        return $this->belongsToMany(Product::class, 'imagefootage_wishlist_products', 'wishlist_id', 'product_id')->withPivot('type');
    }

    public function user()
    {
        return $this->belongsToMany(User::class, 'imagefootage_users_wishlist', 'wishlist_id', 'user_id')
            ->withTimestamps();
    }
}
