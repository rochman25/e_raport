<?php

namespace App\Http\Controllers;

use App\Exports\NilaiSiswaExport;
use App\Imports\NilaiSiswaImport;
use App\Models\DetailNilai;
use App\Models\Ekstrakurikuler;
use App\Models\Kelas;
use App\Models\KompetensiDasar;
use App\Models\MataPelajaran;
use App\Models\NilaiSiswa;
use App\Models\Pivot\GuruMatpel;
use App\Models\Pivot\GuruMatpelKelas;
use App\Models\Pivot\KelasSiswa;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use App\Models\WaliKelas;
use PDF;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class NilaiSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd(Auth::user()->guru);
        $matpel_id = $request->matpel_id;
        $guru_id = Auth::user()->guru->id ?? "";
        $guruMatpel = GuruMatpelKelas::whereHas('guruMatpel', function (Builder $query) use ($guru_id) {
            $query->where('guru_id', $guru_id);
        })->whereHas('guruMatpel', function (Builder $query) use ($matpel_id) {
            $query->where('matpel_id', $matpel_id);
        })->with(['guruMatpel.mata_pelajaran', 'kelas_'])->get();
        $matpel = GuruMatpel::where('guru_id', $guru_id)->get();
        // dd($guruMatpel->toArray());
        $tahun_ajaran = TahunAjaran::all();
        $siswa = Siswa::paginate(10);
        return view('pages.nilai_siswa.index', compact('matpel', 'guruMatpel', 'tahun_ajaran', 'siswa'));
    }

    public function ekstra_view(Request $request)
    {
        $id = Auth::user()->guru->id ?? "";
        $tahun_ajaran_id = TahunAjaran::where('active', '1')->first()->id;
        $kelas_id = $request->kelas_id;
        $tahun_ajaran = TahunAjaran::all();
        $ekstrakurikuler = Ekstrakurikuler::all();
        if ($request->tahun_ajaran_id) {
            $tahun_ajaran_id = $request->tahun_ajaran_id;
        }
        $ekstra_id = $request->ekstra_id;
        $walikelas = WaliKelas::with('kelas')->where('tahun_ajaran_id', $tahun_ajaran_id)->when($kelas_id, function ($query, $kelas_id) {
            return $query->where('kelas_id', $kelas_id);
        })->where('guru_id', $id)->first();
        $kelas = WaliKelas::with('kelas', 'tahun_ajaran')->where('tahun_ajaran_id', $tahun_ajaran_id)->where('guru_id', $id)->get();
        $siswa = KelasSiswa::with('siswa')->where('kelas_id', $walikelas->kelas_id)->paginate(10);
        if ($ekstra_id == null) {
            $siswa = [];
        }
        $nilai = NilaiSiswa::where('kelas_id', $request->kelas_id)
            ->where('jenis_nilai', "eks")
            ->when($ekstra_id, function ($query, $kd_id) {
                return $query->where('ekstra_id', $kd_id);
            })
            ->first();
        $idNilai = $nilai->id ?? null;
        if ($idNilai == null) {
            $nilai_siswa = [];
            // $siswa = [];
        } else {
            $nilai_siswa = DetailNilai::when($idNilai, function ($query, $idNilai) {
                return $query->where('nilai_id', $idNilai);
            })->get()->toArray();
        }
        // dd($nilai_siswa);
        return view('pages.nilai_siswa.ekstrakurikuler.index', compact('walikelas', 'tahun_ajaran', 'siswa', 'kelas', 'ekstrakurikuler', 'nilai', 'nilai_siswa'));
    }

    public function store(Request $request)
    {
        // dd($request);
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
    public function ekstra_store(Request $request)
    {
        // dd($request);
        $request->validate([
            // "tipe_nilai" => 'required',
            // "jenis_nilai" => 'required',
        ]);

        try {
            DB::beginTransaction();
            // dd($request);
            $nilai_id = $request->id_nilai;
            $nilaiSiswa = NilaiSiswa::find($nilai_id);
            if (!$nilaiSiswa) {
                $nilaiSiswa = new NilaiSiswa();
            }
            $nilaiSiswa->kelas_id = $request->kelas_id;
            $nilaiSiswa->jenis_nilai = "eks";
            $nilaiSiswa->tahun_ajaran_id = $request->tahun_ajaran_id;
            $nilaiSiswa->ekstra_id = $request->ekstra_id;
            $nilaiSiswa->save();

            $nilai = $request->nilai_huruf;
            $deskripsi = $request->deskripsi;
            $nilai_detail_id = $request->id_nilai_siswa;
            $siswa_id = $request->siswa_id;
            if (!empty($nilai)) {
                foreach ($nilai as $index => $item) {
                    // dd($item);
                    DetailNilai::updateOrCreate(
                        ['id' => $nilai_detail_id[$index]],
                        ['nilai_id' => $nilaiSiswa->id, 'siswa_id' => $siswa_id[$index], 'nilai_angka' => 0, 'nilai_huruf' => $item, 'deskripsi' => $deskripsi[$index]]
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
    public function edit(Request $request, $id)
    {
        //
        $guruMatpel = GuruMatpel::find($id);
        $kds = KompetensiDasar::where('matpel_id', $guruMatpel->matpel_id)->get();
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
            ->where('tipe_nilai', $request->tipe_nilai)
            ->where('jenis_nilai', $request->jenis_nilai)
            ->when($kd_id, function ($query, $kd_id) {
                return $query->where('kd_id', $kd_id);
            })
            ->first();
        $idNilai = $nilai->id ?? null;
        $siswa = KelasSiswa::where('kelas_id', $request->kelas)->get();
        if ($idNilai == null) {
            $nilai_siswa = [];
            // $siswa = [];
        } else {
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function createPDF(Request $request, $id)
    {
        $kd_id = $request->kd_id;
        $guru_matpel = GuruMatpel::find($id);
        $nilai = NilaiSiswa::where('guru_matpel_id', $id)
            ->where('kelas_id', $request->kelas)
            ->where('tipe_nilai', $request->tipe_nilai)
            ->where('jenis_nilai', $request->jenis_nilai)
            ->when($kd_id, function ($query, $kd_id) {
                return $query->where('kd_id', $kd_id);
            })
            ->first();
        $idNilai = $nilai->id ?? null;
        $siswa = KelasSiswa::where('kelas_id', $request->kelas)->get();
        if ($idNilai == null) {
            $nilai_siswa = [];
            // $siswa = [];
        } else {
            $nilai_siswa = DetailNilai::when($idNilai, function ($query, $idNilai) {
                return $query->where('nilai_id', $idNilai);
            })->get()->toArray();
        }
        // dd($idNilai);
        $kelas_id = $request->kelas;
        $kelas = Kelas::find($request->kelas);
        // dd($kelas);
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
        // $keys = array_keys(array_column($jnspenilaian, 'id'), 'uts');
        // $keys = array_keys(array_combine(array_keys($jnspenilaian), array_column($jnspenilaian, 'id')),'uts');
        // dd($keys);
        $pdf = PDF::loadView('pages.prints.nilai_siswa', compact('jnspenilaian', 'guru_matpel', 'kelas', 'kelas_id', 'nilai_siswa', 'siswa', 'kd_id', 'nilai'));
        return $pdf->download('rekap_nilai_kelas.pdf');
        // return $pdf->stream('rekap nilai kelas.pdf',array("Attachment" => false));
    }


    public function detailNilaiSiswa(Request $request, $id)
    {
        $kelas_id = $request->kelas_id;
        $matpel_id = $request->matpel_id;
        // $matpel = MataPelajaran::all();
        $kelas = KelasSiswa::where('siswa_id', $id)->get();
        $tahun_ajaran = TahunAjaran::all();
        $matpel = GuruMatpelKelas::where('kelas_id', $kelas_id)->get();
        $nilai_siswa = DetailNilai::where('siswa_id', $id)
            ->with(['nilai.kelas', 'nilai.guru_matpel.mata_pelajaran'])
            ->whereHas('nilai', function (Builder $query) {
                $query->where('jenis_nilai', '<>', 'eks');
            });
        if ($kelas_id) {
            $nilai_siswa->whereHas('nilai.kelas', function (Builder $query) use ($kelas_id) {
                $query->where('id', $kelas_id);
            })->get();
        }

        if ($matpel_id) {
            $nilai_siswa->whereHas('nilai.guru_matpel.mata_pelajaran', function (Builder $query) use ($matpel_id) {
                $query->where('id', $matpel_id);
            })->get();
        }

        $nilai_siswa = $nilai_siswa->get();
        foreach ($matpel as $index_m => $item_m) {
            $uts = 0;
            $cUts = 0;
            $uas = 0;
            $cUas = 0;
            $kd = 0;
            $cKd = 0;
            foreach ($nilai_siswa as $index => $item) {
                // dd($item->nilai);
                // dd($item_m);
                if($item->nilai->jenis_nilai == "uts" && $item_m->guru_matpel_id == $item->nilai->guru_matpel_id){
                    // dd($item->nilai);
                    $uts += $item->nilai_angka;
                    $cUts += 1;
                }
                
                if($item->nilai->jenis_nilai == "uas" && $item_m->guru_matpel_id == $item->nilai->guru_matpel_id){
                    // dd($item);
                    $uas += $item->nilai_angka;
                    $cUas += 1;
                }

                if($item->nilai->jenis_nilai == "kd" && $item_m->guru_matpel_id == $item->nilai->guru_matpel_id){
                    // dd($item);
                    $kd += $item->nilai_angka;
                    $cKd += 1;
                }
            }
            $item_m['uts'] = $cUts > 0 ? $uts / $cUts : 0;
            $item_m['uas'] = $cUas > 0 ? $uas / $cUas : 0;
            $item_m['kd'] = $cKd > 0 ? $kd / $cKd : 0;
        }

        // dd($matpel);
        $siswa = Siswa::find($id);
        // dd($nilai_siswa);
        return view('pages.nilai_siswa.detail', compact('siswa', 'nilai_siswa', 'matpel', 'kelas', 'tahun_ajaran'));
    }

    public function viewImport(Request $request, $id)
    {
        $nilai_siswa = "";
        $kelas = $request->kelas_id;
        $tipe_nilai = $request->tipe_nilai;
        $jenis_nilai = $request->jenis_nilai;
        $kd_id = $request->kd_id;
        $format = $request->format;
        if ($format == "download") {
            return Excel::download(new NilaiSiswaExport($id, $kelas, $tipe_nilai, $jenis_nilai, $kd_id), 'Import_Format.xlsx');
        }
        return view('pages.nilai_siswa.import', compact('nilai_siswa', 'id'));
    }

    public function storeImport(Request $request, $id)
    {
        //get import data excel and save to session and preview it
        $request->validate([
            'file' => 'required',
            'kelas_id' => 'required',
            'jenis_nilai' => 'required',
            'tipe_nilai' => 'required',
            'kd_id' => 'sometimes|required'
        ]);
        try {
            DB::beginTransaction();
            $kd_id = $request->kd_id;
            $idNilai = "";
            $nilai = NilaiSiswa::where('guru_matpel_id', $id)
                ->where('kelas_id', $request->kelas_id)
                ->where('tipe_nilai', $request->tipe_nilai)
                ->where('jenis_nilai', $request->jenis_nilai)
                ->when($kd_id, function ($query, $kd_id) {
                    return $query->where('kd_id', $kd_id);
                })->first();

            if ($nilai == null) {
                $nilai = new NilaiSiswa();
                $nilai->guru_matpel_id = $id;
                $nilai->kelas_id = $request->kelas_id;
                $nilai->tipe_nilai = $request->tipe_nilai;
                $nilai->jenis_nilai = $request->jenis_nilai;
                $nilai->kd_id = $kd_id;
                $nilai->save();
            }

            $idNilai = $nilai->id;

            $file = $request->file;
            // membuat nama file unik
            $nama_file = rand() . $file->getClientOriginalName();
            // upload ke folder file_siswa di dalam folder public
            $file->move('file_nilai_siswa', $nama_file);
            // import data
            Excel::import(new NilaiSiswaImport($idNilai), public_path('/file_nilai_siswa/' . $nama_file));
            // dd($nilai);
            DB::commit();
            unlink(public_path('/file_nilai_siswa/' . $nama_file));
            if ($kd_id == null) {
                return redirect()->route('view.nilai_siswa.edit', [$id, 'kelas' => $request->kelas_id, 'tipe_nilai' => $request->tipe_nilai, 'jenis_nilai' => $request->jenis_nilai, 'kd_id' => $kd_id])
                    ->with('success', 'Data Berhasil disimpan');
            }
            return redirect()->route('view.nilai_siswa.edit', [$id, 'kelas' => $request->kelas_id, 'tipe_nilai' => $request->tipe_nilai, 'jenis_nilai' => $request->jenis_nilai])
                ->with('success', 'Data Berhasil disimpan');
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
            return redirect()->back()
                ->with('error', 'Data Gagal disimpan');
        }
    }

    public function saveImport(Request $request, $id)
    {
        // get session data and save it to db
    }
}
