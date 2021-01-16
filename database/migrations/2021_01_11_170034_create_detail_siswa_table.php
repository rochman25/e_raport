<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_nilai_siswa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nilai_id');
            $table->unsignedBigInteger('siswa_id');
            $table->float('nilai_angka');
            $table->timestamps();

            $table->foreign('nilai_id')->references('id')->on('nilai_siswa');
            $table->foreign('siswa_id')->references('id')->on('siswa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_nilai_siswa');
    }
}
