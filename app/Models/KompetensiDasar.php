<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KompetensiDasar extends Model
{
    use HasFactory;
    protected $table = "kompetensi_dasar";
    protected $fillable = ['kode_kd','matpel_id','kelas_id','tahun_ajaran_id','jenis_kd','deskripsi'];

    public function kelas(){
        return $this->belongsTo(Kelas::class,'kelas_id');
    }

    public function matpel(){
        return $this->belongsTo(MataPelajaran::class,'matpel_id');
    }

    public function tahun_ajaran(){
        return $this->belongsTo(TahunAjaran::class,'tahun_ajaran_id');
    }

}
