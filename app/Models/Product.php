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

class Product extends Model
{
    protected $table = 'imagefootage_products';
    protected $primaryKey = 'id';
    protected $fillable = ['product_id', 'product_category', 'product_subcategory', 'product_owner', 'product_title', 'product_vertical', 'product_keywords', 'product_thumbnail', 'product_main_image', 'product_release_details', 'product_price_small', 'product_price_medium', 'product_price_large', 'product_price_extralarge', 'product_status', 'product_main_type', 'product_sub_type', 'product_added_on', 'updated_at', 'product_added_by', 'product_size', 'product_verification', 'product_rejectod_reason', 'product_editedby', 'adult_content'];
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
        $data = [];
        $totalRecords = 0;
        if ($keyword['productType']['id'] == '1') {
            $type = 'Image';
        } else if ($keyword['productType']['id'] == '2') {
            $type = 'Footage';
        } else if ($keyword['productType']['id'] == '3') {
            $type = 'Music';
        } else {
            $type = 'Editorial';
        }

        $pageNumber = $keyword['pagenumber'];
        $recordsPerPage = $keyword['limit']; 
        $offset = ($pageNumber - 1) * $recordsPerPage;

        $limit  = isset($keyword['limit']) ? $keyword['limit'] : 30;
        $search = isset($keyword['search']) && trim($keyword['search']) !== '' ? trim($keyword['search']) : '';

        //TODO : Need to check with support team and do required changes for adult_content filter
        //$adult_content  = isset($keyword['adult_content']) ? $keyword['adult_content'] : 'nil';
        $filters        = Arr::except($requestData, ['search', 'productType', 'pagenumber', 'product_editorial', 'limit']);
        $applied_filters = [];
        
        foreach ($filters as $name => $value) {
            if(isset($value['value'])) {
                if (strpos($value['value'], ',') == true) {
    
                    $elements = explode(', ', $value['value']);
                    $result = $elements;
                    $applied_filters[] = [
                        "name" => $name,
                        "value" => array($result),
                        "hasMultipleValues" => ($value['hasMultipleValue'] == 0) ? false : true
                    ];
                } else {
                    $result = $value['value'];
                    $applied_filters[] = [
                        "name" => $name,
                        "value" => $result,
                        "hasMultipleValues" => ($value['hasMultipleValue'] == 0) ? false : true
                    ];
                }
            }
        }

        //TODO:  pricing and color filter pending
        //TODO: need to confirm from both API providers how the attributes will be returned in API response
        // $applied_filters = [
        //     [
        //         "name"   => "people",
        //         "value"  => "1",
        //         "hasMultipleValues" => false
        //     ],
        //     [
        //         "name"  => "resolutions",
        //         "value" => "4K",
        //         "hasMultipleValues" => false
        //     ]
        // ];

        $products = ImageFilterValue::query();
        if (!empty($applied_filters)) {
            foreach ($applied_filters as $filter) {
                $name  = $filter['name'];
                $value = $filter['value'];

                if ($filter['hasMultipleValues']) {
                    $products->whereIn("attributes.$name", $value);
                } else {
                    $products->where("attributes.$name", $value);
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
                    'product_size'
                )
                ->where(function ($query) use ($type) {
                    // TODO: Need to check the use of product_web field
                    //$query->whereIn('product_web', [1, 2, 3])
                    $query->where('product_main_type', '=', $type);
                });

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
            $data = $data->distinct()->offset($offset)->limit($recordsPerPage)->get()->toArray();
            

            if (count($data) > 0) {
                foreach($data as &$item) {
                    $item['url']            = 'detail/' . $item['api_product_id'] . '/' . $item['product_web'] . "/" . $item['product_main_type'];
                    $item['slug']           = preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower(trim($item['product_title'])));
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
        $data           = [];
        $type           = 'Music';
        $limit          = isset($keyword['limit']) ? $keyword['limit'] : 30;
        $search         = isset($keyword['search']) ? $keyword['search'] : '' ;
        $requestFilters = Arr::except($requestData, ['search', 'productType', 'pagenumber', 'product_editorial','limit','sort']);
        $pageNumber = $keyword['pagenumber'];
        $recordsPerPage = 15; 
        $offset = ($pageNumber - 1) * $recordsPerPage;
        
        //TODO: need to confirm from both API providers how the attributes will be returned in API response
        // $applied_filters = [
        //     [
        //         "name"   => "music_sound_bpm",
        //         "value"  => ["119", "135", "127"],
        //         "hasMultipleValues" => true
        //     ],
        //     [
        //         "name"  => "genre",
        //         "value" => ["kids", "ambient"],
        //         "hasMultipleValues" => true
        //     ]
        // ];

        $applied_filters = [];        

        foreach ($requestFilters as $name => $value) { 
            if(isset($value['value'])) {
                if (strpos($value['value'], ',') == true) {
    
                    $elements = explode(', ', $value['value']);
                    $result = $elements;
                    $applied_filters[] = [
                        "name" => $name,
                        "value" => array($result),
                        "hasMultipleValues" => ($value['hasMultipleValue'] == 0) ? false : true
                    ];
                } else {
                    $result = $value['value'];
                    $applied_filters[] = [
                        "name" => $name,
                        "value" => $result,
                        "hasMultipleValues" => ($value['hasMultipleValue'] == 0) ? false : true
                    ];
                }
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
                    $products->where("attributes.$name", $value);
                }
            }
        }

        $filteredProducts        = $products->project(['_id' => 0, 'api_product_id' => 1, 'attributes.music_sound_bpm' => 1])
                                            ->get()
                                            ->toArray();
        $indexedFilteredProducts = [];
        $apiProductIds           = [];

        foreach ($filteredProducts as $product) {
            $indexedFilteredProducts[$product['api_product_id']] = $product;
            $apiProductIds[] = $product['api_product_id'];
        }

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
            'auther_name',
            'license_type',
            'product_keywords',
            'music_size'
        )
        ->where(function ($query) use ($type){
            // TODO: Need to check the use of product_web field
            //$query->whereIn('product_web', [1, 2, 3])
            $query->where('product_main_type', '=', $type);
        });

        if (!empty($keyword['search'])) {
            $data->where(function ($query) use ($search) {
                $query->orWhere('product_id', '=', $search)
                    ->orWhere('product_title', 'LIKE', '%' . $search . '%')
                    ->orWhere('product_keywords', 'LIKE', '%' . $search . '%');
            });
        }

        //TODO:  pricing and color filter pending
        if (!empty($apiProductIds)) {
            $data->whereIn('api_product_id', $apiProductIds);
        }
        $totalRecords = count($data->get());
        $data = $data->distinct()->limit($limit)->get()->toArray();

        if (count($data)>0) {
            foreach ($data as &$item) {
                $item['music_sound_bpm']  = $indexedFilteredProducts[$item['api_product_id']]['attributes']['music_sound_bpm'] ?? '';
                $item['url']              = 'detail/' . $item['api_product_id'] . '/' . $item['product_web'] . "/" . $item['product_main_type'];
                $item['slug']             = preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower(trim($item['product_title'])));
                $item['api_product_id']   = encrypt($item['api_product_id'], true);
                $item['random_three_keywords'] = $this->processMusicKeywords($item['product_keywords']);
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
                    'product_vertical' => 'Royalty Free', //TODO: why hard coded value
                    'updated_at' => date("Y-m-d H:i:s"),
                    'adult_content' => isset($eachmedia['adult-content']) ? $eachmedia['adult-content'] : 'no',
                    'auther_name' => $eachmedia['author-username']
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
                        'people_ethnicity' => 'xd',
                        'people_number'    => 'people_1',
                        'orientation'      => 'horizontal',
                        'people_age'       => 'babies',
                        'people_gender'    => 'f',
                        'license'          => ['commercial', 'editorial'],
                        'type'             => ['photos'],
                        'collection'       => ['standard', 'spx']
                    );
                    $imageFilterValue = new ImageFilterValue([
                        'api_product_id' => $eachmedia['id'],
                        'attributes'     => $productData
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
                            'updated_at'           => date('Y-m-d H:i:s')
                        ]);

                    $apiProductId = $eachmedia['id'];
                    $productData  = [
                        'people_ethnicity' => 'u',
                        'people_number'    => 'people_2',
                        'orientation'      => 'horizontal',
                        'people_age'       => 'babies',
                        'people_gender'    => 'f',
                        'license'          => ['commercial'],
                        'type'             => ['photos'],
                        'collection'       => ['standard']
                    ];

                    // Find the existing document by api_product_id, or create a new one
                    $imageFilterValue = ImageFilterValue::updateOrCreate(
                        ['api_product_id' => $apiProductId],
                        [
                            'attributes' => $productData,
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
                        'thumb_update_status' =>  1
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
            if (isset($eachmedia['id'])) {
                $pond_id_withprefix = $eachmedia['id']; // TODO: need to check use of it
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
                    'product_size'        => '', //TODO: check for this value
                    "product_keywords"    => implode(',', $eachmedia['keywords']),
                    'product_status'      => "Active",
                    'product_main_type'   => "Footage",
                    'product_sub_type'    => "Footage",
                    'product_added_on'    => date("Y-m-d H:i:s"),
                    'product_web'         => '3',
                    'product_vertical'    => 'Royalty Free', //TODO: why hard coded value
                    'updated_at'          => date("Y-m-d H:i:s")

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
                        'editorial'        => '0',
                        'people'           => ['2'],
                        'resolutions'      => ['8K'],
                        'subscription'     => '1',
                        'news_archival'    => '1',
                        'fps'              => [$eachmedia['videoFps']],
                        'gender'           => ['1'],
                        'artist'           => $eachmedia['authorName']
                    );
                    $imageFilterValue = new ImageFilterValue([
                        'api_product_id' => $eachmedia['id'],
                        'attributes'     => $productData
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
                            'updated_at'           => date('Y-m-d H:i:s')
                        ]);

                    $apiProductId = $eachmedia['id'];
                    $productData  = array(
                        'editorial'        => '1',
                        'people'           => ['1'],
                        'resolutions'      => ['4K'],
                        'artist'           => $eachmedia['authorName']
                    );

                    // Find the existing document by api_product_id, or create a new one
                    $imageFilterValue = ImageFilterValue::updateOrCreate(
                        ['api_product_id' => $apiProductId],
                        [
                            'attributes' => $productData,
                        ]
                    );
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
                'updated_at' => date("Y-m-d H:i:s")

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
            if (isset($eachmedia['id'])) {
                $pond_id_withprefix = $eachmedia['id']; // TODO: need to check use of it
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
                    'product_size'        => '', //TODO: check for this value
                    "product_keywords"    => implode(',', $eachmedia['keywords']),
                    'product_status'      => "Active",
                    'product_main_type'   => "Music",
                    'product_sub_type'    => "Music",
                    'product_added_on'    => date("Y-m-d H:i:s"),
                    'product_web'         => '3',
                    'product_vertical'    => 'Royalty Free', //TODO: why hard coded value
                    'updated_at'          => date("Y-m-d H:i:s")
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
                        'music_sound_bpm'  => $eachmedia['soundBpm'] ?? '',
                        'mood'             => ['action', 'chill'],
                        'genre'            => ['ambient', 'jazz'],
                        'artist'           => $eachmedia['authorName']
                    );

                    $imageFilterValue = new ImageFilterValue([
                        'api_product_id' => $eachmedia['id'],
                        'attributes'     => $productData
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
                            'updated_at'           => date('Y-m-d H:i:s')
                        ]);

                    $apiProductId = $eachmedia['id'];
                    $productData  = array(
                        'music_sound_bpm'  => $eachmedia['soundBpm'] ?? '',
                        'mood'             => ['chill'],
                        'genre'            => ['ambient']
                    );

                    // Find the existing document by api_product_id, or create a new one
                    $imageFilterValue = ImageFilterValue::updateOrCreate(
                        ['api_product_id' => $apiProductId],
                        [
                            'attributes' => $productData,
                        ]
                    );
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
                    'author_name'         => $data['metadata']['author_username']

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
}
