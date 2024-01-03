<?php

namespace App\Http\Controllers;

use App\Models\Common;
use App\Models\ImageFilterValue;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use App\Http\PantherMedia\ImageApi;
use App\Http\Pond5\FootageApi;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Api;
use App\Models\UserPackage;
use App\Models\UserProductDownload;
use CORS;
use Image;
use App\Http\Pond5\MusicApi;
use App\Models\ProductsDownload;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Models\LicenceType;

class MediaController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->product = new Product();
    }


    /** Check the image is already downloaded by user or not */
    public function getAlreadyDownloadedImage(Request $request)
    {
        // TODO : need to update the code (need to send all the downloaded image with different size)
        $checkExists = UserProductDownload::where(['user_id' => $request->user_id, 'product_id_api' => $request->media_id])->get();
        return response()->json(["status" => 'success','data'=>$checkExists]);
    }

    public function index(Request $request)
    {
        $requestData = $request->json()->all();
        $origin = $requestData['type'];
        $slug = $requestData['slug'];
        $product_details = Product::where(['slug' => $slug, 'product_main_type' => $origin])->first();
        if ($product_details) {
            // Use the $product_details['id'] to query MongoDB
            $apiProductId = $product_details['api_product_id'];
            // Retrieve data from MongoDB where api_product_id matches
            $matchingData = ImageFilterValue::where('api_product_id', $apiProductId)->get();
            $attributes = [];
            $options = [];

            foreach ($matchingData as $data) {

                $attributes = isset($data->attributes) ? $data->attributes : [];
                $options    = isset($data->options) ? $data->options : [];
            }
            $product_details['attributes'] = $attributes;
            $product_details['options'] = $options;
        }
        return response()->json(['data' => $product_details, 'status' => 'success']);
    }

    public function categoryListApi()
    {
        $categories  = ProductCategory::select('category_id', 'category_name','category_slug')
            ->where(['is_display_home'=> 1,'type'=>'1'])
            ->where('category_status','Active')
            ->orderBy('category_order', 'asc')
            ->limit(24)
            ->get()
            ->toArray();
        if (count($categories) > 0) {
            $i = 0;
            $catArray = array();
            $tempArray = array();
            foreach ($categories as $k => $category) {
                if ($k == 0) {
                    array_push($tempArray, $category);
                    $catArray[$i] = $tempArray;
                } else {
                    if (($k) % 6 != '0') {
                        array_push($tempArray, $category);
                        $catArray[$i] = $tempArray;
                    } else {
                        $tempArray = array();
                        array_push($tempArray, $category);
                        $i++;
                        $catArray[$i] = $tempArray;
                    }
                }
            }

            return response()->json($catArray);
        } else {
            return response()->json(array('status' => '0', 'message' => "No category found"));
        }
    }


    public function download(Request $request)
    {
        $allFields = $request->all();
        $tokens = json_decode($allFields['product']['token'], true);
        $id = $tokens['Utype'];
        $package_id = $allFields['product']['package'];
        if ($allFields['product']['type'] == 2) {
            $flag = 'Image';
        } else if ($allFields['product']['type'] == 3) {
            $flag = 'Footage';
        } else {
            $flag = 'Music';
        }

        $pacakegalist = UserPackage::whereIn('payment_status', ['Completed', 'Transction Success'])
            ->where('user_id', '=', $id)
            ->where('package_type', '=', $flag)
            ->where('id', '=', $package_id)
            ->where('package_expiry_date_from_purchage', '>', Now())
            ->get();

        $download = 0;
        $downoad_type = 0;

        if ($pacakegalist->isNotEmpty()) {
            foreach ($pacakegalist as $perpack) {

                if ($perpack->package_plan == 1) { // For subscriprion type package
                    // Check subscription is monthly or not

                    if ($perpack->package_expiry != 0 && $perpack->package_expiry_yearly == 0) {

                        $subscriptionStartDate = Carbon::parse($perpack->created_at);

                        $latestDates = $this->getDateGaps($subscriptionStartDate);
                        $startDateOfSpecificMonth = $latestDates['startDate'];
                        $endDateOfSpecificMonth = $latestDates['endDate'];

                        // Count the number of downloads for the current month
                        $monthlyDownloads = ProductsDownload::where(['user_id' => $id, 'package_id' => $package_id])
                            ->whereBetween('downloaded_date', [$startDateOfSpecificMonth, $endDateOfSpecificMonth])
                            ->distinct('id_media')
                            ->pluck('id_media')->count();

                        if ($monthlyDownloads >= $perpack->package_products_count) {
                            return response()->json(['status' => '0', 'message' => 'You have exceeded a monthly download limit.']);
                        } else {
                            $download = 1;
                        }
                    } else if ($perpack->downloaded_product < $perpack->package_products_count) {
                        $download = 1;
                    }
                } else if ($perpack->package_plan == 2 && $perpack->downloaded_product < $perpack->package_products_count) { // For download type package
                    $download = 1;
                }

                if ($allFields['product']['type'] == 3) {
                    $downoad_type = 1;
                }

            }
        } else {
            return response()->json(['status' => '0', 'message' => 'Please select correct package to download!!']);
        }

        if ($download == 1) {
            if ($allFields['product']['type'] == 3) {

                if ($downoad_type == 0) {
                    return response()->json(['status' => '0', 'message' => 'Please select correct package to download!!']);
                }
                $footageMedia = new FootageApi();
                $download_id = $allFields['product']['product_info']['media']['id'];
                $version =  isset($allFields['product']['version_data']['version']) ? $allFields['product']['version_data']['version'] : $download_id.':1';
                $product_details_data = $footageMedia->download($download_id ,$version);
                if (!empty($product_details_data)) {
                    $dataCheck = UserProductDownload::where('product_id_api', $download_id)->where('web_type', $allFields['product']['type'])->first();
                    $product_id = Product::where('api_product_id', '=', $download_id)->first()->product_id;
                    $dataInsert = array(
                        'user_id' => $id,
                        'package_id' => $allFields['product']['package'],
                        'product_id' => $product_id,
                        'product_id_api' => $download_id,
                        'id_media' => $download_id,
                        'download_url' => $product_details_data['url'],
                        'downloaded_date' => date('Y-m-d H:i:s'),
                        'product_name' => $allFields['product']['product_info'][0]['clip_data']['n'],
                        'product_desc' => $allFields['product']['product_info'][0]['clip_data']['pic_description'],
                        'product_thumb' => $allFields['product']['product_info'][0]['flv_base'] . $allFields['product']['product_info'][1],
                        'web_type' => $allFields['product']['type'],
                        'product_size' => '',
                        'product_price' => $allFields['product']['selected_product']['price'],
                        'product_poster' => $allFields['product']['product_info'][2],
                        'selected_product' => json_encode($allFields['product']['selected_product']),
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                        'redownloded_date' => null,
                        'licence_type' => $allFields['product']['extended']
                    );
                    UserProductDownload::insert($dataInsert);
                    if (!$dataCheck) {
                        UserPackage::where('user_id', '=', $id)
                            ->where('package_type', '=', $flag)
                            ->where('id', '=', $package_id)
                            ->update([
                                'downloaded_product' => DB::raw('downloaded_product+1'),
                                'updated_at' => date('Y-m-d H:i:s')
                            ]);
                    }
                }
                return response()->json($product_details_data);
            } else if ($allFields['product']['type'] == 2) {
                // Download Images from Pond5
                $footageMedia = new FootageApi();
                $download_id = $allFields['product']['product_info']['media']['id'];

                $version =  isset($allFields['product']['version_data']['version']) ? $allFields['product']['version_data']['version'] : $download_id.':1';

                if ($allFields['product']['product_info']['productWeb'] == 2) { // If image is from PantherMedia
                    $imageMedia = new ImageApi();
                    $product_details_data = $imageMedia->download($allFields, $download_id);

                } elseif ($allFields['product']['product_info']['productWeb'] == 3) { // If image is from Pond5
                    $footageMedia = new FootageApi();
                    $product_details_data = $footageMedia->download($download_id, $version);
                }


                if (!empty($product_details_data)) {
                    
                    //In the case when product is not avilable anymore.
                    if($product_details_data['stat'] == "fail"){
                        if($product_details_data['product_id']){
                            DB::table('imagefootage_products')
                            ->where('product_id', '=', $product_details_data['product_id'])
                            ->update([
                                'product_server_activation' => 'inactive',
                                'product_status' => 'Inactive'
                            ]);
                        }                        
                        return $product_details_data;
                    }

                    $dataCheck = UserProductDownload::select('product_id')->where('product_id_api', $allFields['product']['product_info']['media']['id'])->where('product_size', $allFields['product']['selected_product']['width'])->where('web_type', $allFields['product']['type'])->first();

                    $product_id = Product::where('api_product_id', '=', $allFields['product']['product_info']['media']['id'])->first()->product_id;


                    if($product_details_data['download_status']['status'] == "pending"){
                        $dataInsert = array(
                            'user_id' => $id,
                            'package_id' => $allFields['product']['package'],
                            'product_id' => $product_id,
                            'id_download' => $product_details_data['download_status']['id_download'],
                            'product_id_api' => $allFields['product']['product_info']['media']['id'],
                            'id_media' => $allFields['product']['product_info']['media']['id'],
                            'download_url' => $product_details_data['download_status']['queue_hash'],
                            'downloaded_date' => date('Y-m-d H:i:s'),
                            'product_name' => $allFields['product']['product_info']['metadata']['title'],
                            'product_desc' => $allFields['product']['product_info']['metadata']['description'],
                            'product_thumb' => $allFields['product']['product_info']['media']['thumb_170_url'],
                            'web_type' => $allFields['product']['type'],
                            'product_size' => $allFields['product']['selected_product']['width'],
                            'product_price' => $allFields['product']['selected_product']['price'],
                            'product_poster' => $allFields['product']['product_info']['media']['thumb_170_url'],
                            'selected_product' => json_encode($allFields['product']['selected_product']),
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s'),
                            'licence_type' => $allFields['product']['extended'],
                            'redownloded_date' => null,
                        );
                    }else{
                        $dataInsert = array(
                            'user_id' => $id,
                            'package_id' => $allFields['product']['package'],
                            'product_id' => $product_id,
                            'id_download' => $product_details_data['transaction'],
                            'product_id_api' => $allFields['product']['product_info']['media']['id'],
                            'id_media' => $allFields['product']['product_info']['media']['id'],
                            'download_url' => $product_details_data['url'],
                            'downloaded_date' => date('Y-m-d H:i:s'),
                            'product_name' => $allFields['product']['product_info']['metadata']['title'],
                            'product_desc' => $allFields['product']['product_info']['metadata']['description'],
                            'product_thumb' => $allFields['product']['product_info']['media']['thumb_170_url'],
                            'web_type' => $allFields['product']['type'],
                            'product_size' => $allFields['product']['selected_product']['width'],
                            'product_price' => $allFields['product']['selected_product']['price'],
                            'product_poster' => $allFields['product']['product_info']['media']['thumb_170_url'],
                            'selected_product' => json_encode($allFields['product']['selected_product']),
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s'),
                            'licence_type' => $allFields['product']['extended'],
                            'redownloded_date' => null,
                        );
                    }


                    UserProductDownload::insert($dataInsert);

                    if (!$dataCheck) {
                        UserPackage::where('user_id', '=', $id)
                            ->where('package_type', '=', $flag)
                            ->where('id', '=', $package_id)
                            ->update([
                                'downloaded_product' => DB::raw('downloaded_product+1'),
                                'updated_at' => date('Y-m-d H:i:s')
                            ]);
                    }
                }
                return response()->json($product_details_data);
            } else if ($allFields['product']['type'] == 4) {
                // Download music from pond5
                $footageMedia = new FootageApi();
                //TODO Need to change for api_product_id
                $download_id = $allFields['product']['product_info']['media']['id'];
                $version = isset($allFields['product']['selected_product']['version']) ? $allFields['product']['selected_product']['version'] : $download_id.':0';
                $product_details_data = $footageMedia->download($download_id ,$version);
                if (!empty($product_details_data)) {
                    $dataCheck = UserProductDownload::select('product_id')->where('product_id_api', $allFields['product']['product_info']['media']['id'])->where('web_type', $allFields['product']['type'])->first();

                    $product_id = Product::where('api_product_id', '=', $allFields['product']['product_info']['media']['id'])->first();

                    /** TODO : set the array as per response */
                    $dataInsert = array(
                        'user_id' => $id,
                        'package_id' => $allFields['product']['package'],
                        'product_id' => $product_id,
                        'product_id_api' => $allFields['product']['product_info']['media']['id'],
                        'id_media' => $allFields['product']['product_info']['media']['id'],
                        'download_url' => $product_details_data['url'],
                        'downloaded_date' => date('Y-m-d H:i:s'),
                        'product_name' => $allFields['product']['product_info'][0]['clip_data']['n'],
                        'product_desc' => $allFields['product']['product_info'][0]['clip_data']['pic_description'],
                        'product_thumb' => $allFields['product']['product_info'][0]['flv_base'],
                        'web_type' => $allFields['product']['type'],
                        'product_size' => '',
                        'product_price' => $allFields['product']['selected_product']['price'],
                        'product_poster' => $allFields['product']['product_info'][0]['flv_base'],
                        'selected_product' => json_encode($allFields['product']['selected_product']),
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                        'licence_type' => $allFields['product']['extended'],
                        'redownloded_date' => null,
                    );

                    UserProductDownload::insert($dataInsert);

                    if (!$dataCheck) {
                        UserPackage::where('user_id', '=', $id)
                            ->where('package_type', '=', $flag)
                            ->where('id', '=', $package_id)
                            ->update([
                                'downloaded_product' => DB::raw('downloaded_product+1'),
                                'updated_at' => date('Y-m-d H:i:s')
                            ]);
                    }
                }
                return response()->json($product_details_data);
            }
        } else {
            return response()->json(['status' => '0', 'message' => 'Download pack limit has been over already !!']);
        }
    }

    public function multipleDownload(Request $request)
    {
        $allFields = $request->all();
        $tokens = json_decode($allFields['userData'], true);
        $id = $tokens['Utype'];
        $flag = 'Image';
        $package_id = $allFields['planId'];

        $pacakegalist = UserPackage::whereIn('payment_status', ['Completed', 'Transction Success'])
            ->where('user_id', '=', $id)
            ->where('package_type', '=', $flag)
            ->where('id', '=', $package_id)
            ->where('package_expiry_date_from_purchage', '>', Now())
            ->get();

        $download = 0;
        $downoad_type = 0;
        if ($pacakegalist->isNotEmpty()) {
            foreach ($pacakegalist as $perpack) {
                if ($perpack->package_plan == 1) { // For subscriprion type package
                    // Check subscription is monthly or not

                    if ($perpack->package_expiry != 0 && $perpack->package_expiry_yearly == 0) {

                        $subscriptionStartDate = Carbon::parse($perpack->created_at);

                        $latestDates = $this->getDateGaps($subscriptionStartDate);
                        $startDateOfSpecificMonth = $latestDates['startDate'];
                        $endDateOfSpecificMonth = $latestDates['endDate'];

                        // Count the number of downloads for the current month
                        $monthlyDownloads = ProductsDownload::where(['user_id' => $id, 'package_id' => $package_id])
                            ->whereBetween('downloaded_date', [$startDateOfSpecificMonth, $endDateOfSpecificMonth])
                            ->distinct('id_media')
                            ->pluck('id_media')->count();

                        if ($monthlyDownloads >= $perpack->package_products_count) {
                            return response()->json(['status' => '0', 'message' => 'You have exceeded a monthly download limit.']);
                        } else {
                            $download = 1;
                        }
                    } else if ($perpack->downloaded_product < $perpack->package_products_count) {
                        $download = 1;
                    }
                } else if ($perpack->package_plan == 2 && $perpack->downloaded_product < $perpack->package_products_count) { // For download type package
                    $download = 1;
                }
            }
        } else {
            return response()->json(['status' => 'wrong_plan', 'message' => 'Please select correct package to download!!']);
        }

        if ($download == 1) {
            if ($flag == "Image") {

                $products = Product::whereIn('product_id', $allFields['selectedValues'])
                    ->get();
                foreach ($products as $product) {

                    $dataCheck = UserProductDownload::where('product_id_api', $product['api_product_id'])->where('product_size', $product["product_size"])->where('web_type', $product['product_web'])->first();

                    $dataInsert = array(
                        'user_id' => $id,
                        'package_id' => $package_id,
                        'product_id' => $product['product_id'],
                        'id_download' => 0,
                        'product_id_api' => $product['api_product_id'],
                        'id_media' => $product['product_id'],
                        'download_url' => $product['product_thumbnail'],
                        'downloaded_date' => date('Y-m-d H:i:s'),
                        'product_name' => $product['product_title'],
                        'product_desc' => $product['product_description'],
                        'product_thumb' => $product['product_thumbnail'],
                        'web_type' => $product['product_web'],
                        'product_size' => $product["product_size"],
                        'selected_product' => json_encode($product),
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    );

                    UserProductDownload::insert($dataInsert);
                }

                if (!$dataCheck) {
                    UserPackage::where('user_id', '=', $id)
                        ->where('package_type', '=', $flag)
                        ->where('id', '=', $package_id)
                        ->update([
                            'downloaded_product' => DB::raw('downloaded_product+1'),
                            'updated_at' => date('Y-m-d H:i:s')
                        ]);
                }
                return response()->json(['status' => 'download_success', 'message' => 'Products downloaded successfully !!']);
            }
        } else {
            return response()->json(['status' => 'download_limit', 'message' => 'Download pack limit has been over already !!']);
        }
    }
    /**
     * This API is used to re-download the image
     */
    public function reDownload(Request $request)
    {
        $checkUserDownloads = UserProductDownload::where(
            [
                'user_id' => $request->user_id,
                'id_media' => $request->id_media,
                'web_type' => $request->type
            ]
        )->first();

        if (!$checkUserDownloads) {
            return response()->json(['status'=> 'success', 'message'=> 'Requested Image is not found in downloaded history!!','data'=>null]);
        }else{
            $imageDownloadData = '';
            if($request->type == 2){
                $getPantherMediaDetail =Product::where(['api_product_id'=>$request->id_media,'product_web'=>2])->first();
                if(!empty($getPantherMediaDetail)) {
                    $image = new ImageApi();
                    $data = ['id_media'=>$checkUserDownloads->id_media,'id_download'=>$checkUserDownloads->id_download,'queue_hash'=>$checkUserDownloads->queue_hash];
                    $imageDownloadData = $image->reDownloadMedia($data);
                }
            }

            $imageDataInsert = array(
                'user_id' => $checkUserDownloads->user_id,
                'package_id' => $checkUserDownloads->package_id,
                'product_id' => $checkUserDownloads->product_id,
                'id_download' => $checkUserDownloads->id_download,
                'product_id_api' => $checkUserDownloads->product_id_api,
                'id_media' => $checkUserDownloads->id_media,
                'download_url' => isset($imageDownloadData) && !empty($imageDownloadData) ? $imageDownloadData['download_status']['download_url'] : $checkUserDownloads->download_url,
                'downloaded_date'=>null,
                'redownloded_date' => date('Y-m-d H:i:s'),
                'product_name' => $checkUserDownloads->product_name,
                'product_desc' => $checkUserDownloads->product_desc,
                'product_thumb' => $checkUserDownloads->product_thumb,
                'web_type' => $checkUserDownloads->web_type,
                'product_size' => $checkUserDownloads->product_size,
                'product_price' => $checkUserDownloads->product_price,
                'product_poster' => $checkUserDownloads->product_poster,
                'selected_product' => $checkUserDownloads->selected_product,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            );

            $userProductDownload = new UserProductDownload();
            $condition = ['product_id' => $checkUserDownloads->product_id];
            $userProductDownload->updateOrInsert($condition, $imageDataInsert);

            if($imageDownloadData['download_status']['status'] == "ready"){
                return response()->json(['status'=> 'ready', 'message'=> 'Download url get successfully','data'=>$imageDataInsert]);
            }else{
                return response()->json(['status'=> 'Pending', 'message'=> 'Your Product will be downloaded soon.','data'=>$imageDataInsert]);
            }

        }
    }

    public function getDateGaps($packageStartDate)
    {

        $currentDate = Carbon::now();
        // Define an array to store date ranges
        $dateRanges = [];

        // Loop through 12 months and calculate date ranges
        for ($i = 0; $i < 12; $i++) {
            $startDate = Carbon::parse($packageStartDate)->addMonths($i);
            $endDate = Carbon::parse($packageStartDate)->addMonths($i + 1);

            // Check if the current date is within this date range
            if ($currentDate >= $startDate && $currentDate <= $endDate) {
                $dateRanges = ['startDate' => $startDate, 'endDate' => $endDate];
                break; // Exit the loop once a match is found
            }
        }
        return $dateRanges;
    }

    public function downloadindi(Request $request)
    {
        ini_set('max_execution_time', 0);
        $allFields = $request->all();
        //print_r($allFields); die;
        $tokens = json_decode($allFields['product']['token'], true);
        $id = $tokens['Utype'];
        if ($allFields['product']['type'] == 2) {
            $flag = 'Image';
        } else {
            $flag = 'Footage';
        }
        if ($allFields['product']['type'] == 3) {
            $version = (array) json_decode($allFields['product']['product_info']['selected_product']);
            $version = $version['version'];
            $footageMedia = new FootageApi();
            $product_details_data = $footageMedia->download(json_decode($allFields['product']['product_info']['selected_product'], true), $id, $version);
            return response()->json($product_details_data);
        } else if ($allFields['product']['type'] == 2) {
            $imageMedia = new ImageApi();
            $selected = json_decode($allFields['product']['product_info']['selected_product'], true);
            $all = json_decode($allFields, true);
            $download = [];
            $download['product']['product_info']['media']['id'] = $all['product']['product_info']['media']['id'];
            $download['product']['selected_product']['id'] = $selected['id'];
            $product_details_data = $imageMedia->download($allFields, $id);
            return response()->json($product_details_data);
        }
    }

    public function sampledownloadFootage(Request $request)
    {
        ini_set('max_execution_time', 0);
        $allFields = $request->all();
        // $main_image = Product::where('product_id', '=', $allFields['productID'])->first()->product_main_image;
        $main_image = Product::where('api_product_id', '=', $allFields['productID'])->first()->product_main_image;
        $b64image = base64_encode(file_get_contents($main_image));
        $downlaod_image = 'data:video/mp4;base64,' . $b64image;
        return response()->json($downlaod_image);
    }

    public function callback_download(Request $request)
    {
        $first = $request->all();
        $second = file_get_contents('php://input');
        $final = $first . '<>' . $second;
        Log::channel('panther_media')->debug('FINAL: ' . $final);
    }

    //Get Licence details

    public function licenceDetails(Request $request){
        if(isset($request->type) && !empty($request->type)){
            $getDetails = LicenceType::where('product_type',$request->type)->get();
        }else{
            $getDetails = LicenceType::get();
        }
        return response()->json(['status'=>'success','data'=>$getDetails]);

    }
}
