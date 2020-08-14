<?php
namespace App\Http\PantherMedia;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\RequestException;

use GuzzleHttp\Client;
class ImageApi {

     private  $api_key =  '80b310f4750374158b8dfb065ee9d0753481a050c68798033bc74efb60718349';
     private $api_secret= 'fd9f2adce5715dc1309be4b3af1c77226ffa430fa42b7bfb5528546404cc56bb';
     private $timestamp =NULL;
     private $nonce ="imagefootage";
     private $algo = "sha1";
     private $access_key =NULL;

     public function  __construct(){

     }
     public function getHostInfo(){
        $this->access_key = $this->getAccessKey();
      // echo $this->access_key; die;
        $client = new Client(); //GuzzleHttp\Client
       // $client->setDefaultOption('headers', array('Content-Type' => 'application/x-www-form-urlencoded','Accept-Version'=>'1.0'));
         try {
             $result = $client->post('https://rest.panthermedia.net/v1.0/host-info', [
                 'headers' => [
                     'Content-Type' => 'application/x-www-form-urlencoded',
                     'Accept-Version' => '1.0'
                 ],
                 'form_params' => [
                     'api_key' => $this->api_key,
                     'access_key' => $this->access_key,
                     'timestamp' => $this->timestamp,
                     'nonce' => $this->nonce,
                     'algo' => $this->algo,
                     'content_type' => 'application/json'
                 ]
             ]);
         }catch (GuzzleHttp\Exception\BadResponseException  $e){
            //echo "heelo"; die;
             //echo Psr7\str($e->getResponse());
             //echo $e->getCode();
             //echo $response = $e->getResponse();
            // echo $responseBodyAsString = $response->getBody()->getContents();
             //die;
         }
        //print_r($result); die;
     }


    private function str_random($len = 8, $allowed_charset=null) {
        if($allowed_charset === null){
           $allowed_charset = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        }
        return substr(str_shuffle($allowed_charset), 0, $len);
    }

 public function getAccessKey(){
    $this->nonce = $this->str_random();
    $this->timestamp = str_replace('+0000','UTC', gmdate(DATE_RSS));
    $data = $this->timestamp.$this->api_key.$this->nonce;
    $access_key = hash_hmac('sha1', $data, $this->api_secret);
    return $access_key;
 }


 public function search($keyword,$getKeyword=[],$limit=30,$page=0){
    $serach = $keyword['search'];
    if(isset($getKeyword['pagenumber']) && $getKeyword['pagenumber']>'0'){
        $page = $getKeyword['pagenumber'];
    }
    if(isset($getKeyword['letest']) && $getKeyword['letest']=='1'){
       $sort = 'sort: date;' ;
   }else if(isset($getKeyword['populer']) && $getKeyword['populer']=='1'){
       $sort = 'sort: buy;' ;
   }else{
       $sort = 'sort: rel;' ;
   }
       $product_filter_data ='people_number:all;';
       if(isset($getKeyword['product_people']) && !empty($getKeyword['product_people'])){
             $peoples = explode(',',$getKeyword['product_people']);
             $count = count($peoples);
             $people_filter = $peoples[$count-1];
             if($people_filter=='6'){
                $product_filter_data = 'people_number:people_0;';
             }else if($people_filter=='5'){
                 $product_filter_data = 'people_number:people_any;';
             }else{
                 $product_filter_data = 'people_number:people_'.$people_filter.';';
             }
       }
     $gender_filter_data ='';
     if(isset($getKeyword['product_gender']) && !empty($getKeyword['product_gender'])){
         $genders = explode(',',$getKeyword['product_gender']);
         $count = count($genders);
         $gender_filter = $genders[$count-1];
         if($gender_filter=='1'){
             $gender_filter_data = 'people_gender:m;';
         }else{
             $gender_filter_data = 'people_gender:f;';
         }
     }
     $ethinicities_filter_data ='people_ethnicity:all;';
     if(isset($getKeyword['product_ethinicities']) && !empty($getKeyword['product_ethinicities'])){
         $ethinicities = explode(',',$getKeyword['product_ethinicities']);
         $count = count($ethinicities);
         $ethinicities_filter = $ethinicities[$count-1];
         if($ethinicities_filter=='2' || $ethinicities_filter=='4') {
             $ethinicities_filter_data = 'people_ethnicity:f;';
         }else if($ethinicities_filter=='8' || $ethinicities_filter=='5'){
             $ethinicities_filter_data = 'people_ethnicity:e;';
         }else if($ethinicities_filter=='7' || $ethinicities_filter=='1'){
             $ethinicities_filter_data = 'people_ethnicity:a;';
         }else if($ethinicities_filter=='3'){
             $ethinicities_filter_data = 'people_ethnicity:xd;';
         }else if($ethinicities_filter=='9'){
             $ethinicities_filter_data = 'people_ethnicity:e;';
         }
     }
     if(isset($getKeyword['product_imagesizes']) && !empty($getKeyword['product_imagesizes'])){
         $imagesizes = explode(',',$getKeyword['product_imagesizes']);
         $count = count($imagesizes);
         $imagesize_filter = $imagesizes[$count-1];
     }
     if(isset($getKeyword['product_locations']) && !empty($getKeyword['product_locations'])){
         $locations = explode(',',$getKeyword['product_locations']);
         $count = count($locations);
         $location_filter = $locations[$count-1];
     }
     $color_filter ='';
     if(isset($getKeyword['product_colors']) && !empty($getKeyword['product_colors'])){
         //$colors = explode(',',$getKeyword['product_colors']);
         //$count = count($colors);
         //$color_filter = $colors[$count-1];
         if(trim($getKeyword['product_colors']) != 'Pick Color') {
             $color_filter = "color:".strtoupper(str_replace('#','',$getKeyword['product_colors'])).';';
         }
     }
     $tolerance='';
     if(isset($getKeyword['tolerance']) && !empty($getKeyword['tolerance'])){
         $tolerance = "color_tolerance:".$getKeyword['tolerance'].';';
     }
     if(isset($getKeyword['product_imagetypes']) && !empty($getKeyword['product_imagetypes'])){
         $types = explode(',',$getKeyword['product_imagetypes']);
         $count = count($types);
         $type_filter = $types[$count-1];
     }
     $orientation_filter_data ='orientation:all;';
     if(isset($getKeyword['product_orientation']) && !empty($getKeyword['product_orientation'])){
         $orientation = explode(',',$getKeyword['product_orientation']);
         $count = count($orientation);
         $orientation_filter = $orientation[$count-1];
         if($orientation_filter=='1'){
             $orientation_filter_data ='orientation:vertical;';
         }else if($orientation_filter=='2'){
             $orientation_filter_data ='orientation:horizontal;';
         }else if($orientation_filter=='3'){
             $orientation_filter_data ='orientation:square;';
         }else if($orientation_filter=='4'){
             $orientation_filter_data ='orientation:panorama;';
         }
     }
     $liencence_filter_data ='license:commercial;';
      if(isset($getKeyword['product_editorial']) && !empty($getKeyword['product_editorial'])){
          $liencence_filter_data = 'license:editorial;';
      }

    $this->access_key = $this->getAccessKey();
      // echo $this->access_key; die;
      try{
        $client = new Client(); //GuzzleHttp\Client
        $response = $client->post('http://rest.panthermedia.net/search', [
            'headers'=>[
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Accept-Version'=>'1.0'
            ],
            'form_params' => [
                'api_key' => $this->api_key,
                'access_key' => $this->access_key,
                'timestamp' => $this->timestamp,
                'nonce' => $this->nonce,
                'algo' => $this->algo,
                'content_type'=>'application/json',
                'lang'=>'en',
                'q'=>$serach,
                'page'=>$page,
                'limit'=>$limit,
                'extra_info'=>"preview,preview_high,width,height,copyright,date,keywords,title,description,editorial,extended,packet,subscription,premium,rights_managed,mimetype,model_id,model_release,property_release,author_username,author_realname,adult_content",
                'filters'=> $sort.'type: photos;'.$product_filter_data.$color_filter.$tolerance.$gender_filter_data.$ethinicities_filter_data.$orientation_filter_data.$liencence_filter_data
            ]
        ]);
       
        if ($response->getBody()) {
            $contents = json_decode($response->getBody(), true);
            //$contents = $response->getBody();
            return $contents;

        }
     }catch (BadResponseException $ex) {
          $response = $ex->getResponse();
          $jsonBody = (string) $response->getBody();
          print_r($jsonBody); die;
         }
      }

 public function get_media_info($media_id){
        $this->access_key = $this->getAccessKey();
        // echo $this->access_key; die;
        $client = new Client(); //GuzzleHttp\Client
        $response = $client->post('http://rest.panthermedia.net/get-media-info', [
            'headers'=>[
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Accept-Version'=>'1.0'
            ],
            'form_params' => [
                'api_key' => $this->api_key,
                'access_key' => $this->access_key,
                'timestamp' => $this->timestamp,
                'nonce' => $this->nonce,
                'algo' => $this->algo,
                'content_type'=>'application/json',
                'lang'=>'en',
                'id_media'=>$media_id,
                'show_articles'=>'yes',
                'show_top10_keywords'=>'yes'
            ]
        ]);
        if ($response->getBody()) {
            $contents = json_decode($response->getBody(), true);
            //$contents = $response->getBody();
            return $contents;

        }
 }

  public function getPriceFromList($media,$product_id= NULL){
        if(count($media)>0){
            //echo "<pre>";
            //print_r($media); die;
            $products = array();
            //foreach($media as $eachmedia){
                $products[0]['name'] = $media['metadata']['title'];
                $products[0]['api_product_id'] = $media['media']['id'];
                $products[0]['product_code'] = isset($product_id)?$product_id:$media['media']['id'];
                $products[0]['description'] = str_replace('http','https',$media['metadata']['description']);
                $products[0]['thumbnail_image'] = str_replace('http','https',$media['media']['preview_url_no_wm']);
                $products[0]['type'] = "Royalty Free";
                $products[0]['product_web'] = "2";
                $products[0]['small_size'] = (isset($media['articles']['singlebuy_list']['singlebuy'][0]['sizes']['article'][1]['price']))?$media['articles']['singlebuy_list']['singlebuy'][0]['sizes']['article'][1]['price']*80:"";
                $products[0]['medium_size'] = (isset($media['articles']['singlebuy_list']['singlebuy'][0]['sizes']['article'][2]['price']))?$media['articles']['singlebuy_list']['singlebuy'][0]['sizes']['article'][2]['price']*80:"";;
                $products[0]['large_size'] = (isset($media['articles']['singlebuy_list']['singlebuy'][0]['sizes']['article'][3]['price']))?$media['articles']['singlebuy_list']['singlebuy'][0]['sizes']['article'][3]['price']*80:"";;
                $products[0]['x_large_size'] = (isset($media['articles']['singlebuy_list']['singlebuy'][0]['sizes']['article'][4]['price']))?$media['articles']['singlebuy_list']['singlebuy'][0]['sizes']['article'][4]['price']*80:"";;
                // $products[0]['small_size'] = $media['articles']['singlebuy_list']['singlebuy'][0]['sizes']['article'][1]['price']*80;
                // $products[0]['medium_size'] = $media['articles']['singlebuy_list']['singlebuy'][0]['sizes']['article'][2]['price']*80;;
                // $products[0]['large_size'] = $media['articles']['singlebuy_list']['singlebuy'][0]['sizes']['article'][3]['price']*80;;
                // $products[0]['x_large_size'] = $media['articles']['singlebuy_list']['singlebuy'][0]['sizes']['article'][4]['price']*80;;
            //}
            return $products;
        }
  }

  public function download($data,$id){
      $this->access_key = $this->getAccessKey();
      // echo $this->access_key; die;
      if(count($data['product']['selected_product'])>0){
         $id = $data['product']['selected_product']['id'];
      }else{
          $id = $data['product']['extended']['id'];
      }
      $client = new Client(); //GuzzleHttp\Client
      $response = $client->post('http://rest.panthermedia.net/download-media', [
          'headers'=>[
              'Content-Type' => 'application/x-www-form-urlencoded',
              'Accept-Version'=>'1.0'
          ],
          'form_params' => [
              'api_key' => $this->api_key,
              'access_key' => $this->access_key,
              'timestamp' => $this->timestamp,
              'nonce' => $this->nonce,
              'algo' => $this->algo,
              'content_type'=>'application/json',
              'lang'=>'en',
              'id_media'=> $data['product']['product_info']['media']['id'],
              'id_article'=>$id,
              'test'=>'yes'
          ]
      ]);
      if ($response->getBody()) {
          $contents = json_decode($response->getBody(), true);
          $redownload = $contents['download_status']['id_download'];
          //print_r($contents); die;

          $client2 = new Client(); //GuzzleHttp\Client
          $response2 = $client2->post('https://rest.panthermedia.net/download-media', [
              'headers'=>[
                  'Content-Type' => 'application/x-www-form-urlencoded',
                  'Accept-Version'=>'1.0'
              ],
              'form_params' => [
                  'api_key' => $this->api_key,
                  'access_key' => $this->access_key,
                  'timestamp' => $this->timestamp,
                  'nonce' => $this->nonce,
                  'algo' => $this->algo,
                  'content_type'=>'application/json',
                  'lang'=>'en',
                  'id_media'=> $data['product']['product_info']['media']['id'],
                  'queue_hash'=>$contents['download_status']['queue_hash'],
                  'test'=>'yes'
              ]
          ]);
        if ($response2->getBody()) {
            echo $this->timestamp;
            echo "<br/>";
            echo $this->access_key;
            $downloadcontents = json_decode($response2->getBody());
            print_r($downloadcontents);
            die;
            return $downloadcontents;
        }

      }
  }

}

?>
