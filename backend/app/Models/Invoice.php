<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
     protected $table = 'imagefootage_performa_invoices';
	 protected $primaryKey = 'id';
	// protected $fillable = ['user_id','txn_id','plan_id','invoice','download_plan_id','download_plan_title','tax','tax_selected','coupon_code','coupon_type','coupon_value','coupon_discount','order_total','order_date','order_status','order_title','order_cancel_status','order_type','order_email','ip','payment_mode','cc_number','cc_expiry_date','job_number','po_detail','po_image','order_comments','bill_firstname','bill_lastname','bill_address1','bill_address2','bill_city','bill_state','bill_zip','bill_country','bill_phone','created','modified','invoice_type','expiry_invoices','deletion_date','invoice_closed'];
    public function items(){
        return $this->hasMany(InvoiceItem::class,'invoice_id', 'id');
    }
    public function user(){
        return $this->hasOne(User::class,'id', 'user_id');
    }
    public function country(){
        return $this->hasOne(Country::class,'id', 'bill_country');
    }

    public function city(){
        return $this->hasOne(City::class,'id', 'bill_city');
    }
    public function state(){
        return $this->hasOne(State::class,'id', 'bill_state');
    }
}
