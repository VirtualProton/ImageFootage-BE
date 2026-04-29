<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use DB;

class UserPackage extends Model
{
    protected $table = 'imagefootage_user_package';

    protected $fillable = ['transaction_id', 'user_id', 'package_id', 'package_name', 'package_price', 'package_description', 'package_products_count', 'package_type', 'package_expiry', 'package_plan', 'package_permonth_download', 'package_pcarry_forward', 'invoice', 'package_expiry_yearly', 'package_expiry_date_from_purchage', 'package_extended_expiry_data', 'downloaded_product', 'pacage_size', 'payment_status', 'payment_mode', 'payment_gatway_provider', 'response_payment', 'status', 'order_type', 'footage_tier', 'created_at', 'updated_at', 'rozor_pay_id','status'];

    public function resolveEffectiveExpiryDate()
    {
        $rawExpiryDate = $this->package_extended_expiry_data ?: $this->package_expiry_date_from_purchage;

        if (empty($rawExpiryDate)) {
            return null;
        }

        try {
            return Carbon::parse($rawExpiryDate);
        } catch (\Throwable $exception) {
            return null;
        }
    }

    public function scopeWhereEffectiveExpiryOnOrAfter(Builder $query, $date = null, ?string $extendedColumn = null, ?string $baseColumn = null)
    {
        $comparisonDate = $date ? Carbon::parse($date) : Carbon::today();
        $extendedColumn = $extendedColumn ?: $query->getModel()->qualifyColumn('package_extended_expiry_data');
        $baseColumn = $baseColumn ?: $query->getModel()->qualifyColumn('package_expiry_date_from_purchage');

        return $query->where(function ($expiryQuery) use ($comparisonDate, $extendedColumn, $baseColumn) {
            $expiryQuery->where(function ($extendedExpiryQuery) use ($comparisonDate, $extendedColumn) {
                $extendedExpiryQuery->whereNotNull($extendedColumn)
                    ->whereDate($extendedColumn, '>=', $comparisonDate->toDateString());
            })->orWhere(function ($baseExpiryQuery) use ($comparisonDate, $extendedColumn, $baseColumn) {
                $baseExpiryQuery->whereNull($extendedColumn)
                    ->whereDate($baseColumn, '>=', $comparisonDate->toDateString());
            });
        });
    }

    public function scopeWhereEffectiveExpiryBefore(Builder $query, $date = null, ?string $extendedColumn = null, ?string $baseColumn = null)
    {
        $comparisonDate = $date ? Carbon::parse($date) : Carbon::today();
        $extendedColumn = $extendedColumn ?: $query->getModel()->qualifyColumn('package_extended_expiry_data');
        $baseColumn = $baseColumn ?: $query->getModel()->qualifyColumn('package_expiry_date_from_purchage');

        return $query->where(function ($expiryQuery) use ($comparisonDate, $extendedColumn, $baseColumn) {
            $expiryQuery->where(function ($extendedExpiryQuery) use ($comparisonDate, $extendedColumn) {
                $extendedExpiryQuery->whereNotNull($extendedColumn)
                    ->whereDate($extendedColumn, '<', $comparisonDate->toDateString());
            })->orWhere(function ($baseExpiryQuery) use ($comparisonDate, $extendedColumn, $baseColumn) {
                $baseExpiryQuery->whereNull($extendedColumn)
                    ->whereDate($baseColumn, '<', $comparisonDate->toDateString());
            });
        });
    }

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
