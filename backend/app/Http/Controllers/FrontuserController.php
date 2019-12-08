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
                $Usercart->standard_price = $request['product']['selected_product']['price']*80;
                $Usercart->extended_name= ($request['product']['extended'])? $request['product']['extended']['id']:'';
                $Usercart->extended_price= ($request['product']['extended'])?$request['product']['extended']['price']:'0';
                $Usercart->total= $request['product']['total'];
                $Usercart->product_name= $request['product']['product_info']['metadata']['title'];
                $Usercart->product_thumb= $request['product']['product_info']['media']['thumb_170_url'];
                $Usercart->product_desc= $request['product']['product_info']['metadata']['description'];
                $Usercart->product_web= $request['product']['type'];
                $Usercart->product_json= json_encode($request['product']['product_info']);
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
		$cart_list= $Usercart->where('cart_added_by',$request['Utype'])->get()->toArray();
		echo json_encode($cart_list,true);
	}
	public function deleteCartItom($id){
		$del_result=Usercart::find($id)->delete();
		if($del_result){
			echo '{"status":"1","message":"Cart itom deleted successfully"}';
		}else{
			echo '{"status":"0","message":"Some problem occured."}';
		}
	}
	public function addtoWishlist($id,$product_addedby){
		$UserWishlist=new UserWishlist;
		$product_id=$id;
		$product_addedby=$product_addedby;
		$cart_list=$UserWishlist->where('wishlist_product',$product_id)->where('wishlist_user_id',$product_addedby)->get()->toArray();
		if(empty($cart_list)){
			$UserWishlist=new UserWishlist;
			$UserWishlist->wishlist_product=$product_id;
			$UserWishlist->wishlist_user_id=$product_addedby;
			$UserWishlist->wishlist_added_on=date('Y-m-d H:i:s');
			$result=$UserWishlist->save();
			if($result){
				echo '{"status":"1","message":"Product added to Wishlist successfully"}';
			}else{
				echo '{"status":"0","message":"Some problem occured."}';
			}
		}else{
			echo '{"status":"0","message":"Allready this product is in your Wishlist."}';
		}
		
	}
	public function deleteWishlistItom($id){
		$del_result=UserWishlist::find($id)->delete();
		if($del_result){
			echo '{"status":"1","message":"Wishlist itom deleted successfully"}';
		}else{
			echo '{"status":"0","message":"Some problem occured."}';
		}
	}
	public function productList(Request $request){
		$user_id=$request->user_id;
		$UserWishlist=new UserWishlist;
		$products=new Product;
		$cart_list=$UserWishlist->select('wishlist_product')->where('wishlist_user_id',$user_id)->get()->toArray();
		if(isset($cart_list) && !empty($cart_list)){
			$wishlist_products=array();
			foreach($cart_list as $key=>$wish){
				$wishlist_products[]=$wish['wishlist_product'];
			}
			$productids=implode(',',$wishlist_products);
			$cart_list=$products->whereRaw('FIND_IN_SET(id,"'.$productids.'")')->get()->toArray();
			echo '{"status":"1","data":'.json_encode($cart_list,true).',"message":""}';
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
}
