<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class UserPackage extends Model
{
    protected $table = 'imagefootage_user_package';

    protected $fillable = ['transaction_id', 'user_id', 'package_id', 'package_name', 'package_price', 'package_description', 'package_products_count', 'package_type', 'package_expiry', 'package_plan', 'package_permonth_download', 'package_pcarry_forward', 'invoice', 'package_expiry_yearly', 'package_expiry_date_from_purchage', 'downloaded_product', 'pacage_size', 'payment_status', 'payment_mode', 'payment_gatway_provider', 'response_payment', 'status', 'order_type', 'footage_tier', 'created_at', 'updated_at', 'rozor_pay_id','status'];

    public function downloads()
    {
        return $this->hasMany(UserProductDownload::class, 'package_id', 'id');
    }
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function licence()
    {
        return $this->hasOne(LicenceType::class, 'id', 'footage_tier');
    }

}
