<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiSiswa extends Model
{
    use HasFactory;
    protected $table = "nilai_siswa";
    protected $fillable = ["guru_matpel_id","siswa_id","nilai_angka","nilai_huruf","type"];
}
