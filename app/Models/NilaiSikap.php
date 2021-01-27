<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiSikap extends Model
{
    use HasFactory;
    protected $table = "nilai_sikap";
    protected $fillable = ["siswa_id","guru_id","type","kelas_id","tahun_ajaran_id","predikat","deskripsi"];

    public function siswa(){
        return $this->belongsTo(Siswa::class,'siswa_id');
    }

    public function kelas(){
        return $this->belongsTo(Kelas::class,'kelas_id');
    }

    public function tahun_ajaran(){
        return $this->belongsTo(TahunAjaran::class,'tahun_ajaran_id');
    }

    public function guru(){
        return $this->belongsTo(Guru::class,'guru_id');
    }


}
