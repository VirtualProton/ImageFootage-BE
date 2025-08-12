<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class ImageFootageWishlist extends Model
{
    use SoftDeletes;

    protected $table = "imagefootage_wishlists";
    protected $fillable = ['id', 'name'];

    public function products() {
        return $this->belongsToMany(Product::class, 'imagefootage_wishlist_products', 'wishlist_id', 'product_id')->withPivot('type');
    }
    
    public function getWishlistProducts() {
        return DB::table('imagefootage_wishlist_products')
        ->where('wishlist_id', $this->id)
        ->get();

    }

    public function user()
    {
        return $this->belongsToMany(User::class, 'imagefootage_users_wishlist', 'wishlist_id', 'user_id')
            ->withTimestamps();
    }
}
