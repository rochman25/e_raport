<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableKompetensiDasarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kompetensi_dasar', function (Blueprint $table) {
            $table->id();
            $table->string('kode_kd');
            $table->enum('jenis_kd',['P,K']);
            $table->unsignedBigInteger('matpel_id');
            $table->text('deskripsi');
            $table->timestamps();

            $table->foreign('matpel_id')->references('id')->on('mata_pelajaran');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_kompetensi_dasar');
    }
}
