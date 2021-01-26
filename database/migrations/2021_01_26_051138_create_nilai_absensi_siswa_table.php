<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiAbsensiSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_absensi_siswa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('siswa_id');
            $table->unsignedBigInteger('kelas_id');
            $table->unsignedBigInteger('tahun_ajaran_id');
            $table->integer('izin')->default(0);
            $table->integer('sakit')->default(0);
            $table->integer('alpha')->default(0);
            $table->timestamps();

            $table->foreign('siswa_id')->references('id')->on('siswa');
            $table->foreign('kelas_id')->references('id')->on('kelas');
            $table->foreign('tahun_ajaran_id')->references('id')->on('tahun_ajaran');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nilai_absensi_siswa');
    }
}
