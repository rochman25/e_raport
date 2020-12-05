<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_siswa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('guru_matpel_id');
            $table->unsignedBigInteger('siswa_id');
            $table->float('nilai_angkat');
            $table->string('nilai_huruf',10);
            $table->enum('type',['Peng','Ket']);
            $table->timestamps();

            $table->foreign('guru_matpel_id')->references('id')->on('guru_matpel');
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
        Schema::dropIfExists('nilai_siswa');
    }
}
