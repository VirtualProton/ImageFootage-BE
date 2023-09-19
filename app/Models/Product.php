<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Models\Api;
use PhpOffice\PhpSpreadsheet\Calculation\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;

class Product extends Model
{
    protected $table = 'imagefootage_products';
    protected $primaryKey = 'id';
    protected $fillable = ['product_id', 'product_category', 'product_subcategory', 'product_owner', 'product_title', 'product_vertical', 'product_keywords', 'product_thumbnail', 'product_main_image', 'product_release_details', 'product_price_small', 'product_price_medium', 'product_price_large', 'product_price_extralarge', 'product_status', 'product_main_type', 'product_sub_type', 'product_added_on', 'updated_at', 'product_added_by', 'product_size', 'product_verification', 'product_rejectod_reason', 'product_editedby'];
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

    public function getProducts($keyword)
    {
        // dd($keyword);
        //DB::enableQueryLog();
        if ($keyword['productType']['id'] == '1') {
            $type = 'Image';
        } else if ($keyword['productType']['id'] == '2') {
            $type = 'Footage';
        } else {
            $type = 'Editorial';
        }
        // dd($keyword['search']);
        if (!empty($keyword['search'])) {
            $serach = $keyword['search'];
            $filterTypes = array(
                'product_colors' => 'product_color',
                'product_gender' => 'product_gender',
                'product_ethinicities' => 'product_ethinicities',
                'product_imagesizes' => 'product_image_size',
                'product_imagetypes' => 'product_glow_type',
                'product_orientations' => 'product_orientations',
                'product_peoples' => 'product_peoples',
                'product_locations' => 'product_locations',
                'product_sorttype' => 'product_sort_types'
            );
            // DB::enableQueryLog();
            $data = Product::select('product_id', 'api_product_id', 'product_category', 'product_title', 'product_web', 'product_main_type', 'product_thumbnail', 'product_main_image', 'product_added_on', 'product_keywords')
                //->join('imagefootage_productfilters','imagefootage_productfilters.filter_product_id','=','imagefootage_products.id')
                ->where(function ($query) use ($type) {
                    $query->whereIn('product_web', [1, 2, 3])->where('product_main_type', '=', $type);
                })->Where(function ($query) use ($serach) {
                    $query->orWhere('product_id', '=', $serach);
                    //->orWhere('product_title','LIKE', ''. $serach .'%')
                    //->orWhere('product_keywords','LIKE',''. $serach .'%');
                })->get()->toArray();
            //dd(DB::getQueryLog());

            if (count($data) > 0) {
                if ($serach == $data[0]['product_id'] && count($data) == 1) {
                    //if($data[0]['product_web']=='2'){
                    $url = 'detail/' . $data[0]['api_product_id'] . '/' . $data[0]['product_web'] . "/" . $data[0]['product_main_type'];
                    $data[0]['slug'] = preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower(trim($data[0]['product_title'])));
                    $data[0]['api_product_id'] = encrypt($data[0]['api_product_id'], true);
                    $data = array('code' => 1, 'url' => $url, 'data' => $data);
                    //}else{

                    //}
                }
            }

            //dd(DB::getQueryLog());
            //            if($getKeyword['product_colors']){
            //
            //            }
        } else {
            //            $data =Product::where('product_main_type','=',$type)
            //                    ->select('product_id','api_product_id','product_title','product_web','product_main_type','product_thumbnail','product_main_image','product_added_on','product_keywords')
            //                    ->where('product_web','!=','1')
            //                    ->get()
            //                    ->toArray();
            $data = [];
        }
        return  $data;
    }

    //API search function
    public function getProductsNew($keyword, $requestData)
    {
        $data = [];
        if ($keyword['productType']['id'] == '1') {
            $type = 'Image';
        } else if ($keyword['productType']['id'] == '2') {
            $type = 'Footage';
        } else {
            $type = 'Editorial';
        }
        if (!empty($keyword['search'])) {
            $search = $keyword['search'];
            $requestFilters = Arr::except($requestData, ['search', 'productType', 'pagenumber', 'product_editorial']);

            $data = Product::select('product_id', 'api_product_id', 'product_category', 'product_title', 'product_web', 'product_main_type', 'product_thumbnail', 'product_main_image', 'product_added_on', 'product_keywords')
                ->leftJoin('imagefootage_productfilters', 'imagefootage_productfilters.filter_product_id', '=', 'imagefootage_products.id')
                ->leftJoin('imagefootage_filters_options', 'imagefootage_filters_options.id', 'imagefootage_productfilters.filter_type_id')
                ->where(function ($query) use ($type) {
                    $query->whereIn('product_web', [1, 2, 3])->where('product_main_type', '=', $type);
                })->Where(function ($query) use ($search) {
                    $query->orWhere('product_id', '=', $search) //exact match
                        ->orWhere('product_title', 'LIKE', '%' . $search . '%')
                        ->orWhere('product_keywords', 'LIKE', '%' . $search . '%');
                });
            //filters apply pending
            if (count($requestFilters) > 0) {
                //TODO:  pricing and color filter pending
                $filtersArr = array_values(array_filter($requestFilters));
                if (count($filtersArr) > 0) {
                    $data = $data->whereIn('imagefootage_filters_options.id', $filtersArr);
                }
            }
            $data = $data->distinct()->get()->toArray();
            if (count($data) > 0) {
                $url = 'detail/' . $data[0]['api_product_id'] . '/' . $data[0]['product_web'] . "/" . $data[0]['product_main_type'];
                $data[0]['slug'] = preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower(trim($data[0]['product_title'])));
                $data[0]['api_product_id'] = encrypt($data[0]['api_product_id'], true);
                $data = array('code' => 1, 'url' => $url, 'data' => $data);
            }
        }
        return  $data;
    }

    //API search function
    public function getMusicProducts($keyword, $requestData)
    {
        $data = [];
        if (!empty($keyword['search'])) {
            $search = $keyword['search'];
            $requestFilters = Arr::except($requestData, ['search', 'productType', 'pagenumber', 'product_editorial']);

            $data = Product::select('product_id', 'api_product_id', 'product_category', 'product_title', 'product_web', 'product_main_type', 'product_thumbnail', 'product_main_image', 'product_added_on', 'product_keywords', 'product_description', 'music_sound_bpm', 'music_duration', 'music_fileType', 'music_price', 'auther_name', 'license_type', 'product_keywords')
                ->leftJoin('imagefootage_productfilters', 'imagefootage_productfilters.filter_product_id', '=', 'imagefootage_products.id')
                ->leftJoin('imagefootage_filters_options', 'imagefootage_filters_options.id', 'imagefootage_productfilters.filter_type_id')
                ->where(function ($query) {
                    $query->whereIn('product_web', [1, 2, 3])->where('product_main_type', '=', 'Music');
                })->Where(function ($query) use ($search) {
                    $query->orWhere('product_id', '=', $search)
                        ->orWhere('product_title', 'LIKE', '%' . $search . '%')
                        ->orWhere('product_keywords', 'LIKE', '%' . $search . '%')
                        ->orWhere('auther_name', 'LIKE', '%' . $search . '%');
                });

            //filters apply pending
            if (count($requestFilters) > 0) { //TODO:  pricing and color filter pending
                $filtersArr = array_values(array_filter($requestFilters));
                if (count($filtersArr) > 0) {
                    $data = $data->whereIn('imagefootage_filters_options.id', $filtersArr);
                }
            }
            $data = $data->distinct()->get()->toArray();

            if (count($data) > 0) {
                $data[0]['slug'] = preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower(trim($data[0]['product_title'])));
                $data[0]['api_product_id'] = encrypt($data[0]['api_product_id'], true);
                $data = array('code' => 1, 'data' => $data);
            }
        }
        return  $data;
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

    public function savePantherImage($data, $category_id)
    {

        foreach ($data['items']['media'] as $eachmedia) {
            if (isset($eachmedia['id'])) {
                $media = array(
                    'product_id' => "",
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
                    'product_vertical' => 'Royalty Free',
                    'updated_at' => date("Y-m-d H:i:s")

                );
                // print_r($media); die;
                $data2 = DB::table('imagefootage_products')
                    ->where('api_product_id', $eachmedia['id'])
                    ->get()
                    ->toArray();

                if (count($data2) == 0) {
                    $flag = $this->get_api_flag('2', 'api_flag');
                    $key  = $this->randomkey();
                    DB::table('imagefootage_products')->insert($media);
                    $id = DB::getPdo()->lastInsertId();
                    DB::table('imagefootage_products')
                        ->where('id', '=', $id)
                        ->update(['product_id' => $flag . $key]);
                    //return $flag.$key;
                    echo "Inserted" . $id;
                } else {

                    //echo "hello";
                    DB::table('imagefootage_products')
                        ->where('api_product_id', '=', $eachmedia['id'])
                        ->update([
                            'product_thumbnail' => $eachmedia['preview_no_wm'],
                            'product_main_image' => $eachmedia['preview_high'],
                            'product_description' => $eachmedia['description'],
                            'product_title' => $eachmedia['title'],
                            'updated_at' => date('Y-m-d H:i:s')
                        ]);
                    // return $data2[0]->product_id;
                    echo "Updated" . $eachmedia['id'];
                }
            }
        }
    }
    public function updatePantherImage($data)
    {

        if (isset($data['media']['id'])) {
            // print_r($media); die;
            $count = DB::table('imagefootage_products')
                ->where('api_product_id', $data['media']['id'])
                ->count();

            if ($count > 0) {
                $imgData = getimagesize($data['media']['preview_url_no_wm']);

                DB::table('imagefootage_products')
                    ->where('api_product_id', '=', $data['media']['id'])
                    ->update([
                        'product_thumbnail' => $data['media']['preview_url_no_wm'],
                        'product_main_image' => $data['media']['preview_url'],
                        'product_description' => $data['metadata']['description'],
                        'product_title' => $data['metadata']['title'],
                        'updated_at' => date('Y-m-d H:i:s'),
                        'width_thumb' => $imgData[0],
                        'height_thumb' => $imgData[1],
                        'thumb_update_status' =>  1
                    ]);
                echo "Updated" . $data['media']['id'];
            }
        }
    }

    public function savePond5Image($data, $category_id)
    {        
        $eachmedia = $data;
        foreach($data['items'] as $eachmedia){
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
            // print_r($media); die;
            $data2 = DB::table('imagefootage_products')
                ->where('api_product_id', $eachmedia['id'])
                ->get()
                ->toArray();
            if (count($data2) == 0) {
                $flag = $this->get_api_flag('3', 'api_flag');
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

    }

    # savePond5Music
    public function savePond5Music($data, $category_id)
    {
        $eachmedia = $data;

        foreach ($eachmedia as $key => $music) {
            if (isset($music['id'])) {
                $pond_id_withprefix = $music['id'];
                if (strlen($music['id']) < 9) {
                    $add_zero = 9 - (strlen($music['id']));
                    for ($i = 0; $i < $add_zero; $i++) {
                        $pond_id_withprefix =  "0" . $pond_id_withprefix;
                    }
                }

                $media = array(
                    'product_id' => "",
                    'api_product_id' => $music['id'],
                    'product_category' => $category_id,
                    'product_title' => $music['title'],
                    'product_thumbnail' => $music['thumbnail'],
                    'product_main_image' => $music['watermarkPreview'],
                    'product_description' => $music['description'],
                    'product_size' => '',
                    "product_keywords" => implode(',', $music['keywords']),
                    'product_status' => "Active",
                    'product_main_type' => "Music",
                    'product_sub_type' => "Music",
                    'product_added_on' => date("Y-m-d H:i:s"),
                    'product_web' => '3',
                    'product_vertical' => 'Royalty Free',
                    'music_sound_bpm' => $music['soundBpm'] ?? null,
                    'auther_name' => $music['authorName'] ?? null,
                    'updated_at' => date("Y-m-d H:i:s")
                );

                if (!empty($music['versions'])) {
                    $media['music_duration'] = $music['versions'][0]['duration'] ?? null;
                    $media['music_fileType'] = $music['versions'][0]['fileType'] ?? null;
                    $media['music_price'] = $music['versions'][0]['price'] ?? null;
                    $media['music_size'] = $music['versions'][0]['size'] ?? null;
                }

                $data2 = DB::table('imagefootage_products')
                    ->where('api_product_id', $music['id'])
                    ->get()
                    ->toArray();
                if (count($data2) == 0) {
                    //TODO
                    $flag = $this->get_api_flag('5', 'api_flag');
                    $key  = $this->randomkey();
                    DB::table('imagefootage_products')->insert($media);
                    $id = DB::getPdo()->lastInsertId();
                    DB::table('imagefootage_products')
                        ->where('id', '=', $id)
                        ->update(['product_id' => $flag . $key]);
                }
            }
        }
    }


    public function getProductsRandom()
    {
        ini_set('max_execution_time', 0);
        $final_data = [];
        $data =   DB::table('imagefootage_products as pr')
            //->where('pr.product_web','2')
            //->where('pr.width_thumb','<>',NULL)
            ->select('id', 'product_id', 'api_product_id', 'product_title', 'product_description', 'product_thumbnail', 'product_main_image', 'product_web', 'category_name', 'category_id', 'product_main_type', 'width_thumb', 'height_thumb', 'thumb_update_status')
            ->join('imagefootage_productcategory as pc', 'pc.category_id', '=', 'pr.product_category')
            //->whereIn('pc.category_name',['Christmas', 'SkinCare', 'Cannabis', 'Business', 'Curated',
            //   'Video', 'Autumn', 'Family', 'Halloween', 'Seniors', 'Cats', 'Dogs', 'Party', 'Food'])
            ->where('pc.is_display_home', '=', '1')
            ->where('pr.thumb_update_status', '=', '1')
            ->whereRaw("date(pr.updated_at) >= '2020-05-01'")
            ->orderBy('pc.category_order', 'asc')
            ->inRandomOrder()

            // ->limit(Product::HomeLimit)
            ->get()
            ->groupBy("category_name")
            ->map(function ($product) {
                return $product->take(Product::HomeLimit);
                // return $product->take(4);
            });


        // print_r(count($data)); die;
        // print_r($data); die;

        // foreach($data as $dat){

        //     foreach($dat as $da){
        //         echo "<pre>"; print_r($da); die;

        //         $check_url_status = $this->check_urls($da->product_thumbnail);
        //         if ($check_url_status != '200'){
        //             $da->product_thumbnail = $da->product_main_image;



        //             }

        //     }

        // }



        //$data = (array)$data;
        $home = [];
        //$n = 0;

        foreach ($data as $k => $perdata) {
            // $n2 = 0;
            // $n++;

            // $final_data[$k] = (array)$perdata;
            // $imgData =getimagesize($perdata->product_thumbnail);
            //$final_data[$k]['width_img'] = $imgData[0];
            // $final_data[$k] ['height_img']= $imgData[1];
            //$final_data[$k]['attr'] = $imgData[3];
            foreach ($perdata as $j => $eachproduct) {
                //$n2++;



                // $ch = curl_init();
                // curl_setopt($ch, CURLOPT_URL, $eachproduct->product_main_image);
                // curl_setopt($ch, CURLOPT_HEADER, 1);
                // curl_setopt($ch , CURLOPT_RETURNTRANSFER, 1);
                // $data2 = curl_exec($ch);
                // $headers = curl_getinfo($ch);
                // curl_close($ch);

                // if ($headers['http_code'] != '200')
                $ldate = date('d');
                // echo $ldate;
                // die;
                if ($ldate == "28" || $ldate == "29" ||  $ldate == "30" ||  $ldate == "31" ||  $ldate == "1") {
                    $eachproduct->product_thumbnail = $eachproduct->product_main_image;
                }

                // if($n<=8)
                // {
                //     if($n2<=4)
                //     {
                //         //echo $n; echo $k; echo $n2; echo "<br>";


                //         $file_headers = get_headers($eachproduct->product_thumbnail); 
                //         if(!$file_headers || $file_headers[0] != '200')
                //         {
                //             $eachproduct->product_thumbnail = $eachproduct->product_main_image;               

                //         }

                //     }

                // }
                // echo "<pre>"; print_r($eachproduct); die;

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

        if ($data['stat'] == 'ok') {
            if (isset($data['media']['id'])) {
                $media = array(
                    'product_id' => "",
                    'api_product_id' => $data['media']['id'],
                    'product_category' => $category_id,
                    'product_title' => $data['metadata']['title'],
                    'product_thumbnail' => $data['media']['preview_url_no_wm'],
                    'product_main_image' => $data['media']['preview_url'],
                    'product_description' => $data['metadata']['description'],
                    'product_size' => $data['media']['width'] . "X" . $data['media']['height'],
                    "product_keywords" => $data['metadata']['keywords'],
                    'product_status' => "Active",
                    'product_main_type' => "Image",
                    'product_sub_type' => "Photo",
                    'product_added_on' => date("Y-m-d H:i:s", strtotime($data['metadata']['date'])),
                    'product_web' => '2',
                    'product_vertical' => 'Royalty Free',
                    'updated_at' => date("Y-m-d H:i:s")

                );
                // print_r($media); die;
                $data2 = DB::table('imagefootage_products')
                    ->where('api_product_id', $data['media']['id'])
                    ->get()
                    ->toArray();

                if (count($data2) == 0) {
                    $flag = $this->get_api_flag('2', 'api_flag');
                    $key  = $this->randomkey();
                    DB::table('imagefootage_products')->insert($media);
                    $id = DB::getPdo()->lastInsertId();
                    DB::table('imagefootage_products')
                        ->where('id', '=', $id)
                        ->update(['product_id' => $flag . $key]);
                    return $flag . $key;
                    // echo "Inserted" . $id;
                } else {

                    //echo "hello";
                    DB::table('imagefootage_products')
                        ->where('api_product_id', '=', $data['media']['id'])
                        ->update([
                            'product_thumbnail' => $data['media']['preview_url_no_wm'],
                            'product_main_image' => $data['media']['preview_url'],
                            'product_description' => $data['metadata']['description'],
                            'product_title' => $data['metadata']['title'],
                            'updated_at' => date('Y-m-d H:i:s')
                        ]);
                    return $data2[0]->product_id;
                    //echo "Updated". $eachmedia['id'];
                }
            }
        }
    }

    public function get_api_flag($flag, $field)
    {
        return Api::where('api_id', $flag)->first()->$field;
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
                'product_id' => "",
                'api_product_id' => $productData['product_id'],
                'product_category' => "",
                'product_title' => $productData['product_title'],
                'product_thumbnail' => $productData['product_thumbnail'],
                'product_main_image' => $productData['product_main_image'],
                'product_description' => $productData['product_description'],
                'product_size' => '',
                "product_keywords" => $productData['product_keywords'],
                'product_status' => "Active",
                'product_main_type' => "Footage",
                'product_sub_type' => "Photo",
                'product_added_on' => date("Y-m-d H:i:s"),
                'product_web' => '3',
                'product_vertical' => 'Royalty Free'

            );
            $flag = $this->get_api_flag('3', 'api_flag');
            $key  = $this->randomkey();
            DB::table('imagefootage_products')->insert($media);
            $id = DB::getPdo()->lastInsertId();
            DB::table('imagefootage_products')
                ->where('id', '=', $id)
                ->update(['product_id' => $flag . $key]);
        } else {
            $media = array(
                'product_id' => "",
                'api_product_id' => $productData['product_id'],
                'product_category' => "",
                'product_title' => $productData['product_title'],
                'product_thumbnail' => $productData['product_thumbnail'],
                'product_main_image' => $productData['product_main_image'],
                'product_description' => $productData['product_description'],
                'product_size' => '',
                "product_keywords" => $productData['product_keywords'],
                'product_status' => "Active",
                'product_main_type' => "Image",
                'product_sub_type' => "Photo",
                'product_added_on' => $productData['product_added_on'],
                'product_web' => '2',
                'product_vertical' => 'Royalty Free'
            );
            DB::table('imagefootage_products')->insert($media);
            $id = DB::getPdo()->lastInsertId();
            $flag = $this->get_api_flag('3', 'api_flag');
            $key  = $this->randomkey();
            DB::table('imagefootage_products')
                ->where('id', '=', $id)
                ->update(['product_id' => $flag . $key]);
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
        //echo "<pre>";print_r($data->toArray()); die;
        foreach ($data as $k => $perdata) {
            // $final_data[$k] = (array)$perdata;
            // $imgData =getimagesize($perdata->product_thumbnail);
            // $final_data[$k]['width_img'] = $imgData[0];
            // $final_data[$k] ['height_img']= $imgData[1];
            // $final_data[$k]['attr'] = $imgData[3];
            foreach ($perdata as $j => $eachproduct) {
                if ($eachproduct->product_web == '2') {
                    $home[$k]["images"][$j] = $eachproduct;
                    $home[$k]["images"][$j]->api_product_id = encrypt($eachproduct->api_product_id);
                    $home[$k]["images"][$j]->slug =  preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower(trim($eachproduct->product_title)));
                } else {
                    $home[$k]["footages"][$j] = $eachproduct;
                    $home[$k]["footages"][$j]->api_product_id = encrypt($eachproduct->api_product_id);
                    $home[$k]["footages"][$j]->slug =  preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower(trim($eachproduct->product_title)));
                }

                // if($j<4){
                //     array_push($home,$data[$k][$j]);
                // }
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
        $data = curl_exec($ch);
        $headers = curl_getinfo($ch);
        curl_close($ch);

        return $headers['http_code'];
    }

    public function downloads()
    {
        return $this->hasMany(ProductsDownload::class, 'product_id', 'product_id');
    }
}
