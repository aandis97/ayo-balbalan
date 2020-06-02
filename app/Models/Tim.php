<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tim extends Model
{
    use SoftDeletes;

    protected $table = 'tim';   
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function pemains()
    {
        return $this->hasMany(TimPemain::class,'id_tim','id');
    }


    public function pertandinganRumah()
    {
        return $this->hasMany(Pertandingan::class,'id_tim_rumah','id');
    }

    public function pertandinganTamu()
    {
        return $this->hasMany(Pertandingan::class,'id_tim_tamu','id');
    }

    public function otherPertandingan()
    {
        if($this->pertandinganRumah->id == $this->id) {
            return $this->pertandinganRumah;

        }
        return $this->pertandinganTamu;
    }

    public function getExcerptAttribute()
    {
        $string = strip_tags($this->keterangan_tim);
        if (strlen($string) > 300) {
            $stringCut = substr($string, 0, 300);
            $endPoint = strrpos($stringCut, ' ');
            $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
            $string .= '...';
        }
        return $string;
    }
     /**
     * Override parent boot and Call deleting event
     *
     * @return void
     */
    protected static function boot() 
    {
        parent::boot();

        static::deleting(function($tim) {
            foreach ($tim->pemains()->get() as $timPemain) {
            $timPemain->delete();
            }
            
            foreach ($tim->pertandinganRumah()->get() as $pertandingan) {
                $pertandingan->delete();
            }

            foreach ($tim->pertandinganTamu()->get() as $pertandingan) {
                $pertandingan->delete();
            }
        });
    } 
}
