<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->string('nis')->unique(true);
            $table->string('nama_lengkap');
            $table->string('nama_panggilan')->nullable(true);
            $table->enum('jk',['L','P'])->nullable(true);
            $table->date('dob')->nullable(true);
            $table->string('pob')->nullable(true);
            $table->string('agama')->nullable(true);
            $table->text('alamat')->nullable(true);
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
        Schema::dropIfExists('siswa');
    }
}
