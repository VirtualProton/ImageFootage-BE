<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Common extends Model
{

 public function getCurruncy($col=NULL,$value=NULL){
        if(!empty($id) && !empty($type)){
            $currencies = DB::table('currency_convertes')->where($col,'=',$value)->get()->toArray();
        }else{
            $currencies = DB::table('currency_convertes')->get()->toArray();
        }
        return $currencies;
    }

    public function getIndustryTypes($col=NULL,$value=NULL){
        if(!empty($id) && !empty($type)){
            $industrytypes = DB::table('industry_types')->where($col,'=',$value)->get()->toArray();
        }else{
            $industrytypes = DB::table('industry_types')->get()->toArray();
        }
        return $industrytypes;
    }


}
