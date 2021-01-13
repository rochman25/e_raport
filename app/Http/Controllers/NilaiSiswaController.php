<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\KompetensiDasar;
use App\Models\Pivot\GuruMatpel;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NilaiSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(Auth::user()->guru);
        $guru_id = Auth::user()->guru->id??"";
        $guruMatpel = GuruMatpel::with(['kelas'])->when($guru_id,function($query,$guru_id){
            return $query->where('guru_id',$guru_id);
        })->get();
        // dd($guruMatpel->toArray());
        $tahun_ajaran = TahunAjaran::all();
        $siswa = Siswa::paginate(10);
        return view('pages.nilai_siswa.index',compact('guruMatpel','tahun_ajaran','siswa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $kds = KompetensiDasar::all();
        // $jnspenilaian = ["uas","uts","kd"];
        $jnspenilaian = [
            [
                "id" => "uts",
                "val" => "UTS"
            ],
            [
                "id" => "uas",
                "val" => "UAS"
            ],
            [
                "id" => "kd",
                "val" => "Kompetensi Dasar"
            ],
        ];
        return view('pages.nilai_siswa.edit',compact('kds','jnspenilaian'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
