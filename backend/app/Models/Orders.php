<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
     protected $table = 'imagefootage_orders';
	 protected $primaryKey = 'id';
	// protected $fillable = ['user_id','txn_id','plan_id','invoice','download_plan_id','download_plan_title','tax','tax_selected','coupon_code','coupon_type','coupon_value','coupon_discount','order_total','order_date','order_status','order_title','order_cancel_status','order_type','order_email','ip','payment_mode','cc_number','cc_expiry_date','job_number','po_detail','po_image','order_comments','bill_firstname','bill_lastname','bill_address1','bill_address2','bill_city','bill_state','bill_zip','bill_country','bill_phone','created','modified','invoice_type','expiry_invoices','deletion_date','invoice_closed'];
}
