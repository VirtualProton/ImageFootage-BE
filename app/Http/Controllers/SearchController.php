<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;
use App\Http\Requests\SearchRequest;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use App\Http\PantherMedia\ImageApi;
use App\Http\Pond5\FootageApi;
use App\Models\Keywords;
use App\Models\Product;
use App\Models\Promotion;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use App\Models\Editorial;
use CORS;
use App\Models\TrendingWord;
use App\Http\Pond5\MusicApi;
use App\Models\ImageFilterValue;
use App\Jobs\FetchThirdPartyData;


class SearchController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function home(){
        $product = new Product();
        $all_products = $product->getProductsRandom();
        return array('api'=>$all_products[0],'home'=>$all_products[1]);
    }

    public function index(SearchRequest $request){
        ini_set('max_execution_time', 0);

        $getKeyword                   = $request->all();
        $all_products                 = array();
        $keyword                      = array();
        $keyword['search']            = isset($getKeyword['search']) ? $getKeyword['search'] : NULL;
        $keyword['sort']            = isset($getKeyword['sort']) ? $getKeyword['sort'] : NULL;
        $keyword['productType']['id'] = $getKeyword['productType'];
        $keyword['limit']             = isset($getKeyword['limit']) ? $getKeyword['limit'] : 25;
        $keyword['pagenumber']        = isset($getKeyword['pagenumber']) ? $getKeyword['pagenumber'] - 1 : 0;
        $keyword['category_id']       = isset($getKeyword['category_id']) ? $getKeyword['category_id'] : '';
        $keyword['adult_content_filter']     = isset($getKeyword['adult_content_filter']) ? $getKeyword['adult_content_filter'] : '';

        $keyword['productType'] = 'photo';
        if ($getKeyword['productType'] == '1' || $getKeyword['productType'] == '4') {
            $keyword['productType']  = 'photo';
            $type = 'Image';
        }else if($getKeyword['productType'] == '2' || $getKeyword['productType'] == '4'){
            $keyword['productType'] = 'video';
            $type = 'Footage';
        }else if($getKeyword['productType'] == '3'){
            $keyword['productType'] = 'music';
            $type = 'Music';
        }

        $imagesMedia        = new \App\Http\Pond5\ImageApi();
        $pond5ImagesData    = $imagesMedia->search($keyword, $getKeyword, null, $keyword['pagenumber']);
        if ($pond5ImagesData) {
            $all_products = $this->setResponseFromApi($getKeyword, $pond5ImagesData, $type);
        } else {
            $response = [];
            $response['imgfootage'] = [];
            $response['total']      = 0;
            $response['perpage']    = 0;
            $response['tp']         = 0;
            $all_products = $response;
        }

        // Save search keyword to trending words table
        if(!empty($keyword['search']) && strlen($keyword['search']) > 1){
            $search_keyword = Str::slug($keyword['search']);
            $trending_word  = TrendingWord::where('name', $search_keyword)->first();
            if(!empty($trending_word)){
                $trending_word->count += 1;
                $trending_word->save();
            } else {
                $trending_word        = new TrendingWord();
                $trending_word->name  = $search_keyword;
                $trending_word->count = 1;
                if($all_products['total'] == 0 || $all_products['total'] < config('constants.products_in_database_limit')){
                    $trending_word->is_processing_keyword = 1;
                }
                $trending_word->save();
            }
        }

        return response()->json($all_products);
    }

    public function setResponseFromApi($getKeyword, $pond5ImagesData, $type) {
        $all_products = [];
        if ($getKeyword['productType'] == '1') {
            $all_products = $this->getImageFootageProducts($getKeyword, $pond5ImagesData, $type);
        } else if ($getKeyword['productType'] == '2') {
            $all_products = $this->getImageFootageProducts($getKeyword, $pond5ImagesData, $type);
        }  else if ($getKeyword['productType'] == '3') {
            $all_products = $this->getMusicProducts($getKeyword, $pond5ImagesData, $type);
        } /* else if ($keyword['productType']['id'] == '4') {
            $all_products = $this->getEditorialData($keyword, $getKeyword, $limit);
        }*/ else {
            $images  = $this->getProducts($getKeyword, $pond5ImagesData, $type);
            $footage = $this->getProducts($getKeyword, $pond5ImagesData, $type);
            $music   = $this->getMusicData($getKeyword, $pond5ImagesData, $type);
            array_push($all_products, $images);
            array_push($all_products, $footage);
            array_push($all_products, $music);
         }
         return $all_products;
    }

    public function getImageFootageProducts($getKeyword, $pond5ImagesData, $type) {
        $total        = $totalPages = 0;
        $perpage      = $getKeyword['limit'] ?? 25;
        
        if ($pond5ImagesData['totalNumberOfItems'] > 0) {
            $total        = $pond5ImagesData['totalNumberOfItems'];
            $totalPages   = ceil($total / $perpage);
        }

        $response = [];
        $response['imgfootage'] = array_map(function ($product) use ($type) {
            return [
                "product_id" => $product['id'],
                "api_product_id" => encrypt($product['id']),
                "product_category" => null,
                "product_title" => $product['title'],
                "product_web" => null,
                "product_main_type" => $type,
                "product_thumbnail" => $product['thumbnail'],
                "product_main_image" => $type == 'Footage' ? $product['watermarkPreview'] : $product['thumbnail'],
                "product_added_on" => null,
                "product_keywords" => implode(',', $product['keywords']),
                "product_price_small" => null,
                "product_size" => null,
                "slug" => $product['id'] . '-' . preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower(trim($product['title']))),
                "attributes" => array(),
                "options" => array(),
                "url" => null,
            ];
        }, $pond5ImagesData['items']);


        $response['total']      = $total;
        $response['perpage']    = $perpage;
        $response['tp']         = $totalPages;

        return $response;
    }

    public function getMusicProducts($getKeyword, $pond5ImagesData, $type) {
        $total        = $totalPages = 0;
        $perpage      = $getKeyword['limit'];
        
        if ($pond5ImagesData['totalNumberOfItems'] > 0) {
            $total        = $pond5ImagesData['totalNumberOfItems'];
            $totalPages   = ceil($total / $perpage);
        }

        $response = [];
        $response['imgfootage'] = array_map(function ($product) use ($type) {
            return [
                "product_id" => $product['id'],
                "api_product_id" => encrypt($product['id']),
                "product_category" => null,
                "product_title" => $product['title'],
                "product_web" => null,
                "product_main_type" => $type,
                "product_thumbnail" => $product['thumbnail'],
                "product_main_image" => $product['watermarkPreview'],
                "product_added_on" => null,
                "product_keywords" => implode(',', $product['keywords']),
                "music_duration"=> $product['versions'][0]['duration'],
                "music_fileType"=> $product['versions'][0]['fileType'],
                "music_price"=> $product['versions'][0]['price'],
                "license_type"=> null,
                "music_size"=> $product['versions'][0]['size'],
                "slug" => $product['id'] . '-' . preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower(trim($product['title']))),
                "attributes" => array(),
                "options" => $product['versions'],
                "url" => null,
                "random_three_keywords" => implode(',', Arr::random($product['keywords'], min(3, count($product['keywords']))))
            ];
        }, $pond5ImagesData['items']);

        $response['total']      = $total;
        $response['perpage']    = $perpage;
        $response['tp']         = $totalPages;

        return $response;
    }

	public function relatedProductList(Request $request){
        $all_products = [];
		ini_set('max_execution_time', 0);
        $keyword = array();
		$getKeyword = $request->all();
        if(!empty($getKeyword['searchData']['keyword'])){
            $keyword['search'] = $getKeyword['searchData']['keyword'];
            $keyword['pagenumber'] = $getKeyword['pagenumber'];
            $keyword['authorname'] = '';
        }else{
            $keyword['search'] = '';
            $keyword['authorname'] = $getKeyword['searchData']['authorName'];
            $keyword['pagenumber'] = $getKeyword['pagenumber'];
        }

		if($getKeyword['imgtype']=='2') {
            $pantherMediaImages = new ImageApi();
            $pantharmediaData = $pantherMediaImages->search($keyword, $getKeyword, 30);
          if (count($pantharmediaData) > 0) {
           if(empty($pantharmediaData['items']['media'][0] ) ){
                $all_products = array(
                    'product_id' => $pantharmediaData['items']['media']['id'],
                    'api_product_id' => encrypt($pantharmediaData['items']['media']['id']),
                    'product_title' => $pantharmediaData['items']['media']['title'],
                    'slug' => preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower(trim($pantharmediaData['items']['media']['title']))),
                    'product_main_image' => $pantharmediaData['items']['media']['preview_high'],
                    'product_thumbnail' => $pantharmediaData['items']['media']['preview_no_wm'],
                    'product_description' => $pantharmediaData['items']['media']['description'],
                    'product_keywords' => $pantharmediaData['items']['media']['keywords'],
                    'product_main_type' => "Image",
                    'product_added_on' => date("Y-m-d H:i:s", strtotime($pantharmediaData['items']['media']['date'])),
                    'product_web' => '2',
                );
            }else{
                    foreach ($pantharmediaData['items']['media'] as $eachmedia) {
                     if (isset($eachmedia['id'])) {
                        $media = array(
                            'product_id' => $eachmedia['id'],
                            'api_product_id' => encrypt($eachmedia['id']),
                            'product_title' => $eachmedia['title'],
                            'slug' => preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower(trim($eachmedia['title']))),
                            'product_main_image' => $eachmedia['preview_high'],
                            'product_thumbnail' => $eachmedia['preview_no_wm'],
                            'product_description' => $eachmedia['description'],
                            'product_keywords' => $eachmedia['keywords'],
                            'product_main_type' => "Image",
                            'product_added_on' => date("Y-m-d H:i:s", strtotime($eachmedia['date'])),
                            'product_web' => '2',
                        );
                    }
                    array_push($all_products, $media);
                }
            }
            return array('imgfootage'=>$all_products,'total'=>$pantharmediaData['items']['total'],'perpage'=>$pantharmediaData['items']['items']);
            }
        }else{
            $footageMedia = new FootageApi();
            $pondfootageMediaData = $footageMedia->search($keyword,$getKeyword,'30');
            if (count($pondfootageMediaData) > 0) {
                foreach ($pondfootageMediaData['items'] as $eachmedia) {
                    if (isset($eachmedia['id'])) {
                        $pond_id_withprefix = $eachmedia['id'];
                        if (strlen($eachmedia['id']) < 9) {
                            $add_zero = 9 - (strlen($eachmedia['id']));
                            for ($i = 0; $i < $add_zero; $i++) {
                                $pond_id_withprefix = "0" . $pond_id_withprefix;
                            }
                        }
                        $media = array(
                            'product_id' => $eachmedia['id'],
                            'api_product_id' => encrypt($eachmedia['id']),
                            'product_title' => $eachmedia['title'],
                            'slug' => preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower(trim($eachmedia['title']))),
                            'product_thumbnail' => $eachmedia['thumbnail'],
                            'product_main_image' => $eachmedia['watermarkPreview'],
                            'product_description' => $eachmedia['description'],
                            'product_main_type' => "Footage",
                            'product_added_on' => date("Y-m-d H:i:s"),
                            'product_web' => '3',
                            'product_keywords' => $eachmedia['keywords'],
                            'product_price' => $eachmedia['versions'][0]['price'],
                            'product_label' => $eachmedia['versions'][0]['label'],
                            'product_authorName' => $eachmedia['authorName']
                        );
                    }
                    array_push($all_products, $media);
                }
                return array('imgfootage'=>$all_products,'total'=>$pondfootageMediaData['totalNumberOfItems'],'perpage'=>$pondfootageMediaData['itemsPerPage']);
            }
        }
        return array('imgfootage'=>$all_products,'total'=>0,'perpage'=>20);
	}

    /* public function getProducts($keyword, $getKeyword, $perpage = 30)
    {
        $product      = new Product();
        $all_products = $product->getProductsData($keyword, $getKeyword);
        $total        = $totalPages = 0;

        $jsonData = json_decode($all_products->getContent(), true);

        if ($jsonData['total_count'] > 0) {
            $total        = $jsonData['total_count'];
            $totalPages   = ceil($total / $perpage);
        }
        return array('imgfootage' => $jsonData['data'], 'total'=> $total, 'perpage'=> $perpage, 'tp'=> $totalPages);
    } */

    public function getHomePageProducts($keyword = [], $getKeyword = [], $perpage = 30)
    {
        $type = 'Image';
        $data         = [];

        $keyword                      = array();
        $keyword['search']            = NULL;
        $keyword['sort']              = 'Popular';
        $keyword['limit']             = 17;
        $keyword['pagenumber']        = 0;

        /*$productsVertical = ImageFilterValue::query();
        $productsVertical->where(["attributes.orientation"=>'vertical',"product_main_type"=>$type])->orderByDesc('_id')->limit(4);
        $filteredProducts = $productsVertical->project(['_id' => 0, 'api_product_id' => 1])->get()->toArray();
        $apiProductIdsVertical    = collect($filteredProducts)->pluck('api_product_id')->toArray();

        $productsHorizontal = ImageFilterValue::query();
        $productsHorizontal->where(["attributes.orientation"=> 'horizontal',"product_main_type"=>$type])->orderByDesc('_id')->limit(13);
        $filteredProductsHorizontal = $productsHorizontal->project(['_id' => 0, 'api_product_id' => 1])->get()->toArray();
        $apiProductIdsHorizontal    = collect($filteredProductsHorizontal)->pluck('api_product_id')->toArray();
        $verticalAndHorizontalIds = array_merge($apiProductIdsVertical, $apiProductIdsHorizontal);*/

        // Filter Data from MongoDB
        /*if ((!empty($verticalAndHorizontalIds))) {
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
                ->where(function ($query) use ($type) {
                    $query->where('product_main_type', '=', $type);
                });

            if (!empty($verticalAndHorizontalIds)) {
                $data->whereIn('api_product_id', $verticalAndHorizontalIds);
            }
            $data->orderBy('created_at', 'desc');
            $data = $data->distinct()->limit(17)->get()->toArray();

            if (count($data) > 0) {
                foreach($data as &$item) {
                    $item['url']            = 'detail/' . $item['api_product_id'] . '/' . $item['product_web'] . "/" . $item['product_main_type'];
                    $item['api_product_id'] =  encrypt($item['api_product_id'], true);
                }
            } 
        } */
        
        $imagesMedia        = new \App\Http\Pond5\ImageApi();
        $pond5ImagesData    = $imagesMedia->search($keyword, [], 25, $keyword['pagenumber']);
        if ($pond5ImagesData) {
            $getKeyword['productType'] = 1;
            $all_products = $this->setResponseFromApi($getKeyword, $pond5ImagesData, $type);
        } else {
            $response = [];
            $response['imgfootage'] = [];
            $response['total']      = 0;
            $response['perpage']    = 0;
            $response['tp']         = 0;
            $all_products = $response;
        }
        
        // return array('imgfootage' => $data, 'total'=> count($data), 'perpage'=> 17, 'tp'=> 1);
        return $all_products;
    }

    /* public function getEditorialData($keyword, $getKeyword, $perpage = 30)
    {
        $product      = new Product();
        $all_products = $product->getEditorialData($keyword, $getKeyword);
        $total        = $totalPages = 0;

        $jsonData = json_decode($all_products->getContent(), true);

        if ($jsonData['total_count'] > 0) {
            $total        = $jsonData['total_count'];
            $totalPages   = ceil($total / $perpage);
        }

        return array('imgfootage' => $jsonData['data'], 'total'=> $total, 'perpage'=> $perpage, 'tp'=> $totalPages);
    } */

    # Music search by music title
    public function musicSearchByTitle($query)
    {
        $titles = Product::select('product_title')
                            ->where('product_main_type', 'Music')
                            ->where('product_sub_type', 'Music')
                            ->where('product_title', 'LIKE', "%{$query}%")
                            ->get();

        $keywords = [];
        if (!empty($titles)) {
            foreach ($titles as $key => $musicRecord) {
                $keywords [] = $musicRecord->product_title;
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => __('List of music search words'),
            'data' => $keywords ?? null,
        ], 200);
    }

    public function getAuthorProducts(Request $keyword)
    {
        $product      = new Product();
        $perpage      = isset($keyword['limit']) ? $keyword['limit'] : 10;
        $all_products = $product->getAuthorProductsData($keyword);
        $total        = $totalPages = 0;

        $jsonData = json_decode($all_products->getContent(), true);
        $perpage      = $jsonData['per_page'];
        if ($jsonData['total_count'] > 0) {
            $total        = $jsonData['total_count'];
            $totalPages   = ceil($total / $jsonData['per_page']);
        }
        return array('imgfootage' => $jsonData['data'], 'total'=> $total, 'perpage'=> $perpage, 'tp'=> $totalPages);
    }

    public function getAuthorMusics(Request $keyword)
    {
        $product      = new Product();
        $perpage      = isset($keyword['limit']) ? $keyword['limit'] : 10;
        $all_products = $product->getAuthorMusicData($keyword);
        $total        = $totalPages = 0;

        $jsonData = json_decode($all_products->getContent(), true);
        $perpage      = $jsonData['per_page'];
        if ($jsonData['total_count'] > 0) {
            $total        = $jsonData['total_count'];
            $totalPages   = ceil($total / $jsonData['per_page']);
        }
        return array('imgfootage' => $jsonData['data'], 'total'=> $total, 'perpage'=> $perpage, 'tp'=> $totalPages);
    }

    public function categoryWiseData() {
        $product = new Product();
        $all_products = $product->categoryWiseData();
        return $all_products;
    }

    public function getKeywords(Request $request, $keyword = "")
    {
        try {
            $products = Keywords::where(function($query) use ($keyword) {
                // Filter the keywords when pass keywords as param
                $keyword = trim($keyword);
                if($keyword != "") {
                    $query->where("name", "like", "%$keyword%");
                }
            })->get()->toArray();
            return response()->json(["status"=> true, "data"=> $products]);
        } catch (\Throwable $th) {
            return response()->json(["status"=> false, "message"=> "Cannot get keywords"]);
        }
    }

    public function getTrendingKeywords(Request $request, $keyword = "")
    {
        try {
            $result = TrendingWord::where(function($query) use ($keyword) {
                $keyword = trim($keyword);
                if($keyword != "") {
                    $query->where("name", "like", "%$keyword%");
                }
            })->orderBy('count', 'desc')->orderBy('id', 'desc')->get()->take(5);
            return response()->json(["status"=> true, "data"=> $result]);
        } catch (\Throwable $th) {
            return response()->json(["status"=> false, "message"=> "Cannot get keywords"]);
        }
    }
    public function relatedSimilarImageList(Request $request){
        try{
            $all_products = [];
            $requestData = $request->all();

            $pantherMediaImages = new ImageApi();
            if(isset($requestData['searchData']['mediaId']) && !empty($requestData['searchData']['mediaId'])){
                $pantharmediaData = $pantherMediaImages->searchWithMedia($requestData['searchData']['mediaId'], 30,$requestData['pagenumber']);
            } else{
                $pantharmediaData = $pantherMediaImages->searchWithAuthor($requestData['searchData']['authorName'], 30,$requestData['pagenumber']);
            }
            if (count($pantharmediaData) > 0) {
                if(empty($pantharmediaData['items']['media'][0] ) ){
                     $all_products = array(
                         'product_id' => $pantharmediaData['items']['media']['id'],
                         'api_product_id' => encrypt($pantharmediaData['items']['media']['id']),
                         'product_title' => $pantharmediaData['items']['media']['title'],
                         'slug' => preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower(trim($pantharmediaData['items']['media']['title']))),
                         'product_main_image' => $pantharmediaData['items']['media']['preview_high'],
                         'product_thumbnail' => $pantharmediaData['items']['media']['preview_no_wm'],
                         'product_description' => $pantharmediaData['items']['media']['description'],
                         'product_keywords' => $pantharmediaData['items']['media']['keywords'],
                         'product_main_type' => "Image",
                         'product_added_on' => date("Y-m-d H:i:s", strtotime($pantharmediaData['items']['media']['date'])),
                         'product_web' => '2',
                         'product_authorName' => $pantharmediaData['items']['media']['author-username']
                     );
                 }else{
                         foreach ($pantharmediaData['items']['media'] as $eachmedia) {
                          if (isset($eachmedia['id'])) {
                             $media = array(
                                 'product_id' => $eachmedia['id'],
                                 'api_product_id' => encrypt($eachmedia['id']),
                                 'product_title' => $eachmedia['title'],
                                 'slug' => preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower(trim($eachmedia['title']))),
                                 'product_main_image' => $eachmedia['preview_high'],
                                 'product_thumbnail' => $eachmedia['preview_no_wm'],
                                 'product_description' => $eachmedia['description'],
                                 'product_keywords' => $eachmedia['keywords'],
                                 'product_main_type' => "Image",
                                 'product_added_on' => date("Y-m-d H:i:s", strtotime($eachmedia['date'])),
                                 'product_web' => '2',
                                 'product_authorName' => $eachmedia['author-username']
                             );
                         }
                         array_push($all_products, $media);
                     }
                 }
                 return array('imgfootage'=>$all_products,'total'=>$pantharmediaData['items']['total'],'perpage'=>$pantharmediaData['items']['items']);
                 }

        }catch(\Exception $e){
            return response()->json(["status"=> false, "message"=> "Please try after some times"]);
        }
    }

    public function getCategoryProducts(Request $request)
    {
        $product  = new Product();
        $data     = $product->getCategoryProductsData($request);

        return response()->json([
            'imgfootage' => $data
        ]);
    }

    public function getCategoryMusics(Request $request)
    {
        $product  = new Product();
        $data     = $product->getCategoryMusicsData($request);

        return response()->json([
            'imgfootage' => $data
        ]);
    }

    /* public function searchProductsInDatabase($keyword, $getKeyword, $limit){

        if ($keyword['productType']['id'] == '1') {
            $all_products = $this->getProducts($keyword, $getKeyword, $limit);
         } else if ($keyword['productType']['id'] == '2') {
            $all_products = $this->getProducts($keyword, $getKeyword, $limit);
         } else if ($keyword['productType']['id'] == '3') {
            $all_products = $this->getMusicData($keyword, $getKeyword, $limit);
         } else if ($keyword['productType']['id'] == '4') {
             $all_products = $this->getEditorialData($keyword, $getKeyword, $limit);
         } else {
             $images  = $this->getProducts($keyword, $getKeyword, $limit);
             $footage = $this->getProducts($keyword, $getKeyword, $limit);
             $music   = $this->getMusicData($keyword, $getKeyword, $limit);
             array_push($all_products, $images);
             array_push($all_products, $footage);
             array_push($all_products, $music);
         }
         return $all_products;
    } */
}
