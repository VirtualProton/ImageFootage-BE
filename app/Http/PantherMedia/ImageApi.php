<?php

namespace App\Http\PantherMedia;

use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use Illuminate\Support\Arr;


class ImageApi
{

    private $api_key =  '';
    private $api_secret = '';
    private $timestamp = '';
    private $nonce = '';
    private $algo = '';
    private $access_key = '';
    private $url = '';

    public function  __construct()
    {
        $this->api_key = config('thirdparty.panthermedia.api_key');
        $this->api_secret = config('thirdparty.panthermedia.api_secret');
        $this->timestamp = config('thirdparty.panthermedia.timestamp');
        $this->nonce = config('thirdparty.panthermedia.nonce');
        $this->algo = config('thirdparty.panthermedia.algo');
        $this->access_key = config('thirdparty.panthermedia.access_key');
        $this->url = config('thirdparty.panthermedia.api_url');
    }
    public function getHostInfo()
    {
        $this->access_key = $this->getAccessKey();
        // echo $this->access_key; die;
        $client = new Client(); //GuzzleHttp\Client
        // $client->setDefaultOption('headers', array('Content-Type' => 'application/x-www-form-urlencoded','Accept-Version'=>'1.0'));
        try {
            $result = $client->post($this->url . '/v1.0/host-info', [
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
        } catch (\GuzzleHttp\Exception\BadResponseException  $e) {
            //echo "heelo"; die;
            //echo Psr7\str($e->getResponse());
            //echo $e->getCode();
            //echo $response = $e->getResponse();
            // echo $responseBodyAsString = $response->getBody()->getContents();
            //die;
        }
        //print_r($result); die;
    }


    private function str_random($len = 8, $allowed_charset = null)
    {
        if ($allowed_charset === null) {
            $allowed_charset = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        }
        return substr(str_shuffle($allowed_charset), 0, $len);
    }

    public function getAccessKey()
    {
        // $this->nonce = $this->str_random();
        $this->nonce = "imagefootage";
        $this->timestamp = str_replace('+0000', 'UTC', gmdate(DATE_RSS));
        $data = $this->timestamp . $this->api_key . $this->nonce;
        $access_key = hash_hmac('sha1', $data, $this->api_secret);
        return $access_key;
    }


    public function search($keyword, $getKeyword = [], $limit = 30, $page = 0)
    {
        $serach = $keyword['search'];
        if (isset($getKeyword['pagenumber']) && $getKeyword['pagenumber'] > '0') {
            $page = $getKeyword['pagenumber'];
        }
        if (isset($getKeyword['letest']) && $getKeyword['letest'] == '1') {
            $sort = 'sort: date;';
        } else if (isset($getKeyword['populer']) && $getKeyword['populer'] == '1') {
            $sort = 'sort: buy;';
        } else {
            $sort = 'sort: rel;';
        }

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

        $this->access_key = $this->getAccessKey();
        try {
            $client = new Client(); //GuzzleHttp\Client
            $response = $client->post($this->url . '/search', [
                'headers' => [
                    'Content-Type'   => 'application/x-www-form-urlencoded',
                    'Accept-Version' => '1.0'
                ],
                'form_params' => [
                    'api_key'      => $this->api_key,
                    'access_key'   => $this->access_key,
                    'timestamp'    => $this->timestamp,
                    'nonce'        => $this->nonce,
                    'algo'         => $this->algo,
                    'content_type' => 'application/json',
                    'lang' => 'en',
                    'q' => $serach,
                    'page' => $page,
                    'limit' => $limit,
                    'extra_info' => "preview,preview_high,width,height,copyright,date,keywords,title,description,editorial,extended,packet,subscription,premium,rights_managed,mimetype,model_id,model_release,property_release,author_username,author_realname,adult_content",
                    'filters' => $sort . 'type: photos;' . $filter_mapping
                ]
            ]);

            if ($response->getBody()) {
                $contents = json_decode($response->getBody(), true);
                return $contents;
            }
        } catch (BadResponseException $ex) {
            $response = $ex->getResponse();
            $jsonBody = (string) $response->getBody();
            print_r($jsonBody);
            die;
        }
    }

    public function get_media_info($media_id)
    {
        $this->access_key = $this->getAccessKey();
        $client = new Client(); //GuzzleHttp\Client
        $response = $client->post($this->url . '/get-media-info', [
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
                'content_type' => 'application/json',
                'lang' => 'en',
                'id_media' => $media_id,
                'show_articles' => 'yes',
                'show_top10_keywords' => 'yes'
            ]
        ]);


        if ($response->getBody()) {
            $contents = json_decode($response->getBody(), true);
            //$contents = $response->getBody();
            return $contents;
        }
    }

    public function getPriceFromList($media, $product_id = NULL)
    {
        if (count($media) > 0) {
            $products = array();
            //foreach($media as $eachmedia){
            $products[0]['name'] = $media['metadata']['title'];
            $products[0]['api_product_id'] = $media['media']['id'];
            $products[0]['product_code'] = isset($product_id) ? $product_id : $media['media']['id'];
            $products[0]['description'] = $media['metadata']['description'];
            $products[0]['thumbnail_image'] = $media['media']['preview_url_no_wm'];
            $products[0]['type'] = "Royalty Free";
            $products[0]['product_web'] = "2";
            $products[0]['small_size'] = (isset($media['articles']['singlebuy_list']['singlebuy'][0]['sizes']['article'][1]['price'])) ? $media['articles']['singlebuy_list']['singlebuy'][0]['sizes']['article'][1]['price'] : "";
            $products[0]['medium_size'] = (isset($media['articles']['singlebuy_list']['singlebuy'][0]['sizes']['article'][2]['price'])) ? $media['articles']['singlebuy_list']['singlebuy'][0]['sizes']['article'][2]['price'] : "";
            $products[0]['large_size'] = (isset($media['articles']['singlebuy_list']['singlebuy'][0]['sizes']['article'][3]['price'])) ? $media['articles']['singlebuy_list']['singlebuy'][0]['sizes']['article'][3]['price'] : "";
            $products[0]['x_large_size'] = (isset($media['articles']['singlebuy_list']['singlebuy'][0]['sizes']['article'][4]['price'])) ? $media['articles']['singlebuy_list']['singlebuy'][0]['sizes']['article'][4]['price'] : "";
            //}
            return $products;
        }
    }

    public function download($data, $id)
    {
        $this->access_key = $this->getAccessKey();

        if (count($data['product']['selected_product']) > 0) {
            if (isset($data['product']['product_info']['articles'])) {
                $id = $data['product']['product_info']['articles']['subscription_list']['subscription']['article']['id'];
            } else {
                $getIdArticle = $this->get_media_infoNew($data['product']['product_info']['media']['id']);
                $id = $getIdArticle['articles']['subscription_list']['subscription']['article']['id'];
            }
        } else {
            $id = $data['product']['product_info']['media']['id'];
        }

        $client = new Client(); //GuzzleHttp\Client
        $response = $client->post($this->url . '/download-media', [
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
                'content_type' => 'application/json',
                'lang' => 'en',
                'id_media' => $data['product']['product_info']['media']['id'],
                'id_article' => $id,
                'test' => 'yes'
            ]
        ]);

        if ($response->getBody()) {
            $contents = json_decode($response->getBody(), true);
            $redownload = $contents['download_status']['id_download'];
            $hostname = env('APP_URL');

            $client2 = new Client(); //GuzzleHttp\Client
            $response2 = $client2->post($this->url . '/download-media', [
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
                    'content_type' => 'application/json',
                    'lang' => 'en',
                    'id_media' => $data['product']['product_info']['media']['id'],
                    'queue_hash' => $contents['download_status']['queue_hash'],
                    'callback_url' => $hostname . '/backend/api/callback_download',
                    'test' => 'yes'
                ]
            ]);
            if ($response2->getBody()) {
                $downloadcontents = json_decode($response2->getBody(), true);
                return $downloadcontents;
            }
        }
    }

    public function get_media_infoNew($media_id)
    {
        $this->access_key = $this->getAccessKey();
        try {
            $time2 = str_replace(' ', '%20', $this->timestamp);
            $clip_cmd = 'api_key=' . $this->api_key .
                '&access_key=' . $this->access_key .
                '&nonce=' . $this->nonce .
                '&algo=' . $this->algo .
                '&timestamp=' . $time2 .
                '&content_type=application/json&lang=en&id_media=' . $media_id .
                '&show_articles=yes&show_top10_keywords=yes';
            $data_req = $clip_cmd;
            $curl = curl_init();
            $ua = 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US) AppleWebKit/525.13 (KHTML, like Gecko) Chrome/0.A.B.C Safari/525.13';
            // Set some options - we are passing in a useragent too here
            curl_setopt_array($curl, [
                CURLOPT_URL => $this->url . '/v1.0/get-media-info',
                CURLOPT_POST => TRUE,
                CURLOPT_MAXREDIRS => 20,
                CURLOPT_POSTFIELDS => $data_req,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_USERAGENT => $ua,
                CURLOPT_HTTPHEADER => array(
                    'Content-Type' => 'application/x-www-form-urlencoded',
                    'Accept-Version' => '1.0',
                    'Accept-Encoding' => 'gzip, deflate'
                ),
            ]);
            // Send the request & save response to $resp
            $response = curl_exec($curl);
            curl_close($curl);
            $contents = json_decode($response, true);
            return $contents;
        } catch (\RuntimeException $ex) {
            die(sprintf('Http error %s with code %d', $ex->getMessage(), $ex->getCode()));
        }
    }

    public function downloadCallback()
    {
        $hostname = env('APP_URL');
        $client2 = new Client(); //GuzzleHttp\Client
        $response2 = $client2->post($this->url . '/download-media', [
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
                'content_type' => 'application/json',
                'lang' => 'en',
                'id_media' => $contents['download_status']['$data']['media']['id'],
                'queue_hash' => $contents['download_status']['queue_hash'],
                'callback_url' => $hostname . '/backend/api/callback_download',
                'test' => 'yes'
            ]
        ]);
        if ($response2->getBody()) {
            $downloadcontents = json_decode($response2->getBody());
            print_r($downloadcontents);
            die;
            return $downloadcontents;
        }
    }


    public function reDownloadMedia($data)
    {
        $this->access_key = $this->getAccessKey();
        $client = new Client(); //GuzzleHttp\Client
        $response = $client->post($this->url . '/download-media', [
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
                'content_type' => 'application/json',
                'lang' => 'en',
                'id_media' => $data['id_media'],
                'id_download' => $data['id_download'],
            ]
        ]);

        if ($response->getBody()) {
            $downloadcontents = json_decode($response->getBody(), true);
            return $downloadcontents;
        }
    }

    public function searchWithMedia($mediaId, $limit = 30,$pageNumber = 0){
        try {
            $this->access_key = $this->getAccessKey();
            $client = new Client(); //GuzzleHttp\Client
            $response = $client->post($this->url . '/search-similar', [
                'headers' => [
                    'Content-Type'   => 'application/x-www-form-urlencoded',
                    'Accept-Version' => '1.0'
                ],
                'form_params' => [
                    'api_key'      => $this->api_key,
                    'access_key'   => $this->access_key,
                    'timestamp'    => $this->timestamp,
                    'nonce'        => $this->nonce,
                    'algo'         => $this->algo,
                    'content_type' => 'application/json',
                    'lang' => 'en',
                    'id_media'=>$mediaId,
                    'page' => $pageNumber,
                    'limit' => $limit,
                    'extra_info' => "preview,preview_high,width,height,copyright,date,keywords,title,description,editorial,extended,packet,subscription,premium,rights_managed,mimetype,model_id,model_release,property_release,author_username,author_realname,adult_content",
                ]
            ]);

            if ($response->getBody()) {
                $contents = json_decode($response->getBody(), true);
                return $contents;
            }
        } catch (BadResponseException $ex) {
            $response = $ex->getResponse();
            $jsonBody = (string) $response->getBody();
        }
    }

    public function searchWithAuthor($authorName, $limit = 30,$pageNumber = 0){
        try {
            $this->access_key = $this->getAccessKey();
            $client = new Client(); //GuzzleHttp\Client
            $response = $client->post($this->url . '/search', [
                'headers' => [
                    'Content-Type'   => 'application/x-www-form-urlencoded',
                    'Accept-Version' => '1.2'
                ],
                'form_params' => [
                    'api_key'      => $this->api_key,
                    'access_key'   => $this->access_key,
                    'timestamp'    => $this->timestamp,
                    'nonce'        => $this->nonce,
                    'algo'         => $this->algo,
                    'content_type' => 'application/json',
                    'lang' => 'en',
                    'page' => $pageNumber,
                    'limit' => $limit,
                    'q'=>'',
                    'filter'=>'sort:date;type:photos;author:'.$authorName,
                    'extra_info' => "preview,preview_high,width,height,copyright,date,keywords,title,description,editorial,extended,packet,subscription,premium,rights_managed,mimetype,model_id,model_release,property_release,author_username,author_realname,adult_content",
                ]
            ]);

            if ($response->getBody()) {
                $contents = json_decode($response->getBody(), true);
                return $contents;
            }
        } catch (BadResponseException $ex) {
            $response = $ex->getResponse();
            $jsonBody = (string) $response->getBody();
        }
    }
}
