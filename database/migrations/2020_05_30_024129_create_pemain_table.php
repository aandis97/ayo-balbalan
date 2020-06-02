<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemainTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemain', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_posisi')->unsigned();
            $table->string('nama');
            $table->string('tempat_lahir', 20);
            $table->date('tanggal_lahir');
            $table->decimal('tinggi');
            $table->decimal('berat');
            $table->string('foto_pemain')->nullable();
            $table->timestamps();
            $table->softDeletes();

            
            $table->foreign('id_posisi')
            ->references('id')->on('posisi_pemain')
            ->onUpdate('cascade')
            ->onDelete('cascade');
 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pemain');

    }
}
