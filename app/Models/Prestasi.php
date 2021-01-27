<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    use HasFactory;
    protected $table = "prestasi";

    protected $fillable = ["siswa_id","guru_id","jenis_kegiatan","keterangan"];

    public function siswa(){
        return $this->belongsTo(Siswa::class,'siswa_id');
    }

}
