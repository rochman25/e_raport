<?php

namespace App\Http\Controllers;

use App\Models\Pivot\KelasSiswa;
use App\Models\TahunAjaran;
use App\Models\WaliKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CetakController extends Controller
{
    //

    public function view_raport_data(Request $request){
        $tahun_ajaran = TahunAjaran::all();
        $tahun_ajaran_id = TahunAjaran::where('active','1')->first()->id;
        $kelas = WaliKelas::with('kelas','tahun_ajaran')->where('tahun_ajaran_id',$tahun_ajaran_id)->where('guru_id',Auth::user()->guru->id)->get();
        $kelas_id = $request->kelas_id;
        $tahun_ajaran_id = $request->tahun_ajaran_id;
        $id = Auth::user()->guru->id;
        $walikelas = WaliKelas::with('kelas')->where('tahun_ajaran_id', $tahun_ajaran_id)->where('kelas_id', $kelas_id)->where('guru_id', $id)->first();
        $siswa = [];
        if ($walikelas != null) {
            $siswa = KelasSiswa::with('siswa')->where('kelas_id', $walikelas->kelas_id)->paginate(10);
        }
        return view('pages.cetak.index_raport',compact('kelas','tahun_ajaran','siswa','walikelas'));
    }


    public function view_leger_data(Request $request){
        $tahun_ajaran = TahunAjaran::all();
        $tahun_ajaran_id = TahunAjaran::where('active','1')->first()->id;
        $kelas = WaliKelas::with('kelas','tahun_ajaran')->where('tahun_ajaran_id',$tahun_ajaran_id)->where('guru_id',Auth::user()->guru->id)->get();
        $kelas_id = $request->kelas_id;
        $tahun_ajaran_id = $request->tahun_ajaran_id;
        $id = Auth::user()->guru->id;
        $walikelas = WaliKelas::with('kelas')->where('tahun_ajaran_id', $tahun_ajaran_id)->where('kelas_id', $kelas_id)->where('guru_id', $id)->first();
        $siswa = [];
        if ($walikelas != null) {
            $siswa = KelasSiswa::with('siswa')->where('kelas_id', $walikelas->kelas_id)->paginate(10);
        }
        return view('pages.cetak.index_leger',compact('kelas','tahun_ajaran','siswa','walikelas'));
    }

}
