<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $guru = Guru::count();
        $siswa = Siswa::count();
        $kelas = Kelas::count();
        return view('pages.dashboard',compact('guru','siswa','kelas'));
    }
}
