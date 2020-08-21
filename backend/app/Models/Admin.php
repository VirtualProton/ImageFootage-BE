<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class Admin  extends Authenticatable
{
    use Notifiable;
    protected $table = 'imagefootage_admins';
    protected $guard = 'admins';
    public function role(){
        return $this->hasOne(Roles::class,'id', 'role_id');
    }

    public function department(){
        return $this->hasOne(Department::class,'id', 'department_id');
    }

    public function save_admin($data){
     try{
            $admin = new Admin();
            $admin->name = $data->name;
            $admin->email = $data->email;
            $admin->mobile = $data->mobile;
            $admin->address = $data->address;
            $admin->role_id = $data->role;
            $admin->department_id = $data->department;
            $admin->password =Hash::make($data->password);
            $admin->save();
       }catch (Exception $e) {
        report($e);
        return false;
      }
      return true;
    }

    public function getAgentData($id=NULL){

        if($id==''){
        return Admin::where('id','<>','1')->with('role')->with('department')->get()->toArray();
        }else{
         return Admin::where('id','=',$id)->with('role')->with('department')->first();
        }
    }

    public function update_admin($data,$id){
        try{
            $admin = Admin::find($id);
            $admin->id = $id;
            $admin->name = $data->name;
            $admin->email = $data->email;
            $admin->mobile = $data->mobile;
            $admin->address = $data->address;
            $admin->role_id = $data->role;
            $admin->department_id = $data->department;
            if(!empty($data->password)){
            $admin->password =Hash::make($data->password);
            }
            $admin->save();
       }catch (Exception $e) {
        report($e);
        return false;
      }
      return true;
    }
    //change status of subadmin
    public function change_status($flag,$id){
      try{
        $admin = Admin::find($id);
        $admin->id = $id;
        $admin->admin_status = $flag;
        $admin->save();
        }catch (Exception $e) {
        report($e);
        return false;
      }
      return true;
    }
}
