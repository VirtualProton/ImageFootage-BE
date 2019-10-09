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
        $product = new Product();
        $all_products = $product->getProducts($keyword);
        $pantherMediaImages = new ImageApi();
         $pantherMediaImages->search($keyword);
       // return response()->json($all_products);
    }
}
