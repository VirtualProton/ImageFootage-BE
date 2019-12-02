<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Product extends Model
{
    protected $table = 'imagefootage_products';
	protected $primaryKey = 'id';
	protected $fillable = ['product_id','product_category','product_subcategory','product_owner','product_title','product_vertical','product_keywords','product_thumbnail','product_main_image','product_release_details','product_price_small','product_price_medium','product_price_large','product_price_extralarge','product_status','product_main_type','product_sub_type','product_added_on','updated_at','product_added_by','product_size','product_verification','product_rejectod_reason','product_editedby'];
    const HomeLimit = '100';
    public function getProducts($keyword){
        if($keyword['productType']['id']=='1'){
            $type='Image';
        }else if($keyword['productType']['id']=='2'){
            $type='Footage';
        }else{
            $type='Editorial';
        }
        $serach = $keyword['search'];
        $data =Product::where('product_main_type','=',$type)
                ->orWhere('product_id','=',$serach)
                ->orWhere('product_title','LIKE', '%'. $serach .'%')
                ->orwhere('product_keywords','LIKE','%'. $serach .'%')
                ->get()
                ->toArray();
        return  $data;
    }

    public function getProductDetail($media_id,$type){
        $data =Product::where('product_main_type','=',$type)
                ->Where('product_id','=',$media_id)
                ->get()
                ->toArray();
        return  $data;    
    }
	public function adminAllProductList(){
		  $all_produst_list=Product::leftJoin('imagefootage_productcategory', 'imagefootage_products.product_category', '=','imagefootage_productcategory.category_id')->leftJoin('imagefootage_productsubcategory', 'imagefootage_products.product_subcategory', '=','imagefootage_productsubcategory.subcategory_id' )->leftJoin('imagefootage_productimages', 'imagefootage_products.id', '=','imagefootage_productimages.image_product_id')->get()->toArray();
		  return $all_produst_list;
		 
    }
    
    public function savePantherImage($data,$category_id){
        foreach($data['items']['media'] as $eachmedia){
            if(isset($eachmedia['id'])) {
                $media = array(
                    'product_id' => "",
                    'api_product_id' => $eachmedia['id'],
                    'product_category' => $category_id,
                    'product_title' => $eachmedia['title'],
                    'product_thumbnail' => $eachmedia['preview_no_wm'],
                    'product_main_image' => $eachmedia['preview_high'],
                    'product_description' => $eachmedia['description'],
                    'product_size' => $eachmedia['width'] . "X" . $eachmedia['height'],
                    "product_keywords" => $eachmedia['keywords'],
                    'product_status' => "Active",
                    'product_main_type' => "Image",
                    'product_sub_type' => "Photo",
                    'product_added_on' => date("Y-m-d H:i:s", strtotime($eachmedia['date'])),
                    'product_web' => '2',
                    'product_vertical' => 'Royalty Free'

                );
                // print_r($media); die;
                $count = DB::table('imagefootage_products')
                    ->where('api_product_id', $eachmedia['id'])
                    ->count();

                if ($count == 0) {
                    DB::table('imagefootage_products')->insert($media);
                    $id = DB::getPdo()->lastInsertId();
                    DB::table('imagefootage_products')
                        ->where('id', '=', $id)
                        ->update(['product_id' => 'IMGFT' . $id]);
                    echo "Inserted" . $id;
                }
            }
         }

    }

    public function savePond5Image($data,$category_id){
        //dd($data);
        foreach($data['items'] as $eachmedia){
            if(isset($eachmedia['id'])) {
                $pond_id_withprefix = $eachmedia['id'];
                if(strlen($eachmedia['id'])<9){
                 $add_zero = 9 - (strlen($eachmedia['id']));
                   for($i=0;$i<$add_zero;$i++){
                       $pond_id_withprefix =  "0".$pond_id_withprefix;
                   }
                }
                $media = array(
                    'product_id' => "",
                    'api_product_id' => $eachmedia['id'],
                    'product_category' => $category_id,
                    'product_title' => $eachmedia['n'],
                    'product_thumbnail' => $data['icon_base'].$pond_id_withprefix."_main_l.mp4",
                    'product_main_image' => $data['icon_base'].$pond_id_withprefix."_main_l.mp4",
                    'product_description' => $eachmedia['desc'],
                    'product_size' => '',
                    "product_keywords" => $eachmedia['kw'],
                    'product_status' => "Active",
                    'product_main_type' => "Footage",
                    'product_sub_type' => "Photo",
                    'product_added_on' => date("Y-m-d H:i:s"),
                    'product_web' => '3',
                    'product_vertical' => 'Royalty Free'

                );
                // print_r($media); die;
                $count = DB::table('imagefootage_products')
                    ->where('api_product_id', $eachmedia['id'])
                    ->count();

                if ($count == 0) {
                    DB::table('imagefootage_products')->insert($media);
                    $id = DB::getPdo()->lastInsertId();
                    DB::table('imagefootage_products')
                        ->where('id', '=', $id)
                        ->update(['product_id' => 'IMGFT' . $id]);
                    echo "Inserted" . $id;
                }
            }
        }

    }

    public function getProductsRandom(){
        return DB::table('imagefootage_products as pr')
            ->select('id','product_id','api_product_id','product_title','product_description','product_thumbnail','product_web','category_name')
            ->join('imagefootage_productcategory as pc','pc.category_id','=','pr.product_category')
            ->whereIn('pc.category_name',['Christmas', 'SkinCare', 'Cannabis', 'Business', 'Curated',
                'Video', 'Autumn', 'Family', 'Halloween', 'Seniors', 'Cats', 'Dogs', 'Party', 'Food'])
            ->inRandomOrder()
            ->limit(Product::HomeLimit)
            ->get();
   }
}
