<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 * Price Model
 * 
 */
class Price extends Model
{

    /**
     * 
     * Small Image Size
     */
    const SMALL_IMAGE = 'S';

    /**
     * 
     * Medium Image Size
     */
    const MEDIUM_IMAGE = 'M';

    /**
     * 
     * Large Image Size
     */
    const LARGE_IMAGE = 'L';

    /**
     * 
     * Extra large Image size
     */
    const EXTRA_LARGE_IMAGE = 'XL';

    /**
     * 
     * High Resolution Footage
     */
    const HIGH_RESOLUTION_FOOTAGE = 'HD (1080)';

    /**
     * 
     * 4K Footage
     */
    const FOUR_K_FOOTAGE = '4K';


    protected $table = 'imagefootage_prices';
    protected $fillable = ['license_type', 'product_type', 'small_image_price', 'medium_image_price', 'large_image_price', 'extra_large_image_price', 'music_price', 'high_resolution_footage_price', '4k_footage_price'];
    /**
     * 
     * Get Licence Type associated with the Price
     */
    public function licenceType()
    {
        return $this->belongsTo(LicenceType::class, 'license_type', 'id');
    }

    /**
     * 
     * Get Music Product Price based on license type and product type
     * 
     * @param int|null $licenseTypeId
     * @param string $productType
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getMusicProductPrice($licenseTypeId = null, $productType)
    {
        $query = self::with('licenceType');
        if ($licenseTypeId) {
            $query->where('license_type', $licenseTypeId);
        }

        if ($productType) {
            $query->where('product_type', $productType);
        }
        return $query->first();
    }

    /**
     * 
     * Get Footage Product Price based on license type, product type and resoultion type
     * 
     * @param int|null $licenseTypeId
     * @param string $productType
     * @param string $resoultionType
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getFootageProductPrice($licenseTypeId = null, $productType, $resoultionType)
    {
        $query = self::with('licenceType');
        if ($licenseTypeId) {
            $query->where('license_type', $licenseTypeId);
        }

        if ($productType) {
            $query->where('product_type', $productType);
        }
        switch ($resoultionType) {
            case self::HIGH_RESOLUTION_FOOTAGE:
                $query->whereNotNull('high_resolution_footage_price');
                break;
            case self::FOUR_K_FOOTAGE:
                $query->whereNotNull('4k_footage_price');
                break;
        }
        return $query->first();
    }

    /**
     * 
     * Get Image Product Price based on license type, product type and image size
     * 
     * @param int|null $licenseTypeId
     * @param string $productType
     * @param string $imageSize
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getImageProductPrice($licenseTypeId = null, $productType, $imageSize)
    {
        $query = self::with('licenceType');
        if ($licenseTypeId) {
            $query->where('license_type', $licenseTypeId);
        }

        if ($productType) {
            $query->where('product_type', $productType);
        }
        switch ($imageSize) {
            case self::SMALL_IMAGE:
                $query->whereNotNull('small_image_price');
                break;
            case self::MEDIUM_IMAGE:
                $query->whereNotNull('medium_image_price');
                break;
            case self::LARGE_IMAGE:
                $query->whereNotNull('large_image_price');
                break;
            case self::EXTRA_LARGE_IMAGE:
                $query->whereNotNull('extra_large_image_price');
                break;
        }
        return $query->first();
    }
}
