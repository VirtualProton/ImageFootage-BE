<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SearchRequest;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use App\Http\PantherMedia\ImageApi;
use App\Http\Pond5\FootageApi;
use App\Models\Product;
use Illuminate\Support\Str;
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
//        $keyword['search'] = '';
//        $pantherMediaImages = new ImageApi();
//        $pantharmediaData = $pantherMediaImages->search($keyword);
        return array('api'=>$all_products);
    }
    public function index(SearchRequest $request){
        ini_set('max_execution_time', 0);
        $getKeyword = $request->all();
        //dd($getKeyword);
        $keyword = array();
        $keyword['search'] = $getKeyword['search'];
        $keyword['productType']['id']= $getKeyword['productType'];
        if($keyword['productType']['id']=='1'){
           $all_products = $this->getImagesData($keyword,$getKeyword);
        }else if($keyword['productType']['id']=='2'){
            $all_products =$this->getFootageData($keyword);
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
		//print_r($getKeyword); die;
		$keyword = array();
		$keyword['search'] = $getKeyword['searchData'];
		if($getKeyword['imgtype']=='2') {
            $pantherMediaImages = new ImageApi();
            $pantharmediaData = $pantherMediaImages->search($keyword, $getKeyword, 30);
            if (count($pantharmediaData) > 0) {
                foreach ($pantharmediaData['items']['media'] as $eachmedia) {
                    if (isset($eachmedia['id'])) {
                        $media = array(
                            'product_id' => $eachmedia['id'],
                            'api_product_id' => $eachmedia['id'],
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
                }

            }
        }else{
            $footageMedia = new FootageApi();
            $pondfootageMediaData = $footageMedia->search($keyword,'30');

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
                            'api_product_id' => $eachmedia['id'],
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
            }
        }
        return array('imgfootage'=>$all_products);
	}

    public function getImagesData($keyword,$getKeyword){
        $all_products = [];
        $product = new Product();
        //print_r($keyword); die;
        $all_products = $product->getProducts($keyword);
        $flag =0;
       // print_r($all_products); die;
        if(count($all_products)>0){
            if(isset($all_products['code'])&& $all_products['code']=='1'){
                $all_products = $all_products['data'];
                $flag =1;
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
                            'api_product_id' => $eachmedia['id'],
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
                }
            }
        }

        return array('imgfootage'=>$all_products);
    }

    public function getFootageData($keyword){
        $product = new Product();
        $all_products =[];
        $all_products = $product->getProducts($keyword);
        $flag =0;
        if(count($all_products)>0){
            if(isset($all_products['code'])&& $all_products['code']=='1'){
                $all_products = $all_products['data'];
                $flag =1;
            }
        }
        if($flag=='0'){

            $footageMedia = new FootageApi();
            $pondfootageMediaData = $footageMedia->search($keyword);

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
                            'api_product_id' => $eachmedia['id'],
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
            }
        }
        return array('imgfootage'=>$all_products);
    }

    

}
