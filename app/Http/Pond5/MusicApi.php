<?php

namespace App\Http\Pond5;

use App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class MusicApi
{

    private $api_key;
    private $api_secret;
    private $url;

    public function  __construct()
    {
        $this->api_key = config('thirdparty.pond5.api_key');
        $this->api_secret = config('thirdparty.pond5.api_secret');
        $this->url = config('thirdparty.pond5.api_url');
    }

    # searchMusic form pond5
    public function searchMusic($keyword, $getKeyword, $limit = 30, $page = 1)
    {
        $search = $keyword['search'];
        $editorial = 0;
        $bittotal  = 0;
        if (isset($keyword['pagenumber'])) {
            $page = $keyword['pagenumber'];
        }
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
        $filters = '';

        $getFilters = Arr::except($getKeyword, ['search', 'productType', 'pagenumber', 'product_editorial','sort']);
        $filter_mapping = "";

        $transformedArray = [];

        foreach ($getFilters['all_filters'] as $filter) {
            $key = $filter['key'];
            $values = $filter['value'];
            $transformedArray[$key] = $values;
        }

        foreach($transformedArray as $getFilterName => $getFilterValue){

            if(!empty($getFilterValue)){

                $filterData = DB::table('imagefootage_filters')
                ->select('imagefootage_filters.id', 'imagefootage_filters_options.value')
                ->where('imagefootage_filters.value', $getFilterName)
                ->join('imagefootage_filters_options', 'imagefootage_filters.id', '=', 'imagefootage_filters_options.filter_id')
                ->whereIn('imagefootage_filters_options.value', explode(', ', $getFilterValue))
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

        $url['type'] = 'music';

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

        $response = curl_exec($curl);
        $contents = json_decode($response, true);
        return $contents;
    }

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

    public function getMusicInfo($music_id)
    {
        $curl = curl_init();
        // Set some options - we are passing in a useragent too here
        //https://api-reseller.pond5.com
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->url . '/api/v3/items/' . $music_id,
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
