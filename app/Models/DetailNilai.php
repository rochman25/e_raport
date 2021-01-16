<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailNilai extends Model
{
    use HasFactory;
    protected $table = "detail_nilai_siswa";
    protected $fillable = ["id","nilai_id","siswa_id","nilai_angka"];

    public function siswa(){
        return $this->belongsTo(Siswa::class,'siswa_id');
    }

    public function nilai(){
        return $this->belongsTo(NilaiSiswa::class,'nilai_id');
    }

}
