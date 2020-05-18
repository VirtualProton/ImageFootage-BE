<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Country extends Model
{
    protected $table = 'countries';
    public function state(){
        return $this->hasMany(State::class,'country_id', 'id');
    }
    public function getCity($col=NULL,$value=NULL){
        if(!empty($col) && !empty($value)){
            $cities = DB::table('cities')->where($col,'=',$value)->get()->toArray();
        }else{
            $cities = DB::table('cities')->get()->toArray();
        }
        return $cities;
    }


    public function getState($col=NULL,$value=NULL){
        if(!empty($col) && !empty($value)){
            $states = DB::table('states')->where($col,'=',$value)->get()->toArray();
        }else{
            $states = DB::table('states')->get()->toArray();
        }
        return $states;
    }

    public function getcountrylist($col=NULL,$value=NULL){
        if(!empty($col) && !empty($value)){
            $countries = DB::table('countries')->where($col,'=',$value)->get()->toArray();
        }else{
            $countries = DB::table('countries')->get()->toArray();
        }
        return $countries;
    }


}
