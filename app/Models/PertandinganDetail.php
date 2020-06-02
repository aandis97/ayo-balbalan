<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PertandinganDetail extends Model
{
    use SoftDeletes;
    
    protected $table = 'detail_pertandingan';   
    protected $guarded = [];
    protected $dates = ['deleted_at'];

}
