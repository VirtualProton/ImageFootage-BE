<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StaticPages;

class StaticController extends Controller
{
    public function getCustomPage($slug){
        $staticpages = new StaticPages;
        $result = StaticPages::where('page_slug',$slug)->where('image_status',"Active");
        $count = $result->count();
        if($count>0){
        $staticpage_data = $result->first()->toArray();
            echo json_encode(['status'=>"success",'data'=>$staticpage_data]);
        }else{
            echo json_encode(['status'=>"fail",'data'=>'','message'=>'Some error happened']);
        }
      }
}
