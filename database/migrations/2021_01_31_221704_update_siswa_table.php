<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('siswa',function(Blueprint $table){
            $table->string('nama_ayah')->after('alamat')->nullable(true);
            $table->string('nama_ibu')->after('nama_ayah')->nullable(true);
            $table->string('pekerjaan_ayah')->after('nama_ibu')->nullable(true);
            $table->string('pekerjaan_ibu')->after('pekerjaan_ayah')->nullable(true);
            $table->text('alamat_ortu')->after('pekerjaan_ibu')->nullable(true);
            $table->string('no_telphone_ortu',20)->after('alamat_ortu')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('siswa',function(Blueprint $table){
            $table->dropColumn(['nama_ayah','nama_ibu','pekerjaan_ayah','pekerjaan_ibu','alamat_ortu','no_telphone_ortu']);
        });
    }
}
