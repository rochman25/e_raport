<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $table = "siswa";
    protected $fillable = ['nis','nama_lengkap','nama_panggilan','jk','dob','pob','alamat','agama','nama_ayah','nama_ibu','pekerjaan_ayah','pekerjaan_ibu','alamat_ortu','no_telphone_ortu'];
    
}
