<?php

namespace App\Http\Pond5;

use App;

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
    public function searchMusic($keyword, $getKeyword, $limit = 30, $page = 0)
    {
        $search = $keyword['search'];
        $editorial = 0;
        $bittotal  = 0;
        if (isset($keyword['pagenumber'])) {
            $page = $keyword['pagenumber'];
        }

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
        $url = [];
        if (!empty($search)) {
            $url['query'] = $search;
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
}
