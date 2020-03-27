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
    public function search($keyword,$getKeyword,$limit=30,$page=0){
         //print_r($getKeyword); die;
        $serach = $keyword['search'];
        if(isset($keyword['pagenumber'])){
            $page = $keyword['pagenumber'];
        }
        //print_r($getKeyword); die;
        if(isset($getKeyword['letest']) && $getKeyword['letest']=='1'){
            $sort = '6' ;
        }else if(isset($getKeyword['populer']) && $getKeyword['populer']=='1'){
            $sort = '8' ;
        }else{
            $sort = '1' ;
        }
        $filters ='';
        if(isset($getKeyword['searchFilter']) && count($getKeyword['searchFilter'])>0){
            if(count($getKeyword['searchFilter']['fps'])>0){
                foreach($getKeyword['searchFilter']['fps'] as $perfps){
                    if($perfps=='60+'){
                        $filters .= ' fpsgt:'.$perfps;
                    }else{
                        $filters .= ' fps:'.$perfps;
                    }

                }
            }
            if(count($getKeyword['searchFilter']['people'])>0){
                foreach($getKeyword['searchFilter']['people'] as $perpeople){
                    if($perpeople=='6'){
                        $filters .= ' people:0';
                    }elseif($perpeople!='6' && $perpeople>3 ){
                        $filters .= ' people:3';
                    }else{
                        $filters .= ' people:'.$perpeople;
                    }
                }
            }
            if(count($getKeyword['searchFilter']['gender'])>0){
                foreach($getKeyword['searchFilter']['gender'] as $pergender){
                    if($pergender=='4'){
                        $filters .= ' gender:3';
                    }else if($pergender=='1'){
                        $filters .= ' gender:2';
                    }elseif($pergender=='2'){
                        $filters .= ' gender:1';
                    }else{
                        $filters .= ' gender:3';
                    }
                }
            }

            if(count($getKeyword['searchFilter']['resolution'])>0){
                $array  = array("8K"=>"5K+","4K"=>"4K","HD1080"=>"HD(1080)","HD720"=>"HD(720)","2K"=>"2K","SD"=>"SD");
                $rs =[];
                foreach($getKeyword['searchFilter']['resolution'] as $resoulution){
                     $resolutionkey = array_search($resoulution,$array);
                     array_push($rs,$resolutionkey);
                }
                $all = implode(":",$rs);
                $filters .= " resolutions:".$all;
            }
            if($getKeyword['durationless']!=0 && $getKeyword['durationgrt']!=2) {
                $filters .= " durationgt:" . $getKeyword['durationless'];
                $filters .= " durationlt:" . $getKeyword['durationgrt'];
            }
        }

        $search_cmd= array();
        //$search_cmd['command'] = 'search';
        $search_cmd['query'] = $filters.' '.$serach;
        $search_cmd['bm'] = '4095';
        $search_cmd['sb'] = $sort;
        $search_cmd['no'] = $limit;
        $search_cmd['p'] = $page;
        $search_cmd['col'] = '3071';
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
