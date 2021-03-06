<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;
    protected $table = "guru";
    protected $fillable = ['nip','nama','gelar_depan','gelar_belakang'];

    public function walikelas(){
        return $this->hasMany(WaliKelas::class,'guru_id');
    }

}
