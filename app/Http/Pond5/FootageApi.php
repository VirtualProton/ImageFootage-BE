<?php

namespace App\Http\Pond5;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

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

    public function search($keyword, $getKeyword, $limit = 30, $page = 0)
    {
        $search = $keyword['search'];
        $authorname = $keyword['authorname'];
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
        $getFilters = Arr::except($getKeyword, ['search', 'productType', 'pagenumber', 'product_editorial']);
        $filter_mapping = "";

        foreach($getFilters as $getFilterName => $getFilterValue){

            if(!empty($getFilterValue)){
                $filterData = DB::table('imagefootage_filters')
                ->select('imagefootage_filters.id', 'imagefootage_filters_options.value')
                ->where('imagefootage_filters.value', $getFilterName)
                ->join('imagefootage_filters_options', 'imagefootage_filters.id', '=', 'imagefootage_filters_options.filter_id')
                ->whereIn('imagefootage_filters_options.value', explode(',', $getFilterValue))
                ->get();

                foreach($filterData as $filter){
                    $filter_mapping .= $getFilterName.":".$filter->value.';';
                }
            }
        }
        $search_cmd = array();

        $url = [];
        if (!empty($filter_mapping)) {
            $url['query'] = $filter_mapping;
        }
        if(!empty($search)){
            $url['query']=$search;
        }
        if(!empty($authorname)){
            $url['query'] = 'authorName:'.$authorname;
        }


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
