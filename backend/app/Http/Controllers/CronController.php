<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SearchRequest;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use App\Http\PantherMedia\ImageApi;
use App\Http\Pond5\FootageApi;
use App\Models\Product;
use App\Models\Common;
use  App\Models\ProductCategory;
use CORS;

class CronController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->product = new Product();

    }

    public function pantherImageUpload(){
        ini_set('max_execution_time', 0);
        //$product = new Product();
        //$all_products = $product->getProducts($keyword);
        $home_categories = array('COVID-19','Summer','Work from Home','Mothers day','Earth Day','Nature');
        foreach($home_categories as $percategory){
        $keyword['search'] = $percategory;
        $pantherMediaImages = new ImageApi();
        $pantharmediaData = $pantherMediaImages->search($keyword);
        //echo "<pre>";
        //print_r($pantharmediaData); die;
        $common = new Common();
        $category_id = $common->checkCategory($percategory);
        if(count($pantharmediaData) > 0){
            $this->product->savePantherImage($pantharmediaData,$category_id);
        }    

        //print_r($pantharmediaData); die;

    }
        //return array('api'=>$pantharmediaData);
    }

    public function pantherImageUploadCategory(){
        ini_set('max_execution_time', 0);
        //$product = new Product();
        //$all_products = $product->getProducts($keyword);
       // $home_categories = array('COVID-19','Summer','Work from Home','Mothers day','Earth Day','Nature');
         $categories = ProductCategory::get()->toArray();
        foreach($categories as $percategory){
            $keyword['search'] = $percategory['category_name'];
            $pantherMediaImages = new ImageApi();
            $pantharmediaData = $pantherMediaImages->search($keyword);
            //echo "<pre>";
            //print_r($pantharmediaData); die;

            if(count($pantharmediaData) > 0){
                $this->product->savePantherImage($pantharmediaData,$percategory['category_id']);
            }

            //print_r($pantharmediaData); die;

        }
        //return array('api'=>$pantharmediaData);
    }
    public function pantherImageUpdate(){
        ini_set('max_execution_time', 0);
        $cat=[53,54,55,56,57,3,4,5,40,15,8,10,12,17,20,23,13,24,26,31,52,34];
        DB::enableQueryLog();
        $products = Product::where('product_web','=','2')
                    ->whereIn('product_category',$cat)
                    //->whereRaw("date(updated_at) < '2020-04-02'")
                    ->orderBy('id','desc')
                    ->get()
                    ->toArray();
        //dd(DB::getQueryLog());
       // print_r($products); die;
        foreach($products as $perproduct){
            $keyword['search'] = $perproduct['api_product_id'];
            //echo $keyword['search'];
            $pantherMediaImages = new ImageApi();
            $pantharmediaData = $pantherMediaImages->get_media_info_cron($keyword['search']);
            //echo "<pre>";
            //print_r($pantharmediaData); die;
            if(count($pantharmediaData) > 0){
                $this->product->updatePantherImage($pantharmediaData);
              }

            //print_r($pantharmediaData); die;

        }

        //return array('api'=>$pantharmediaData);
    }
    // public function index(SearchRequest $request){
    //     $getKeyword = request(['search', 'productType']);
    //     $keyword = array();
    //     $keyword['search'] = $getKeyword['search'];
    //     $keyword['productType']['id']= $getKeyword['productType'];
    //     if($keyword['productType']['id']=='1'){
    //        $all_products = $this->getImagesData($keyword);
    //     }else if($keyword['productType']['id']=='2'){
    //         $all_products =$this->getFootageData($keyword);
    //     }else{
    //         $this->getImagesData($keyword);
    //         $this->getFootageData($keyword);
    //     }

    //     return response()->json($all_products);
    // }

    // public function getImagesData($keyword){
    //     $product = new Product();
    //     $all_products = $product->getProducts($keyword);
    //     $pantherMediaImages = new ImageApi();
    //     $pantharmediaData = $pantherMediaImages->search($keyword);
    //     return array('imgfootage'=>$all_products,'api'=>$pantharmediaData);
    // }

    // public function getFootageData($keyword){
    //     $product = new Product();
    //     $all_products = $product->getProducts($keyword);
    //     $footageMedia = new FootageApi();
    //     $pondfootageMediaData = $footageMedia->search($keyword);
    //     return array('imgfootage'=>$all_products,'api'=>$pondfootageMediaData);
    // }

    public function pond5Upload()
    {
        ini_set('max_execution_time', 0);
        //$product = new Product();
        //$all_products = $product->getProducts($keyword);
        $home_categories = array('COVID-19','Summer','Work from Home','Mothers day','Earth Day','Nature');
        foreach ($home_categories as $percategory) {
            $keyword['search'] = $percategory;
            $footageMedia = new FootageApi();
            $pondfootageMediaData = $footageMedia->search($keyword,[]);
            $common = new Common();
            $category_id = $common->checkCategory($percategory);
            if (count($pondfootageMediaData) > 0) {
                //echo "<pre>";
                //print_r($pondfootageMediaData); die;
                $this->product->savePond5Image($pondfootageMediaData, $category_id);
            }
        }
    }

    public function pond5UploadCategory()
    {
        ini_set('max_execution_time', 0);
        //$product = new Product();
        //$all_products = $product->getProducts($keyword);
        //$home_categories = array('COVID-19','Summer','Work from Home','Mothers day','Earth Day','Nature');
        $categories = ProductCategory::get()->toArray();
        foreach ($categories as $percategory) {
            $keyword['search'] = $percategory['category_name'];
            $footageMedia = new FootageApi();
            $pondfootageMediaData = $footageMedia->search($keyword,[]);
            //$common = new Common();
            //$category_id = $common->checkCategory($percategory);
            if (count($pondfootageMediaData) > 0) {
                //echo "<pre>";
                //print_r($pondfootageMediaData); die;
                $this->product->savePond5Image($pondfootageMediaData, $percategory['category_id']);
            }
        }
    }



}
