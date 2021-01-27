<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCatatanWalikelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('catatan_walikelas',function(Blueprint $table){
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
        Schema::table('catatan_walikelas',function(Blueprint $table){
            $table->dropForeign(['guru_id']);
            $table->dropColumn(['guru_id']);
        });
    }
}
