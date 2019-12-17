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
           $product_details_data = $footageMedia->search($keyword);
           if (isset($product_details_data['items'][0]['id'])) {
               $pond_id_withprefix = $product_details_data['items'][0]['id'];
               if (strlen($product_details_data['items'][0]['id']) < 9) {
                   $add_zero = 9 - (strlen($product_details_data['items'][0]['id']));
                   for ($i = 0; $i < $add_zero; $i++) {
                       $pond_id_withprefix = "0" . $pond_id_withprefix;
                   }
               }
           }
           $product_details = array($product_details_data,$pond_id_withprefix.'_main_xl.mp4');
        }else{
            $product = new Product();
            $product_details = $product->getProductDetail($media_id,$type);
        }
        return response()->json($product_details);
    }


    

}
