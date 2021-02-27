<?php

namespace App\Exports;

use App\Models\DetailNilai;
use App\Models\Ekstrakurikuler;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\NilaiAbsensi;
use App\Models\NilaiSiswa;
use App\Models\Pivot\GuruMatpelKelas;
use App\Models\Pivot\KelasSiswa;
use App\Models\TahunAjaran;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromView;

class LegerExport implements FromView
{

    public function __construct(string $kelas_id, string $tahun_ajaran_id)
    {
        $this->kelas_id = $kelas_id;
        $this->tahun_ajaran_id = $tahun_ajaran_id;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $tahun_ajaran_id = $this->tahun_ajaran_id;
        $kelas_id = $this->kelas_id;
        $nilai_p = DetailNilai::with(['nilai.kelas', 'nilai.guru_matpel.mata_pelajaran'])
            ->whereHas('nilai', function (Builder $query) {
                $query->where('tipe_nilai', 'P');
            })->get();
        $nilai_k = DetailNilai::with(['nilai.kelas', 'nilai.guru_matpel.mata_pelajaran'])
            ->whereHas('nilai', function (Builder $query) {
                $query->where('tipe_nilai', 'K');
            })->get();
        $ketidakhadiran = NilaiAbsensi::where('kelas_id', $kelas_id)->where('tahun_ajaran_id', $tahun_ajaran_id)->get();
        $nilai_ekstra = NilaiSiswa::with(['ekstra', 'detail_nilai'])->where('jenis_nilai', 'eks')->where('kelas_id', $kelas_id)->get();
        $siswa = KelasSiswa::with('siswa')->where('kelas_id', $kelas_id)->where('tahun_ajaran_id', $tahun_ajaran_id)->get();
        $mata_pelajaran = GuruMatpelKelas::with(['guruMatpel' => function ($query) use ($tahun_ajaran_id) {
            $query->where('tahun_ajaran_id', $tahun_ajaran_id);
        }, 'guruMatpel.mata_pelajaran'])->where('kelas_id', $kelas_id)->get();
        $nilai_siswa = [];
        foreach ($siswa as $index => $item) {
            $nilai_peng = [];
            $nilai_ket = [];
            $nilai_absent = [];
            $nilai_ekskul = [];
            foreach ($mata_pelajaran as $index_m => $item_m) {
                $nilai_ratarata_p = 0;
                $total_p = 0;
                $jml_p = 0;
                $nilai_ratarata_k = 0;
                $total_k = 0;
                $jml_k = 0;

                foreach ($nilai_p as $index_p => $item_p) {
                    if ($item_p->siswa_id == $item->siswa->id) {
                        if (!empty($item_p->nilai->guru_matpel->mata_pelajaran->id) && $item_p->nilai->guru_matpel->mata_pelajaran->id == $item_m->guruMatpel->mata_pelajaran->id) {
                            $total_p += $item_p->nilai_angka;
                            $jml_p++;
                        }
                    }
                }

                foreach ($nilai_k as $index_k => $item_k) {
                    if ($item_k->siswa_id == $item->siswa->id) {
                        if (!empty($item_k->nilai->guru_matpel->mata_pelajaran->id) && $item_k->nilai->guru_matpel->mata_pelajaran->id == $item_m->guruMatpel->mata_pelajaran->id) {
                            $total_k += $item_k->nilai_angka;
                            $jml_k++;
                        }
                    }
                }

                foreach($ketidakhadiran as $index_a => $item_a){
                    if ($item_a->siswa_id == $item->siswa->id) {
                        $nilai_absent = [
                            "izin" => $item_a->izin,
                            "sakit" => $item_a->sakit,
                            "alpha" => $item_a->alpha,
                        ];
                    }
                }

                foreach($nilai_ekstra as $index_e => $item_e){
                    foreach($item_e['detail_nilai'] as $index_ed => $item_ed){
                        if($item_ed->siswa_id == $item->siswa->id){
                            $nilai_ekskul = [
                                "ekskul" => $item_e->ekstra->nama_ekstra,
                                "nilai" => $item_ed->nilai_huruf
                            ];
                        }
                    }
                }

                if ($jml_p != 0) {
                    $nilai_ratarata_p = $total_p / $jml_p;
                } else {
                    $nilai_ratarata_p = 0;
                }

                if ($jml_k != 0) {
                    $nilai_ratarata_k = $total_k / $jml_k;
                } else {
                    $nilai_ratarata_k = 0;
                }
                if($nilai_ratarata_p > 88){
                    $predikat_p = "A";
                }else if($nilai_ratarata_p >= 78){
                    $predikat_p = "B";
                }else{
                    $predikat_p = "C";
                }
                $nilai_peng[] = [
                    "nama_matpel" => $item_m->guruMatpel->mata_pelajaran->nama_matpel,
                    "nilai_angka" => $nilai_ratarata_p,
                    "predikat" => $predikat_p
                ];
                if($nilai_ratarata_k > 88){
                    $predikat_ket = "A";
                }else if($nilai_ratarata_k >= 78){
                    $predikat_ket = "B";
                }else{
                    $predikat_ket = "C";
                }
                $nilai_ket[] = [
                    "nama_matpel" => $item_m->guruMatpel->mata_pelajaran->nama_matpel,
                    "nilai_angka" => $nilai_ratarata_k,
                    "predikat" => $predikat_ket
                ];
            }

            $nilai_siswa[] = [
                "no" => ++$index,
                "nis" => $item->siswa->nis,
                "nama" => $item->siswa->nama_lengkap,
                "nilai_p" => $nilai_peng,
                "nilai_k" => $nilai_ket,
                "nilai_absent" => $nilai_absent,
                "nilai_ekskul" => $nilai_ekskul
            ];
        }
        // dd($nilai_ekstra->toArray());
        // dd($ketidakhadiran->toArray());
        // dd($mata_pelajaran->toArray());
        // dd($nilai_p->toArray());
        // dd($nilai_siswa);
        return view('pages.prints.nilai_leger', [
            'kelas' => Kelas::find($this->kelas_id),
            'tahun_ajaran' => TahunAjaran::find($this->tahun_ajaran_id),
            'mata_pelajaran' => $mata_pelajaran,
            'ekstrakurikuler' => Ekstrakurikuler::all(),
            'nilai_siswa' => $nilai_siswa,
        ]);
    }
}
