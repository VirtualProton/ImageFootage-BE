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

use CORS;

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
        $getKeyword = $request->all();
        $keyword = array();
        $keyword['search'] = $getKeyword['search'];
        $keyword['productType']['id']= $getKeyword['productType'];

        if($keyword['productType']['id']=='1'){
           $all_products = $this->getImagesData($keyword,$getKeyword);
        }else if($keyword['productType']['id']=='2'){
            if(isset($getKeyword['pagenumber'])){
                $keyword['pagenumber']= $getKeyword['pagenumber'];
            }
               $all_products =$this->getFootageData($keyword,$getKeyword);
              
        }else{
            $all_products =[];
            $images = $this->getImagesData($keyword);
            $footage = $this->getFootageData($keyword);
            array_push($all_products,$images);
            array_push($all_products,$footage);
        }

        return response()->json($all_products);
    }
	public function relatedProductList(Request $request){
        $all_products = [];
		ini_set('max_execution_time', 0);
		$getKeyword = $request->all();
		$keyword = array();
		$keyword['search'] = $getKeyword['searchData'];
        $keyword['pagenumber'] = $getKeyword['pagenumber'];
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
                    'product_main_image' => str_replace('http','https',$pantharmediaData['items']['media']['preview_high']),
                    'product_thumbnail' => str_replace('http','https',$pantharmediaData['items']['media']['preview_no_wm']),
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
                            'product_main_image' => str_replace('http','https',$eachmedia['preview_high']),
                            'product_thumbnail' => str_replace('http','https',$eachmedia['preview_no_wm']),
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
                            'product_title' => $eachmedia['n'],
                            'slug' => preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower(trim($eachmedia['n']))),
                            'product_thumbnail' => "https://p5iconsp.s3-accelerate.amazonaws.com/" . $pond_id_withprefix . "_iconl.jpeg",
                            'product_main_image' => $pondfootageMediaData['icon_base'] . $pond_id_withprefix . "_main_l.mp4",
                            'product_description' => $eachmedia['desc'],
                            'product_main_type' => "Footage",
                            'product_added_on' => date("Y-m-d H:i:s"),
                            'product_web' => '3',
                            'product_keywords' => $eachmedia['kw']
                        );
                    }
                    array_push($all_products, $media);
                }
                return array('imgfootage'=>$all_products,'total'=>$pondfootageMediaData['nbr_footage'],'perpage'=>$pondfootageMediaData['max_per_page']);
            }
        }
        return array('imgfootage'=>$all_products,'total'=>0,'perpage'=>20);
	}

    public function getImagesData($keyword,$getKeyword){
        $all_products = [];
        $product = new Product();
        $all_products = $product->getProducts($keyword);
        $flag =0;
        if(count($all_products)>0){
            if(isset($all_products['code'])&& $all_products['code']=='1'){
                $all_products = $all_products['data'];
                $flag =1;
                return array('imgfootage'=>$all_products,'total'=>'1','perpage'=>'30','tp'=>'1');
            }
        }
        if($flag=='0'){ 
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
                            'product_main_image' => str_replace('http','https',$eachmedia['preview_high']),
                            'product_thumbnail' => str_replace('http','https',$eachmedia['preview_no_wm']),
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
                return array('imgfootage'=>$all_products,'total'=>$pantharmediaData['items']['total'],'perpage'=>$pantharmediaData['items']['items'],'tp'=>'2');
            }
        }

          return array('imgfootage'=>$all_products,'total'=>0,'perpage'=>30,'tp'=>'2');
    }

    public function getFootageData($keyword,$getKeyword){
        $product = new Product();
        $all_products =[];
        $all_products = $product->getProducts($keyword);
        $flag =0;
        
        if(count($all_products)>0){
            if(isset($all_products['code'])&& $all_products['code']=='1'){
                $all_products = $all_products['data'];
                $flag =1;
                return array('imgfootage'=>$all_products,'total'=>'1','perpage'=>'30','tp'=>'1');
            }
        }
        if($flag=='0'){

            $footageMedia = new FootageApi();
            $pondfootageMediaData = $footageMedia->search($keyword,$getKeyword);
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
                            'api_product_id' => encrypt($eachmedia['id'],true),
                            'slug' => preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower(trim($eachmedia['n']))),
                            'product_title' => $eachmedia['n'],
                            'product_thumbnail' => "https://p5iconsp.s3-accelerate.amazonaws.com/" . $pond_id_withprefix . "_iconl.jpeg",
                            'product_main_image' => $pondfootageMediaData['icon_base'] . $pond_id_withprefix . "_main_l.mp4",
                            'product_description' => $eachmedia['desc'],
                            'product_main_type' => "Footage",
                            'product_added_on' => date("Y-m-d H:i:s"),
                            'product_web' => '3',
                            'product_keywords' => $eachmedia['kw']
                        );

                    }
                    array_push($all_products, $media);
                }
                return array('imgfootage'=>$all_products,'total'=>$pondfootageMediaData['nbr_footage'],'perpage'=>$pondfootageMediaData['max_per_page'],'tp'=>'2');
            }
        }
        return array('imgfootage'=>$all_products,'total'=>0,'perpage'=>20,'tp'=>'2');
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
    
}
