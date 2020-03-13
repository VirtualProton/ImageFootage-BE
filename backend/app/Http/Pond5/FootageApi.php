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
    public function search($keyword,$limit=30,$page=0){
        $serach = $keyword['search'];
        if(isset($keyword['pagenumber'])){
            $page = $keyword['pagenumber'];
        }
        $search_cmd= array();
        //$search_cmd['command'] = 'search';
        $search_cmd['query'] = $serach;
        $search_cmd['bm'] = '4095';
        $search_cmd['sb'] = '1';
        $search_cmd['no'] = $limit;
        $search_cmd['p'] = $page;
        $search_cmd['col'] = '2047';
        $search_cmd["secret"] = $this->api_secret;
        $search_cmd["key"] =  $this->api_key;
        //print_r($search_cmd); die;
        $data_req = json_encode($search_cmd);
        $curl = curl_init();
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $this->url,
            CURLOPT_USERAGENT => '',
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => $search_cmd
        ]);
        // Send the request & save response to $resp
        $response = curl_exec($curl);
        curl_close($curl);
        $contents = json_decode($response, true);
        return $contents;
        // Close request to clear up some resources

 }

  public function download($data,$id){
      ini_set('max_execution_time',0);
        if(count($data)>0){
            $search_cmd= array();
           //$search_cmd['command'] = 'search';
            $search_cmd['bid'] = $data['id'];
            $search_cmd['v'] = $data['id'];
            $search_cmd['vs'] = $data['vs'];
            $search_cmd['oi'] = $data['offset'];
            $search_cmd['pr'] = $data['pr'];
            $search_cmd['tr'] = $id;
            $search_cmd["secret"] = $this->api_secret;
            $search_cmd["key"] =  $this->api_key;
            //print_r($search_cmd); die;
            $data_req = json_encode($search_cmd);
            $curl = curl_init();
            // Set some options - we are passing in a useragent too here
            curl_setopt_array($curl, [
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => "https://reseller-preprod.pond5.com/api/download",
                CURLOPT_USERAGENT => '',
                CURLOPT_POST => 1,
                CURLOPT_POSTFIELDS => $search_cmd
            ]);
            // Send the request & save response to $resp
            $response = curl_exec($curl);
            curl_close($curl);
            $contents = json_decode($response, true);
            return $contents;
        }
  }


}

?>
