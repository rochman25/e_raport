<?php

namespace App\Http\Controllers;

use App\Models\DetailNilai;
use App\Models\Kelas;
use App\Models\KompetensiDasar;
use App\Models\NilaiSiswa;
use App\Models\Pivot\GuruMatpel;
use App\Models\Pivot\KelasSiswa;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $guru_id = Auth::user()->guru->id ?? "";
        $guruMatpel = GuruMatpel::with(['kelas'])->when($guru_id, function ($query, $guru_id) {
            return $query->where('guru_id', $guru_id);
        })->get();
        // dd($guruMatpel->toArray());
        $tahun_ajaran = TahunAjaran::all();
        $siswa = Siswa::paginate(10);
        return view('pages.nilai_siswa.index', compact('guruMatpel', 'tahun_ajaran', 'siswa'));
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
    public function store(Request $request, $id)
    {


        // dd($request);
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
    public function edit(Request $request, $id)
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
        $kd_id = $request->kd_id;
        $nilai = NilaiSiswa::where('guru_matpel_id', $id)
                    ->where('kelas_id', $request->kelas)
                    ->where('tipe_nilai',$request->tipe_nilai)
                    ->where('jenis_nilai',$request->jenis_nilai)
                    ->when($kd_id,function($query,$kd_id){
                        return $query->where('kd_id',$kd_id);
                    })
                    ->first();
        $idNilai = $nilai->id ?? null;
        $siswa = KelasSiswa::where('kelas_id', $request->kelas)->get();
        if($idNilai == null){
            $nilai_siswa = [];
            // $siswa = [];
        }else{
            $nilai_siswa = DetailNilai::when($idNilai, function ($query, $idNilai) {
                return $query->where('nilai_id', $idNilai);
            })->get()->toArray();
        }
        // dd($nilai_siswa);
        $kelas_id = $request->kelas;
        return view('pages.nilai_siswa.edit', compact('kds', 'jnspenilaian', 'siswa', 'id', 'nilai', 'nilai_siswa', 'kelas_id'));
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
            "tipe_nilai" => 'required',
            "jenis_nilai" => 'required',
        ]);

        try {
            DB::beginTransaction();
            // dd($request);
            $nilai_id = $request->id_nilai;
            $nilaiSiswa = NilaiSiswa::find($nilai_id);
            if (!$nilaiSiswa) {
                $nilaiSiswa = new NilaiSiswa();
            }
            $nilaiSiswa->guru_matpel_id = $id;
            $nilaiSiswa->kelas_id = $request->kelas_id;
            $nilaiSiswa->jenis_nilai = $request->jenis_nilai;
            $nilaiSiswa->tipe_nilai = $request->tipe_nilai;
            $nilaiSiswa->kd_id = $request->kd_id;
            $nilaiSiswa->save();

            $nilai = $request->nilai;
            $nilai_detail_id = $request->id_nilai_siswa;
            $siswa_id = $request->siswa_id;
            if (!empty($nilai)) {
                foreach ($nilai as $index => $item) {
                    DetailNilai::updateOrCreate(
                        ['id' => $nilai_detail_id[$index]],
                        ['nilai_id' => $nilaiSiswa->id, 'siswa_id' => $siswa_id[$index], 'nilai_angka' => $item]
                    );
                }
            }
            DB::commit();
            return redirect()->route('view.nilai_siswa')
                ->with('success', 'Data Berhasil disimpan');
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
            return redirect()->route('view.nilai_siswa.edit', $id)
                ->with('error', 'Data Gagal disimpan');
        }
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
