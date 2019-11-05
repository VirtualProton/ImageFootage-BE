<?php
namespace App\Http\PantherMedia;
use GuzzleHttp\Exception\GuzzleException;
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
        $result = $client->post('http://rest.panthermedia.net/v1.0/host-info', [
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
                'content_type'=>'application/json'
            ]
        ]);
        print_r($result); die;
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


 public function search($keyword){
    $serach = $keyword['search'];
    $this->access_key = $this->getAccessKey();
      // echo $this->access_key; die;
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
                'page'=>0,
                'limit'=>100,
                'extra_info'=>"preview,preview_high,width,height,copyright,date,keywords,title,description,editorial,extended,packet,subscription,premium,rights_managed,mimetype,model_id,model_release,property_release,author_username,author_realname,adult_content",
                'filters'=>'sort: date; type: photos'
            ]
        ]);
        if ($response->getBody()) {
            $contents = json_decode($response->getBody(), true);
            //$contents = $response->getBody();
            return $contents;

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

  public function getPriceFromList($media){
       if(count($media)>0){
           
       }
  }

}

?>
