<?php

namespace App\Http\Controllers;

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

        if ($keyword['productType']['id'] == '1') {
           $all_products = $this->getImagesData($keyword, $getKeyword);
        } else if ($keyword['productType']['id'] == '2') {
           $all_products = $this->getFootageData($keyword, $getKeyword);
        } else if ($keyword['productType']['id'] == '3') {
           $all_products = $this->getMusicData($keyword, $getKeyword);
        } else if ($keyword['productType']['id'] == '4') {
            $all_products = $this->getEditorialData($keyword, $getKeyword);
        } else {
            $images  = $this->getImagesData($keyword, $getKeyword);
            $footage = $this->getFootageData($keyword, $getKeyword);
            $music   = $this->getMusicData($keyword, $getKeyword);
            array_push($all_products, $images);
            array_push($all_products, $footage);
            array_push($all_products, $music);
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
                $trending_word->save();
            }
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

    public function getImagesData($keyword, $getKeyword)
    {
        $all_products = [];
        $product      = new Product();
        $all_products = $product->getProductsUpdated($keyword, $getKeyword);
        $flag         = 0;

        if (count($all_products) > 0) {
            $flag         = 1;
            $total        = count($all_products);
            $perpage      = 15;
            $totalPages   = ceil($total / $perpage);

            return array('imgfootage' => $all_products, 'total'=> $total, 'perpage'=> $perpage, 'tp'=> $totalPages);
        }

        if($flag=='0') {
            $pantherMediaImages = new ImageApi();
            $pantharmediaData = $pantherMediaImages->search($keyword, $getKeyword);
            if (count($pantharmediaData) > 0) {
                foreach ($pantharmediaData['items']['media'] as $eachmedia) {
                    if (isset($eachmedia['id'])) {
                        $media = array(
                            'product_id' => $eachmedia['id'],
                            'api_product_id' => encrypt($eachmedia['id'],true),
                            'slug' => preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower(trim($eachmedia['title']))),
                            'product_title' => $eachmedia['title'],
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
                    $all_products [] = shuffle($all_products);
                }
                $total        = $pantharmediaData['items']['total'];
                $perpage      = $pantharmediaData['items']['items'];
                $totalPages   = ceil($total / $perpage);

                return array('imgfootage'=>$all_products, 'total'=>$total, 'perpage'=>$perpage, 'tp'=> $totalPages);
            }
        }

        return array('imgfootage'=>$all_products, 'total'=>0, 'perpage'=>15, 'tp'=>'0');
    }

    public function getEditorialData($keyword, $getKeyword)
    {

        if (!empty($keyword['search'])) {
            $editoriallist = Editorial::where('status', 1)
                ->where('search_term', $keyword['search'])
                ->get();
        } else {
            $editoriallist = Editorial::where('status', 1)->get();
        }

        $selectedValues = [];
        // Retrive all occured products Ids
        foreach ($editoriallist as $editorial) {
            $editorialValue = json_decode($editorial['selected_values'], true);

            if (is_array($editorialValue)) {
                $selectedValues = array_merge($selectedValues, $editorialValue);
            }
        }

        // Retrive URLs based on Ids
        $is_filter = 0;
        $product_ids = [];
        if(count($getKeyword) > 0) {
            $requestFilters = Arr::except($getKeyword, ['search', 'productType', 'pagenumber', 'product_editorial']);
            $filtersArr = array_values(array_filter($requestFilters));
            if(count($filtersArr) > 0) {
                $is_filter = 1;
            }
        }
        if($is_filter == 1) {
            // Get filtered products
            $products = Product::select('product_id', 'product_main_image')
            ->join('imagefootage_productfilters','imagefootage_productfilters.filter_product_id','=','imagefootage_products.id')
            ->join('imagefootage_filters_options', 'imagefootage_filters_options.id', 'imagefootage_productfilters.filter_type_id')
            ->whereIn('product_id', $selectedValues)
            ->whereIn('imagefootage_filters_options.id', $filtersArr)
            ->distinct()->get();
            // Get filtered product ids array
            $product_ids = $products->pluck('product_id')->toArray();
            // if filter apply editorials list result update by above product ids
            $editoriallist = Editorial::select('*');
            if(count($product_ids) > 0) {
                foreach ($product_ids as $product_id) {
                    // find in json by and condition
                    $editoriallist = $editoriallist->whereJsonContains('selected_values', [$product_id]);
                }
            } else {
                $editoriallist = $editoriallist->whereJsonContains('selected_values', ['']);
            }
            $editoriallist = $editoriallist->get();
        } else {
            $products = Product::select('product_id', 'product_main_image')->whereIn('product_id', $selectedValues)->get();
            $product_ids = $products->pluck('product_id')->toArray();
        }

        $productUrlMap = [];
        foreach ($products as $product) {
            $productUrlMap[$product->product_id] = $product->product_main_image;
        }

        foreach ($editoriallist as $editorial) {
            $editorialValue = json_decode($editorial['selected_values'], true);
            if (is_array($editorialValue)) {
                $updatedEditorialValue = [];
                foreach ($editorialValue as $productId) {
                    if (isset($productUrlMap[$productId])) {
                        $updatedEditorialValue[] = $productUrlMap[$productId];
                    }
                }
                $editorial['selected_values'] = implode(',', $updatedEditorialValue);
                $editorial['selected_values_count'] = count($updatedEditorialValue);
            }
            if (!empty($editorial['main_image_upload'])) {
                $editorial['main_image_upload'] = asset('uploads/editorialmainimage/' . $editorial['main_image_upload']);
            }
        }
        $total = count($editoriallist);
        $perpage = 15;
        $totalPages = ceil($total / $perpage);

        return array('imgfootage' => $editoriallist, 'total' => $total, 'perpage' => $perpage, 'tp' => $totalPages);
    }

    public function getFootageData($keyword,$getKeyword)
    {
        $all_products = [];
        $product      = new Product();
        $all_products = $product->getProductsUpdated($keyword, $getKeyword);
        $flag         = 0;

        if (count($all_products) > 0) {
            $flag         = 1;
            $total        = count($all_products);
            $perpage      = 30;
            $totalPages   = ceil($total / $perpage);

            return array('imgfootage' => $all_products, 'total' => $total, 'perpage' => $perpage, 'tp' => $totalPages);
        }

        if ($flag =='0') {
            $footageMedia         = new FootageApi();
            $pondfootageMediaData = $footageMedia->search($keyword, $getKeyword);

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
                            'product_id'          => $eachmedia['id'],
                            'api_product_id'      => encrypt($eachmedia['id'],true),
                            'slug'                => preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower(trim($eachmedia['title']))),
                            'product_title'       => $eachmedia['title'],
                            'product_thumbnail'   => "https://p5iconsp.s3-accelerate.amazonaws.com/" . $pond_id_withprefix . "_iconl.jpeg",
                            'product_main_image'  => $eachmedia['watermarkPreview'],
                            'product_description' => $eachmedia['description'],
                            'product_main_type'   => "Footage",
                            'product_added_on'    => date("Y-m-d H:i:s"),
                            'product_web'         => '3',
                            'product_keywords'    => implode(',',$eachmedia['keywords'])
                        );
                    }
                    array_push($all_products, $media);
                }

                $total      = $pondfootageMediaData['totalNumberOfItems'];
                $perpage    = $pondfootageMediaData['itemsPerPage'];
                $totalPages = ceil($total / $perpage);

                return array('imgfootage' => $all_products, 'total' => $total, 'perpage' => $perpage, 'tp' => $totalPages);
            }
        }

        return array('imgfootage' => $all_products, 'total' => 0, 'perpage' => 0, 'tp'=> 0);
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

    public function getMusicData($keyword,$getKeyword){

        $flag = 0;
        if (!empty($getKeyword['all_filters'])) {
            $flag = 1;
        }

        $all_products = [];
        $product      = new Product();
        $all_products = $product->getMusicProducts($keyword, $getKeyword);

        // TODO: need to remove this condition after mongodb filters code implementation
        if ( count($all_products) > 0 && $flag == 0) {
            $total        = count($all_products);
            $perpage      = 30;
            $totalPages   = ceil($total / $perpage);

            return array('imgfootage' => $all_products, 'total' => $total, 'perpage' => $perpage, 'tp' => $totalPages);
        } else {
            $musicMedia         = new MusicApi();
            $pondmusicMediaData = $musicMedia->searchMusic($keyword,$getKeyword);

            if (!empty($pondmusicMediaData) && count($pondmusicMediaData) > 0) {
                foreach ($pondmusicMediaData['items'] as $eachmedia) {
                    if (isset($eachmedia['id'])) {
                        $pond_id_withprefix = $eachmedia['id'];
                        if (strlen($eachmedia['id']) < 9) {
                            $add_zero = 9 - (strlen($eachmedia['id']));
                            for ($i = 0; $i < $add_zero; $i++) {
                                $pond_id_withprefix = "0" . $pond_id_withprefix;
                            }
                        }
                        $media = array(
                            'product_id'     => $eachmedia['id'],
                            'api_product_id' => encrypt($eachmedia['id'],true),
                            'slug'           => preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower(trim($eachmedia['title']))),
                            'product_title'       => $eachmedia['title'],
                            'product_thumbnail'   => "https://p5iconsp.s3-accelerate.amazonaws.com/" . $pond_id_withprefix . "_iconl.jpeg",
                            'product_main_image'  => $eachmedia['watermarkPreview'],
                            'product_description' => $eachmedia['description'],
                            'product_main_type' => "Music",
                            'product_added_on'  => date("Y-m-d H:i:s"),
                            'product_web'       => '3',
                            'product_keywords'  => implode(',',$eachmedia['keywords']),
                            'music_sound_bpm'   => $eachmedia['soundBpm'] ?? null,
                            'music_duration'    => $eachmedia['versions'][0]['duration'] ?? null,
                            'music_fileType'    => $eachmedia['versions'][0]['fileType'] ?? null,
                            'music_price'       => $eachmedia['versions'][0]['price'] ?? null,
                            'music_size'        => $eachmedia['versions'][0]['size'] ?? null,
                        );
                    }
                    array_push($all_products, $media);
                }

                $total      = $pondmusicMediaData['totalNumberOfItems'];
                $perpage    = $pondmusicMediaData['itemsPerPage'];
                $totalPages = ceil($total / $perpage);

                return array('imgfootage' => $all_products, 'total' => $total, 'perpage' => $perpage, 'tp' => $totalPages);
            }
        }

        return array('imgfootage' => $all_products, 'total' => 0, 'perpage' => 30, 'tp' => 0);
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

}
