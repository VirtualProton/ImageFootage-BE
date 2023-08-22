<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class WishListController extends Controller
{
   public function __construct()
    {

    }

   public function getWishList(Request $request)
    {
    	dd($request);
        /*try {
            $products = Keywords::where(function($query) use ($keyword) {
                // Filter the keywords when pass keywords as param
                $keyword = trim($keyword);
                if($keyword != "") {
                    $query->where("name", "like", "%$keyword%");
                } 
            })->get()->toArray();
            return response()->json(["status"=> true, "data"=> $products]);
        } catch (\Throwable $th) {
            return response()->json(["status"=> false, "message"=> "Cannot get keywords"]);
        }*/
    }

    # Create Share Wish list Link
    public function shareWishListCreateLink(Request $request)
    {
        $encryptedId = Crypt::encryptString($request->wishlist_id);
        return response()->json(["success" => true, "message" => "WishList link generated successfully.", "data" => $encryptedId], 200);
    }

    # Accept wish list link and added own account
    public function acceptWishlistFolder(Request $request)
    {
        try {
            $user = auth('api')->user();

            if (empty($request->wishlist_id)) {
                return response()->json(['status' => false, 'message' => 'Wishlist id is required.'], 200);
            }
            $wishlistId = Crypt::decryptString($request->wishlist_id);

            // Todo  get wishlistId records and store in new user
            dd($wishlistId);

        } catch (\Exception $e) {
            return response()->json(['error' => true, "message" => $e->getMessage()], 200);
        }
    }
}
