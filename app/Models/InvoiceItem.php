<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
	public $timestamps = false; 
    protected $table = 'imagefootage_performa_invoice_items';
	protected $primaryKey = 'id';
	//protected $fillable = ['cart_product_id','cart_product_type','cart_added_by','cart_added_on'];

    public function product(){
        return $this->hasOne(Product::class,'api_product_id', 'product_id');
    }
}
