<?php

namespace App\Http\Controllers;

use App\Models\Common;
use App\Models\Product;
use App\Http\Pond5\FootageApi;
use App\Models\ProductCategory;
use App\Http\PantherMedia\ImageApi;
use App\Http\Pond5\MusicApi;
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

    public function pantherImageUpdate(){
        // allow the script to run for an infinite amount of time
        ini_set('max_execution_time', 0);
        // TODO: Need to remove static IDs
        $cat=[53,54,55,56,57,14,3,4,5,12,15,40,8,10,17,20,23,24,26,31,52,34,51,42,43];
        $products = Product::where('product_web','=','2')
                    ->select('api_product_id')
                    ->whereIn('product_category',$cat)
                    ->whereRaw("date(updated_at) < '2020-12-04'") // TODO: remove this static condition
                    ->orderBy('id','desc')
                    ->get()
                    ->toArray();

        foreach($products as $perproduct){
            $keyword['search']  = $perproduct['api_product_id'];
            $pantherMediaImages = new ImageApi();
            $pantharmediaData   = $pantherMediaImages->get_media_infoNew($keyword['search']);

            if (isset($pantharmediaData['stat'])) {
                if ($pantharmediaData['stat'] != 'fail') {
                    $this->product->updatePantherImage($pantharmediaData);
                } else {
                    Product::where('api_product_id', '=', $perproduct['api_product_id'])->update(['thumb_update_status' => 0]);
                }
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
}
