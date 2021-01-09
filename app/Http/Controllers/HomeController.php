<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Pivot\GuruMatpel;
use App\Models\Pivot\GuruMatpelKelas;
use App\Models\RoleUser;
use App\Models\Siswa;
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
            $matpel = GuruMatpel::with('kelas')->where('guru_id', $guruId)->count();
            $kelas_matpel = GuruMatpelKelas::with(['guruMatpel' => function ($query)use($guruId) {
                $query->where('guru_id', $guruId);
            }])->count();
        }
        return view('pages.dashboard', compact('guru', 'siswa', 'kelas', 'matpel','kelas_matpel'));
    }
}
