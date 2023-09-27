<?php

namespace App\Http\Controllers;

use App\Models\Common;
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
        $checkExists = UserProductDownload::where(['user_id' => $request->user_id, 'product_id_api' => $request->media_id])->exists();
        return response()->json(["status" => $checkExists]);
    }

    public function index($media_id, $origin, $type)
    {
        if ($origin == '2') {
            $imageMedia = new ImageApi();
            $media_id = decrypt($media_id);
            $product_details_data = $imageMedia->get_media_info($media_id);

            $product_details_data['articles']['singlebuy_list']['singlebuy'][0]['sizes']['article'] = [
                ["name" => 'web', "description" => "Web", "price" => "550", "width" => "141", "height" => "94"],
                ["name" => 'medium', "description" => "Medium", "price" => "2500", "width" => "148", "height" => "98"],
                ["name" => 'large', "description" => "Large", "price" => "3500", "width" => "297", "height" => "198"],
                ["name" => 'xxl', "description" => "XXL", "price" => "4600", "width" => "360", "height" => "240"]
            ];

            $b64image = base64_encode(file_get_contents($product_details_data['media']['preview_url_no_wm']));
            $size = getimagesize($product_details_data['media']['preview_url_no_wm']);
            $height = $size[1];
            $width = $size[0];
            $left = 0;
            if ($width > 300) {
                $left = $width - 300;
            }

            $img = Image::make($product_details_data['media']['preview_url_no_wm']);
            // insert watermark at bottom-right corner with 10px offset
            //$downlaod_image1 = $img->insert(public_path('images/logoimage_new.png'), 'top-left', intval($left / 2), intval($height / 2));
            $time = time();
            $img->save(public_path('images/dump/' . $time . '.jpg'));
            $img->encode('jpg');
            $type = 'jpg';
            // $downlaod_image = '';
            $downlaod_image = 'data:image/' . $type . ';base64,' . base64_encode($img);
            // dd($downlaod_image);
            // unlink(public_path('images/dump/' . $time . '.jpg'));

            if (count($product_details_data) > 0) {
                $imagefootage_id = $this->product->savePantherImagedetail($product_details_data, 0);
            }

            // $product_details_data['media']['thumb_150_url'] = str_replace('http:', 'https:', $product_details_data['media']['thumb_150_url']);
            // $product_details_data['media']['thumb_170_url'] = str_replace('http:', 'https:', $product_details_data['media']['thumb_170_url']);
            // $product_details_data['media']['preview_url'] = str_replace('http:', 'https:', $product_details_data['media']['preview_url']);
            // $product_details_data['media']['preview_url_high'] = str_replace('http:', 'https:', $product_details_data['media']['preview_url_high']);
            // $product_details_data['media']['preview_url_no_wm'] = str_replace('http:', 'https:', $product_details_data['media']['preview_url_no_wm']);
            // $product_details_data['media']['preview_url_high_no_wm'] = str_replace('http:', 'https:', $product_details_data['media']['preview_url_high_no_wm']);
            $product_details = array($product_details_data, $imagefootage_id, $downlaod_image);
        } else if ($origin == '3') {

            if ($type == 'Music') {

                $media_id = decrypt($media_id);
                $musicMedia = new MusicApi();
                $product_details_data = $musicMedia->getMusicInfo($media_id);
                if (count($product_details_data) > 0) {
                    $imagefootage_id = $this->product->savePond5Music($product_details_data, 0);
                }
                $product_details = array($product_details_data);
            } else {
                $media_id = decrypt($media_id);
                $keyword['search'] = $media_id;
                $footageMedia = new FootageApi();
                $product_details_data = $footageMedia->getclipdata($media_id);

                if (isset($product_details_data['id'])) {
                    $pond_id_withprefix = $product_details_data['id'];
                    if (strlen($product_details_data['id']) < 9) {
                        $add_zero = 9 - (strlen($product_details_data['id']));
                        for ($i = 0; $i < $add_zero; $i++) {
                            $pond_id_withprefix = "0" . $pond_id_withprefix;
                        }
                    }
                    $b64image = base64_encode(file_get_contents($product_details_data['watermarkPreview']));
                    $downlaod_image = '';
                    if (count($product_details_data) > 0) {
                        $imagefootage_id = $this->product->savePond5singleImage($product_details_data, 0);
                    }
                }
                $product_details = array($product_details_data, $pond_id_withprefix . '_main_xl.mp4', $pond_id_withprefix . '_iconl.jpeg', $imagefootage_id, $downlaod_image);
            }
        } else {
            $product = new Product();
            $product_details = $product->getProductDetail($media_id, $type);
        }
        return response()->json($product_details);
    }


    public function categoryListApi()
    {
        $categories  = ProductCategory::select('category_id', 'category_name')
            ->where('is_display_home', 1)
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
                    if ($allFields['product']['selected_product']['size'] == '4K' && $perpack['pacage_size'] == '2') {
                        $downoad_type = 1;
                    } else if ($allFields['product']['selected_product']['size'] == 'HD (1080)' && $perpack['pacage_size'] == '1') {
                        $downoad_type = 1;
                    }
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
                $product_details_data = $footageMedia->download($allFields['product']['selected_product'], $id);

                if (!empty($product_details_data)) {
                    $dataCheck = UserProductDownload::where('product_id_api', $allFields['product']['selected_product']['id'])->where('product_size', $allFields['product']['selected_product']['size'])->where('web_type', $allFields['product']['type'])->first();
                    $product_id = Product::where('api_product_id', '=', $allFields['product']['selected_product']['id'])->first()->product_id;
                    $dataInsert = array(
                        'user_id' => $id,
                        'package_id' => $allFields['product']['package'],
                        'product_id' => $product_id,
                        'product_id_api' => $allFields['product']['selected_product']['id'],
                        'id_media' => $allFields['product']['selected_product']['id'],
                        'download_url' => $product_details_data['url'],
                        'downloaded_date' => date('Y-m-d H:i:s'),
                        'product_name' => $allFields['product']['product_info'][0]['clip_data']['pic_name'],
                        'product_desc' => $allFields['product']['product_info'][0]['clip_data']['pic_description'],
                        'product_thumb' => $allFields['product']['product_info'][0]['flv_base'] . $allFields['product']['product_info'][1],
                        'web_type' => $allFields['product']['type'],
                        'product_size' => $allFields['product']['selected_product']['size'],
                        'product_price' => $allFields['product']['selected_product']['pr'],
                        'product_poster' => $allFields['product']['product_info'][2],
                        'selected_product' => json_encode($allFields['product']['selected_product']),
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
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
                $imageMedia = new ImageApi();

                $product_details_data = $imageMedia->download($allFields, $id);
                if (!empty($product_details_data)) {
                    $dataCheck = UserProductDownload::select('product_id')->where('product_id_api', $allFields['product']['product_info']['media']['id'])->where('product_size', $allFields['product']['selected_product']['width'])->where('web_type', $allFields['product']['type'])->first();

                    $product_id = Product::where('api_product_id', '=', $allFields['product']['product_info']['media']['id'])->first();

                    $dataInsert = array(
                        'user_id' => $id,
                        'package_id' => $allFields['product']['package'],
                        'product_id' => $product_id,
                        'id_download' => $product_details_data['download_status']['id_download'],
                        'product_id_api' => $allFields['product']['product_info']['media']['id'],
                        'id_media' => $allFields['product']['product_info']['media']['id'],
                        'download_url' => $product_details_data['download_status']['download_url'],
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
                        'updated_at' => date('Y-m-d H:i:s')
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
            } else if ($allFields['product']['type'] == 4) {
                $musicMedia = new MusicApi();

                $product_details_data = $musicMedia->download($allFields, $id);
                if (!empty($product_details_data)) {
                    $dataCheck = UserProductDownload::select('product_id')->where('product_id_api', $allFields['product']['product_info']['media']['id'])->where('product_size', $allFields['product']['selected_product']['width'])->where('web_type', $allFields['product']['type'])->first();

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
                        'product_name' => $allFields['product']['product_info']['metadata']['title'],
                        'product_desc' => $allFields['product']['product_info']['metadata']['description'],
                        'product_thumb' => $allFields['product']['product_info']['media']['thumb_170_url'],
                        'web_type' => $allFields['product']['type'],
                        'product_size' => $allFields['product']['selected_product']['width'],
                        'product_price' => $allFields['product']['selected_product']['price'],
                        'product_poster' => $allFields['product']['product_info']['media']['thumb_170_url'],
                        'selected_product' => json_encode($allFields['product']['selected_product']),
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
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
                foreach($products as $product){

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

        if ($checkUserDownloads) {
            if ($request->type == 2) {
                $imageMedia = new ImageApi();
                $image_product_details_data = $imageMedia->reDownloadMedia($checkUserDownloads);
                if (!empty($product_details_data)) {

                    $imageDataInsert = array(
                        'user_id' => $checkUserDownloads->user_id,
                        'package_id' => $checkUserDownloads->package_id,
                        'product_id' => $checkUserDownloads->product_id,
                        'id_download' => $image_product_details_data['download_status']['id_download'],
                        'product_id_api' => $checkUserDownloads->product_id,
                        'id_media' => $image_product_details_data['download_status']['id_media'],
                        'download_url' => $image_product_details_data['download_status']['download_url'],
                        'downloaded_date' => date('Y-m-d H:i:s'),
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
                    UserProductDownload::insert($imageDataInsert);
                }
                return response()->json($image_product_details_data);
            } else if ($request->type == 3) {
                $footageMedia = new FootageApi();
                $footage_product_details_data = $footageMedia->download($checkUserDownloads, $checkUserDownloads['user_id']);

                if (!empty($footage_product_details_data)) {
                    $footageDataInsert = array(
                        'user_id' => $checkUserDownloads->user_id,
                        'package_id' => $checkUserDownloads->package_id,
                        'product_id' => $checkUserDownloads->product_id,
                        'id_download' => $footage_product_details_data['download_status']['id_download'],
                        'product_id_api' => $checkUserDownloads->product_id,
                        'id_media' => $footage_product_details_data['download_status']['id_media'],
                        'download_url' => $footage_product_details_data['download_status']['download_url'],
                        'downloaded_date' => date('Y-m-d H:i:s'),
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

                    UserProductDownload::insert($footageDataInsert);
                }
                return response()->json($footage_product_details_data);
            } else if ($request->type == 4) {
                $musicMedia = new MusicApi();
                $music_product_details_data = $musicMedia->download($checkUserDownloads, $checkUserDownloads['user_id']);

                if (!empty($music_product_details_data)) {
                    $musicDataInsert = array(
                        'user_id' => $checkUserDownloads->user_id,
                        'package_id' => $checkUserDownloads->package_id,
                        'product_id' => $checkUserDownloads->product_id,
                        'id_download' => $music_product_details_data['download_status']['id_download'],
                        'product_id_api' => $checkUserDownloads->product_id,
                        'id_media' => $music_product_details_data['download_status']['id_media'],
                        'download_url' => $music_product_details_data['download_status']['download_url'],
                        'downloaded_date' => date('Y-m-d H:i:s'),
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
                    UserProductDownload::insert($musicDataInsert);
                }
                return response()->json($music_product_details_data);
            }
        } else {
            return response()->json(['status' => '0', 'message' => 'Requested Image is not found in downloaded history!!']);
        }
    }

    public function getDateGaps($packageStartDate)
    {
        $currentDate = Carbon::today();
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
        echo "<pre>";
        print_r($request->all());
        die;
    }
}
