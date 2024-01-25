<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Models\Api;
use App\Models\ImageFilterValue;
use App\Models\ImageFootageFilter;
use PhpOffice\PhpSpreadsheet\Calculation\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

class Product extends Model
{
    protected $table = 'imagefootage_products';
    protected $primaryKey = 'id';
    protected $fillable = ['product_id', 'product_category', 'product_subcategory', 'product_owner', 'product_title', 'product_vertical', 'product_keywords', 'product_thumbnail', 'product_main_image', 'product_release_details', 'product_price_small', 'product_price_medium', 'product_price_large', 'product_price_extralarge', 'product_status', 'product_main_type', 'product_sub_type', 'product_added_on', 'updated_at', 'product_added_by', 'product_size', 'product_verification', 'product_rejectod_reason', 'product_editedby', 'adult_content','slug','is_premium'];
    const HomeLimit = '32';

    public function api()
    {
        return $this->hasOne(Api::class, 'api_id', 'product_web');
    }

    public function category()
    {
        return $this->hasOne(ProductCategory::class, 'category_id', 'product_category');
    }

    public function wishlists()
    {
        return $this->belongsToMany(ImageFootageWishlist::class, 'imagefootage_wishlist_products', 'product_id', 'wishlist_id');
    }

    public function getTypeAttribute()
    {
        return $this->pivot->type;
    }

    //API search function
    public function getProductsData($keyword, $requestData)
    {
        $data         = [];
        $totalRecords = 0;

        if ($keyword['productType']['id'] == '1') {
            $type = 'Image';
        } else if ($keyword['productType']['id'] == '2') {
            $type = 'Footage';
        }

        $pageNumber = isset($keyword['pagenumber']) ? $keyword['pagenumber'] : 1;
        $limit      = isset($keyword['limit']) ? $keyword['limit'] : 1;
        $offset     = ($pageNumber - 1) * $limit;
        $search     = isset($keyword['search']) && trim($keyword['search']) !== '' ? trim($keyword['search']) : '';

        //TODO :
        // 1. Need to check with support team and do required changes for adult_content filter
        $filters         = Arr::except($requestData, ['search', 'productType', 'pagenumber', 'product_editorial', 'limit','adult_content_filter']);
        $applied_filters = [];

        foreach ($filters as $name => $value) {
            if(isset($value['value'])) {
                $elements = explode(', ', $value['value']);
                $result   = $elements;
                $applied_filters[] = [
                    "name"  => $name,
                    "value" => (strpos($value['value'], ',') == true) ? $result : [$value['value']],
                    "hasMultipleValues" => true
                ];
            }
        }

        $products = ImageFilterValue::query();
        if (!empty($applied_filters)) {
            foreach ($applied_filters as $filter) {
                $name  = $filter['name'];
                $value = $filter['value'];
                if ($filter['hasMultipleValues']) {
                    $products->whereIn("attributes.$name", $value);
                }
            }
        }

        // Filter Data from MongoDB
        $filteredProducts = $products->project(['_id' => 0, 'api_product_id' => 1])->get()->toArray();
        $apiProductIds    = collect($filteredProducts)->pluck('api_product_id')->toArray();
        if ((!empty($applied_filters) && !empty($apiProductIds)) || empty($applied_filters)) {
            $data = Product::select(
                    'product_id',
                    'api_product_id',
                    'product_category',
                    'product_title',
                    'product_web',
                    'product_main_type',
                    'product_thumbnail',
                    'product_main_image',
                    'product_added_on',
                    'product_keywords',
                    'product_price_small',
                    'product_size',
                    'slug'
                )
                ->where('product_status','Active')
                ->where(function ($query) use ($type) {
                    $query->where('product_main_type', '=', $type);
                });

            if(isset($keyword['category_id']) && !empty($keyword['category_id'])){
                $data->where('product_category',$keyword['category_id']);
            }

            if(isset($keyword['adult_content_filter']) && !empty($keyword['adult_content_filter'])){
                $data->where('adult_content','no');
            }
            if (isset($filters['sort']) && !empty($filters['sort']) && $filters['sort'] == 'Recent'){
                $data->orderBy('created_at', 'desc');
            } else {
                // default sorting will be latest first
                $data->orderBy('created_at', 'desc');
            }
            if(isset($filters['sort']) && !empty($filters['sort']) && $filters['sort'] == 'Popular'){
                $data->orderBy('view_count', 'desc');
            }

            if (!empty($keyword['search'])) {
                $data->where(function ($query) use ($search) {
                    $query->orWhere('product_id', '=', $search) //exact match
                        ->orWhere('product_title', 'LIKE', '%' . $search . '%')
                        ->orWhere('product_keywords', 'LIKE', '%' . $search . '%');
                });
            }

            if (!empty($apiProductIds)) {
                $data->whereIn('api_product_id', $apiProductIds);
            }

            $totalRecords = count($data->get());
            $data = $data->distinct()->offset($offset)->limit($limit)->get()->toArray();


            foreach($data as $key => $value) {
                $stringValue = strval($value['api_product_id']);
                $matchingData = ImageFilterValue::where('api_product_id',$stringValue)->first();
                $attributes = [];
                $options = [];
                $attributes = isset($matchingData->attributes) ? $matchingData->attributes : [];
                $options    = isset($matchingData->options) ? $matchingData->options : [];

                $data[$key]['attributes'] = isset($attributes) ? $attributes : [];
                $data[$key]['options'] = isset($options) ? $options : [];
            }

            if (count($data) > 0) {
                foreach($data as &$item) {
                    $item['url']            = 'detail/' . $item['api_product_id'] . '/' . $item['product_web'] . "/" . $item['product_main_type'];
                    $item['api_product_id'] =  encrypt($item['api_product_id'], true);
                }
            }
        }

        $response = [
            'data' => $data,
            'total_count' => $totalRecords,
        ];

        return response()->json($response);
    }

    public function getEditorialData($keyword, $requestData)
    {
        $data         = [];
        $totalRecords = 0;
        $pageNumber   = isset($keyword['pagenumber']) ? $keyword['pagenumber'] : 1;
        $limit        = isset($keyword['limit']) ? $keyword['limit'] : 1;
        $offset       = ($pageNumber - 1) * $limit;
        $search       = isset($keyword['search']) && trim($keyword['search']) !== '' ? trim($keyword['search']) : '';
        $selectedPrApiIds  = [];

        if(isset($requestData['api_product_ids']) && !empty($requestData['api_product_ids'])){
            $selectedPrApiIds = explode(',', $requestData['api_product_ids']);
        }

        $filters         = Arr::except($requestData, ['search', 'productType', 'pagenumber', 'product_editorial', 'limit','api_product_ids']);

        $applied_filters = [];
        foreach ($filters as $name => $value) {
            if(isset($value['value'])) {
                $elements = explode(', ', $value['value']);
                $result   = $elements;
                $applied_filters[] = [
                    "name"  => $name,
                    "value" => (strpos($value['value'], ',') == true) ? $result : [$value['value']],
                    "hasMultipleValues" => true
                ];
            }
        }
        $products = ImageFilterValue::query();
        if (!empty($applied_filters)) {
            foreach ($applied_filters as $filter) {
                $name  = $filter['name'];
                $value = $filter['value'];
                if ($filter['hasMultipleValues']) {
                    $products->whereIn("attributes.$name", $value);
                }
            }
        }

        // Filter Data from MongoDB
        $filteredProducts = $products->project(['_id' => 0, 'api_product_id' => 1])->get()->toArray();
        $apiProductIds    = collect($filteredProducts)->pluck('api_product_id')->toArray();
        if ((!empty($applied_filters) && !empty($apiProductIds)) || empty($applied_filters)) {

                $data = Product::select(
                    'product_id',
                    'api_product_id',
                    'product_category',
                    'product_title',
                    'product_web',
                    'product_main_type',
                    'product_thumbnail',
                    'product_main_image',
                    'product_added_on',
                    'product_keywords',
                    'product_price_small',
                    'product_size',
                    'slug'
                )
                ->whereIn('product_main_type', ['Image', 'Footage'])
                ->where('product_status','Active');

            if(isset($keyword['category_id']) && !empty($keyword['category_id'])){
                $data->where('product_category',$keyword['category_id']);
            }

            if (!empty($keyword['search'])) {
                $data->where(function ($query) use ($search) {
                    $query->orWhere('product_id', '=', $search) //exact match
                        ->orWhere('product_title', 'LIKE', '%' . $search . '%')
                        ->orWhere('product_keywords', 'LIKE', '%' . $search . '%');
                });
            }
            $data->orderBy('created_at', 'desc');

            if(!empty($selectedPrApiIds)){
                $exceptSelectedRecords = clone $data;
                $exceptSelectedRecords = $exceptSelectedRecords->whereNotIn('api_product_id', $selectedPrApiIds)->get();
                $selectedData = $data->whereIn('api_product_id', $selectedPrApiIds)->get();

                $totalRecords = count($selectedData) + count($exceptSelectedRecords);
                $combinedData = array_merge($selectedData->toArray(), $exceptSelectedRecords->toArray());
                $data = array_slice($combinedData, $offset, $limit);
            }else{
                if (!empty($apiProductIds)) {
                    $data->whereIn('api_product_id', $apiProductIds);
                }
                $totalRecords = count($data->get());
                $data = $data->distinct()->offset($offset)->limit($limit)->get()->toArray();
            }
            foreach($data as $key => $value) {

                $matchingData = ImageFilterValue::where('api_product_id',$value['api_product_id'])->first();
                $attributes = [];
                $options = [];
                $attributes = isset($matchingData->attributes) ? $matchingData->attributes : [];
                $options    = isset($matchingData->options) ? $matchingData->options : [];

                $data[$key]['attributes'] = isset($value->attributes) ? $attributes : [];
                $data[$key]['options'] = isset($options) ? $options : [];
            }

            if (count($data) > 0) {
                foreach($data as &$item) {
                    $item['url']            = 'detail/' . $item['api_product_id'] . '/' . $item['product_web'] . "/" . $item['product_main_type'];
                    $item['api_product_id'] =  encrypt($item['api_product_id'], true);
                }
            }
        }

        $response = [
            'data' => $data,
            'total_count' => $totalRecords,
        ];

        return response()->json($response);
    }

    //API search function
    public function getMusicProducts($keyword, $requestData)
    {
        $data       = [];
        $type       = 'Music';
        $totalRecords = 0;
        $limit      = isset($keyword['limit']) ? $keyword['limit'] : 30;
        $search     = isset($keyword['search']) && trim($keyword['search']) !== '' ? trim($keyword['search']) : '';
        $pageNumber = isset($keyword['pagenumber']) ? $keyword['pagenumber'] : 1;
        $offset     = ($pageNumber - 1) * $limit;

        $filters    = Arr::except($requestData, ['search', 'productType', 'pagenumber', 'product_editorial','limit','sort', 'category_id']);


        $applied_filters = [];

        foreach ($filters as $name => $value) {
            if(isset($value['value'])) {
                $elements = explode(', ', $value['value']);
                $result   = $elements;
                $applied_filters[] = [
                    "name"  => $name,
                    "value" => (strpos($value['value'], ',') == true) ? $result : [$value['value']],
                    "hasMultipleValues" => (isset($value['standalone']) && $value['standalone'] == true) ?  false : true
                ];
            }
        }

        $products = ImageFilterValue::query();
        if (!empty($applied_filters)) {
            foreach ($applied_filters as $filter) {
                $name  = $filter['name'];
                $value = $filter['value'];
                if ($filter['hasMultipleValues']) {
                    $products->whereIn("attributes.$name", $value);
                } else {
                    $products->whereIn('product_id', $value);
                }
            }
        }

        $filteredProducts = $products->project(['_id' => 0, 'api_product_id' => 1, 'attributes.music_sound_bpm' => 1, 'attributes.artist' => 1])->get()->toArray();
        $indexedFilteredProducts = [];
        $apiProductIds    = collect($filteredProducts)->pluck('api_product_id')->toArray();

        if ((!empty($applied_filters) && !empty($apiProductIds)) || empty($applied_filters)) {
            $data = Product::select(
                'product_id',
                'api_product_id',
                'product_category',
                'product_title',
                'product_web',
                'product_main_type',
                'product_thumbnail',
                'product_main_image',
                'product_added_on',
                'product_keywords',
                'product_description',
                'music_duration',
                'music_fileType',
                'music_price',
                'license_type',
                'product_keywords',
                'music_size',
                'slug'
            )
            ->where('product_status','Active')
            ->where(function ($query) use ($type){
                $query->where('product_main_type', '=', $type);
            });

            if(isset($keyword['category_id']) && !empty($keyword['category_id'])){
                $data->where('product_category',$keyword['category_id']);
            }

            if (!empty($keyword['search'])) {
                $data->where(function ($query) use ($search) {
                    $query->orWhere('slug', '=', $search)
                        ->orWhere('product_id', '=', $search)
                        ->orWhere('product_title', 'LIKE', '%' . $search . '%')
                        ->orWhere('product_keywords', 'LIKE', '%' . $search . '%');
                });
            }

            if (!empty($apiProductIds)) {
                $data->whereIn('api_product_id', $apiProductIds);
            }
            $data->orderBy('created_at', 'desc');

            $totalRecords = count($data->get());
            $data         = $data->distinct()->offset($offset)->limit($limit)->get()->toArray();

            foreach($data as $key => $value) {

                $matchingData = ImageFilterValue::where('api_product_id',$value['api_product_id'])->first();
                $attributes = [];
                $options = [];
                $attributes = isset($matchingData->attributes) ? $matchingData->attributes : [];
                $options    = isset($matchingData->options) ? $matchingData->options : [];

                $data[$key]['attributes'] = isset($value->attributes) ? $attributes : [];
                $data[$key]['options'] = isset($options) ? $options : [];
            }

            if (count($data)>0) {
                foreach ($data as &$item) {
                    // dont change below variables
                    $auther_name     = $indexedFilteredProducts[$item['api_product_id']]['attributes']['artist'] ?? '';
                    $music_sound_bpm = $indexedFilteredProducts[$item['api_product_id']]['attributes']['music_sound_bpm'] ?? '';

                    $item['url']              = 'detail/' . $item['api_product_id'] . '/' . $item['product_web'] . "/" . $item['product_main_type'];
                    $item['api_product_id']   = encrypt($item['api_product_id'], true);
                    $item['random_three_keywords'] = $this->processMusicKeywords($item['product_keywords']);
                    $item['music_sound_bpm']  = $music_sound_bpm;
                    $item['auther_name']      = $auther_name;
                }
            }
        }

        $response = [
            'data' => $data,
            'total_count' => $totalRecords,
        ];

        return response()->json($response);
    }

    public function getAuthorProductsData($keyword)
    {
        $data         = [];
        $totalRecords = 0;
        $type         = isset($keyword['type']) ? $keyword['type'] : 'Image';
        $limit        = isset($keyword['limit']) ? $keyword['limit'] : 10;
        $search       = isset($keyword['search']) && trim($keyword['search']) !== '' ? trim($keyword['search']) : '';
        $pageNumber   = isset($keyword['pagenumber']) ? $keyword['pagenumber'] : 1;
        $offset       = ($pageNumber - 1) * $limit;

        $products = ImageFilterValue::query();
        $products->where("attributes.artist", $search);

        $filteredProducts = $products
                            ->project(['_id' => 0, 'api_product_id' => 1, 'attributes.artist' => 1])
                            ->get()
                            ->toArray();
        $indexedFilteredProducts = [];
        $apiProductIds           = [];

        foreach ($filteredProducts as $product) {
            $indexedFilteredProducts[$product['api_product_id']] = $product;
            $apiProductIds[] = $product['api_product_id'];
        }

        if ($search!='' && !empty($apiProductIds)) {
            $data = Product::select(
                'product_id',
                'api_product_id',
                'product_category',
                'product_title',
                'product_web',
                'product_main_type',
                'product_thumbnail',
                'product_main_image',
                'product_added_on',
                'product_keywords',
                'product_price_small',
                'product_size',
                'slug'
            )
            ->where('product_status','Active')
            ->where(function ($query) use ($type){
                $query->where('product_main_type', '=', $type);
            });

            if (!empty($apiProductIds)) {
                $data->whereIn('api_product_id', $apiProductIds);
            }
            $data->orderBy('created_at', 'desc');

            $totalRecords = count($data->get());
            $data         = $data->distinct()->offset($offset)->limit($limit)->get()->toArray();

            foreach($data as $key => $value) {

                $matchingData = ImageFilterValue::where('api_product_id',$value['api_product_id'])->first();
                $attributes = [];
                $options = [];
                $attributes = isset($matchingData->attributes) ? $matchingData->attributes : [];
                $options    = isset($matchingData->options) ? $matchingData->options : [];

                $data[$key]['attributes'] = isset($value->attributes) ? $attributes : [];
                $data[$key]['options'] = isset($options) ? $options : [];
            }
            if (count($data)>0) {
                foreach ($data as &$item) {
                    // dont change below variables
                    $auther_name     = $indexedFilteredProducts[$item['api_product_id']]['attributes']['artist'] ?? '';

                    $item['url']            = 'detail/' . $item['api_product_id'] . '/' . $item['product_web'] . "/" . $item['product_main_type'];
                    $item['api_product_id'] =  encrypt($item['api_product_id'], true);
                    $item['auther_name']    = $auther_name;
                }
            }
        }

        $response = [
            'data' => $data,
            'total_count' => $totalRecords,
        ];

        return response()->json($response);
    }

    public function getAuthorMusicData($keyword)
    {
        $data         = [];
        $totalRecords = 0;
        $type         = isset($keyword['type']) ? $keyword['type'] : 'Music';
        $limit        = isset($keyword['limit']) ? $keyword['limit'] : 10;
        $search       = isset($keyword['search']) && trim($keyword['search']) !== '' ? trim($keyword['search']) : '';
        $pageNumber   = isset($keyword['pagenumber']) ? $keyword['pagenumber'] : 1;
        $offset       = ($pageNumber - 1) * $limit;

        $products = ImageFilterValue::query();
        $products->where("attributes.artist", $search);

        $filteredProducts = $products
                            ->project(['_id' => 0, 'api_product_id' => 1, 'attributes.music_sound_bpm' => 1, 'attributes.artist' => 1])
                            ->get()
                            ->toArray();
        $indexedFilteredProducts = [];
        $apiProductIds           = [];

        foreach ($filteredProducts as $product) {
            $indexedFilteredProducts[$product['api_product_id']] = $product;
            $apiProductIds[] = $product['api_product_id'];
        }

        if ($search!='' && !empty($apiProductIds)) {
            $data = Product::select(
                'product_id',
                'api_product_id',
                'product_category',
                'product_title',
                'product_web',
                'product_main_type',
                'product_thumbnail',
                'product_main_image',
                'product_added_on',
                'product_keywords',
                'product_description',
                'music_duration',
                'music_fileType',
                'music_price',
                'license_type',
                'product_keywords',
                'music_size',
                'slug',
                'is_premium'
            )
            ->where('product_status','Active')
            ->where(function ($query) use ($type){
                $query->where('product_main_type', '=', $type);
            });

            if (!empty($apiProductIds)) {
                $data->whereIn('api_product_id', $apiProductIds);
            }
            $data->orderBy('created_at', 'desc');

            $totalRecords = count($data->get());
            $data         = $data->distinct()->offset($offset)->limit($limit)->get()->toArray();


            foreach($data as $key => $value) {

                $matchingData = ImageFilterValue::where('api_product_id',$value['api_product_id'])->first();
                $attributes = [];
                $options = [];
                $attributes = isset($matchingData->attributes) ? $matchingData->attributes : [];
                $options    = isset($matchingData->options) ? $matchingData->options : [];

                $data[$key]['attributes'] = isset($value->attributes) ? $attributes : [];
                $data[$key]['options'] = isset($options) ? $options : [];
            }

            if (count($data)>0) {
                foreach ($data as &$item) {
                    // dont change below variables
                    $auther_name     = $indexedFilteredProducts[$item['api_product_id']]['attributes']['artist'] ?? '';
                    $music_sound_bpm = $indexedFilteredProducts[$item['api_product_id']]['attributes']['music_sound_bpm'] ?? '';

                    $item['url']              = 'detail/' . $item['api_product_id'] . '/' . $item['product_web'] . "/" . $item['product_main_type'];
                    $item['api_product_id']   = encrypt($item['api_product_id'], true);
                    $item['random_three_keywords'] = $this->processMusicKeywords($item['product_keywords']);
                    $item['music_sound_bpm']  = $music_sound_bpm;
                    $item['auther_name']      = $auther_name;
                }
            }
        }

        $response = [
            'data' => $data,
            'total_count' => $totalRecords,
        ];

        return response()->json($response);
    }

    public function processMusicKeywords($valuesString = '') {
        $selectedValues = [];
        if (!empty($valuesString)) {
            $valuesArray = explode(',', $valuesString);
            $valuesArray = array_map('ucfirst', $valuesArray);
            shuffle($valuesArray);
            $selectedValues = array_slice($valuesArray, 0, 3);
        }

        return implode(', ', $selectedValues);
    }

    public function getProductDetail($media_id, $type)
    {
        $data = Product::where('product_main_type', '=', $type)
            ->Where('product_id', '=', $media_id)
            ->get()
            ->toArray();
        return  $data;
    }
    public function adminAllProductList()
    {
        $all_produst_list = Product::leftJoin('imagefootage_productcategory', 'imagefootage_products.product_category', '=', 'imagefootage_productcategory.category_id')->leftJoin('imagefootage_productsubcategory', 'imagefootage_products.product_subcategory', '=', 'imagefootage_productsubcategory.subcategory_id')->leftJoin('imagefootage_productimages', 'imagefootage_products.id', '=', 'imagefootage_productimages.image_product_id')->get()->toArray();
        return $all_produst_list;
    }

    /**
    * This is main function for storing the panther media data via CRON execution
    * It manages the data storage in Mysql and MongoDB both
    */
    public function savePantherMediaImage($data, $category_id)
    {
        // prefetch the api_flag value
        $flag = $this->get_api_flag('panther_media_image', 'api_flag');
        foreach ($data['items']['media'] as $eachmedia) {
            $optionData = [];
            if (isset($eachmedia['id'])) {
                $media = array(
                    'api_product_id' => $eachmedia['id'],
                    'product_category' => $category_id,
                    'product_title' => $eachmedia['title'],
                    'product_thumbnail' => $eachmedia['preview_no_wm'],
                    'product_main_image' => $eachmedia['preview_high'],
                    'product_description' => $eachmedia['description'],
                    'product_size' => $eachmedia['width'] . "X" . $eachmedia['height'],
                    "product_keywords" => $eachmedia['keywords'],
                    'product_status' => "Active",
                    'product_main_type' => "Image",
                    'product_sub_type' => "Photo",
                    'product_added_on' => date("Y-m-d H:i:s", strtotime($eachmedia['date'])),
                    'product_web' => '2',
                    'updated_at'       => date("Y-m-d H:i:s"),
                    'adult_content'    => (isset($eachmedia['adult-content']) && $eachmedia['adult-content'] == 'yes' )? 1 : 0,
                    'slug'             => preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower(trim($eachmedia['title']))),
                    'is_premium'       => (isset($eachmedia['premium']) && $eachmedia['premium'] == 'yes')  ? 1 : 0
                );

                $data2 = DB::table('imagefootage_products')
                    ->where('api_product_id', $eachmedia['id'])
                    ->get()
                    ->toArray();

                if (count($data2) == 0) {
                    $key  = $this->randomkey();
                    $media['product_id'] = $flag . $key;
                    DB::table('imagefootage_products')->insert($media);

                    $productData = array(
                        'people_number'    => $eachmedia['people_number'],
                        'orientation'      => $eachmedia['orientation'],
                        'license'          => $eachmedia['license'],
                        'type'             => $eachmedia['type'],
                        'collection'       => $eachmedia['collection'],
                        'artist'           => $eachmedia['author-username'],
                        'spx'              => $eachmedia['spx'],
                        'editorial'        => isset($eachmedia['editorial']) && ($eachmedia['editorial'] == 'yes' ) ? 1 :0,
                        'isolated'         => $eachmedia['isolated'],
                    );
                    $imageFilterValue = new ImageFilterValue([
                        'api_product_id'    => $eachmedia['id'],
                        'product_id'        => $media['product_id'],
                        'product_main_type' => "Image",
                        'attributes'        => $productData,
                        'options'           => $optionData
                    ]);
                    $imageFilterValue->save();
                } else {

                    DB::table('imagefootage_products')
                        ->where('api_product_id', '=', $eachmedia['id'])
                        ->update([
                            'product_thumbnail'    => $eachmedia['preview_no_wm'],
                            'product_main_image'   => $eachmedia['preview_high'],
                            'product_description'  => $eachmedia['description'],
                            'product_title'        => $eachmedia['title'],
                            'updated_at'           => date('Y-m-d H:i:s'),
                            'slug'                 => preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower(trim($eachmedia['title']))),
                            'is_premium'           => (isset($eachmedia['premium']) && $eachmedia['premium'] == 'yes')  ? 1 : 0
                        ]);

                    $apiProductId = $eachmedia['id'];
                    $productData  = [
                        'people_number'    => $eachmedia['people_number'],
                        'orientation'      => $eachmedia['orientation'],
                        'license'          => $eachmedia['license'],
                        'type'             => $eachmedia['type'],
                        'collection'       => $eachmedia['collection'],
                        'artist'           => $eachmedia['author-username'],
                        'spx'              => $eachmedia['spx'],
                        'editorial'        => isset($eachmedia['editorial']) && ($eachmedia['editorial'] == 'yes' ) ? 1 :0,
                        'isolated'         => $eachmedia['isolated'],
                    ];

                    // Find the existing document by api_product_id, or create a new one
                    $imageFilterValue = ImageFilterValue::updateOrCreate(
                        ['api_product_id' => $apiProductId],
                        [
                            'attributes' => $productData,
                            'options'    =>$optionData
                        ]
                    );
                }
            }
        }
    }
    public function updatePantherImage($data)
    {

        if (isset($data['media']['id'])) {
            $count = DB::table('imagefootage_products')
                ->where('api_product_id', $data['media']['id'])
                ->count();

            if ($count > 0) {
                $imgData = getimagesize($data['media']['preview_url_no_wm']);

                DB::table('imagefootage_products')
                    ->where('api_product_id', '=', $data['media']['id'])
                    ->update([
                        'product_thumbnail'   => $data['media']['preview_url_no_wm'],
                        'product_main_image'  => $data['media']['preview_url'],
                        'product_description' => $data['metadata']['description'],
                        'product_title'       => $data['metadata']['title'],
                        'updated_at'          => date('Y-m-d H:i:s'),
                        'width_thumb'         => $imgData[0],
                        'height_thumb'        => $imgData[1],
                        'thumb_update_status' =>  1,
                        'is_premium'          => (isset($data['metadata']['premium']) && $data['metadata']['premium'] == 'yes')  ? 1 : 0

                    ]);
                echo "Updated" . $data['media']['id'];
            }
        }
    }

    /**
    * This is main function for storing the pond5 footage data via CRON execution
    * It manages the data storage and update in Mysql and MongoDB both
    */
    public function savePond5Footage($data, $category_id)
    {
        // prefetch the api_flag value
        $flag = $this->get_api_flag('pond5_footage', 'api_flag');
        foreach ($data['items'] as $eachmedia) {
            $optionData = [];
            if (isset($eachmedia['id'])) {
                $pond_id_withprefix = $eachmedia['id'];
                if (strlen($eachmedia['id']) < 9) {
                    $add_zero = 9 - (strlen($eachmedia['id']));
                    for ($i = 0; $i < $add_zero; $i++) {
                        $pond_id_withprefix =  "0" . $pond_id_withprefix;
                    }
                }
                $media = array(
                    'api_product_id'      => $eachmedia['id'],
                    'product_category'    => $category_id,
                    'product_title'       => $eachmedia['title'],
                    'product_thumbnail'   => $eachmedia['thumbnail'],
                    'product_main_image'  => $eachmedia['watermarkPreview'],
                    'product_description' => $eachmedia['description'],
                    'product_keywords'    => implode(',', $eachmedia['keywords']),
                    'product_status'      => "Active",
                    'product_main_type'   => "Footage",
                    'product_sub_type'    => "Footage",
                    'product_added_on'    => date("Y-m-d H:i:s"),
                    'product_web'         => '3',
                    'updated_at'          => date("Y-m-d H:i:s"),
                    'slug'                => preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower(trim($eachmedia['title']))),
                    'is_premium'          => (isset($eachmedia['editorial']) && $eachmedia['editorial'] == true) ? 1 : 0
                );

                $data2 = DB::table('imagefootage_products')
                    ->where('api_product_id', $eachmedia['id'])
                    ->get()
                    ->toArray();

                if (count($data2) == 0) {
                    $key  = $this->randomkey();
                    $media['product_id'] = $flag . $key;
                    DB::table('imagefootage_products')->insert($media);

                    $productData  = array(
                        'editorial'        => isset($eachmedia['editorial']) && ($eachmedia['editorial'] == true ) ? 1 :0,
                        'fps'              => [$eachmedia['videoFps']],
                        'artist'           => $eachmedia['authorName']
                    );
                    foreach($eachmedia['versions'] as $key=>$value){
                        $optionData[] = $value;
                    }
                    $imageFilterValue = new ImageFilterValue([
                        'api_product_id'    => $eachmedia['id'],
                        'product_id'        => $media['product_id'],
                        'product_main_type' => "Footage",
                        'attributes'        => $productData,
                        'options'           => $optionData
                    ]);
                    $imageFilterValue->save();
                } else {
                    DB::table('imagefootage_products')
                        ->where('api_product_id', '=', $eachmedia['id'])
                        ->update([
                            'product_title'       => $eachmedia['title'],
                            'product_thumbnail'   => $eachmedia['thumbnail'],
                            'product_main_image'  => $eachmedia['watermarkPreview'],
                            'product_description' => $eachmedia['description'],
                            'updated_at'          => date('Y-m-d H:i:s'),
                            'slug'                => preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower(trim($eachmedia['title']))),
                            'is_premium'          => (isset($eachmedia['editorial']) && $eachmedia['editorial'] == true) ? 1 : 0
                        ]);

                    $apiProductId = $eachmedia['id'];
                    $productData  = array(
                        'editorial'        => isset($eachmedia['editorial']) && ($eachmedia['editorial'] == true ) ? 1 :0,
                        'fps'              => [$eachmedia['videoFps']],
                        'artist'           => $eachmedia['authorName']
                    );

                    // Find the existing document by api_product_id, or create a new one
                    $imageFilterValue = ImageFilterValue::updateOrCreate(
                        ['api_product_id' => $apiProductId],
                        [
                            'attributes' => $productData,
                        ]
                    );
                    foreach($eachmedia['versions'] as $key=>$value){
                        $optionData[] = $value;
                        $imageFilterValue = ImageFilterValue::updateOrCreate(
                            ['api_product_id' => $apiProductId],
                            [
                                'options' => $optionData,
                            ]
                        );
                    }

                }
            }
        }
    }

    public function savePond5singleImage($data, $category_id)
    {
        $eachmedia = $data;
        $flag = $this->get_api_flag('pond5_footage', 'api_flag');

        if (isset($eachmedia['id'])) {
            $pond_id_withprefix = $eachmedia['id'];
            if (strlen($eachmedia['id']) < 9) {
                $add_zero = 9 - (strlen($eachmedia['id']));
                for ($i = 0; $i < $add_zero; $i++) {
                    $pond_id_withprefix =  "0" . $pond_id_withprefix;
                }
            }
            $media = array(
                'product_id' => "",
                'api_product_id' => $eachmedia['id'],
                'product_category' => $category_id,
                'product_title' => $eachmedia['title'],
                'product_thumbnail' => $eachmedia['thumbnail'],
                'product_main_image' => $eachmedia['watermarkPreview'],
                'product_description' => $eachmedia['description'],
                'product_size' => '',
                "product_keywords" => implode(',', $eachmedia['keywords']),
                'product_status' => "Active",
                'product_main_type' => $eachmedia['type'],
                'product_sub_type' => "Photo",
                'product_added_on' => date("Y-m-d H:i:s"),
                'product_web' => '3',
                'product_vertical' => 'Royalty Free',
                'updated_at' => date("Y-m-d H:i:s"),
                'slug'       => preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower(trim($eachmedia['title']))),
                'is_premium'          => (isset($eachmedia['editorial']) && $eachmedia['editorial'] == true) ? 1 : 0

            );
            $data2 = DB::table('imagefootage_products')
                ->where('api_product_id', $eachmedia['id'])
                ->get()
                ->toArray();
            if (count($data2) == 0) {
                $key  = $this->randomkey();
                DB::table('imagefootage_products')->insert($media);
                $id = DB::getPdo()->lastInsertId();
                DB::table('imagefootage_products')
                    ->where('id', '=', $id)
                    ->update(['product_id' => $flag . $key]);
                // echo "Inserted" . $id;
                return $flag . $key;
            } else {
                return $data2[0]->product_id;
            }

        }

    }

    /**
    * This is main function for storing the pond5 music data via CRON execution
    * It manages the data storage and update in Mysql and MongoDB both
    */
    public function savePond5Music($data, $category_id)
    {
        // prefetch the api_flag value
        $flag = $this->get_api_flag('pond5_music', 'api_flag');

        foreach ($data['items'] as $eachmedia) {
            $optionData = [];
            if (isset($eachmedia['id'])) {
                $pond_id_withprefix = $eachmedia['id'];
                if (strlen($eachmedia['id']) < 9) {
                    $add_zero = 9 - (strlen($eachmedia['id']));
                    for ($i = 0; $i < $add_zero; $i++) {
                        $pond_id_withprefix =  "0" . $pond_id_withprefix;
                    }
                }

                $media = array(
                    'api_product_id'      => $eachmedia['id'],
                    'product_category'    => $category_id,
                    'product_title'       => $eachmedia['title'],
                    'product_thumbnail'   => $eachmedia['thumbnail'],
                    'product_main_image'  => $eachmedia['watermarkPreview'],
                    'product_description' => $eachmedia['description'],
                    'product_keywords'    => implode(',', $eachmedia['keywords']),
                    'product_status'      => "Active",
                    'product_main_type'   => "Music",
                    'product_sub_type'    => "Music",
                    'product_added_on'    => date("Y-m-d H:i:s"),
                    'product_web'         => '3',
                    'updated_at'          => date("Y-m-d H:i:s"),
                    'slug'                => preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower(trim($eachmedia['title']))),
                    'is_premium'          => (isset($eachmedia['editorial']) && $eachmedia['editorial'] == true) ? 1 : 0
                );

                if (!empty($eachmedia['versions'])) {
                    $media['music_duration'] = $eachmedia['versions'][0]['duration'] ?? null;
                    $media['music_fileType'] = $eachmedia['versions'][0]['fileType'] ?? null;
                    $media['music_price']    = $eachmedia['versions'][0]['price'] ?? null;
                    $media['music_size']     = $eachmedia['versions'][0]['size'] ?? null;
                }

                $data2 = DB::table('imagefootage_products')
                    ->where('api_product_id', $eachmedia['id'])
                    ->get()
                    ->toArray();

                if (count($data2) == 0) {
                    $key  = $this->randomkey();
                    $media['product_id'] = $flag . $key;
                    DB::table('imagefootage_products')->insert($media);

                    $productData  = array(
                        'music_sound_bpm'   => $eachmedia['soundBpm'] ?? '',
                        'soundPro'          => $eachmedia['soundPro'] ?? '',
                        'soundCodec'        => $eachmedia['soundCodec'] ?? '',
                        'editorial'         => (isset($eachmedia['editorial']) && $eachmedia['editorial'] == true) ? 1 : 0,
                        'artist'            => $eachmedia['authorName'],
                    );
                    foreach($eachmedia['versions'] as $key=>$value){
                        $optionData[] = $value;
                    }

                    $imageFilterValue = new ImageFilterValue([
                        'product_id'        => $media['product_id'],
                        'api_product_id'    => $eachmedia['id'],
                        'product_main_type' => 'Music',
                        'attributes'        => $productData,
                        'options'           => $optionData
                    ]);
                    $imageFilterValue->save();
                } else {
                    DB::table('imagefootage_products')
                        ->where('api_product_id', '=', $eachmedia['id'])
                        ->update([
                            'product_title'       => $eachmedia['title'],
                            'product_thumbnail'   => $eachmedia['thumbnail'],
                            'product_main_image'  => $eachmedia['watermarkPreview'],
                            'product_description' => $eachmedia['description'],
                            'updated_at'          => date('Y-m-d H:i:s'),
                            'slug'                => preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower(trim($eachmedia['title']))),
                            'is_premium'          => (isset($eachmedia['editorial']) && $eachmedia['editorial'] == true) ? 1 : 0
                        ]);

                    $apiProductId = $eachmedia['id'];
                    $productData  = array(
                        'music_sound_bpm'   => $eachmedia['soundBpm'] ?? '',
                        'soundPro'          => $eachmedia['soundPro'] ?? '',
                        'soundCodec'        => $eachmedia['soundCodec'] ?? '',
                        'editorial'         => (isset($eachmedia['editorial']) && $eachmedia['editorial'] == true) ? 1 : 0,
                        'artist'            => $eachmedia['authorName'],
                    );

                    // Find the existing document by api_product_id, or create a new one
                    $imageFilterValue = ImageFilterValue::updateOrCreate(
                        ['api_product_id' => $apiProductId],
                        [
                            'attributes' => $productData,
                        ]
                    );
                    foreach($eachmedia['versions'] as $key=>$value){
                        $optionData[] = $value;
                        $imageFilterValue = ImageFilterValue::updateOrCreate(
                            ['api_product_id' => $apiProductId],
                            [
                                'options' => $optionData,
                            ]
                        );
                    }

                }
            }
        }
    }


    public function getProductsRandom()
    {
        ini_set('max_execution_time', 0);
        $final_data = [];
        $data =   DB::table('imagefootage_products as pr')
            ->select('id', 'product_id', 'api_product_id', 'product_title', 'product_description', 'product_thumbnail', 'product_main_image', 'product_web', 'category_name', 'category_id', 'product_main_type', 'width_thumb', 'height_thumb', 'thumb_update_status')
            ->join('imagefootage_productcategory as pc', 'pc.category_id', '=', 'pr.product_category')
            ->where('pc.is_display_home', '=', '1')
            ->where('pr.thumb_update_status', '=', '1')
            ->whereRaw("date(pr.updated_at) >= '2020-05-01'")
            ->orderBy('pc.category_order', 'asc')
            ->inRandomOrder()
            ->get()
            ->groupBy("category_name")
            ->map(function ($product) {
                return $product->take(Product::HomeLimit);
            });

        $home = [];

        foreach ($data as $k => $perdata) {

            foreach ($perdata as $j => $eachproduct) {
                $ldate = date('d');
                if ($ldate == "28" || $ldate == "29" ||  $ldate == "30" ||  $ldate == "31" ||  $ldate == "1") {
                    $eachproduct->product_thumbnail = $eachproduct->product_main_image;
                }
                $data[$k][$j]->api_product_id = encrypt($eachproduct->api_product_id);
                $data[$k][$j]->slug =  preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower(trim($eachproduct->product_title)));
                if ($j < 4) {
                    array_push($home, $data[$k][$j]);
                }
            }
        }
        return [$data, $home];
    }

    public function savePantherImagedetail($data, $category_id)
    {
        $flag = $this->get_api_flag('panther_media_image', 'api_flag');

        if ($data['stat'] == 'ok') {
            if (isset($data['media']['id'])) {
                $media = array(
                    'product_id'          => "",
                    'api_product_id'      => $data['media']['id'],
                    'product_category'    => $category_id,
                    'product_title'       => $data['metadata']['title'],
                    'product_thumbnail'   => $data['media']['preview_url_no_wm'],
                    'product_main_image'  => $data['media']['preview_url'],
                    'product_description' => $data['metadata']['description'],
                    'product_size'        => $data['media']['width'] . "X" . $data['media']['height'],
                    "product_keywords"    => $data['metadata']['keywords'],
                    'product_status'      => "Active",
                    'product_main_type'   => "Image",
                    'product_sub_type'    => "Photo",
                    'product_added_on'    => date("Y-m-d H:i:s", strtotime($data['metadata']['date'])),
                    'product_web'         => '2',
                    'product_vertical'    => 'Royalty Free',
                    'updated_at'          => date("Y-m-d H:i:s"),
                    'author_name'         => $data['metadata']['author_username'],
                    'slug'                => preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower(trim($data['metadata']['title'])))

                );
                $data2 = DB::table('imagefootage_products')
                    ->where('api_product_id', $data['media']['id'])
                    ->get()
                    ->toArray();

                if (count($data2) == 0) {
                    $key  = $this->randomkey();
                    $media['product_id'] = $flag . $key;
                    DB::table('imagefootage_products')->insert($media);
                    return $flag . $key;
                } else {
                    DB::table('imagefootage_products')
                        ->where('api_product_id', '=', $data['media']['id'])
                        ->update([
                            'product_thumbnail'   => $data['media']['preview_url_no_wm'],
                            'product_main_image'  => $data['media']['preview_url'],
                            'product_description' => $data['metadata']['description'],
                            'product_title'       => $data['metadata']['title'],
                            'updated_at'          => date('Y-m-d H:i:s')
                        ]);
                    return $data2[0]->product_id;
                }
            }
        }
    }

    public function get_api_flag($slug, $field)
    {
        return Api::where('api_slug', $slug)->first()->$field;
    }

    public function randomkey()
    {
        $digits = 5;
        return random_int(10 ** ($digits - 1), (10 ** $digits) - 1);
    }

    public function saveProduct($productData)
    {
        if ($productData['product_web'] == 3) {
            $media = array(
                'product_id'          => "",
                'api_product_id'      => $productData['product_id'],
                'product_category'    => "",
                'product_title'       => $productData['product_title'],
                'product_thumbnail'   => $productData['product_thumbnail'],
                'product_main_image'  => $productData['product_main_image'],
                'product_description' => $productData['product_description'],
                'product_size'        => '',
                "product_keywords"    => $productData['product_keywords'],
                'product_status'      => "Active",
                'product_main_type'   => "Footage",
                'product_sub_type'    => "Photo",
                'product_added_on'    => date("Y-m-d H:i:s"),
                'product_web'         => '3',
                'product_vertical'    => 'Royalty Free'

            );
            $flag = $this->get_api_flag('pond5_footage', 'api_flag');
            $key  = $this->randomkey();
            $media['product_id'] = $flag . $key;
            DB::table('imagefootage_products')->insert($media);
        } else {
            $media = array(
                'product_id'          => "",
                'api_product_id'      => $productData['product_id'],
                'product_category'    => "",
                'product_title'       => $productData['product_title'],
                'product_thumbnail'   => $productData['product_thumbnail'],
                'product_main_image'  => $productData['product_main_image'],
                'product_description' => $productData['product_description'],
                'product_size'        => '',
                "product_keywords"    => $productData['product_keywords'],
                'product_status'      => "Active",
                'product_main_type'   => "Image",
                'product_sub_type'    => "Photo",
                'product_added_on'    => $productData['product_added_on'],
                'product_web'         => '2',
                'product_vertical'    => 'Royalty Free'
            );
            $flag = $this->get_api_flag('panther_media_image', 'api_flag');
            $key  = $this->randomkey();
            $media['product_id'] = $flag . $key;
            DB::table('imagefootage_products')->insert($media);
        }
        return $id;
    }

    public function categoryWiseData()
    {
        ini_set('max_execution_time', 0);
        $final_data = [];
        $home = [];
        $data =  DB::table('imagefootage_products as pr')
            ->select('id', 'product_id', 'api_product_id', 'product_title', 'product_description', 'product_thumbnail', 'product_main_image', 'product_web', 'category_name', 'category_id', 'product_main_type', 'width_thumb', 'height_thumb', 'thumb_update_status')
            ->join('imagefootage_productcategory as pc', 'pc.category_id', '=', 'pr.product_category')
            ->where('pc.is_display_home', '=', '1')
            ->where('pr.thumb_update_status', '=', '1')
            ->whereRaw("date(pr.updated_at) >= '2020-05-01'")
            ->orderBy('pc.category_order', 'asc')
            ->inRandomOrder()
            ->get()
            ->groupBy("category_name")
            ->map(function ($product) {
                return $product->take(Product::HomeLimit);
            });
        foreach ($data as $k => $perdata) {
            foreach ($perdata as $j => $eachproduct) {
                if ($eachproduct->product_web == '2') {
                    $home[$k]["images"][$j]                 = $eachproduct;
                    $home[$k]["images"][$j]->api_product_id = encrypt($eachproduct->api_product_id);
                    $home[$k]["images"][$j]->slug           =  preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower(trim($eachproduct->product_title)));
                } else {
                    $home[$k]["footages"][$j]                 = $eachproduct;
                    $home[$k]["footages"][$j]->api_product_id = encrypt($eachproduct->api_product_id);
                    $home[$k]["footages"][$j]->slug           =  preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower(trim($eachproduct->product_title)));
                }
            }
        }
        return $home;
    }

    public function check_urls($url)
    {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $data    = curl_exec($ch);
        $headers = curl_getinfo($ch);
        curl_close($ch);

        return $headers['http_code'];
    }

    public function downloads()
    {
        return $this->hasMany(ProductsDownload::class, 'product_id', 'product_id');
    }

    public function getCategoryProductsData($request)
    {
        $data         = [];
        $type         = isset($request['type']) ? $request['type'] : 'Image';
        $limit        = isset($request['limit']) ? $request['limit'] : 9;
        $product_id   = isset($request['product_id']) ? $request['product_id'] : null;

        $product = Product::select('product_category')->where('product_id', '=', $product_id)->first();
        if (!empty($product_id) && !empty($product)) {
            $data = Product::select(
                'product_id',
                'api_product_id',
                'product_category',
                'product_title',
                'product_web',
                'product_main_type',
                'product_thumbnail',
                'product_main_image',
                'product_added_on',
                'product_keywords',
                'product_price_small',
                'product_size',
                'slug',
                'is_premium'
            )
            ->where('product_status','Active')
            ->where('product_category', '=', $product->product_category)
            ->where('product_id', '!=', $product_id)
            ->where('product_main_type', '=', $type);
            $data->orderBy('created_at', 'desc');
            $data = $data->distinct()->limit($limit)->get()->toArray();
            foreach($data as $key => $value) {

                $matchingData = ImageFilterValue::where('api_product_id',$value['api_product_id'])->first();
                $attributes = [];
                $options = [];
                $attributes = isset($matchingData->attributes) ? $matchingData->attributes : [];
                $options    = isset($matchingData->options) ? $matchingData->options : [];

                $data[$key]['attributes'] = isset($value->attributes) ? $attributes : [];
                $data[$key]['options'] = isset($options) ? $options : [];
            }
        }

        return $data;
    }

    public function getCategoryMusicsData($request)
    {
        $data         = [];
        $limit        = isset($request['limit']) ? $request['limit'] : 9;
        $product_id   = isset($request['product_id']) ? $request['product_id'] : null;

        $product = Product::select('*')->where('product_id', '=', $product_id)->first();
        if (!empty($product_id) && !empty($product)) {
            $data = Product::select(
                'product_id',
                'api_product_id',
                'product_category',
                'product_title',
                'product_web',
                'product_main_type',
                'product_thumbnail',
                'product_main_image',
                'product_added_on',
                'product_keywords',
                'product_price_small',
                'product_size',
                'music_duration',
                'music_fileType',
                'music_price',
                'slug',
                'is_premium'
            )
                ->where('product_status','Active')
                ->where('product_category', '=', $product->product_category)
                ->where('product_id', '!=', $product_id)
                ->where('product_main_type', '=', 'Music');
            $data->orderBy('created_at', 'desc');
            $data = $data->distinct()->limit($limit)->get();

            if (count($data) > 0) {
                $getAPIProductIds = $data->pluck('api_product_id');
                $filteredProducts = ImageFilterValue::project(['_id' => 0, 'api_product_id' => 1, 'attributes.music_sound_bpm' => 1, 'attributes.artist' => 1])
                    ->whereIn("api_product_id", $getAPIProductIds)
                    ->get()
                    ->toArray();

                $indexedFilteredProducts = [];
                if (!empty($filteredProducts)) {
                    foreach ($filteredProducts as $product) {
                        $indexedFilteredProducts[$product['api_product_id']] = $product;
                    }
                }

                $data = $data->toArray();
                foreach($data as $key => $value) {

                    $matchingData = ImageFilterValue::where('api_product_id',$value['api_product_id'])->first();
                    $attributes = [];
                    $options = [];
                    $attributes = isset($matchingData->attributes) ? $matchingData->attributes : [];
                    $options    = isset($matchingData->options) ? $matchingData->options : [];

                    $data[$key]['attributes'] = isset($value->attributes) ? $attributes : [];
                    $data[$key]['options'] = isset($options) ? $options : [];
                }
                foreach ($data as &$item) {
                    $auther_name                   = $indexedFilteredProducts[$item['api_product_id']]['attributes']['artist'] ?? '';
                    $music_sound_bpm               = $indexedFilteredProducts[$item['api_product_id']]['attributes']['music_sound_bpm'] ?? '';

                    $item['url']                   = 'detail/' . $item['api_product_id'] . '/' . $item['product_web'] . "/" . $item['product_main_type'];
                    $item['api_product_id']        = encrypt($item['api_product_id'], true);
                    $item['random_three_keywords'] = $this->processMusicKeywords($item['product_keywords']);
                    $item['music_sound_bpm']       = $music_sound_bpm;
                    $item['auther_name']           = $auther_name;
                }
            }
        }

        return $data;
    }

    public function savePond5Image($data, $category_id)
    {
        // prefetch the api_flag value
        $flag = $this->get_api_flag('pond5_image', 'api_flag');

        if (isset($data['items']) && is_array($data['items'])) {
            foreach ($data['items'] as $eachmedia) {
                $optionData = [];
                if (isset($eachmedia['id'])) {
                    $pond_id_withprefix = $eachmedia['id'];
                    if (strlen($eachmedia['id']) < 9) {
                        $add_zero = 9 - (strlen($eachmedia['id']));
                        for ($i = 0; $i < $add_zero; $i++) {
                            $pond_id_withprefix =  "0" . $pond_id_withprefix;
                        }
                    }
                    $media = array(
                        'api_product_id'      => $eachmedia['id'],
                        'product_category'    => $category_id,
                        'product_title'       => $eachmedia['title'],
                        'product_thumbnail'   => $eachmedia['thumbnail'],
                        'product_main_image'  => $eachmedia['watermarkPreview'],
                        'product_description' => $eachmedia['description'],
                        'product_keywords'    => implode(',', $eachmedia['keywords']),
                        'product_status'      => "Active",
                        'product_main_type'   => "Image",
                        'product_sub_type'    => "Photo",
                        'product_added_on'    => date("Y-m-d H:i:s"),
                        'product_web'         => '3',
                        'updated_at'          => date("Y-m-d H:i:s"),
                        'slug'                => preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower(trim($eachmedia['title']))),
                        'is_premium'          => (isset($eachmedia['editorial']) && $eachmedia['editorial'] === true) ? 1 : 0
                    );

                    $data2 = DB::table('imagefootage_products')
                        ->where('api_product_id', $eachmedia['id'])
                        ->get()
                        ->toArray();

                    if (count($data2) == 0) {
                        $key  = $this->randomkey();
                        $media['product_id'] = $flag . $key;
                        DB::table('imagefootage_products')->insert($media);

                        $productData = array(
                            'type'             => [$eachmedia['type']],
                            'artist'           => $eachmedia['authorName'],
                            'editorial'        => (isset($eachmedia['editorial']) && $eachmedia['editorial'] == true) ? 1 : 0
                        );

                        foreach($eachmedia['versions'] as $key=>$value){
                            $optionData[] = $value;
                        }
                        $imageFilterValue = new ImageFilterValue([
                            'api_product_id'    => $eachmedia['id'],
                            'product_id'        => $media['product_id'],
                            'product_main_type' => "Image",
                            'attributes'        => $productData,
                            'options'           => $optionData
                        ]);
                        $imageFilterValue->save();
                    } else {
                        DB::table('imagefootage_products')
                            ->where('api_product_id', '=', $eachmedia['id'])
                            ->update([
                                'product_title'       => $eachmedia['title'],
                                'product_thumbnail'   => $eachmedia['thumbnail'],
                                'product_main_image'  => $eachmedia['watermarkPreview'],
                                'product_description' => $eachmedia['description'],
                                'updated_at'          => date('Y-m-d H:i:s'),
                                'slug'                => preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower(trim($eachmedia['title']))),
                                'product_web'         => '3',
                                'is_premium'          => (isset($eachmedia['editorial']) && $eachmedia['editorial'] == true) ? 1 : 0
                            ]);

                        $apiProductId = $eachmedia['id'];
                        $productData  = array(
                            'type'             => [$eachmedia['type']],
                            'artist'           => $eachmedia['authorName'],
                            'editorial'        => (isset($eachmedia['editorial']) && $eachmedia['editorial'] == true) ? 1 : 0
                        );

                        // Find the existing document by api_product_id, or create a new one
                        $imageFilterValue = ImageFilterValue::updateOrCreate(
                            ['api_product_id' => $apiProductId],
                            [
                                'attributes' => $productData,
                            ]
                        );
                        foreach($eachmedia['versions'] as $key=>$value){
                            $optionData[] = $value;
                            $imageFilterValue = ImageFilterValue::updateOrCreate(
                                ['api_product_id' => $apiProductId],
                                [
                                    'options' => $optionData,
                                ]
                            );
                        }

                    }
                }
            }
        } else {
            Log::channel('daily')->warning("The 'items' index is not present or is not an array.");
        }
    }
}
