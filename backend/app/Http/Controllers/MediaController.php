<?php

namespace App\Http\Controllers;

use App\Models\Common;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use App\Http\PantherMedia\ImageApi;
use App\Http\Pond5\FootageApi;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Api;
use App\Models\UserPackage;
use CORS;
use Image;

class MediaController extends Controller
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

    public function index($media_id,$origin,$type){
       if($origin=='2'){
           $imageMedia = new ImageApi();
           $product_details_data = $imageMedia->get_media_info($media_id);
           $b64image = base64_encode(file_get_contents($product_details_data['media']['preview_url_no_wm']));

		   $img = Image::make($product_details_data['media']['preview_url_no_wm']);
    		// insert watermark at bottom-right corner with 10px offset 
    		$downlaod_image1=$img->insert(public_path('images/logoimage_new.png'), 'bottom-right', 10, 10);
			$time=time();
			//$img->save(public_path('images/dump/'.$time.'.jpg'));
			//$img->encode('jpg');
			$type = 'jpg';
			$downlaod_image = 'data:image/' . $type . ';base64,' . base64_encode($img);
			//unlink(public_path('images/dump/'.$time.'.jpg'));
           if (count($product_details_data) > 0) {
               $imagefootage_id = $this->product->savePantherImagedetail($product_details_data, 0);
           }
           $product_details= array($product_details_data,$imagefootage_id,$downlaod_image);
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
               $b64image = base64_encode(file_get_contents($product_details_data['icon_base'].$pond_id_withprefix.'_main_xl.mp4'));
               $downlaod_image= 'data:video/mp4;base64,'.$b64image;
               if (count($product_details_data) > 0) {
                      $imagefootage_id = $this->product->savePond5Image($product_details_data, 0);
               }

           }
           $product_details = array($product_details_data,$pond_id_withprefix.'_main_xl.mp4',$pond_id_withprefix.'_iconl.jpeg',$imagefootage_id,$downlaod_image);
        }else{
            $product = new Product();
            $product_details = $product->getProductDetail($media_id,$type);
        }
        return response()->json($product_details);
    }


    public function categoryListApi(){
       $categories  = ProductCategory::select('category_id','category_name')
                        ->where('is_display_home',1)
                        ->orderBy('category_id','desc')
                        ->limit(24)
                        ->get()
                        ->toArray();
        if(count($categories)>0){
            $i=0;
            $catArray = array();
            $tempArray= array();
            foreach($categories as $k=>$category){
                if($k==0){
                    array_push($tempArray,$category);
                    $catArray[$i] = $tempArray;
                }else{
                if(($k)%6 != '0'){
                    array_push($tempArray,$category);
                    $catArray[$i] = $tempArray;
                }else{
                    $tempArray= array();
                    array_push($tempArray,$category);
                    $i++;
                    $catArray[$i] = $tempArray;
                }
                }
            }

            return response()->json($catArray);
        }else{
            return response()->json(array('status'=>'0','message'=>"No category found"));
        }

    }


    public function download(Request $request){
        $allFields = $request->all();
        //print_r($allFields); die;
        $tokens=json_decode($allFields['product']['token'],true);
        $id = $tokens['Utype'];
        if($allFields['product']['type']==2){
            $flag ='Image';
        }else{
            $flag ='Footage';
        }
        $pacakegalist= UserPackage::whereIn('payment_status',['Completed','Transction Success'])
            ->where('user_id','=',$id)
            ->where('package_type','=',$flag)
            ->where('package_expiry_date_from_purchage','>',Now())
            //->select()
            ->get()->toArray();
        $download = 0;

      if(count($pacakegalist)>0){
          foreach($pacakegalist as $perpack){
              if($perpack['downloaded_product'] < $perpack['package_products_count']){
                  $download =1;
              }
          }
      }

      if($download==1) {
          if ($allFields['product']['type'] == 3) {
              $footageMedia = new FootageApi();
              $product_details_data = $footageMedia->download($allFields['product']['selected_product'], $id);
              return response()->json($product_details_data);
          } else if ($allFields['product']['type'] == 2) {
              $imageMedia = new ImageApi();
              $product_details_data = $imageMedia->download($allFields, $id);
              return response()->json($product_details_data);
          }
      }
    }


}
