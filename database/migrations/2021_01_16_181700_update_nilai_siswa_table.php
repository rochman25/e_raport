<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateNilaiSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nilai_siswa',function(Blueprint $table){
            $table->unsignedBigInteger('kelas_id')->after('guru_matpel_id');

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
        Schema::table('nilai_siswa',function(Blueprint $table){
            $table->dropForeign(['kelas_id']);
            $table->dropColumn('kelas_id');
        });
    }
}
