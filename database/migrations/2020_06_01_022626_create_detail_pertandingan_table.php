<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPertandinganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pertandingan', function (Blueprint $table) {
            
            $table->increments('id');
            $table->unsignedInteger('id_pertandingan');
            $table->unsignedInteger('id_pemain');
            $table->string('menit',5); 
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_pertandingan')
            ->references('id')->on('pertandingan');

            $table->foreign('id_pemain')
            ->references('id')->on('pemain');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_pertandingan');
    }
}
