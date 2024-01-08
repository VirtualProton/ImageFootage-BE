<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\{
    Usercart,
    UserWishlist,
    Product,
    Contributor,
    ImageFootageWishlist,
    User
};
use Illuminate\Support\Facades\Hash;
use CORS;

use App\Models\Currency;


use Stevebauman\Location\Facades\Location;


class FrontuserController extends Controller {

	public $userWishList, $productModel, $imageFootageWishlistModel, $userModel;
	public function __construct(
		UserWishlist $userWishList,
		Product $product,
		ImageFootageWishlist $imageFootageWishlist,
		User $userModel
	) {
		$this->userWishListModel = $userWishList;
		$this->productModel = $product;
		$this->imageFootageWishlistModel = $imageFootageWishlist;
		$this->userModel = $userModel;
	}

    public function addtocart(Request $request){
        //$lub = new Lcobucci();
		$Usercart=new Usercart;
		$already_image = 0;
		$counterImage  = 0;
		$already_footage = 0;
		$counterFootage  = 0;
		if(isset($request['product']['type']) && $request['product']['type'] =='2'){
            $product_id = $request['product']['product_info']['media']['id'];
            $product_type = "Image";
            $tokens=json_decode($request['product']['token'],true);
            $product_addedby = $tokens['Utype'];
            $cart_list= $Usercart->where('cart_product_id',$product_id)->where('cart_added_by',$product_addedby)->where('extended_name',$request['product']['extended'])->get()->toArray();
            if(empty($cart_list)){
                $Usercart=new Usercart;
                $Usercart->cart_product_id=$product_id;
                $Usercart->cart_product_type= $product_type;
                $Usercart->cart_added_by= $product_addedby;
                $Usercart->standard_type= isset($request['product']['selected_product']['name']) ?$request['product']['selected_product']['name'] : '';
                $Usercart->cart_added_on= date('Y-m-d H:i:s');
                $Usercart->standard_size= isset($request['product']['selected_product']['version'])  ?  $request['product']['selected_product']['version'] : '';
                $Usercart->standard_price = isset($request['product']['selected_product']['price']) ? $request['product']['selected_product']['price']: 0;
				# TODO: After dynamic licenece Type call this should address
                 $Usercart->extended_name= isset($request['product']['extended']) ? $request['product']['extended']:'';
                // $Usercart->extended_price= isset($request['product']['extended'])?$request['product']['extended']['price']:'0';
                $Usercart->total= isset($request['product']['total'])?$request['product']['total']:0;
                $Usercart->product_name= isset($request['product']['product_info']['metadata']['title']) ? $request['product']['product_info']['metadata']['title'] : '';
                $Usercart->product_thumb= isset($request['product']['product_info']['media']['thumb_170_url']) ? $request['product']['product_info']['media']['thumb_170_url']:'';
                $Usercart->product_desc= isset($request['product']['product_info']['metadata']['description']) ? $request['product']['product_info']['metadata']['description'] : '';
                $Usercart->product_web= $request['product']['type'];
                $Usercart->product_json= json_encode($request['product']['product_info']);
                $Usercart->selected_product = json_encode($request['product']['selected_product']);
                $result=$Usercart->save();
                if($result){
                    echo '{"status":"1","message":"Product added to cart successfully"}';
                }else{
                    echo '{"status":"0","message":"Some problem occured."}';
                }
            }else{
                echo '{"status":"0","message":"Already this product is in your cart."}';
            }
        }else if(isset($request['product']['type']) && $request['product']['type'] =='3'){
            $product_id = $request['product']['product_info']['media']['id'];
            if($request['product']['product_type'] == 'music'){
                $product_id = decrypt($product_id);
            }
			$product_type =  $request['product']['product_type'];
			$tokens =  json_decode(stripslashes($request['product']['token']), true);
            $product_addedby = $tokens['Utype'];
            $cart_list= $Usercart->where('cart_product_id',$product_id)->where('cart_added_by',$product_addedby)->where('extended_name',$request['product']['extended'])->where('standard_size',$request['product']['selected_product']['version'])->get()->toArray();
			// dd($request);
            if(empty($cart_list)){
                $Usercart=new Usercart;
                $Usercart->cart_product_id=$product_id;
                $Usercart->cart_product_type= $product_type;
                $Usercart->cart_added_by= $product_addedby;
                $Usercart->standard_type= isset($request['product']['selected_product']['size']) ? $request['product']['selected_product']['size']:'';
                $Usercart->cart_added_on= date('Y-m-d H:i:s');
                $Usercart->standard_size= isset($request['product']['selected_product']['version']) ?$request['product']['selected_product']['version']:'' ;
                $Usercart->standard_price = isset($request['product']['selected_product']['price']) ? $request['product']['selected_product']['price'] : 0;
                // $Usercart->total= $request['product']['total'];
				$Usercart->total = isset($request['product']['selected_product']['price']) ? $request['product']['selected_product']['price']:0;
                $Usercart->product_name= isset($request['product']['product_info'][0]['clip_data']['n']) ? $request['product']['product_info'][0]['clip_data']['n'] : '';
                $Usercart->product_thumb= isset($request['product']['product_info'][2]) ? $request['product']['product_info'][2] : '';
                $Usercart->product_desc= isset($request['product']['product_info'][0]['clip_data']['pic_description']) ? $request['product']['product_info'][0]['clip_data']['pic_description'] : '';
                $Usercart->product_web= isset($request['product']['type']) ? $request['product']['type'] :0;
                $Usercart->product_main_footage = isset($request['product']['product_info'][2]) ?$request['product']['product_info'][2] : '' ;
                $Usercart->product_json= json_encode($request['product']['product_info'][0]);
                $Usercart->selected_product = json_encode($request['product']['selected_product']);
                $Usercart->extended_name = isset($request['product']['extended']) ? $request['product']['extended'] : '';
                $result=$Usercart->save();
                if($result){
                    echo '{"status":"1","message":"Product added to cart successfully"}';
                }else{
                    echo '{"status":"0","message":"Some problem occured."}';
                }
            }else{
                echo '{"status":"0","message":"Allready this product is in your cart."}';
            }
        }else if(isset($request['product']['type']) && $request['product']['type'] =='4'){
			//print_r($request['data']); die;
                $tokens =  json_decode(stripslashes($request['product']['token']), true);
                $product_addedby = $tokens['Utype'];
                $cart_list= $Usercart->where('cart_product_id', $request['product']['product_info']['media']['id'])->where('cart_added_by',$product_addedby)->where('extended_name',$request['product']['extended'])->get()->toArray();
                if(empty($cart_list)){
                    $Usercart=new Usercart;
                    $Usercart->cart_product_id= $request['product']['product_info']['media']['id'];
                    $Usercart->cart_product_type= "music";
                    $Usercart->cart_added_by= $product_addedby;
                    $Usercart->standard_type= isset($request['product']['selected_product']['size']) ? $request['product']['selected_product']['size']:'';
                    $Usercart->cart_added_on= date('Y-m-d H:i:s');
                    $Usercart->standard_size= isset($request['product']['selected_product']['version']) ? $request['product']['selected_product']['version']:'';
                    $Usercart->standard_price = isset($request['product']['selected_product']['price']) ? $request['product']['selected_product']['price']:'';
                    $Usercart->extended_name= isset($request['product']['extended']) ? $request['product']['extended'] : '';;
                    $Usercart->extended_price= '0';
                    $Usercart->total= isset($request['product']['selected_product']['price']) ? $request['product']['selected_product']['price']:0;;
                    $Usercart->product_name= isset($request['product']['product_info'][0]['clip_data']['n']) ? $request['product']['product_info'][0]['clip_data']['n'] : '';
                    $Usercart->product_thumb= isset($request['product']['product_info'][2]) ? $request['product']['product_info'][2] : '';
                    $Usercart->product_desc= isset($request['product']['product_info'][0]['clip_data']['pic_description']) ? $request['product']['product_info'][0]['clip_data']['pic_description'] : '';
                    $Usercart->product_web= '4';
                    $Usercart->product_json= json_encode($request['product']['product_info'][0]);
                    $Usercart->selected_product = json_encode($request['product']['selected_product']);
                    //$Usercart->pricing_tier = $eachproduct['footage_tier'];
                    $result = $Usercart->save();
                    if($result){
                        //$counterFootage++;
                        echo '{"status":"1","message":"Product added to cart successfully"}';
                    }else{

                        echo '{"status":"0","message":"Some problem occured."}';
                    }
                }else{
                    //$already_footage++;
                    echo '{"status":"0","message":"Already this product is in your cart."}';
                }


			//echo "<pre>";
			//print_r($request['data']);
		}else if(isset($request['type']) && $request['type'] =='5'){
			//print_r($request['data']); die;
			if(count($request['data']) > 0){
				foreach($request['data'] as $eachproduct){
					$tokens =  json_decode(stripslashes($request['token']), true);
					$product_addedby = $tokens['Utype'];
					$cart_list= $Usercart->where('cart_product_id', $eachproduct['package_id'])->where('cart_added_by',$product_addedby)->where('extended_name',$request['product']['extended'])->get()->toArray();
            		if(empty($cart_list)){
						$Usercart=new Usercart;
						$Usercart->cart_product_id= $eachproduct['package_id'];
						$Usercart->cart_product_type= "Image";
						$Usercart->cart_added_by= $product_addedby;
						$Usercart->standard_type= $eachproduct['package_name'];
						$Usercart->cart_added_on= date('Y-m-d H:i:s');
						$Usercart->standard_size= $eachproduct['package_name'];
						$Usercart->standard_price = $eachproduct['package_price'];
						$Usercart->extended_name= isset($eachproduct['extended']) ? $eachproduct['extended'] : '';
						$Usercart->extended_price= '0';
						$Usercart->total= $eachproduct['package_price'];
						$Usercart->product_name= $eachproduct['package_description'];
						$Usercart->product_thumb= '';
						$Usercart->product_desc= '';
						$Usercart->product_web= '5';
						$Usercart->product_json= json_encode($eachproduct);
						$Usercart->selected_product = '';
						$Usercart->pricing_tier = $eachproduct['footage_tier'];
						$result = $Usercart->save();
						$counterImage++;
					}else{
						$already_image++;
					}
				}
				if($counterImage == count($request['data'] )){
					echo '{"status":"1","message":"Product added to cart successfully"}';
				}else{
					echo '{"status":"0","message":"Already some products is in your cart."}';
				}
			}
			//echo "<pre>";
			//print_r($request['data']);
		}else if($request[0]['type'] == 'Music'){


			$product_id = $request[0]['id'];
			$product_type = "Music";

			$tokens =  $request[0]['token']; // token
            $product_addedby = json_decode($tokens)->Utype;

            $cart_list= $Usercart->where('cart_product_id',$product_id)->where('cart_added_by',$product_addedby)->get()->toArray();
            if(empty($cart_list)){
                $Usercart=new Usercart;
                $Usercart->cart_product_id=$product_id;
                $Usercart->cart_product_type= $product_type;
                $Usercart->cart_added_by= $product_addedby;
                $Usercart->standard_type= $request[0]['fileType'];
                $Usercart->cart_added_on= date('Y-m-d H:i:s');
                $Usercart->standard_size= $request[0]['versions'][0]['size'];
                $Usercart->standard_price = $request[0]['versions'][0]['price'];
				$Usercart->total = $request[0]['versions'][0]['price'];
                $Usercart->product_name= $request[0]['title'];
                $Usercart->product_thumb= $request[0]['thumbnail'];
                $Usercart->product_desc= $request[0]['description'];
                $Usercart->product_web= 3;
                $Usercart->product_json= json_encode($request[0]);
                $Usercart->selected_product = json_encode($request[0]['versions']);
                $result=$Usercart->save();
                if($result){
                    echo '{"status":"1","message":"Product added to cart successfully"}';
                }else{
                    echo '{"status":"0","message":"Some problem occured."}';
                }
            }else{
                echo '{"status":"0","message":"Already this product is in your cart."}';
            }
		}
	}

	public function userCartList(Request $request)
	{
		$Usercart = new Usercart;
		$cart_list = $Usercart->where('cart_added_by', $request['Utype'])->with('product')->with('licence')->get()->toArray();
		foreach ($cart_list as $item => $eachmedia) {
			$cart_list[$item]['product']['api_product_id'] = encrypt($eachmedia['product']['api_product_id'], true);
		}
		echo json_encode($cart_list, true);
	}

	public function deleteCartItem(Request $request){
        $id       = $request['product']['cart_id'];
		$cartItem = Usercart::find($id);

		if ($cartItem) {
			$del_result = $cartItem->delete();
			if ($del_result) {
				echo '{"status":"1","message":"Cart item deleted successfully"}';
			} else {
				echo '{"status":"0","message":"Some problem occured."}';
			}
		} else {
			echo '{"status":"0","message":"Cart item not found."}';
		}
	}

	public function addtoWishlist(Request $request){

		$product_data = $request->all();
		$UserWishlist=new UserWishlist;
        $product_addedby= $request['tokenData']['Utype'];
		if(is_array($product_data['product'])){
            $product_id = decrypt($request['product']['api_product_id']);
            $productData = Product::where('api_product_id',$product_id)->first();
            if(!$productData){
                $product = new Product;
                $productId =$product->saveProduct($product_data['product']);
            }else{
                $productId=$productData->id;
            }
        }else{
            $productId = Product::where('product_id',$request['product'])->first()->id;
        }

        $cart_list=$UserWishlist->where('wishlist_product',$productId)->where('wishlist_user_id',$product_addedby)->get()->toArray();
		if(empty($cart_list)){
			//dd($request['foldername']);
			$UserWishlist=new UserWishlist;
			$UserWishlist->wishlist_product=$productId;
			$UserWishlist->folder_name = strtolower($request['foldername']);
			$UserWishlist->wishlist_user_id=$product_addedby;
			$UserWishlist->wishlist_added_on=date('Y-m-d H:i:s');
			$result=$UserWishlist->save();

			if($result){
				echo '{"status":"1","message":"Product added to Wishlist successfully"}';
			}else{
				echo '{"status":"0","message":"Some problem occured."}';
			}
		}else{
			$del_result=UserWishlist::where('wishlist_product',$productId)->where('wishlist_user_id',$product_addedby)->delete();
			if($del_result){
				echo '{"status":"2","message":"Product removed from wishlist."}';
			}else{
				echo '{"status":"0","message":"Some problem occured."}';
			}
		}

	}
	public function deleteWishlistItem(Request $request){
        $del_result=UserWishlist::where('wishlist_user_id',$request['tokenData']['Utype'])->where('wishlist_product',$request['product']['id'])->delete();
		if($del_result){
			echo '{"status":"1","message":"Wishlist item deleted successfully"}';
		}else{
			echo '{"status":"0","message":"Some problem occured."}';
		}
	}
	public function wishlist(Request $request){
       	$user_id = $request['Utype'];
        $UserWishlist=new UserWishlist;
		$cart_data = [];
		$cart_list= $UserWishlist->select('wishlist_product', 'folder_name')->where('wishlist_user_id',$user_id)->get()->toArray();
		if(isset($cart_list) && !empty($cart_list)){
			$wishlist_products=array();
			foreach($cart_list as $key=>$wish){
				//$wishlist_products['folder'][] = $wish['wishlist_product'];
				//$cart_data['folder_name'] = $wish['folder_name'];
				$products = new Product;
				$cart_list_new = $products->select('id','product_id','api_product_id','product_title','product_description','product_thumbnail','product_main_image','product_web','product_main_type')->where('id', $wish['wishlist_product'])->get()->toArray();
				$cart_data[$wish['folder_name']][] = $cart_list_new[0];
			}
			//dd($cart_data);
			foreach($cart_data as $folder=>$wishnew){
                 //dd($wishnew);
				foreach($wishnew as $key=>$eachData){
					$cart_data[$folder][$key]['api_product_id'] = encrypt($eachData['api_product_id']);
					$cart_data[$folder][$key]['slug'] = preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower(trim($eachData['product_title'])));
				}
			}
			//dd(json_encode($cart_data));
			echo '{"status":"1","data":'.json_encode($cart_data, true).',"message":""}';
		}else{
			echo '{"status":"0","data":{},"message":"No wishlist items found."}';
		}
	}

	/**
	 * Retrieve user data and their wishlists for the Wishlist App (Version 2).
	 *
	 * This function takes a user's ID from the request and fetches their data,
	 * including their wishlists and product counts. The result is returned as a JSON response.
	 *
	 * @param Request $request The HTTP request object containing user ID (Utype).
	 *
	 * @return void The function echoes a JSON response with user data or an error message.
	 */
	public function wishlistAppV2(Request $request) {
		try {
			if (!empty($request->Utype)) {
				$userId = $request->Utype;
				$userData = $this->userModel->with(['wishlists' => function($qry) {
					$qry->with(['products'])->withCount('products');
				}])
				->withCount('wishlists')
				->find($userId);

				if(!empty($userData->wishlists)) {
					foreach($userData->wishlists as $wishlist) {
						if(!empty($wishlist->products)) {
							foreach($wishlist->products as $product) {
								$product->api_product_id = encrypt($product->api_product_id, true);
							}
						}
					}
				}

				echo '{"status":"1","data":'.json_encode($userData, true).',"message":""}';
			} else {
				echo '{"status":"0","data":{},"message":"No user id passed."}';
			}
		} catch(\Exception $e) {
			echo '{"status":"0","data":{},"message":"Something went wrong."}';
		}
	}

	public function wishlistfs(Request $request){
        //print_r($request->all());
		$user_id = $request['Utype'];
        $UserWishlist=new UserWishlist;
		$products=new Product;
		$cart_list= $UserWishlist->select('wishlist_product')->where('wishlist_user_id',$user_id)->get()->toArray();
		if(isset($cart_list) && !empty($cart_list)){
			$wishlist_products=array();
			foreach($cart_list as $key=>$wish){
				$wishlist_products[]=(int)$wish['wishlist_product'];
			}
			$productids=implode(',',$wishlist_products);
			$cart_list=$products->select('id','product_id','api_product_id','product_title','product_description','product_thumbnail','product_main_image','product_web')->whereRaw('FIND_IN_SET(id,"'.$productids.'")')->get()->toArray();
			foreach($cart_list as $key=>$wish){
				$wishlist_products1[]=(int)$wish['api_product_id'];
			}
			echo '{"status":"1","data":'.json_encode($wishlist_products1,true).',"message":""}';
		}else{
			echo '{"status":"0","data":{},"message":"No wishlist items found."}';
		}
	}
	public function validateOtpForcontributorPass(Request $request){
		$user_id=$request->user_id;
		$contributor_otp=$request->otp;
		$contributor=new Contributor;
		$contributor_list=$contributor->where('contributor_id',$user_id)->where('contributor_otp',$contributor_otp)->get()->toArray();
		if(count($contributor_list)>0){
			echo '{"status":"1","data":'.json_encode($contributor_list,true).',"message":""}';
		}else{
			echo '{"status":"0","data":{},"message":"Invalied otp."}';
		}
	}
	public function resetContributerPass(Request $request){
		$this->validate($request, [
		 	'password'=>'required',
            'cpassword'   => 'required',
            'contributer_id' => 'required'
        ]);
		$update_array=array('contributor_password'=>md5($request->password),
							 'updated_at'=>date('Y-m-d H:i:s')
							 );
		$result = Contributor::where('contributor_id',$request->contributer_id)->update($update_array);
		if($result){
			echo '{"status":"1","data":{},"message":"Reset password successfully."}';
		}else{
			echo '{"status":"0","data":{},"message":"Some problem occured."}';
		}
	}


	// Function to get the client IP address
	public function getIpAddress() {
	    $ipaddress = '';
	    if (getenv('HTTP_CLIENT_IP'))
	        $ipaddress = getenv('HTTP_CLIENT_IP');
	    else if(getenv('HTTP_X_FORWARDED_FOR'))
	        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	    else if(getenv('HTTP_X_FORWARDED'))
	        $ipaddress = getenv('HTTP_X_FORWARDED');
	    else if(getenv('HTTP_FORWARDED_FOR'))
	        $ipaddress = getenv('HTTP_FORWARDED_FOR');
	    else if(getenv('HTTP_FORWARDED'))
	       $ipaddress = getenv('HTTP_FORWARDED');
	    else if(getenv('REMOTE_ADDR'))
	        $ipaddress = getenv('REMOTE_ADDR');
	    else
	        $ipaddress = 'UNKNOWN';
	    return $this->ip_details($ipaddress);
	}


	public function ip_details()
	{
		$ipaddress = '';
	    if (getenv('HTTP_CLIENT_IP'))
	        $ipaddress = getenv('HTTP_CLIENT_IP');
	    else if(getenv('HTTP_X_FORWARDED_FOR'))
	        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	    else if(getenv('HTTP_X_FORWARDED'))
	        $ipaddress = getenv('HTTP_X_FORWARDED');
	    else if(getenv('HTTP_FORWARDED_FOR'))
	        $ipaddress = getenv('HTTP_FORWARDED_FOR');
	    else if(getenv('HTTP_FORWARDED'))
	       $ipaddress = getenv('HTTP_FORWARDED');
	    else if(getenv('REMOTE_ADDR'))
	        $ipaddress = getenv('REMOTE_ADDR');
	    else
	        $ipaddress = 'UNKNOWN';

		// print_r($request->all()); die;
		// $this->validate($request, [
		//  	'ip'=>'required'
  //       ]);

  //       if($validation->fails()){
  //       	echo "hi"; die;

	 //    } else{

	 //    $IPaddress = $request->ip;
		// print_r($IPaddress); die;
		// print_r($IPaddress); die;
		$usd = Currency::where('name','USD')->first();
		$eur = Currency::where('name','EURO')->first();
		// print_r($usd['cur_value']); die;

	    $position = Location::get($ipaddress);
	    // $position = Location::get('23.235.60.92'); //us
	    // $position = Location::get('51.158.22.211');
	    // print_r($position['countryCode']); die;
	    if(!empty($position)){
		    if($position->countryCode=='US'){
		    	$position->currencyValue = $usd['cur_value'];
		    }
		}
		if(!empty($position)){
			$code = $position->countryCode;
		    if($code=="AT" || $code=="BE" || $code=="BG" || $code=="HR"|| $code=="CY" || $code=="CZ"|| $code=="DK"|| $code=="EE"|| $code=="FI"|| $code=="FR"|| $code=="DE"|| $code=="GR"|| $code=="HU"|| $code=="IE"|| $code=="IT"|| $code=="LV"|| $code=="LT"|| $code=="LU"|| $code=="MT"|| $code=="NL"|| $code=="PO"|| $code=="PT"|| $code=="RO"|| $code=="SK"|| $code=="SI"|| $code=="ES"|| $code=="SE")
		    {
		    	$position->currencyValue = $eur['cur_value'];
		    }
		}

    	return json_encode($position);




	}


	public function getCurrencies()
	{
		$api_url_usd = 'https://api.exchangeratesapi.io/latest?base=USD';
		// $api_url = 'https://api.exchangeratesapi.io/latest?base=USD';

		// Read JSON file
		$json_data = file_get_contents($api_url_usd);

		// Decode JSON data into PHP array
		$response_data = json_decode($json_data);

		$usd = $response_data->rates->INR;

		$api_url_eur = 'https://api.exchangeratesapi.io/latest?base=EUR';
		// $api_url = 'https://api.exchangeratesapi.io/latest?base=USD';

		// Read JSON file
		$json_data = file_get_contents($api_url_eur);

		// Decode JSON data into PHP array
		$response_data = json_decode($json_data);

		$eur = $response_data->rates->INR;




	}
}
