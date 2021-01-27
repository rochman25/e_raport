<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateNilaiAbsensiSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nilai_absensi_siswa',function(Blueprint $table){
            $table->unsignedBigInteger('guru_id')->after('siswa_id');
            $table->foreign('guru_id')->references('id')->on('guru');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nilai_absensi_siswa',function(Blueprint $table){
            $table->dropForeign(['guru_id']);
            $table->dropColumn(['guru_id']);
        });
    }
}
