<?php

namespace App\Http\Controllers;

use App\Models\CatatanWalikelas;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use App\Models\WaliKelas;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CatatanWalikelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $catatan = CatatanWalikelas::where('kelas_id',$request->kelas_id)->where('tahun_ajaran_id',$request->tahun_ajaran_id)->paginate(10);
        $tahun_ajaran = TahunAjaran::all();
        $tahun_ajaran_id = TahunAjaran::where('active','1')->first()->id;
        $kelas = WaliKelas::with('kelas','tahun_ajaran')->where('tahun_ajaran_id',$tahun_ajaran_id)->where('guru_id',Auth::user()->guru->id)->get();
        return view('pages.catatan.index',compact('catatan','kelas','tahun_ajaran'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $siswa = Siswa::all();
        return view('pages.catatan.create',compact('siswa'));
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
            'siswa_id' => 'required',
            'catatan' => 'required'
        ]);
        try {
            DB::beginTransaction();
            $dataRequest = $request->all();
            $dataRequest['guru_id'] = Auth::user()->guru->id;
            CatatanWalikelas::create($dataRequest);
            DB::commit();
            return redirect()->route('view.catatan',['kelas_id'=>$request->kelas_id,'tahun_ajaran_id'=>$request->tahun_ajaran_id])
                ->with('success', 'Data Berhasil disimpan');
        } catch (Exception $e) {
            DB::rollBack();
            // dd($e);
            return redirect()->back()
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
        $catatan = CatatanWalikelas::find($id);
        $siswa = Siswa::all();
        return view('pages.catatan.edit',compact('catatan','siswa'));
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
            'siswa_id' => 'required',
            'catatan' => 'required'
        ]);
        try {
            DB::beginTransaction();
            CatatanWalikelas::where('id',$id)->update($request->only(['siswa_id','kelas_id','tahun_ajaran_id','catatan']));
            DB::commit();
            return redirect()->route('view.catatan',['kelas_id'=>$request->kelas_id,'tahun_ajaran_id'=>$request->tahun_ajaran_id])
                ->with('success', 'Data Berhasil disimpan');
        } catch (Exception $e) {
            DB::rollBack();
            // dd($e);
            return redirect()->back()
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
        $id = $request->id;
        try {
            DB::beginTransaction();

            CatatanWalikelas::where('id',$id)->delete();
            DB::commit();
            
            $success = true;         
            return response()->json(['success'=>$success]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['success' => false,'errors' => $e]);
        }
    }
}
