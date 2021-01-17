<?php

namespace App\Models;

use App\Models\Pivot\GuruMatpel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiSiswa extends Model
{
    use HasFactory;
    protected $table = "nilai_siswa";
    protected $fillable = ["guru_matpel_id","siswa_id","nilai_angka","nilai_huruf","type"];


    public function guru_matpel(){
        return $this->belongsTo(GuruMatpel::class,'guru_matpel_id');
    }

    public function kelas(){
        return $this->belongsTo(Kelas::class,'kelas_id');
    }

}
