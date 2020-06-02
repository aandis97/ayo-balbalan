<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\TimPemain;

class Pemain extends Model
{
    use SoftDeletes;
    
    protected $table = 'pemain';
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function posisi(){
        return $this->belongsTo(PosisiPemain::class,'id_posisi','id');
    }

    public function tims()
    {
        return $this->hasMany(TimPemain::class,'id_pemain','id');
    }
    
    public function gols()
    {
        return $this->hasMany(pertandinganDetail::class,'id_pemain','id');
    }

    public function getTanggalLahirAttribute()
    {
        return date('d-m-Y', strtotime($this->attributes['tanggal_lahir']));
    }
    // public function getNomorPunggungAttribute()
    // {
    //     $timPemain = TimPemain::where('id_pemain',$this->attributes['id'])->where('status',1)->first();
    //     return $timPemain ? $timPemain->nomor_punggung : "-";
    // }

    
    protected static function boot() 
    {
        parent::boot();

        static::deleting(function($tim) {
            foreach ($tim->tims()->get() as $tim) {
            $tim->delete();
            }

            foreach ($tim->gols()->get() as $gol) {
                $gol->delete();
            }
        });
    } 



}
