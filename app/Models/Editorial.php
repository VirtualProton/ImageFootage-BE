<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Editorial extends Model
{
    protected $table = 'imagefootage_editorials';
    protected $primaryKey = 'id';

    public function getEditorialData($id = NULL)
    {
        return Editorial::orderBy('id', 'DESC')->get()->toArray();
    }
}
