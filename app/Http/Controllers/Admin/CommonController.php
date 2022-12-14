<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Common;
use App\Models\Country;

class CommonController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin')->except('login','logout');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getStatesByCounty(Request $request){
          $id = $request->input('country_code');
          if($id>0){
             $this->Country = new Country;
             $states  = $this->Country->getState('country_id',$id);
             return response()->json(['response' => 'success', 'data' => $states]);
           }else{
            return response()->json(['response' => 'error', 'message'=>"Found error",'data' =>'' ]);
           }

    }

    public function getCityByState(Request $request){
        $id = $request->input('state_code');
          if($id>0){
             $this->Country = new Country;
             $cities  = $this->Country->getCity('state_id',$id);
             return response()->json(['response' => 'success', 'data' => $cities]);
           }else{
            return response()->json(['response' => 'error', 'message'=>"Found error",'data' =>'' ]);
           }
    }

}
