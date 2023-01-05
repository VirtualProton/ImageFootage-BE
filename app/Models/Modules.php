<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Modules extends Model
{
    public $timestamps = false; 
    protected $table = 'imagefootage_modules';
    protected $primaryKey = 'id';
	protected $fillable = ['module_name', 'url', 'parent_module_id', 'status', 'sort_order', 'created_at', 'updated_at', 'module_icon'];


public function submodules()
{
    return $this->hasMany(Modules::class, 'parent_module_id')->where('status','=','A')->orderBy('sort_order','ASC');
}

public function parentmodules()
{
    return $this->belongsTo(Modules::class, 'parent_module_id');
}


public function getModulesData($id=NULL){

    if($id==''){
    return Modules::select('id', 'module_name')->where('parent_module_id','=','0')->get()->toArray();
    }else{
     return Modules::select('id', 'module_name')->where('parent_module_id','=','0')->first()->toArray();
    }
}


}
