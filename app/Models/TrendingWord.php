<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrendingWord extends Model
{
    public $timestamps = false;
    protected $table = 'trending_words';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'count', 'is_processing_keyword'];
}
