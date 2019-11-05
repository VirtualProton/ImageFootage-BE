<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usercart;
use App\Models\UserWishlist;

class FrontuserController extends Controller {
    public function addtocart(Request $request){
		$Usercart=new Usercart;
		$product_id=$request->product_id;
		$product_type=$request->product_type;
		$product_addedby=$request->product_addedby;
		$cart_list=$Usercart->where('cart_product_id',$product_id)->where('cart_added_by',$product_addedby)->get()->toArray();
		if(empty($cart_list)){
			$Usercart=new Usercart;
			$Usercart->cart_product_id=$product_id;
			$Usercart->cart_product_type=$product_type;
			$Usercart->cart_added_by=$product_addedby;
			$Usercart->cart_added_on=date('Y-m-d H:i:s');
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
	public function userCartList(Request $request){
		$Usercart = new Usercart;
		$cart_list=$Usercart->where('cart_added_by',$request->user_id)->get()->toArray();
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
}
