<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TimPemain extends Model
{
    use SoftDeletes;
    
    protected $table = 'tim_pemain';   
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function tim()
    {
        return $this->belongsTo(Tim::class,'id_tim','id');
        
    }

    public function Pemain()
    {
        return $this->belongsTo(Pemain::class, 'id_pemain','id');
    }
}
