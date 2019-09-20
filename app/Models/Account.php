<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class Account  extends Authenticatable
{
    use Notifiable;
    protected $table = 'imagefootage_accounts';

    public function save_account($data){
     try{
            $account = new Account();
            $account->account_name = $data->account_name;
            $account->email = $data->email;
            $account->phone = $data->phone;
            $account->website = $data->website;
            $account->bill_address = $data->bill_address;
            $account->bill_city = $data->bill_city;
            $account->bill_state = $data->bill_state;
            $account->bill_country = $data->bill_country;
            $account->bill_postal = $data->bill_postal;
            $account->industry_type_id = $data->industry_type_id;
            $account->curruncy_id = $data->curruncy_id;
            $account->global_region = $data->global_region;
            $account->domestic_region = $data->domestic_region;
            $account->save();
       }catch (Exception $e) {
        report($e);
        return false;
      }
      return true;
    }

    public function getAgentData($id=NULL){

        if($id==''){
        return Account::get()->toArray();
        }else{
         return Account::where('id','=',$id)->first()->toArray();
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
