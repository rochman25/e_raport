<?php

namespace App\Http\Controllers;

use App\Exports\LegerExport;
use App\Models\CatatanWalikelas;
use App\Models\DetailNilai;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\NilaiAbsensi;
use App\Models\NilaiSikap;
use App\Models\NilaiSiswa;
use App\Models\Pivot\GuruMatpelKelas;
use App\Models\Pivot\KelasSiswa;
use App\Models\Prestasi;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use App\Models\WaliKelas;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class CetakController extends Controller
{
    //

    public function view_raport_data(Request $request)
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
            $siswa = KelasSiswa::with('siswa')->where('kelas_id', $walikelas->kelas_id)->paginate(10);
        }
        return view('pages.cetak.index_raport', compact('kelas', 'tahun_ajaran', 'siswa', 'walikelas'));
    }


    public function view_leger_data(Request $request)
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
            $siswa = KelasSiswa::with('siswa')->where('kelas_id', $walikelas->kelas_id)->paginate(10);
        }
        return view('pages.cetak.index_leger', compact('kelas', 'tahun_ajaran', 'siswa', 'walikelas'));
    }

    public function cetak_raport(Request $request)
    {
        setlocale(LC_TIME, 'id_ID');
        \Carbon\Carbon::setLocale('id');
        \Carbon\Carbon::now()->formatLocalized("%A, %d %B %Y");

        $siswa = Siswa::find($request->id);
        $tahun_ajaran = TahunAjaran::find($request->tahun_ajaran_id);
        $tahun_ajaran_id = $tahun_ajaran->id;
        $kelas = Kelas::find($request->kelas_id);
        $nilai_sikap_spiritual = NilaiSikap::where('type', 'spiritual')
            ->where('siswa_id', $siswa->id)
            ->where('kelas_id', $kelas->id)
            ->where('tahun_ajaran_id', $tahun_ajaran->id)
            ->first();
        $nilai_sikap_sosial = NilaiSikap::where('type', 'sosial')
            ->where('siswa_id', $siswa->id)
            ->where('kelas_id', $kelas->id)
            ->where('tahun_ajaran_id', $tahun_ajaran->id)
            ->first();
        $id_siswa = $siswa->id;
        // dd($tahun_ajaran_id);
        $nilai_ekstra = NilaiSiswa::with(['ekstra', 'detail_nilai' => function ($query) use ($id_siswa) {
            return $query->where('siswa_id', $id_siswa)->get();
        }])->where('jenis_nilai', 'eks')->where('kelas_id', $kelas->id)->get();
        $prestasi = Prestasi::where('siswa_id', $siswa->id)->get();
        $ketidakhadiran = NilaiAbsensi::where('siswa_id', $siswa->id)->where('kelas_id', $kelas->id)->where('tahun_ajaran_id', $tahun_ajaran->id)->first();
        $catatan = CatatanWalikelas::where('siswa_id', $siswa->id)->where('kelas_id', $kelas->id)->where('tahun_ajaran_id', $tahun_ajaran->id)->first();

        $guruMatpelKelas = GuruMatpelKelas::with(['guruMatpel' => function ($query) use ($tahun_ajaran_id) {
            $query->where('tahun_ajaran_id', $tahun_ajaran_id);
        }, 'guruMatpel.mata_pelajaran'])->where('kelas_id', $kelas->id)->get();

        // $nilai_pengetahuan = NilaiSiswa::with(['detail_nilai' => function ($query) use ($id_siswa) {
        //     return $query->where('siswa_id', $id_siswa)->get();
        // }])->where('tipe_nilai', 'P')->where('kelas_id', $kelas->id)->where('tahun_ajaran_id', $tahun_ajaran->id)->get();
        // dd($guruMatpelKelas);
        $ratarata = [];
        $nilai_pengetahuan = [];
        $nilai_ketrampilan = [];
        foreach ($guruMatpelKelas as $index => $item) {
            $matpel_id = $item->guruMatpel->mata_pelajaran->id;
            $nilai_p = DetailNilai::where('siswa_id', $id_siswa)
                ->with(['nilai.kelas', 'nilai.guru_matpel.mata_pelajaran'])
                ->whereHas('nilai', function (Builder $query) {
                    $query->where('tipe_nilai', 'P');
                })
                ->whereHas('nilai.guru_matpel.mata_pelajaran', function (Builder $query) use ($matpel_id) {
                    $query->where('matpel_id', $matpel_id);
                })->get();
            $total = 0;
            $jml = 0;
            foreach ($nilai_p as $index2 => $item2) {
                $total += $item2->nilai_angka;
                $jml = ++$index2;
            }
            $nilai_pengetahuan[] = [
                'matpel_id' => $matpel_id,
                'matpel_nama' => $item->guruMatpel->mata_pelajaran->nama_matpel,
                'ratarata' => ($total / $jml)
            ];

            $nilai_k = DetailNilai::where('siswa_id', $id_siswa)
                ->with(['nilai.kelas', 'nilai.guru_matpel.mata_pelajaran'])
                ->whereHas('nilai', function (Builder $query) {
                    $query->where('tipe_nilai', 'K');
                })
                ->whereHas('nilai.guru_matpel.mata_pelajaran', function (Builder $query) use ($matpel_id) {
                    $query->where('matpel_id', $matpel_id);
                })->get();
            $total2 = 0;
            $jml2 = 0;
            foreach ($nilai_k as $index3 => $item3) {
                // dd($item2);
                $total2 += $item3->nilai_angka;
                $jml2 = ++$index3;
                // dd($jml2);
                // $nilai_ketrampilan[] = $item3;
            }
            // dd($total2/$jml2);
            // echo $jml2."<br>";
            if ($jml2 != 0) {
                $nilai_ketrampilan[] = [
                    'matpel_id' => $matpel_id,
                    'matpel_nama' => $item->guruMatpel->mata_pelajaran->nama_matpel,
                    'ratarata' => ($total2 / $jml2)
                ];
            } else {
                $nilai_ketrampilan[] = [
                    'matpel_id' => $matpel_id,
                    'matpel_nama' => $item->guruMatpel->mata_pelajaran->nama_matpel,
                    'ratarata' => 0
                ];
            }
        }

        // $matpel = ::all();
        // dd($nilai_ketrampilan);
        $tglNow = Carbon::now()->isoFormat('D MMMM Y');
        $guru = Guru::find(Auth::user()->guru->id);
        // $kepalaSekolah = TahunAjaran->where('')
        $pdf = PDF::loadView('pages.prints.nilai_raport', compact('siswa','guru','tglNow', 'nilai_pengetahuan', 'nilai_ketrampilan', 'catatan', 'prestasi', 'ketidakhadiran', 'nilai_sikap_spiritual', 'nilai_sikap_sosial', 'nilai_ekstra', 'tahun_ajaran', 'kelas'));
        return $pdf->stream('Nilai Raport.pdf');
    }

    public function cetak_leger(Request $request)
    {
        $kelas_id = $request->kelas_id;
        $tahun_ajaran_id = $request->tahun_ajaran_id;
        $kelas = Kelas::find($kelas_id);
        return Excel::download(new LegerExport($kelas_id,$tahun_ajaran_id), 'Leger_'.$kelas->kode_kelas.'.xlsx');
    }

}
