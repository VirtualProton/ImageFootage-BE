<?php

namespace App\Http\Pond5;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App;

class FootageApi
{

    private $api_key;
    private $api_secret;
    private $url;

    public function  __construct()
    {
        // $this->api_key =  'cJ70pBIk119';
        // $this->api_secret = 'j5weLX518rMP119';
        // $this->url = "https://api-reseller.pond5.com";
        $this->api_key = config('thirdparty.pond5.api_key');
        $this->api_secret = config('thirdparty.pond5.api_secret');
        $this->url = config('thirdparty.pond5.api_url');
    }

    private function str_random($len = 8, $allowed_charset = null)
    {
        if ($allowed_charset === null) {
            $allowed_charset = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        }
        return substr(str_shuffle($allowed_charset), 0, $len);
    }
    // public function search($keyword,$getKeyword,$limit=30,$page=0){

    //      //print_r($getKeyword); die;
    //     $serach = $keyword['search'];
    //     $editorial = 0;
    //     $bittotal = 0;
    //     if(isset($keyword['pagenumber'])){
    //         $page = $keyword['pagenumber'];
    //     }
    //     //print_r($getKeyword); die;
    //     if(isset($getKeyword['letest']) && $getKeyword['letest']=='1'){
    //         $sort = '6' ;
    //     }else if(isset($getKeyword['populer']) && $getKeyword['populer']=='1'){
    //         $sort = '8' ;
    //     }else{
    //         $sort = '1' ;
    //     }
    //     $filters ='';
    //     if(isset($getKeyword['searchFilter']) && count($getKeyword['searchFilter'])>0){
    //         if(count($getKeyword['searchFilter']['fps'])>0){
    //             foreach($getKeyword['searchFilter']['fps'] as $perfps){
    //                 if($perfps=='60+'){
    //                     $filters .= ' fpsgt:'.$perfps;
    //                 }else{
    //                     $filters .= ' fps:'.$perfps;
    //                 }

    //             }
    //         }
    //         if(count($getKeyword['searchFilter']['people'])>0){
    //             foreach($getKeyword['searchFilter']['people'] as $perpeople){
    //                 if($perpeople=='6'){
    //                     $filters .= ' people:0';
    //                 }elseif($perpeople!='6' && $perpeople>3 ){
    //                     $filters .= ' people:3';
    //                 }else{
    //                     $filters .= ' people:'.$perpeople;
    //                 }
    //             }
    //         }
    //         if(count($getKeyword['searchFilter']['gender'])>0){
    //             foreach($getKeyword['searchFilter']['gender'] as $pergender){
    //                 if($pergender=='4'){
    //                     $filters .= ' gender:3';
    //                 }else if($pergender=='1'){
    //                     $filters .= ' gender:2';
    //                 }elseif($pergender=='2'){
    //                     $filters .= ' gender:1';
    //                 }else{
    //                     $filters .= ' gender:3';
    //                 }
    //             }
    //         }

    //         if(count($getKeyword['searchFilter']['resolution'])>0){
    //             $array  = array("8K"=>"5K+","4K"=>"4K","HD1080"=>"HD(1080)","HD720"=>"HD(720)","2K"=>"2K","SD"=>"SD");
    //             $bitmak  = array("16515087"=>"5K+","262144"=>"4K","1048576"=>"HD(1080)","2097152"=>"HD(720)","0"=>"2K","0"=>"SD");
    //             $rs =[];

    //             foreach($getKeyword['searchFilter']['resolution'] as $resoulution){
    //                  $resolutionkey = array_search($resoulution,$array);
    //                  $bit = array_search($resoulution,$bitmak);
    //                  $bittotal = $bittotal+$bit;
    //                  array_push($rs,$resolutionkey);
    //             }
    //             $all = implode(":",$rs);
    //             $filters .= " resolutions:".$all;
    //         }
    //         if($getKeyword['durationless']!=0 && $getKeyword['durationgrt']!=2) {
    //              $start = explode('.',$getKeyword['durationless']);
    //              $end = explode('.',$getKeyword['durationgrt']);
    //             $filters .= " durationgt:" .(($start[0]*60) + $start[1]);
    //             $filters .= " durationlt:" .(($end[0]*60) + $end[1]);
    //         }
    //         if(isset($getKeyword['product_editorial']) && !empty($getKeyword['product_editorial']) && $getKeyword['product_editorial']=='editorial'){
    //             $editorial = 1;
    //         }
    //     }

    //     //echo $bittotal; die;
    //     $search_cmd= array();
    //     //$search_cmd['command'] = 'search';
    //     $search_cmd['query'] = $filters.' '.$serach;
    //     $search_cmd['bm'] = ($bittotal!=0)?$bittotal:'2063';
    //     $search_cmd['sb'] = $sort;
    //     $search_cmd['no'] = $limit;
    //     $search_cmd['p'] = $page;
    //     $search_cmd['col'] = '3071';
    //     $search_cmd['editorial'] = $editorial;
    //     $search_cmd["secret"] = $this->api_secret;
    //     $search_cmd["key"] =  $this->api_key;
    //     //print_r($search_cmd); die;
    //     $data_req = json_encode($search_cmd);
    //     $curl = curl_init();
    //     // Set some options - we are passing in a useragent too here
    //     curl_setopt_array($curl, [
    //         CURLOPT_RETURNTRANSFER => 1,
    //         CURLOPT_URL => $this->url.'/api/search',
    //         CURLOPT_USERAGENT => '',
    //         CURLOPT_POST => 1,
    //         CURLOPT_POSTFIELDS => $search_cmd
    //     ]);
    //     // Send the request & save response to $resp
    //     $response = curl_exec($curl);
    //     curl_close($curl);
    //     $contents = json_decode($response, true);
    //     return $contents;
    //     // Close request to clear up some resources

    // }

    public function search($keyword, $getKeyword, $limit = 30, $page = 0)
    {
        $search = $keyword['search'];
        $editorial = 0;
        $bittotal = 0;
        if (isset($keyword['pagenumber'])) {
            $page = $keyword['pagenumber'];
        }
        //print_r($getKeyword); die;
        if (isset($getKeyword['letest']) && $getKeyword['letest'] == '1') {
            $sort = 'newest';
        } else if (isset($getKeyword['populer']) && $getKeyword['populer'] == '1') {
            $sort = 'popular';
        } else {
            $sort = 'default';
        }
        $filters = '';
        if (isset($getKeyword['searchFilter']) && count($getKeyword['searchFilter']) > 0) {
            if (count($getKeyword['searchFilter']['fps']) > 0) {
                foreach ($getKeyword['searchFilter']['fps'] as $perfps) {
                    if ($perfps == '60+') {
                        $filters .= ' fpsgt:' . $perfps;
                    } else {
                        $filters .= ' fps:' . $perfps;
                    }
                }
            }
            if (count($getKeyword['searchFilter']['people']) > 0) {
                foreach ($getKeyword['searchFilter']['people'] as $perpeople) {
                    if ($perpeople == '6') {
                        $filters .= ' people:0';
                    } elseif ($perpeople != '6' && $perpeople > 3) {
                        $filters .= ' people:3';
                    } else {
                        $filters .= ' people:' . $perpeople;
                    }
                }
            }
            if (count($getKeyword['searchFilter']['gender']) > 0) {
                foreach ($getKeyword['searchFilter']['gender'] as $pergender) {
                    if ($pergender == '4') {
                        $filters .= ' gender:3';
                    } else if ($pergender == '1') {
                        $filters .= ' gender:2';
                    } elseif ($pergender == '2') {
                        $filters .= ' gender:1';
                    } else {
                        $filters .= ' gender:3';
                    }
                }
            }

            if (count($getKeyword['searchFilter']['resolution']) > 0) {
                $array  = array("8K" => "5K+", "4K" => "4K", "HD1080" => "HD(1080)", "HD720" => "HD(720)", "2K" => "2K", "SD" => "SD");
                $bitmak  = array("16515087" => "5K+", "262144" => "4K", "1048576" => "HD(1080)", "2097152" => "HD(720)", "0" => "2K", "0" => "SD");
                $rs = [];

                foreach ($getKeyword['searchFilter']['resolution'] as $resoulution) {
                    $resolutionkey = array_search($resoulution, $array);
                    $bit = array_search($resoulution, $bitmak);
                    $bittotal = $bittotal + $bit;
                    array_push($rs, $resolutionkey);
                }
                $all = implode(":", $rs);
                $filters .= " resolutions:" . $all;
            }
            if ($getKeyword['durationless'] != 0 && $getKeyword['durationgrt'] != 2) {
                $start = explode('.', $getKeyword['durationless']);
                $end = explode('.', $getKeyword['durationgrt']);
                $filters .= " durationgt:" . (($start[0] * 60) + $start[1]);
                $filters .= " durationlt:" . (($end[0] * 60) + $end[1]);
            }
            if (isset($getKeyword['product_editorial']) && !empty($getKeyword['product_editorial']) && $getKeyword['product_editorial'] == 'editorial') {
                $editorial = 1;
            }
        }
        $search_cmd = array();
        //    if(!empty($serach)){
        //        $search_cmd['query'] = $serach;
        //    }
        //    $search_cmd['sort'] = $sort;
        //    $search_cmd['perPage'] = $limit;
        //    $search_cmd['page'] = $page;
        // $search = '';
        // dd($search);
        $url = [];
        if (!empty($search)) {
            $url['query'] = $search;
        }
        // dd($url);
        $url['type'] = 'video';

        if (!empty($sort)) {
            $url['sort'] = $sort;
        }

        $url['perPage'] = $limit;

        $url['page'] = $page;

        $url1 = $this->url . '/api/v3/search?' . http_build_query($url);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url1,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'accept: application/json',
                'key: ' . $this->api_key,
                'secret: ' . $this->api_secret,
            ),
        ));

        // dd($url);
        $response = curl_exec($curl);
        $contents = json_decode($response, true);
        return $contents;
    }
    //   public function download($data,$id){
    //       ini_set('max_execution_time',0);
    //         if(count($data)>0){
    //             $search_cmd= array();
    //            //$search_cmd['command'] = 'search';
    //             $search_cmd['bid'] = $data['id'];
    //             $search_cmd['v'] = $data['id'];
    //             $search_cmd['vs'] = $data['vs'];
    //             $search_cmd['oi'] = $data['offset'];
    //             $search_cmd['pr'] = $data['pr'];
    //             $search_cmd['tr'] = $id;
    //             $search_cmd["secret"] = $this->api_secret;
    //             $search_cmd["key"] =  $this->api_key;
    //             //print_r($search_cmd); die;
    //             $data_req = json_encode($search_cmd);
    //             $curl = curl_init();
    //             // Set some options - we are passing in a useragent too here
    //             curl_setopt_array($curl, [
    //                 CURLOPT_RETURNTRANSFER => 1,
    //                 CURLOPT_URL => $this->url."/api/download",
    //                 CURLOPT_USERAGENT => '',
    //                 CURLOPT_POST => 1,
    //                 CURLOPT_POSTFIELDS => $search_cmd
    //             ]);
    //             // Send the request & save response to $resp
    //             $response = curl_exec($curl);
    //             curl_close($curl);
    //             $contents = json_decode($response, true);
    //             return $contents;
    //         }
    //   }

    public function download($data, $id, $version = "")
    {
        ini_set('max_execution_time', 0);
        if (count($data) > 0) {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $this->url . '/api/v3/items/download/' . $version . '/' . $id,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'accept: application/json',
                    'key: cJ70pBIk119',
                    'secret: j5weLX518rMP119'
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            $contents = json_decode($response, true);
            return $contents;
        }
    }

    //   public function getclipdata($footage_id){

    //       $clip_cmd = array();
    //       $clip_cmd['itemid'] = $footage_id;
    //       $clip_cmd["secret"] = $this->api_secret;
    //       $clip_cmd["key"] =  $this->api_key;
    //       $data_req = json_encode($clip_cmd);
    //       $curl = curl_init();
    //       // Set some options - we are passing in a useragent too here
    //       curl_setopt_array($curl, [
    //           CURLOPT_RETURNTRANSFER => 1,
    //           CURLOPT_URL => $this->url.'/api/getclipdata',
    //           CURLOPT_USERAGENT => '',
    //           CURLOPT_POST => 1,
    //           CURLOPT_POSTFIELDS => $clip_cmd
    //       ]);
    //       // Send the request & save response to $resp
    //       $response = curl_exec($curl);
    //       curl_close($curl);
    //       $contents = json_decode($response, true);
    //       return $contents;

    //   }

    public function getclipdata($footage_id)
    {
        $curl = curl_init();
        // Set some options - we are passing in a useragent too here
        //https://api-reseller.pond5.com
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->url . '/api/v3/items/' . $footage_id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'accept: application/json',
                'key: ' . $this->api_key,
                'secret: ' . $this->api_secret
            ),
        ));
        // Send the request & save response to $resp
        $response = curl_exec($curl);
        curl_close($curl);
        $contents = json_decode($response, true);
        return $contents;
    }
}
