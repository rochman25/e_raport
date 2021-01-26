<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateNilaiSiswaTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nilai_siswa',function(Blueprint $table){
            $table->unsignedBigInteger('guru_matpel_id')->nullable(true)->change();
            $table->unsignedBigInteger('tipe_nilai')->nullable(true)->change();
            $table->unsignedBigInteger('ekstra_id')->nullable(true)->after('kd_id');
            $table->unsignedBigInteger('tahun_ajaran_id')->nullable(true)->after('ekstra_id');
            // $table->enum('jenis_nilai',['kd','uts','uas','eks'])->change();
            // $table->foreign()
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
            $table->dropColumn(['ekstra_id']);
        });
    }
}
