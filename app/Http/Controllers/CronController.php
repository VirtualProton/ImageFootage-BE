<?php

namespace App\Http\Controllers;

use App\Models\Common;
use App\Models\Product;
use App\Http\Pond5\FootageApi;
use App\Models\ProductCategory;
use App\Http\PantherMedia\ImageApi;
use App\Http\Pond5\MusicApi;
use App\Jobs\FetchThirdPartyData;
use App\Models\TrendingWord;

class CronController extends Controller
{
    public $product;
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->product = new Product();

    }

    /**
    * This function will be executed as a separate CRON for getting the pantherMedia images
    * for all the categories which are active and set for home display
    * This CRON should run frequently may be once in a day
    */
    public function pantherMediaHomeCategoriesImageUpload()
    {
        // allow the script to run for an infinite amount of time
        ini_set('max_execution_time', 0);

        $home_categories = ProductCategory::select('category_id', 'category_name', 'is_display_home')
                        ->where('is_display_home', '=', '1')
                        ->where('category_status', '=', 'Active')
                        ->where('type', '=', '1')
                        ->get()
                        ->toArray();

        foreach($home_categories as $percategory){
            $keyword['search']  = $percategory['category_name'];
            $pantherMediaImages = new ImageApi();
            $pantharmediaData   = $pantherMediaImages->search($keyword);

            if(count($pantharmediaData) > 0){
                $this->product->savePantherMediaImage($pantharmediaData, $percategory['category_id']);
            }
        }
    }

    /**
    * This function will be executed as a separate CRON for getting the pantherMedia images
    * for all the categories which are active but not set for home display
    * This CRON should run less frequently may be twice in a week
    */
    public function pantherMediaOtherCategoriesImageUpload()
    {
        // allow the script to run for an infinite amount of time
        ini_set('max_execution_time', 0);

        $categories = ProductCategory::select('category_id', 'category_name', 'is_display_home')
                    ->where('is_display_home', '=', '0')
                    ->where('category_status', '=', 'Active')
                    ->where('type', '=', '1')
                    ->get()
                    ->toArray();

        foreach($categories as $percategory){
            $keyword['search']  = $percategory['category_name'];
            $pantherMediaImages = new ImageApi();
            $pantharmediaData   = $pantherMediaImages->search($keyword);

            if (count($pantharmediaData) > 0) {
                $this->product->savePantherMediaImage($pantharmediaData,$percategory['category_id']);
            }
        }
    }

    /**
    * This function will be executed as a separate CRON for getting the pond5 footages
    * for all the categories which are active and set for home display
    * This CRON should run frequently may be once in a day
    */
    public function pond5HomeCategoriesFootageUpload()
    {
        // allow the script to run for an infinite amount of time
        ini_set('max_execution_time', 0);

        $home_categories = ProductCategory::select('category_id', 'category_name', 'is_display_home')
                        ->where('is_display_home', '=', '1')
                        ->where('category_status', '=', 'Active')
                        ->where('type', '=', '2')
                        ->get()
                        ->toArray();

        foreach ($home_categories as $percategory) {
            $keyword['search']     = $percategory['category_name'];
            $footageMedia          = new FootageApi();
            $pond5FootageMediaData = $footageMedia->search($keyword);

            if (!empty($pond5FootageMediaData) && count($pond5FootageMediaData) > 0) {
                $this->product->savePond5Footage($pond5FootageMediaData, $percategory['category_id']);
            }
        }
    }

    /**
    * This function will be executed as a separate CRON for getting the pond5 footages
    * for all the categories which are active but not set for home display
    * This CRON should run less frequently may be twice in a week
    */
    public function pond5OtherCategoriesFootageUpload()
    {
        // allow the script to run for an infinite amount of time
        ini_set('max_execution_time', 0);

        $categories = ProductCategory::select('category_id', 'category_name', 'is_display_home')
                    ->where('is_display_home', '=', '0')
                    ->where('category_status', '=', 'Active')
                    ->where('type', '=', '2')
                    ->get()
                    ->toArray();

        foreach ($categories as $percategory) {
            $keyword['search']     = $percategory['category_name'];
            $footageMedia          = new FootageApi();
            $pond5FootageMediaData = $footageMedia->search($keyword);

            if (!empty($pond5FootageMediaData) && count($pond5FootageMediaData) > 0) {
                $this->product->savePond5Footage($pond5FootageMediaData, $percategory['category_id']);
            }
        }
    }

    /**
    * This function will be executed as a separate CRON for getting the pond5 Music
    * for all the categories which are active and set for home display
    * This CRON should run frequently may be once in a day
    */
    public function pond5HomeCategoriesMusicUpload()
    {
        // allow the script to run for an infinite amount of time
        ini_set('max_execution_time', 0);

        $home_categories = ProductCategory::select('category_id', 'category_name', 'is_display_home')
                        ->where('is_display_home', '=', '1')
                        ->where('category_status', '=', 'Active')
                        ->where('type', '=', '3')
                        ->get()
                        ->toArray();

        foreach ($home_categories as $percategory) {
            $keyword['search']   = $percategory['category_name'];
            $musicMedia          = new MusicApi();
            $pond5MusicMediaData = $musicMedia->search($keyword, []);

            if (!empty($pond5MusicMediaData) && count($pond5MusicMediaData['items']) > 0) {
                $this->product->savePond5Music($pond5MusicMediaData, $percategory['category_id']);
            }
        }
    }

    /**
    * This function will be executed as a separate CRON for getting the pond5 Music
    * for all the categories which are active but not set for home display
    * This CRON should run less frequently may be twice in a week
    */
    public function pond5OtherCategoriesMusicUpload()
    {
        // allow the script to run for an infinite amount of time
        ini_set('max_execution_time', 0);

        $categories = ProductCategory::select('category_id', 'category_name', 'is_display_home')
                    ->where('is_display_home', '=', '0')
                    ->where('category_status', '=', 'Active')
                    ->where('type', '=', '3')
                    ->get()
                    ->toArray();

        foreach ($categories as $percategory) {
            $keyword['search']   = $percategory['category_name'];
            $musicMedia          = new MusicApi();
            $pond5MusicMediaData = $musicMedia->search($keyword,[]);

            if (!empty($pond5MusicMediaData) && count($pond5MusicMediaData) > 0) {
                $this->product->savePond5Music($pond5MusicMediaData, $percategory['category_id']);
            }
        }
    }


    public function pond5HomeCategoriesImageUpload()
    {
        // allow the script to run for an infinite amount of time
        ini_set('max_execution_time', 0);

        $home_categories = ProductCategory::select('category_id', 'category_name', 'is_display_home')
                        ->where('is_display_home', '=', '1')
                        ->where('category_status', '=', 'Active')
                        ->where('type', '=', '1')
                        ->get()
                        ->toArray();

        foreach($home_categories as $percategory) {
            $keyword['search']  = $percategory['category_name'];
            $imagesMedia        = new \App\Http\Pond5\ImageApi();
            $pond5ImagesData    = $imagesMedia->search($keyword);

            if(count($pond5ImagesData) > 0){
                $this->product->savePond5Image($pond5ImagesData, $percategory['category_id']);
            }
        }
    }

    public function pond5OtherCategoriesImageUpload()
    {
        // allow the script to run for an infinite amount of time
        ini_set('max_execution_time', 0);

        $categories = ProductCategory::select('category_id', 'category_name', 'is_display_home')
                    ->where('is_display_home', '=', '0')
                    ->where('category_status', '=', 'Active')
                    ->where('type', '=', '1')
                    ->get()
                    ->toArray();

        foreach($categories as $percategory){
            $keyword['search']  = $percategory['category_name'];
            $imagesMedia        = new \App\Http\Pond5\ImageApi();
            $pond5ImagesData    = $imagesMedia->search($keyword);

            if (count($pond5ImagesData) > 0) {
                $this->product->savePond5Image($pond5ImagesData, $percategory['category_id']);
            }
        }
    }

    public function searchKeywordPond5AndPanthermedia($term, $type, $category = null, $allRequest, $thirdparty = 'panthermedia'){
        $keyword = [];
        $trending_word  = TrendingWord::where('name', $term)->first();
        $limitPond5 = config('thirdparty.pond5.current_per_page_limit');
        $limitPanther = config('thirdparty.panthermedia.current_per_page_limit');
        
        try{
            if ($type == '1' || $type == '4') {

                $keyword['search']  = $term;
                $percategory['category_id'] = $category;
                // conditional based search for panthermedia or pond5, as per new request by client
                if($thirdparty == 'panthermedia'){
                    $pantherMediaImages = new ImageApi();
                    
                    $pantharmediaData   = $pantherMediaImages->search($keyword, [], $limitPanther);
                    
                    if(!empty($trending_word) && empty($trending_word->total_records)){
                        $trending_word->total_records = $pantharmediaData['items']['total'];
                        $trending_word->total_fetched = $limitPanther;
                        $trending_word->save();

                        $data = [
                            'trending_word' => $trending_word,
                            'all_request' => $allRequest,
                            'type' => 'Image',
                            'category' => $percategory['category_id'],
                            'page_number' => ''
                        ];
                        
                        dispatch(new FetchThirdPartyData($data));
                    }

                    if(isset($pantharmediaData['status']) && $pantharmediaData['status'] == 'failed'){
                        return [
                            'status'=>'failed',
                            'message'=>'Please try again'
                        ];
                    }

                    if(!empty($pantharmediaData) && count($pantharmediaData) > 0){
                        $this->product->savePantherMediaImage($pantharmediaData, $percategory['category_id'], $allRequest);
                        $this->product->checkAndUpdateSimilarSlug();
                    }
                } else {
                    $imagesMedia        = new \App\Http\Pond5\ImageApi();
                    $pond5ImagesData    = $imagesMedia->search($keyword, [], config('thirdparty.pond5.current_per_page_limit'));

                    if(isset($pond5ImagesData['status']) && $pond5ImagesData['status'] == 'failed'){
                        return [
                            'status'=>'failed',
                            'message'=>'Please try again'
                        ];
                    }

                    if (!empty($pond5ImagesData) && count($pond5ImagesData) > 0) {
                        $this->product->savePond5Image($pond5ImagesData, $percategory['category_id'], $allRequest);
                        $this->product->checkAndUpdateSimilarSlug();
                    }
                }
            } else if ($type == '2' || $type == '4') {
                $keyword['search']  = $term;
                $percategory['category_id'] = $category;
                $footageMedia          = new FootageApi();
                
                $pond5FootageMediaData = $footageMedia->search($keyword, [], $limitPond5);

                if(!empty($trending_word) && empty($trending_word->total_records)){
                    $trending_word->total_records = $pond5FootageMediaData['totalNumberOfItems'];
                    $trending_word->total_fetched = $limitPond5;
                    $trending_word->save();

                    $data = [
                        'trending_word' => $trending_word,
                        'all_request' => $allRequest,
                        'type' => 'Footage',
                        'category' => $percategory['category_id'],
                        'page_number' => ''
                    ];
                    
                    dispatch(new FetchThirdPartyData($data));
                }

                if(isset($pond5FootageMediaData['status']) && $pond5FootageMediaData['status'] == 'failed'){
                    return [
                        'status'=>'failed',
                        'message'=>'Please try again'
                    ];
                }

                if (!empty($pond5FootageMediaData) && count($pond5FootageMediaData) > 0) {
                    $this->product->savePond5Footage($pond5FootageMediaData, $percategory['category_id'], $allRequest);
                    $this->product->checkAndUpdateSimilarSlug();
                }
            } else if ($type == '3') {
                $keyword['search']  = $term;
                $percategory['category_id'] = $category;
                $musicMedia          = new MusicApi();
                $pond5MusicMediaData = $musicMedia->search($keyword, [], $limitPond5);

                if(!empty($trending_word) && empty($trending_word->total_records)){
                    $trending_word->total_records = $pond5MusicMediaData['totalNumberOfItems'];
                    $trending_word->total_fetched = $limitPond5;
                    $trending_word->save();

                    $data = [
                        'trending_word' => $trending_word,
                        'all_request' => $allRequest,
                        'type' => 'Music',
                        'category' => $percategory['category_id'],
                        'page_number' => ''
                    ];
                    
                    dispatch(new FetchThirdPartyData($data));
                }

                if(isset($pond5MusicMediaData['status']) && $pond5MusicMediaData['status'] == 'failed'){
                    return [
                        'status'=>'failed',
                        'message'=>'Please try again'
                    ];
                }

                if (!empty($pond5MusicMediaData) && count($pond5MusicMediaData) > 0) {
                    $this->product->savePond5Music($pond5MusicMediaData, $percategory['category_id'], $allRequest);
                    $this->product->checkAndUpdateSimilarSlug();
                }
            }
            return true;
        }
        catch(\Exception $e){
            return [
                'status'=>'failed',
                'message'=>'Please try again'
            ];
        }
    }
}
