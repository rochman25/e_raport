<?php

namespace App\Models\Pivot;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasSiswa extends Model
{
    use HasFactory;
    protected $table = "kelas_siswa";
    protected $fillable = ["siswa_id","kelas_id","tahun_ajaran_id"];
    public $timestamps = false;

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
