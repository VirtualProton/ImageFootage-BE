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

            $product_details_data['media']['thumb_150_url'] = str_replace('http:', 'https:', $product_details_data['media']['thumb_150_url']);
            $product_details_data['media']['thumb_170_url'] = str_replace('http:', 'https:', $product_details_data['media']['thumb_170_url']);
            $product_details_data['media']['preview_url'] = str_replace('http:', 'https:', $product_details_data['media']['preview_url']);
            $product_details_data['media']['preview_url_high'] = str_replace('http:', 'https:', $product_details_data['media']['preview_url_high']);
            $product_details_data['media']['preview_url_no_wm'] = str_replace('http:', 'https:', $product_details_data['media']['preview_url_no_wm']);
            $product_details_data['media']['preview_url_high_no_wm'] = str_replace('http:', 'https:', $product_details_data['media']['preview_url_high_no_wm']);
            $product_details = array($product_details_data, $imagefootage_id, $downlaod_image);
        } else if ($origin == '3') {
            $media_id = decrypt($media_id);
            $keyword['search'] = $media_id;
            $footageMedia = new FootageApi();
            $product_details_data = $footageMedia->getclipdata($media_id);
            //print_r($product_details_data);
            if (isset($product_details_data['clip_data']['pic_objectid'])) {
                $pond_id_withprefix = $product_details_data['clip_data']['pic_objectid'];
                if (strlen($product_details_data['clip_data']['pic_objectid']) < 9) {
                    $add_zero = 9 - (strlen($product_details_data['clip_data']['pic_objectid']));
                    for ($i = 0; $i < $add_zero; $i++) {
                        $pond_id_withprefix = "0" . $pond_id_withprefix;
                    }
                }
                $b64image = base64_encode(file_get_contents($product_details_data['icon_base'] . $pond_id_withprefix . '_main_xl.mp4'));
                $downlaod_image = '';
                if (count($product_details_data) > 0) {
                    $imagefootage_id = $this->product->savePond5Image($product_details_data, 0);
                }
            }
            $product_details = array($product_details_data, $pond_id_withprefix . '_main_xl.mp4', $pond_id_withprefix . '_iconl.jpeg', $imagefootage_id, $downlaod_image);
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
        //print_r($allFields); die;
        $tokens = json_decode($allFields['product']['token'], true);
        $id = $tokens['Utype'];
        $pacakeg_id = $allFields['product']['package'];
        if ($allFields['product']['type'] == 2) {
            $flag = 'Image';
        } else {
            $flag = 'Footage';
        }
        $pacakegalist = UserPackage::whereIn('payment_status', ['Completed', 'Transction Success'])
            ->where('user_id', '=', $id)
            ->where('package_type', '=', $flag)
            ->where('id', '=', $pacakeg_id)
            ->where('package_expiry_date_from_purchage', '>', Now())
            //->select()
            ->get()->toArray();
        $download = 0;
        $downoad_type = 0;

        if (count($pacakegalist) > 0) {
            foreach ($pacakegalist as $perpack) {
                if ($perpack['downloaded_product'] < $perpack['package_products_count']) {
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
                    if (!$dataCheck) {
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
                        UserPackage::where('user_id', '=', $id)
                            ->where('package_type', '=', $flag)
                            ->where('id', '=', $pacakeg_id)
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
                return response()->json($product_details_data);
            }
        } else {
            return response()->json(['status' => '0', 'message' => 'Download pack limit has been over already !!']);
        }
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
            $footageMedia = new FootageApi();
            $product_details_data = $footageMedia->download(json_decode($allFields['product']['product_info']['selected_product'], true), $id);
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
        $main_image = Product::where('product_id', '=', $allFields['productID'])->first()->product_main_image;
        $b64image = base64_encode(file_get_contents($main_image));
        $downlaod_image = 'data:video/mp4;base64,' . $b64image;
        return response()->json($downlaod_image);
    }

    public function callback_download(Request $request){
        echo "<pre>"; 
        print_r($request->all()); die;
    }
}
