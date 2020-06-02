<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimPemainTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tim_pemain', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_tim');
            $table->unsignedInteger('id_pemain');
            $table->string('nomor_punggung',2);
            $table->date('tanggal_gabung');
            $table->date('tanggal_pindah')->nullable();
            $table->tinyInteger('status');
            $table->timestamps();
            $table->softDeletes();

            
            $table->foreign('id_tim')
            ->references('id')->on('tim');

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
        Schema::dropIfExists('tim_pemain');
    }
}
