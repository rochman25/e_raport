<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Pivot\GuruMatpel;
use App\Models\Pivot\GuruMatpelKelas;
use App\Models\TahunAjaran;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SetupMatpelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $matpel = GuruMatpel::with(['guru','mata_pelajaran','tahun_ajaran','kelas','kelas.kelas_'])->paginate(10);
        // dd($matpel->toArray());
        return view('pages.setup_matpel.index',compact('matpel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = Kelas::orderBy('tingkat')->get();
        $matpel = MataPelajaran::all();
        $guru = Guru::all();
        $tahun_ajaran = TahunAjaran::all();
        return view('pages.setup_matpel.create',compact('kelas','guru','tahun_ajaran','matpel'));
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
            'guru_id'   => 'required',
            'matpel_id'  => 'required',
            'tahun_ajaran_id' => 'required'
        ]);
        $kelasId = $request->kelas_id;
        try {
            DB::beginTransaction();
            
            $guruMatpel = new GuruMatpel();
            $guruMatpel->guru_id = $request->guru_id;
            $guruMatpel->matpel_id = $request->matpel_id;
            $guruMatpel->tahun_ajaran_id = $request->tahun_ajaran_id;
            $guruMatpel->save();
            $gmk = [];
            if($kelasId){
                foreach(array_unique($kelasId) as $item){
                    $gmk[] = [
                        "guru_matpel_id" => $guruMatpel->id,
                        "kelas_id" => $item
                    ];
                }
                GuruMatpelKelas::insert($gmk);   
            }

            DB::commit();
            return redirect()->route('view.setup_matpel')
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
        $guru_matpel = GuruMatpel::with('kelas')->find($id);
        $kelas = Kelas::orderBy('tingkat')->get();
        $matpel = MataPelajaran::all();
        $guru = Guru::all();
        $tahun_ajaran = TahunAjaran::all();
        return view('pages.setup_matpel.edit',compact('matpel','kelas','guru','tahun_ajaran','guru_matpel'));
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
        $request->validate([
            'guru_id'   => 'required',
            'matpel_id'  => 'required',
            'tahun_ajaran_id' => 'required'
        ]);
        $kelasId = $request->kelas_id;
        try {
            DB::beginTransaction();
            
            $guruMatpel = GuruMatpel::find($id);
            $guruMatpel->guru_id = $request->guru_id;
            $guruMatpel->matpel_id = $request->matpel_id;
            $guruMatpel->tahun_ajaran_id = $request->tahun_ajaran_id;
            $guruMatpel->save();
            $gmk = [];
            if($kelasId){
                // dd($kelasId);
                GuruMatpelKelas::where('guru_matpel_id',$id)->delete();
                foreach(array_unique($kelasId) as $item){
                    $gmk[] = [
                        "guru_matpel_id" => $guruMatpel->id,
                        "kelas_id" => $item
                    ];
                }
                GuruMatpelKelas::insert($gmk);   
            }
            DB::commit();
            return redirect()->route('view.setup_matpel')
                ->with('success', 'Data Berhasil disimpan');
        } catch (Exception $e) {
            DB::rollBack();
            // dd($e);
            return redirect()->route('view.setup_matpel.edit',$id)
                ->with('error', 'Data Gagal disimpan');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $id = $request->id;
        try {
            DB::beginTransaction();

            GuruMatpelKelas::where('guru_matpel_id',$id)->delete();
            GuruMatpel::find($id)->delete();
            
            DB::commit();
            
            $success = true;         
            return response()->json(['success'=>$success]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['success' => false,'errors' => $e]);
        }
    }
}
