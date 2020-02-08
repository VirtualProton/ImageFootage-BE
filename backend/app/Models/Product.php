<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Models\Api;
class Product extends Model
{
    protected $table = 'imagefootage_products';
	protected $primaryKey = 'id';
	protected $fillable = ['product_id','product_category','product_subcategory','product_owner','product_title','product_vertical','product_keywords','product_thumbnail','product_main_image','product_release_details','product_price_small','product_price_medium','product_price_large','product_price_extralarge','product_status','product_main_type','product_sub_type','product_added_on','updated_at','product_added_by','product_size','product_verification','product_rejectod_reason','product_editedby'];
    const HomeLimit = '32';

    public function api(){
        return $this->hasOne(Api::class,'api_id', 'product_web');
    }

    public function getProducts($keyword){
        //dd($getKeyword);
        DB::enableQueryLog();
        if($keyword['productType']['id']=='1'){
            $type='Image';
        }else if($keyword['productType']['id']=='2'){
            $type='Footage';
        }else{
            $type='Editorial';
        }
        if(!empty($keyword['search'])){
            $serach = $keyword['search'];
            $filterTypes = array('product_colors'=>'product_color',
                'product_gender'=>'product_gender',
                'product_ethinicities'=>'product_ethinicities',
                'product_imagesizes'=>'product_image_size',
                'product_imagetypes'=>'product_glow_type',
                'product_orientations'=>'product_orientations',
                'product_peoples'=>'product_peoples',
                'product_locations'=>'product_locations',
                'product_sorttype'=>'product_sort_types');
            //DB::enableQueryLog();
            $data = Product::select('product_id','api_product_id','product_title','product_web','product_main_type','product_thumbnail','product_main_image','product_added_on','product_keywords')
                    //->join('imagefootage_productfilters','imagefootage_productfilters.filter_product_id','=','imagefootage_products.id')
                ->where(function ($query) use ($type){
                $query->whereIn('product_web',[1,2,3])->where('product_main_type','=',$type);
            })->Where(function($query) use ($serach) {
                    $query->orWhere('product_id','=',$serach);
                        //->orWhere('product_title','LIKE', ''. $serach .'%')
                        //->orWhere('product_keywords','LIKE',''. $serach .'%');
            })->get()->toArray();
            if(count($data)>0){
                if($serach==$data[0]['product_id'] && count($data)==1){
                   //if($data[0]['product_web']=='2'){
                        $url = 'detail/'.$data[0]['api_product_id'].'/'.$data[0]['product_web']."/".$data[0]['product_main_type'];
                        $data = array('code'=>1,'url'=>$url,'data'=>$data);
                   //}else{

                   //}
                }
            }

            //dd(DB::getQueryLog());
//            if($getKeyword['product_colors']){
//
//            }
        }else{
            $data =Product::where('product_main_type','=',$type)
                    ->select('product_id','api_product_id','product_title','product_web','product_main_type','product_thumbnail','product_main_image','product_added_on')
                    ->where('product_web','=','1')
                    ->get()
                    ->toArray();
        }
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
                $data2 = DB::table('imagefootage_products')
                    ->where('api_product_id', $eachmedia['id'])
                    ->get()
                    ->toArray();

                if (count($data2) == 0) {
                    DB::table('imagefootage_products')->insert($media);
                    $id = DB::getPdo()->lastInsertId();
                    DB::table('imagefootage_products')
                        ->where('id', '=', $id)
                        ->update(['product_id' => 'IMGFT' . $id]);
                    return 'IMGFT' . $id;
                   // echo "Inserted" . $id;
                }else{

                    //echo "hello";
                    DB::table('imagefootage_products')
                        ->where('api_product_id', '=', $eachmedia['id'])
                        ->update(['product_thumbnail' =>$eachmedia['preview_no_wm'],
                                  'product_main_image'=>$eachmedia['preview_high'],
                                  'product_description' => $eachmedia['description'],
                                  'product_title' => $eachmedia['title'],
                                  'updated_at' => date('Y-m-d H:i:s')
                            ]);
                     return $data2[0]->product_id;
                    //echo "Updated". $eachmedia['id'];
                }
            }
         }

    }
    public function updatePantherImage($data){

            if(isset($data['media']['id'])) {
                // print_r($media); die;
                $count = DB::table('imagefootage_products')
                    ->where('api_product_id', $data['media']['id'])
                    ->count();

                if ($count > 0) {
                    $imgData = getimagesize($data['media']['preview_url_no_wm']);

                    DB::table('imagefootage_products')
                        ->where('api_product_id', '=', $data['media']['id'])
                        ->update(['product_thumbnail' =>$data['media']['preview_url_no_wm'],
                            'product_main_image'=>$data['media']['preview_url'],
                            'product_description' => $data['metadata']['description'],
                            'product_title' => $data['metadata']['title'],
                            'updated_at' => date('Y-m-d H:i:s'),
                            'width_thumb' => $imgData[0],
                            'height_thumb' => $imgData[1]
                        ]);
                    echo "Updated". $data['media']['id'];
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
                    'product_thumbnail' => "https://p5iconsp.s3-accelerate.amazonaws.com/".$pond_id_withprefix."_iconl.jpeg",
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
                $data2 = DB::table('imagefootage_products')
                    ->where('api_product_id', $eachmedia['id'])
                    ->get()
                    ->toArray() ;
                if (count($data2)==0) {
                    $flag = $this->get_api_flag('2','api_flag');
                    $key  = $this->randomkey();
                    DB::table('imagefootage_products')->insert($media);
                    $id = DB::getPdo()->lastInsertId();
                    DB::table('imagefootage_products')
                        ->where('id', '=', $id)
                        ->update(['product_id' => $flag.$key]);
                    //echo "Inserted" . $id;
                    return $flag.$key;
                }else{
                    return $data2[0]->product_id;
                }
            }
        }

    }

    public function getProductsRandom(){
        ini_set('max_execution_time',0);
        $final_data = [];
       return   DB::table('imagefootage_products as pr')
            //->where('pr.product_web','2')
            //->where('pr.width_thumb','<>',NULL)
            ->select('id','product_id','api_product_id','product_title','product_description','product_thumbnail','product_main_image','product_web','category_name','product_main_type','width_thumb','height_thumb')
            ->join('imagefootage_productcategory as pc','pc.category_id','=','pr.product_category')
            ->whereIn('pc.category_name',['Christmas', 'SkinCare', 'Cannabis', 'Business', 'Curated',
                'Video', 'Autumn', 'Family', 'Halloween', 'Seniors', 'Cats', 'Dogs', 'Party', 'Food'])
            ->inRandomOrder()
            ->limit(Product::HomeLimit)
            ->get();
//
//            foreach($data as $k=>$perdata){
//                 $final_data[$k] = (array)$perdata;
//                 $imgData =getimagesize($perdata->product_thumbnail);
//                 $final_data[$k]['width_img'] = $imgData[0];
//                $final_data[$k] ['height_img']= $imgData[1];
//                $final_data[$k]['attr'] = $imgData[3];
//            }
            //return $final_data;
   }

    public function savePantherImagedetail($data,$category_id){

        if($data['stat']=='ok'){
            if(isset($data['media']['id'])) {
                $media = array(
                    'product_id' => "",
                    'api_product_id' => $data['media']['id'],
                    'product_category' => $category_id,
                    'product_title' => $data['metadata']['title'],
                    'product_thumbnail' => $data['media']['preview_url_no_wm'],
                    'product_main_image' => $data['media']['preview_url'],
                    'product_description' => $data['metadata']['description'],
                    'product_size' => $data['media']['width'] . "X" . $data['media']['height'],
                    "product_keywords" => $data['metadata']['keywords'],
                    'product_status' => "Active",
                    'product_main_type' => "Image",
                    'product_sub_type' => "Photo",
                    'product_added_on' => date("Y-m-d H:i:s", strtotime($data['metadata']['date'])),
                    'product_web' => '2',
                    'product_vertical' => 'Royalty Free'

                );
                // print_r($media); die;
                $data2 = DB::table('imagefootage_products')
                    ->where('api_product_id', $data['media']['id'])
                    ->get()
                    ->toArray();

                if (count($data2) == 0) {
                    $flag = $this->get_api_flag('2','api_flag');
                    $key  = $this->randomkey();
                    DB::table('imagefootage_products')->insert($media);
                    $id = DB::getPdo()->lastInsertId();
                    DB::table('imagefootage_products')
                        ->where('id', '=', $id)
                        ->update(['product_id' => $flag.$key]);
                    return $flag.$key;
                    // echo "Inserted" . $id;
                }else{

                    //echo "hello";
                    DB::table('imagefootage_products')
                        ->where('api_product_id', '=', $data['media']['id'])
                        ->update(['product_thumbnail' =>$data['media']['preview_url_no_wm'],
                            'product_main_image'=>$data['media']['preview_url'],
                            'product_description' => $data['metadata']['description'],
                            'product_title' => $data['metadata']['title'],
                            'updated_at' => date('Y-m-d H:i:s')
                        ]);
                    return $data2[0]->product_id;
                    //echo "Updated". $eachmedia['id'];
                }
            }
        }

    }

    public function get_api_flag($flag,$field){
        return Api::where('api_id',$flag)->first()->$field;
    }

    public function randomkey(){
         $digits = 5;
         return random_int( 10 ** ( $digits - 1 ), ( 10 ** $digits ) - 1);
    }
}
