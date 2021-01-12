<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\KompetensiDasar;
use App\Models\MataPelajaran;
use App\Models\TahunAjaran;
use Exception;
// use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KompetensiDasarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kds = KompetensiDasar::paginate(10);
        return view('pages.kd.index', compact('kds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = Kelas::all();
        $matpel = MataPelajaran::all();
        $tahun_ajaran = TahunAjaran::all();
        return view('pages.kd.create', compact('kelas', 'matpel', 'tahun_ajaran'));
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
            'kode_kd' => 'required|unique:kompetensi_dasar',
            'kelas_id' => 'required',
            'matpel_id' => 'required',
            'tahun_ajaran_id' => 'required',
            'jenis_kd' => 'required',
            'deskripsi' => 'required',
        ]);
        // dd($request);
        try {
            DB::beginTransaction();
            $kd = new KompetensiDasar();
            $kd->kode_kd = $request->kode_kd;
            $kd->kelas_id = $request->kelas_id;
            $kd->matpel_id = $request->matpel_id;
            $kd->tahun_ajaran_id = $request->tahun_ajaran_id;
            $kd->deskripsi = $request->deskripsi;
            $kd->jenis_kd = $request->jenis_kd;
            $kd->save();
            DB::commit();
            return redirect()->route('view.kompetensi_dasar')
                ->with('success', 'Data Berhasil disimpan');
        } catch (Exception $e) {
            DB::rollBack();
            // dd($e);
            return redirect()->route('view.kompetensi_dasar.insert')
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
        $kelas = Kelas::all();
        $matpel = MataPelajaran::all();
        $tahun_ajaran = TahunAjaran::all();
        $kd = KompetensiDasar::find($id);
        return view('pages.kd.edit', compact('kelas', 'matpel', 'tahun_ajaran', 'kd'));
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
            'kode_kd' => 'required|unique:kompetensi_dasar,kode_kd,'.$id,
            'kelas_id' => 'required',
            'matpel_id' => 'required',
            'tahun_ajaran_id' => 'required',
            'jenis_kd' => 'required',
            'deskripsi' => 'required',
        ]);
        // dd($request);
        try {
            DB::beginTransaction();
            $kd = KompetensiDasar::find($id);
            $kd->kode_kd = $request->kode_kd;
            $kd->kelas_id = $request->kelas_id;
            $kd->matpel_id = $request->matpel_id;
            $kd->tahun_ajaran_id = $request->tahun_ajaran_id;
            $kd->deskripsi = $request->deskripsi;
            $kd->jenis_kd = $request->jenis_kd;
            $kd->save();
            DB::commit();
            return redirect()->route('view.kompetensi_dasar')
                ->with('success', 'Data Berhasil disimpan');
        } catch (Exception $e) {
            DB::rollBack();
            // dd($e);
            return redirect()->route('view.kompetensi_dasar.insert')
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

            KompetensiDasar::find($id)->delete();

            DB::commit();

            $success = true;
            return response()->json(['success' => $success]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['success' => false, 'errors' => $e]);
        }
    }
}
