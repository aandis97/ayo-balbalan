<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePertandinganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pertandingan', function (Blueprint $table) {
            
            $table->increments('id');
            $table->unsignedInteger('id_tim_rumah');
            $table->unsignedInteger('id_tim_tamu');
            $table->date('jadwal_pertandingan');
            $table->time('waktu_mulai'); 
            $table->tinyInteger('gol_rumah')->nullable();
            $table->tinyInteger('gol_tamu')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_tim_rumah')
            ->references('id')->on('tim');

            $table->foreign('id_tim_tamu')
            ->references('id')->on('tim');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::dropIfExists('pertandingan');
    }
}
