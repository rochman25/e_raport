<?php

namespace App\Models\Pivot;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasSiswa extends Model
{
    use HasFactory;
    protected $table = "kelas_siswa";
    protected $fillable = ["siswa_id","kelas_id","tahun_ajaran_id"];
    public $timestamps = false;
}
