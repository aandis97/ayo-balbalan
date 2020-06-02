<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PosisiPemain extends Model
{
    protected $table = 'posisi_pemain';
    
    protected $guarded = [];

    // //Relation Kamar to KamarSantri
    // public function KamarSantri(){
    //     return $this->hasMany('App\Models\KamarSantri','id_kamar');
    // }

}
