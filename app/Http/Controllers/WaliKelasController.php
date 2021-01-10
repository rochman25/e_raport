<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Pivot\KelasSiswa;
use App\Models\TahunAjaran;
use App\Models\WaliKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WaliKelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $walikelas = WaliKelas::with(['guru','kelas','tahun_ajaran'])->paginate(10);
        $kelas = Kelas::all();
        $guru = Guru::all();
        $tahun_ajaran = TahunAjaran::all();
        return view('pages.walikelas.index',compact('walikelas','kelas','guru','tahun_ajaran'));
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
        $request->validate([
            'guru_id' => 'required',
            'tahun_ajaran_id' => 'required',
            'kelas_id' => 'required',
        ]);
        
        if($request->id !== null){
            $query = WaliKelas::find($request->id);
            $query->update($request->all());
        }else{
            $query = WaliKelas::create($request->all());
        }

        if ($query) {
            return redirect()->route('view.walikelas')
                ->with('success', 'Data Berhasil disimpan');
        } else {
            return redirect()->route('view.walikelas')
                ->with('error', 'Data Gagal disimpan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $tahun_ajaran_id = TahunAjaran::where('active','1')->first()->id;
        $kelas_id = $request->kelas_id;
        $tahun_ajaran = TahunAjaran::all();
        if($request->tahun_ajaran_id){
            $tahun_ajaran_id = $request->tahun_ajaran_id;
        }
        $walikelas = WaliKelas::with('kelas')->where('tahun_ajaran_id',$tahun_ajaran_id)->when($kelas_id,function($query,$kelas_id){
            return $query->where('kelas_id',$kelas_id);
        })->where('guru_id',$id)->first();
        $kelas = WaliKelas::with('kelas','tahun_ajaran')->where('tahun_ajaran_id',$tahun_ajaran_id)->where('guru_id',$id)->get();
        $siswa = KelasSiswa::with('siswa')->where('kelas_id',$walikelas->kelas_id)->paginate(10);
        // dd($walikelas->toArray());
        return view('pages.walikelas.show',compact('walikelas','tahun_ajaran','siswa','kelas'));
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
    public function destroy(Request $request)
    {
        $id = $request->id;
        try {
            DB::beginTransaction();

            WaliKelas::find($id)->delete();
            
            DB::commit();
            
            $success = true;         
            return response()->json(['success'=>$success]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['success' => false,'errors' => $e]);
        }
    }
}
