<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatatanWalikelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catatan_walikelas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('siswa_id');
            $table->unsignedBigInteger('kelas_id');
            $table->unsignedBigInteger('tahun_ajaran_id');
            $table->text('catatan');
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
        Schema::dropIfExists('catatan_walikelas');
    }
}
