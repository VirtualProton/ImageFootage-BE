<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use Auth;
use Image;

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
		 $this->validate($request, [
            'owner_name'   => 'required',
            'product_category' => 'required',
			'product_sub_category' => 'required',
			'product_vertical'=>'required',
			'prodect_keywords'=>'required',
			'release_details'=>'required',
			'product_type'=>'required',
			'product_image'=>'required|file'
        ]);
		 $product = new Product;
		 $file = $request->file('product_image');
		 $data = getimagesize($file);
 		 $dimenctions = $data[0].'x'.$data[1];
		 //Get the first three characters using substr.
		 $firstThreeCharacters = substr($request->owner_name, 0, 3);
		 $firstThreeCharactersType = substr($request->product_type, 0, 3);
		 $productid=$firstThreeCharacters.$firstThreeCharactersType;
         $product->product_id =$productid;
		 $product->product_category=$request->product_category;
		 $product->product_subcategory=$request->product_sub_category;  
		 $product->product_owner=$request->owner_name;
		 $product->product_title=$request->product_title;
		 $product->product_vertical=$request->product_vertical;
		 $product->product_keywords=$request->prodect_keywords;
		 $product->product_thumbnail=$request->product_thumbnail;
		 $product->product_size=$dimenctions;
		 $product->product_release_details=$request->release_details;
		 $product->product_price_small=$request->Price_small;
		 $product->product_price_medium=$request->price_medium;
		 $product->product_price_large=$request->price_large;
		 $product->product_price_extralarge=$request->price_extra_large;
		 $product->product_main_type=$request->product_type;
		 $product->product_added_by=Auth::guard('admins')->user()->id;
		 if(isset($request->sub_product_type) && !empty($request->sub_product_type)){
		 	$product->product_sub_type=$request->sub_product_type;
		 }
		 $product->product_added_on=date('Y-m-d');
		 $result=$product->save();
		 $last_id=$product->id;
		 if($result){
			 if($last_id < 10){
				 $last_id='00'.$last_id;
			 }else if($last_id < 100){
				 $last_id='0'.$last_id;
			 }
			 if($request->hasFile('product_image')) {
				$image = $request->file('product_image');
				$name = time().'.'.$image->getClientOriginalExtension();
				$file_path='/uploads/';
				if($request->product_type=='Image'){
					if($request->sub_product_type=='Vector'){
						$file_path.='image/vector/';
					}else if($request->sub_product_type=='Illustrator'){
						$file_path.='image/illustrator/';
					}else{
						$file_path.='image/photo/';
					}
					
				}else if($request->product_type=='Footage'){
					$file_path.='footage/';
				}else if($request->product_type=='Editorial'){
					if($request->sub_product_type=='Vector'){
						$file_path.='editorial/vector/';
					}else if($request->sub_product_type=='Illustrator'){
						$file_path.='editorial/illustrator/';
					}else{
						$file_path.='editorial/photo/';
					}
				}
				$destinationPath = public_path($file_path);
				$image->move($destinationPath, $name);
				/* for thumbnail image */
				/*if($request->product_type=='Image' || $request->product_type=='Editorial' ){
					
					$input['imagename'] ='thumbnail_'.$name;
					$destinationPath1 = public_path($file_path.'thumb');
					$img = Image::make($request->file('product_image')->getRealPath());
					$img->resize(100, 100, function ($constraint) {
						$constraint->aspectRatio();
					})->save($destinationPath1.'/'.$input['imagename']);
					//$destinationPath = public_path('/images');
					//$image->move($destinationPath, $input['imagename']);
					
				}*/
				/* end */
    		 }
			 $productid=strtolower($firstThreeCharacters.$firstThreeCharactersType.$last_id);
			 $product_update = Product::find($last_id);
			 $product_update->product_id=$productid;
			 $product_update->product_main_image=$name;
			 $product_update->save();
			 return back()->with('success','Product Upload successful');
		 }else{
			 return back()->with('warning','Some problem occured.');
		 }
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

   public function productsList(){
	   $product = new Product;
	   $all_produst_list=$product->all()->toArray();
	   $title = "Product List";
	  // echo '<pre>';
	   //print_r($all_produst_list);
	   //echo '</pre>';
       return view('admin.product.productlist', ['products' => $all_produst_list]);
   }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeProductStatus($status,$id)
    {
        return $status;
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
