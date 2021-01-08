<?php

namespace App\Models\Pivot;

use App\Models\Guru;
use App\Models\MataPelajaran;
use App\Models\TahunAjaran;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuruMatpel extends Model
{
    use HasFactory;
    protected $table = "guru_matpel";
    protected $fillable = ['guru_id','matpel_id','tahun_ajaran_id'];


    public function guru(){
        return $this->belongsTo(Guru::class,'guru_id');
    }

    public function kelas(){
        return $this->hasMany(GuruMatpelKelas::class,'guru_matpel_id','id');
    }

    public function mata_pelajaran(){
        return $this->belongsTo(MataPelajaran::class,'matpel_id');
    }

    public function tahun_ajaran(){
        return $this->belongsTo(TahunAjaran::class,'tahun_ajaran_id');
    }

}
