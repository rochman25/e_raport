<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Pivot\KelasSiswa;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SetupKelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $kelas = Kelas::all();
        $tahun_ajaran = TahunAjaran::all();
        $kelas_id = $request->kelas_id;
        $tahun_ajaran_id = $request->tahun_ajaran_id;
        if (empty($tahun_ajaran_id)) {
            $tahun_ajaran_id = TahunAjaran::where('active', 1)->first();
            $tahun_ajaran_id = $tahun_ajaran_id->id;
        }
        $siswa = KelasSiswa::with('siswa', 'kelas', 'tahun_ajaran')->when($kelas_id, function ($query, $kelas_id) {
            return $query->where('kelas_id',$kelas_id);
        })->where('tahun_ajaran_id',$tahun_ajaran_id)->paginate(10);
        return view('pages.setup_kelas.index', compact('siswa', 'kelas', 'tahun_ajaran'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $siswa = Siswa::all();
        $kelas = Kelas::all();
        $tahun_ajaran = TahunAjaran::all();
        return view('pages.setup_kelas.create',compact('siswa','kelas','tahun_ajaran'));
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
            'siswa_id'   => 'required',
            'kelas_id'  => 'required',
            'tahun_ajaran_id' => 'required'
        ]);
        $siswaId = $request->siswa_id;
        try {
            DB::beginTransaction();
            $sk = [];
            if($siswaId){
                foreach(array_unique($siswaId) as $item){
                    $sk[] = [
                        "tahun_ajaran_id" => $request->tahun_ajaran_id,
                        "kelas_id" => $request->kelas_id,
                        "siswa_id" => $item
                    ];
                }
                KelasSiswa::insert($sk);   
            }

            DB::commit();
            return redirect()->route('view.setup_kelas')
                ->with('success', 'Data Berhasil disimpan');
        } catch (Exception $e) {
            DB::rollBack();
            // dd($e);
            return redirect()->route('view.setup_matpel.insert')
                ->with('error', 'Data Gagal disimpan');
        }

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
        $siswa_id = $request->siswa_id;
        $kelas_id = $request->kelas_id;
        $tahun_ajaran_id = $request->tahun_ajaran_id;
        try {
            DB::beginTransaction();
            KelasSiswa::where('kelas_id',$kelas_id)->where('siswa_id',$siswa_id)->where('tahun_ajaran_id',$tahun_ajaran_id)->delete();
            
            DB::commit();
            
            $success = true;         
            return response()->json(['success'=>$success]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['success' => false,'errors' => $e]);
        }
    }
}
