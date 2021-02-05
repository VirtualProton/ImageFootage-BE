<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Usercart;
use App\Models\UserWishlist;
use App\Models\Product;
use App\Models\Contributor;
use Illuminate\Support\Facades\Hash;
use CORS;

use Stevebauman\Location\Facades\Location;


class FrontuserController extends Controller {


    public function addtocart(Request $request){
        //$lub = new Lcobucci();

       // echo $request['product']['type'];
       // dd($request->all());
		$Usercart=new Usercart;
		if($request['product']['type']=='2'){
            $product_id = $request['product']['product_info']['media']['id'];
            $product_type = "Image";
            $tokens=json_decode($request['product']['token'],true);
            $product_addedby = $tokens['Utype'];
            $cart_list= $Usercart->where('cart_product_id',$product_id)->where('cart_added_by',$product_addedby)->get()->toArray();
            if(empty($cart_list)){
                $Usercart=new Usercart;
                $Usercart->cart_product_id=$product_id;
                $Usercart->cart_product_type= $product_type;
                $Usercart->cart_added_by= $product_addedby;
                $Usercart->standard_type= $request['product']['selected_product']['name'];
                $Usercart->cart_added_on= date('Y-m-d H:i:s');
                $Usercart->standard_size= $request['product']['selected_product']['width']." X ".$request['product']['selected_product']['height'];
                $Usercart->standard_price = $request['product']['selected_product']['price'];
                $Usercart->extended_name= ($request['product']['extended'])? $request['product']['extended']['id']:'';
                $Usercart->extended_price= ($request['product']['extended'])?$request['product']['extended']['price']:'0';
                $Usercart->total= $request['product']['total'];
                $Usercart->product_name= $request['product']['product_info']['metadata']['title'];
                $Usercart->product_thumb= $request['product']['product_info']['media']['thumb_170_url'];
                $Usercart->product_desc= $request['product']['product_info']['metadata']['description'];
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
        }else if($request['product']['type']=='3'){
            $product_id = $request['product']['product_info'][0]['clip_data']['pic_objectid'];
			$product_type = "Footage";
			$tokens =  json_decode(stripslashes($request['product']['token']), true);
            $product_addedby = $tokens['Utype'];
            $cart_list= $Usercart->where('cart_product_id',$product_id)->where('cart_added_by',$product_addedby)->get()->toArray();
            if(empty($cart_list)){
                $Usercart=new Usercart;
                $Usercart->cart_product_id=$product_id;
                $Usercart->cart_product_type= $product_type;
                $Usercart->cart_added_by= $product_addedby;
                $Usercart->standard_type= $request['product']['selected_product']['size'];
                $Usercart->cart_added_on= date('Y-m-d H:i:s');
                $Usercart->standard_size= $request['product']['selected_product']['size'];
                $Usercart->standard_price = $request['product']['selected_product']['pr'];
                $Usercart->total= $request['product']['total'];
                $Usercart->product_name= $request['product']['product_info'][0]['clip_data']['n'];
                $Usercart->product_thumb= $request['product']['product_info'][0]['flv_base'].$request['product']['product_info'][1];
                $Usercart->product_desc= $request['product']['product_info'][0]['clip_data']['pic_description'];
                $Usercart->product_web= $request['product']['type'];
                $Usercart->product_main_footage = $request['product']['product_info'][2];
                $Usercart->product_json= json_encode($request['product']['product_info'][0]);
                $Usercart->selected_product = json_encode($request['product']['selected_product']);
                $result=$Usercart->save();
                if($result){
                    echo '{"status":"1","message":"Product added to cart successfully"}';
                }else{
                    echo '{"status":"0","message":"Some problem occured."}';
                }
            }else{
                echo '{"status":"0","message":"Allready this product is in your cart."}';
            }
        }



	}
	public function userCartList(Request $request){
        $Usercart = new Usercart;
		$cart_list= $Usercart->where('cart_added_by',$request['Utype'])->with('product')->get()->toArray();
		echo json_encode($cart_list,true);
	}
	public function deleteCartItem(Request $request){
        //dd($request['product']);
       // $tokens=json_decode($request['product']['token'],true);
        $id = $request['product']['cart_id'];
		$del_result=Usercart::find($id)->delete();
		if($del_result){
			echo '{"status":"1","message":"Cart item deleted successfully"}';
		}else{
			echo '{"status":"0","message":"Some problem occured."}';
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
			$UserWishlist=new UserWishlist;
			$UserWishlist->wishlist_product=$productId;
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
        //print_r($request->all());
		$user_id = $request['Utype'];
        $UserWishlist=new UserWishlist;
		$products=new Product;
		$cart_list= $UserWishlist->select('wishlist_product')->where('wishlist_user_id',$user_id)->get()->toArray();
		if(isset($cart_list) && !empty($cart_list)){
			$wishlist_products=array();
			foreach($cart_list as $key=>$wish){
				$wishlist_products[]=$wish['wishlist_product'];
			}
			$productids=implode(',',$wishlist_products);
			$cart_list_new=$products->select('id','product_id','api_product_id','product_title','product_description','product_thumbnail','product_main_image','product_web','product_main_type')->whereRaw('FIND_IN_SET(id,"'.$productids.'")')->get()->toArray();
            foreach($cart_list_new as $key=>$wishnew){
                $cart_list_new[$key]['api_product_id'] = encrypt($wishnew['api_product_id']);
                $cart_list_new[$key]['slug'] = preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower(trim($wishnew['product_title'])));
            }
			echo '{"status":"1","data":'.json_encode($cart_list_new,true).',"message":""}';
		}else{
			echo '{"status":"0","data":{},"message":"No wishlist items found."}';
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

	    $position = Location::get($ipaddress);
	    // $position = Location::get('49.204.183.130');

	    // print_r($position); die;
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
