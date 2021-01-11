<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiSiswaTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('nilai_siswa');
        Schema::create('nilai_siswa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('guru_matpel_id');
            $table->enum('jenis_nilai',['kd','uas','uts']);
            $table->enum('tipe_nilai',['P','K']);
            $table->unsignedBigInteger('kd_id')->nullable(true);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nilai_siswa_table2');
    }
}
