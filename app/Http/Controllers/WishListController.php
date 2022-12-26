<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
