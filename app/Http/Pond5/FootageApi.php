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
        $this->api_key    = config('thirdparty.pond5.api_key');
        $this->api_secret = config('thirdparty.pond5.api_secret');
        $this->url        = config('thirdparty.pond5.api_url');
    }

    private function str_random($len = 8, $allowed_charset = null)
    {
        if ($allowed_charset === null) {
            $allowed_charset = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        }
        return substr(str_shuffle($allowed_charset), 0, $len);
    }

    public function search($keyword, $getKeyword = [], $limit = 30, $page = 1)
    {
        $search = $keyword['search'];
        $page   = isset($keyword['pagenumber']) ? $keyword['pagenumber'] : $page;

        if(isset($keyword['authorname']) && !empty($keyword['authorname'])){
            $authorname = $keyword['authorname'];
        }

        // IMPROVEMENT: change the frontend value for the sort, use slug
        if (isset($getKeyword['sort']) && $getKeyword['sort'] == 'Recent') {
            $sort = 'newest';
        } else if (isset($getKeyword['sort']) && $getKeyword['sort'] == 'Popular') {
            $sort = 'popular';
        } elseif (isset($getKeyword['sort']) && $getKeyword['sort'] == 'Price: Low to High'){
            $sort = 'price_low_high';
        } elseif (isset($getKeyword['sort']) && $getKeyword['sort'] == 'Price: High to Low'){
            $sort = 'price_high_low';
        } elseif (isset($getKeyword['sort']) && $getKeyword['sort'] == 'Duration: Long to Short'){
            $sort = 'duration_short_long';
        } else {
            $sort = 'default';
        }

        $getFilters     = Arr::except($getKeyword, ['search', 'productType', 'pagenumber', 'product_editorial']);
        $filter_mapping = "";

        $url            = [];
        $url['type']    = 'video';
        $url['perPage'] = $limit;
        $url['page']    = $page;

        if (!empty($filter_mapping)) {
            $url['query'] = $filter_mapping;
        }
        if (!empty($search)) {
            $url['query'] = $search;
        }
        if (!empty($authorname)) {
            $url['query'] = 'authorName:'.$authorname;
        }
        if (!empty($sort)) {
            $url['sort'] = $sort;
        }
        try{
            $apiUrl = $this->url . '/api/v3/search?' . http_build_query($url);
            $curl   = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL            => $apiUrl,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING       => '',
                CURLOPT_MAXREDIRS      => 10,
                CURLOPT_TIMEOUT        => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST  => 'GET',
                CURLOPT_HTTPHEADER     => array(
                    'accept: application/json',
                    'key: ' . $this->api_key,
                    'secret: ' . $this->api_secret,
                ),
            ));

            $response = curl_exec($curl);
            $contents = json_decode($response, true);
            return $contents;
        }
        catch (\Exception $ex) {
            return [
                'status'=>'failed',
                'message'=>'Please try again'
            ];
        }
    }


    public function download($id, $version = "")
    {
        ini_set('max_execution_time', 0);
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
                'key: ' . $this->api_key,
                'secret: ' . $this->api_secret,
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $contents = json_decode($response, true);
        return $contents;
    }


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
