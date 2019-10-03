<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductFilters extends Model
{
    protected $table = 'imagefootage_productfilters';
	protected $primaryKey = 'filter_id';
	protected $fillable = ['filter_type','filter_type_id','filter_added_by','filter_added_on','filter_updated_on'];
}
