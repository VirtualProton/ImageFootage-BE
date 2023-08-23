<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImagefootageSharedWishlistsLog extends Model
{
    protected $table = 'imagefootage_shared_wishlists_logs';

    protected $fillable = [
        'id',
        'shared_by_user_id',
        'shared_wishlist_id',
        'shared_with_user_id',
        'new_wishlist_id',
        'shared_product_ids'
    ];

    // Accessor to retrieve shared_product_ids as an array
    public function getSharedProductIdsAttribute($value) {
        return json_decode($value, true);
    }

    // Mutator to store shared_product_ids as a JSON-encoded string
    public function setSharedProductIdsAttribute($value) {
        $this->attributes['shared_product_ids'] = json_encode($value);
    }

    public function sharedByUser()
    {
        return $this->belongsTo(User::class, 'shared_by_user_id');
    }

    public function sharedWishlist()
    {
        return $this->belongsTo(ImageFootageWishlist::class, 'shared_wishlist_id');
    }

    public function sharedWithUser()
    {
        return $this->belongsTo(User::class, 'shared_with_user_id');
    }

    public function newWishlist()
    {
        return $this->belongsTo(ImageFootageWishlist::class, 'new_wishlist_id');
    }
}
