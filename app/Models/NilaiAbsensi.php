<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiAbsensi extends Model
{
    use HasFactory;
    protected $table = "nilai_absensi_siswa";

    public function siswa(){
        return $this->belongsTo(Siswa::class,'siswa_id');
    }

    public function kelas(){
        return $this->belongsTo(Kelas::class,'kelas_id');
    }

    public function tahun_ajaran(){
        return $this->belongsTo(TahunAjaran::class,'tahun_ajaran_id');
    }
}
