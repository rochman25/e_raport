<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDetailNilaiSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detail_nilai_siswa',function(Blueprint $table){
            $table->string('nilai_huruf',1)->after('nilai_angka');
            $table->text('deskripsi')->nullable(true)->after('nilai_huruf');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detail_nilai_siswa',function(Blueprint $table){
            $table->dropColumn(['nilai_huruf','deskripsi']);
        });
    }
}
