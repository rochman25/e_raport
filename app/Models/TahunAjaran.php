<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
    use HasFactory;
    protected $table = "tahun_ajaran";
    protected $fillable = ['tahun','semester','nama_ks','nip_ks','tgl_ttd','active'];
    
}
