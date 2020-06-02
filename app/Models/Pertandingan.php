<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pertandingan extends Model
{
    use SoftDeletes;

    protected $table = 'pertandingan';   
    protected $guarded = [];

    public function getJadwalPertandinganAttribute()
    {
        return date('d-m-Y', strtotime($this->attributes['jadwal_pertandingan']));
    }
    public function getWaktuMulaiAttribute()
    {
        return date('H:i', strtotime($this->attributes['waktu_mulai']));
    }

    public function pertandinganDetail()
    {
        return $this->hasMany(PertandinganDetail::class,'id_pertandingan','id');
    }

    protected static function boot() 
    {
        parent::boot();

        static::deleting(function($tim) {
            foreach ($tim->pertandinganDetail()->get() as $detail) {
            $detail->delete();
            }
        });
    }

}
