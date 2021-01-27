<?php

namespace App\Http\Controllers;

use App\Models\NilaiSikap;
use App\Models\Pivot\KelasSiswa;
use App\Models\TahunAjaran;
use App\Models\WaliKelas;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NilaiSikapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_spiritual(Request $request)
    {
        $tahun_ajaran = TahunAjaran::all();
        $tahun_ajaran_id = TahunAjaran::where('active', '1')->first()->id;
        $kelas = WaliKelas::with('kelas', 'tahun_ajaran')->where('tahun_ajaran_id', $tahun_ajaran_id)->where('guru_id', Auth::user()->guru->id)->get();
        $kelas_id = $request->kelas_id;
        $tahun_ajaran_id = $request->tahun_ajaran_id;
        $id = Auth::user()->guru->id;
        $walikelas = WaliKelas::with('kelas')->where('tahun_ajaran_id', $tahun_ajaran_id)->where('kelas_id', $kelas_id)->where('guru_id', $id)->first();
        $siswa = [];
        if ($walikelas != null) {
            $siswa = KelasSiswa::with('siswa')->where('kelas_id', $walikelas->kelas_id)->get();
        }
        $nilai_siswa = NilaiSikap::where('type','spiritual')->where('kelas_id', $kelas_id)->where('tahun_ajaran_id', $tahun_ajaran_id)
            ->get()->toArray();
        return view('pages.nilai_sikap.index_spiritual', compact('kelas', 'tahun_ajaran', 'siswa', 'nilai_siswa'));
    }

    public function index_sosial(Request $request)
    {
        $tahun_ajaran = TahunAjaran::all();
        $tahun_ajaran_id = TahunAjaran::where('active', '1')->first()->id;
        $kelas = WaliKelas::with('kelas', 'tahun_ajaran')->where('tahun_ajaran_id', $tahun_ajaran_id)->where('guru_id', Auth::user()->guru->id)->get();
        $kelas_id = $request->kelas_id;
        $tahun_ajaran_id = $request->tahun_ajaran_id;
        $id = Auth::user()->guru->id;
        $walikelas = WaliKelas::with('kelas')->where('tahun_ajaran_id', $tahun_ajaran_id)->where('kelas_id', $kelas_id)->where('guru_id', $id)->first();
        $siswa = [];
        if ($walikelas != null) {
            $siswa = KelasSiswa::with('siswa')->where('kelas_id', $walikelas->kelas_id)->get();
        }
        $nilai_siswa = NilaiSikap::where('type','sosial')->where('kelas_id', $kelas_id)->where('tahun_ajaran_id', $tahun_ajaran_id)
            ->get()->toArray();
        return view('pages.nilai_sikap.index_sosial', compact('kelas', 'tahun_ajaran', 'siswa', 'nilai_siswa'));
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
    public function store_spiritual(Request $request)
    {
        try {
            DB::beginTransaction();
            // dd($request);

            $predikat = $request->predikat;
            $deskripsi = $request->deskripsi;
            $siswa_id = $request->siswa_id;
            $nilai_detail_id = $request->id_nilai_siswa;
            $kelas_id = $request->kelas_id;
            $tahun_ajaran_id = $request->tahun_ajaran_id;
            if (!empty($siswa_id)) {
                foreach ($siswa_id as $index => $item) {
                    // dd($item);
                    NilaiSikap::updateOrCreate(
                        ['id' => $nilai_detail_id[$index]],
                        ['siswa_id' => $item,'type' => 'spiritual', 'guru_id' => Auth::user()->guru->id , 'kelas_id' => $kelas_id, 'tahun_ajaran_id' => $tahun_ajaran_id, 'predikat' => $predikat[$index], 'deskripsi' => $deskripsi[$index]]
                    );
                }
            }
            DB::commit();
            return redirect()->back()
                ->with('success', 'Data Berhasil disimpan');
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
            return redirect()->back()
                ->with('error', 'Data Gagal disimpan');
        }
    }

    public function store_sosial(Request $request)
    {
        try {
            DB::beginTransaction();
            // dd($request);

            $predikat = $request->predikat;
            $deskripsi = $request->deskripsi;
            $siswa_id = $request->siswa_id;
            $nilai_detail_id = $request->id_nilai_siswa;
            $kelas_id = $request->kelas_id;
            $tahun_ajaran_id = $request->tahun_ajaran_id;
            if (!empty($siswa_id)) {
                foreach ($siswa_id as $index => $item) {
                    // dd($item);
                    NilaiSikap::updateOrCreate(
                        ['id' => $nilai_detail_id[$index]],
                        ['siswa_id' => $item,'type' => 'sosial', 'guru_id' => Auth::user()->guru->id , 'kelas_id' => $kelas_id, 'tahun_ajaran_id' => $tahun_ajaran_id, 'predikat' => $predikat[$index], 'deskripsi' => $deskripsi[$index]]
                    );
                }
            }
            DB::commit();
            return redirect()->back()
                ->with('success', 'Data Berhasil disimpan');
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
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
    public function destroy($id)
    {
        //
    }
}
