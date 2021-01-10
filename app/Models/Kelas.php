<?php

namespace App\Models;

use App\Models\Pivot\KelasSiswa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $table = "kelas";
    protected $fillable = ['nama_kelas','kode_kelas','tingkat'];
    

    public function siswa(){
        return $this->hasMany(KelasSiswa::class,'kelas_id');
    }

}
