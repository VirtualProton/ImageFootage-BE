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
        $keyword['productType']['id'] = $getKeyword['productType'];
        $keyword['limit']             = isset($getKeyword['limit']) ? $getKeyword['limit'] : 18;
        $keyword['pagenumber']        = isset($getKeyword['pagenumber']) ? $getKeyword['pagenumber'] : 1;
        $keyword['category_id']       = isset($getKeyword['category_id']) ? $getKeyword['category_id'] : '';
        $keyword['adult_content_filter']     = isset($getKeyword['adult_content_filter']) ? $getKeyword['adult_content_filter'] : '';

        $searchKeyword = $keyword['search'];
        $thirdparty = 'panthermedia';

        if(isset($keyword['category_id']) && !empty($keyword['category_id'])){
            $searchKeyword = $keyword['category_id'];
            $getCategoryId = ProductCategory::where(['category_slug'=> $request->category_id,'type'=>$keyword['productType']['id']])->first();
            if(!empty($getCategoryId)){
                $keyword['category_id'] = $getCategoryId->category_id;
            }else{
                $keyword['category_id'] = '';
            }
        }

        $all_products = $this->searchProductsInDatabase($keyword, $getKeyword, $keyword['limit']);
        $countTotalRecords = count($all_products);

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
                if($countTotalRecords == 0 || $countTotalRecords < 15){
                    $trending_word->is_processing_keyword = 1;
                }
                $trending_word->save();
            }
        }
        
        // If records not found check with respective third party api for the data
        if($countTotalRecords == 0 || $countTotalRecords < 15){
            $cronController  = new CronController();
            $cronController->searchKeywordPond5AndPanthermedia($searchKeyword, $keyword['productType']['id'], $keyword['category_id'], $getKeyword, $thirdparty);
            $all_products = $this->searchProductsInDatabase($keyword, $getKeyword, $keyword['limit']);
        }

        return response()->json($all_products);
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

    public function getProducts($keyword, $getKeyword, $perpage = 30)
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
    }

    public function getHomePageProducts($keyword = [], $getKeyword = [], $perpage = 30)
    {
        $type = 'Image';
        $data         = [];

        $productsVertical = ImageFilterValue::query();
        $productsVertical->where("attributes.orientation", 'vertical')->limit(1);
        $filteredProducts = $productsVertical->project(['_id' => 0, 'api_product_id' => 1])->get()->toArray();
        $apiProductIdsVertical    = collect($filteredProducts)->pluck('api_product_id')->toArray();

        $productsHorizontal = ImageFilterValue::query();
        $productsHorizontal->where("attributes.orientation", 'horizontal')->limit(13);
        $filteredProductsHorizontal = $productsHorizontal->project(['_id' => 0, 'api_product_id' => 1])->get()->toArray();
        $apiProductIdsHorizontal    = collect($filteredProductsHorizontal)->pluck('api_product_id')->toArray();
        $verticalAndHorizontalIds = array_merge($apiProductIdsVertical, $apiProductIdsHorizontal);
    
        // Filter Data from MongoDB
        if ((!empty($verticalAndHorizontalIds))) {
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
            $data = $data->distinct()->get()->toArray();

            if (count($data) > 0) {
                foreach($data as &$item) {
                    $item['url']            = 'detail/' . $item['api_product_id'] . '/' . $item['product_web'] . "/" . $item['product_main_type'];
                    $item['api_product_id'] =  encrypt($item['api_product_id'], true);
                }
            }
            $total        = count($data);
        }

        return array('imgfootage' => $data, 'total'=> count($data), 'perpage'=> 17, 'tp'=> 1);
    }

    public function getEditorialData($keyword, $getKeyword, $perpage = 30)
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
    }

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

    public function getMusicData($keyword, $getKeyword, $perpage = 30)
    {
        $product      = new Product();
        $all_products = $product->getMusicProducts($keyword, $getKeyword);
        $total        = $totalPages = 0;

        $jsonData = json_decode($all_products->getContent(), true);

        if ($jsonData['total_count'] > 0) {
            $total        = $jsonData['total_count'];
            $totalPages   = ceil($total / $perpage);
        }
        return array('imgfootage' => $jsonData['data'], 'total'=> $total, 'perpage'=> $perpage, 'tp'=> $totalPages);
    }

    public function getAuthorProducts(Request $keyword)
    {
        $product      = new Product();
        $perpage      = isset($keyword['limit']) ? $keyword['limit'] : 10;
        $all_products = $product->getAuthorProductsData($keyword);
        $total        = $totalPages = 0;

        $jsonData = json_decode($all_products->getContent(), true);

        if ($jsonData['total_count'] > 0) {
            $total        = $jsonData['total_count'];
            $totalPages   = ceil($total / $perpage);
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

        if ($jsonData['total_count'] > 0) {
            $total        = $jsonData['total_count'];
            $totalPages   = ceil($total / $perpage);
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

    public function searchProductsInDatabase($keyword, $getKeyword, $limit){

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
    }

}
