<?php
namespace App\Http\Pond5;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
class FootageApi {

     private  $api_key =  '22frBD55299';
     private $api_secret= 'v72OkjirkV6D299';
     private $url = "https://reseller-preprod.pond5.com/api/search";
     
     public function  __construct(){

     }
   
  private function str_random($len = 8, $allowed_charset=null) {
        if($allowed_charset === null){
           $allowed_charset = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        }
        return substr(str_shuffle($allowed_charset), 0, $len);
    }
    public function search($keyword){
        $serach = $keyword['search'];
        $search_cmd= array();
        //$search_cmd['command'] = 'search';
        $search_cmd['query'] = $serach;
        $search_cmd['bm'] = '15';
        $search_cmd['sb'] = '1';
        $search_cmd['no'] = '25';
        $search_cmd['p'] = '0';
        $search_cmd['col'] = '15';
        $search_cmd["secret"] = $this->api_secret;
        $search_cmd["key"] =  $this->api_key;

       //Creating the json object with all data (this is usually wrapped in a subroutine since its always the same)
//        $json_object = array();
//        $json_object["api_key"] = $this->api_key;
//        $json_object["my_secret"] = $this->api_secret;
//        $json_object["ver"] = 1;
//        $json_object["commands_json"] = json_encode( array($search_cmd) );
//
//        //NOTE: the commands_hash must always have the string 'dragspel' appended
//        $json_object["commands_hash"] = md5($json_object["commands_json"] . $this->api_secret . 'dragspel');
//
//        $data_req = json_encode($json_object);
         $data_req = json_encode($search_cmd);

        //the post argument
        //$post_val = "api=" . urlencode($data_req);
         $client = new Client(); //GuzzleHttp\Client
            $response = $client->post($this->url, [
                'headers'=>[
                    'Content-Type' => 'application/json',
                ],
                'body' => $data_req,

            ]);
            if ($response->getBody()) {
                $contents = json_decode($response->getBody(), true);
                //$contents = $response->getBody();
                return $contents;

            }
 }


}

?>
