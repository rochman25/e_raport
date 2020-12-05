<?php

namespace App\Models\Pivot;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuruMatpel extends Model
{
    use HasFactory;
    protected $table = "guru_matpel";
    protected $fillable = ['guru_id','matpel_id','tahun_ajaran_id'];
}
