<?php

namespace App\Models\Pivot;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuruMatpelKelas extends Model
{
    use HasFactory;
    protected $table = "guru_matpel_kelas";
    public $timestamps = false;
    protected $fillable = ['guru_matpel_id','kelas_id'];
    
}
