<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SearchRequest;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use App\Http\PantherMedia\ImageApi;
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

    public function index(SearchRequest $request){
        $keyword = request(['search', 'productType']);
        if($keyword['productType']['id']=='1'){
           $all_products = $this->getImagesData($keyword);
        }else if($keyword['productType']['id']=='2'){
           $this->getFootageData($keyword);
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

}
