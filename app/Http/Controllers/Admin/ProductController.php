<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
		$title = "Add Product";
        return view('admin.product.addproduct', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){
		 $product = new Product;
		 $file = $request->file('product_image');
		 //Get the first three characters using substr.
		 $firstThreeCharacters = substr($request->owner_name, 0, 3);
		 $firstThreeCharactersType = substr($request->product_type, 0, 3);
		 $productid=$firstThreeCharacters.$firstThreeCharactersType;
         $product->product_id =$productid;
		 $product->product_owner=$request->owner_name;
		 $product->product_title=$request->product_title;
		 $product->product_vertical=$request->product_vertical;
		 $product->product_keywords=$request->prodect_keywords;
		 $product->product_thumbnail=$request->product_thumbnail;
		 $product->product_main_image=$request->product_image;
		 $product->product_release_details=$request->release_details;
		 $product->product_price_small=$request->Price_small;
		 $product->product_price_medium=$request->price_medium;
		 $product->product_price_large=$request->price_large;
		 $product->product_price_extralarge=$request->price_extra_large;
		 $product->product_main_type=$request->product_type;
		// $product->product_sub_type=$request->sub_product_type;
		 $product->product_added_on=date('Y-m-d');
		 $product->save();
		 $last_id=$product->id;
		 if($last_id < 10){
			 $last_id='00'.$last_id;
		 }else if($last_id < 100){
			 $last_id='0'.$last_id;
		 }
		 $productid=strtolower($firstThreeCharacters.$firstThreeCharactersType.$last_id);
		 $product_update = Product::find($last_id);
		 $product_update->product_id=$productid;
		 $product_update->save();
		  return $productid;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
