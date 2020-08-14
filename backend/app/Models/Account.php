<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use DB;

class Account  extends Authenticatable
{
    use Notifiable;
    protected $table = 'imagefootage_accounts';

    public function save_account($data){
     try{
            $account = new Account();
            $account->account_name = $data->account_name;
            $account->email = $data->email;
            $account->contact_name = $data->contact_name;
            $account->title = $data->title;
            $account->mobile = $data->mobile;
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
            $account->bank_name = $data->bank_name;
            $account->account_holder_name = $data->account_holder_name;
            $account->account_number = $data->account_number;
            $account->ifsc = $data->ifsc;
            $account->save();
       }catch (Exception $e) {
        report($e);
        return false;
      }
      return true;
    }

    public function getAccountData($id=NULL){

        if($id==''){
        return Account::orderBy('id', 'DESC')->get()->toArray();
        }else{
         return Account::where('id','=',$id)->first()->toArray();
        }
    }

    public function update_account($data,$id){
        try{
            $account = Account::find($id);
            $account->id = $id;
            $account->account_name = $data->account_name;
            $account->email = $data->email;
            $account->contact_name = $data->contact_name;
            $account->title = $data->title;
            $account->mobile = $data->mobile;
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
            $account->bank_name = $data->bank_name;
            $account->account_holder_name = $data->account_holder_name;
            $account->account_number = $data->account_number;
            $account->ifsc = $data->ifsc;
            $account->save();

       }catch (Exception $e) {
        report($e);
        return false;
      }
      return true;
    }
    //change status of accounts
    public function change_status($flag,$id){
      try{
        $account = Account::find($id);
        $account->id = $id;
        $account->status = $flag;
        $account->save();
        }catch (Exception $e) {
        report($e);
        return false;
      }
      return true;
    }

    public function getAccountDataForShow($id){
      if($id>0){
      $data  = DB::table('imagefootage_accounts')
               ->select('imagefootage_accounts.*,states.state,countries.name as countryName,states.name as stateName,industry_types.name as industryName,currency_convertes.name as curruncyName')
               ->join('countries','countries.id','=','imagefootage_accounts.bill_country')
               ->join('states','states.id','=','imagefootage_accounts.bill_state')
               ->join('cities','cities.id','=','imagefootage_accounts.bill_city')
               ->join('industry_types','industry_types.id','=','imagefootage_accounts.industry_type_id')
               ->join('currency_convertes','currency_convertes.id','=','imagefootage_accounts.curruncy_id')
              ->where('id','=',$id)->get()->toArray();
          return $data ;   
      }else{
        return [];
      }
      
    }

    public function getAccountInvoices ($id){
      if($id>0){
          $data = DB::table('imagefootage_performa_invoices')
          ->select('imagefootage_performa_invoices.*')
         // ->join('imagefootage_performa_invoice_items','imagefootage_performa_invoice_items.invoice_id','=','imagefootage_performa_invoices.id')
          ->join('imagefootage_users','imagefootage_users.id','=','imagefootage_performa_invoices.user_id')
          ->where('imagefootage_performa_invoices.user_id','=',$id)
          ->orderBy('imagefootage_performa_invoices.id','desc')
          ->get()
          ->toArray();
          //dd(DB::getQueryLog());
          $data = json_decode(json_encode($data), True);
          return $data ;   
        }else{
          return [];
        }
    }
}
