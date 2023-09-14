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

    public function pantherImageUpload()
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
                $this->product->savePantherImage($pantharmediaData, $percategory['category_id']);
            }
        } 
    }

    public function pantherImageUploadCategory()
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
                $this->product->savePantherImage($pantharmediaData,$percategory['category_id']);
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

    public function pond5Upload()
    {
        // allow the script to run for an infinite amount of time
        ini_set('max_execution_time', 0);
        // TODO: Need to manage via constant array
        $home_categories = array('COVID-19','Summer','Work from Home','Mothers day','Earth Day','Nature');
        foreach ($home_categories as $percategory) {
            $keyword['search']    = $percategory;
            $footageMedia         = new FootageApi();
            $pondfootageMediaData = $footageMedia->search($keyword,[]);
            $common               = new Common();
            $category_id          = $common->checkCategory($percategory);
            if (count($pondfootageMediaData) > 0) {
                $this->product->savePond5Image($pondfootageMediaData, $category_id);
            }
        }
    }

    public function pond5GetMusic()
    {
        // allow the script to run for an infinite amount of time
        ini_set('max_execution_time', 0);
        // TODO: Need to manage via constant array
        $homeCategories = ['COVID-19', 'Summer', 'Work from Home', 'Mothers day', 'Earth Day', 'Nature'];

        foreach ($homeCategories as $percategory) {
            $keyword['search']  = $percategory;
            $musicMedia         = new MusicApi();
            $pondMusicMediaData = $musicMedia->searchMusic($keyword, []);
            $common             = new Common();
            $categoryId         = $common->checkCategory($percategory);

            if (!empty($pondMusicMediaData) && count($pondMusicMediaData['items']) > 0) {
                $this->product->savePond5Music($pondMusicMediaData['items'], $categoryId);
            }
        }
    }

    public function pond5UploadCategory()
    {
        // allow the script to run for an infinite amount of time
        ini_set('max_execution_time', 0);

        $categories = ProductCategory::get()->toArray();
        foreach ($categories as $percategory) {
            $keyword['search'] = $percategory['category_name'];
            $footageMedia = new FootageApi();
            $pondfootageMediaData = $footageMedia->search($keyword,[]);
            if (count($pondfootageMediaData) > 0) {
                $this->product->savePond5Image($pondfootageMediaData, $percategory['category_id']);
            }
        }
    }
}
