<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiscountMessage extends Model
{
	protected $table = 'discount_messages';
	protected $primaryKey = 'id';
	protected $fillable = ['page_type', 'title', 'description', 'link', 'button_text', 'status', 'created_at', 'updated_at'];
}
