<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keywords extends Model
{
	public $timestamps = false; 
    protected $table = 'imagefootage_keywords';
	protected $primaryKey = 'id';

	protected $fillable = ['name'];


}
