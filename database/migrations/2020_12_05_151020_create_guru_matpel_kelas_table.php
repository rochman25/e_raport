<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuruMatpelKelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guru_matpel_kelas', function (Blueprint $table) {
            $table->unsignedBigInteger('guru_matpel_id');
            $table->unsignedBigInteger('kelas_id');

            $table->foreign('guru_matpel_id')->references('id')->on('guru_matpel');
            $table->foreign('kelas_id')->references('id')->on('kelas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guru_matpel_kelas');
    }
}
