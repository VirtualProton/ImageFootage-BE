<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SearchRequest;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use App\Http\PantherMedia\ImageApi;
use App\Http\Pond5\FootageApi;
use App\Models\Product;
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
        $getKeyword = request(['search', 'productType']);
        $keyword = array();
        $keyword['search'] = $getKeyword['search'];
        $keyword['productType']['id']= $getKeyword['productType'];
        if($keyword['productType']['id']=='1'){
           $all_products = $this->getImagesData($keyword);
        }else if($keyword['productType']['id']=='2'){
            $all_products =$this->getFootageData($keyword);
        }else{
            $this->getImagesData($keyword);
            $this->getFootageData($keyword);
        }

        return response()->json($all_products);
    }

    public function getImagesData($keyword){
        $product = new Product();
        $all_products = $product->getProducts($keyword);
        $pantherMediaImages = new ImageApi();
        $pantharmediaData = $pantherMediaImages->search($keyword);
        return array('imgfootage'=>$all_products,'api'=>$pantharmediaData);
    }

    public function getFootageData($keyword){
        $product = new Product();
        $all_products = $product->getProducts($keyword);
        $footageMedia = new FootageApi();
        $pondfootageMediaData = $footageMedia->search($keyword);
        return array('imgfootage'=>$all_products,'api'=>$pondfootageMediaData);
    }

    

}
