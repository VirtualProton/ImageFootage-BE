<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use App\Http\PantherMedia\ImageApi;
use App\Http\Pond5\FootageApi;
use App\Models\Product;
use CORS;

class MediaController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function index($media_id,$origin,$type){
       if($origin=='2'){
           $imageMedia = new ImageApi();
           $product_details = $imageMedia->get_media_info($media_id);
        }else if($origin=='3'){
           $keyword['search'] = $media_id;
           $footageMedia = new FootageApi();
           $product_details = $footageMedia->search($keyword);
        }else{
            $product = new Product();
            $product_details = $product->getProductDetail($media_id,$type);
        }
        return response()->json($product_details);
    }


    

}
