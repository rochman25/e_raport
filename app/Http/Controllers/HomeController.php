<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Pivot\GuruMatpel;
use App\Models\Pivot\GuruMatpelKelas;
use App\Models\RoleUser;
use App\Models\Siswa;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $guru = "";
        $siswa = "";
        $kelas = "";
        $matpel = "";
        $kelas_matpel = "";
        $role = RoleUser::with('role', 'user', 'user.guru')->where('user_id', Auth::user()->id)->first();
        if ($role->role['name'] == "super admin") {
            $guru = Guru::count();
            $siswa = Siswa::count();
            $kelas = Kelas::count();
        } else {
            // dd($role->toArray());
            $guruId = $role->user->guru['id'];
            $dataMatpel = GuruMatpel::with('kelas')->where('guru_id', $guruId)->get();
            $kelas_matpel = 0;
            $matpel = count($dataMatpel);
            foreach($dataMatpel as $item){
                $kelas_matpel += count($item->kelas);
            }
        }
        return view('pages.dashboard', compact('guru', 'siswa', 'kelas', 'matpel','kelas_matpel'));
    }
}
