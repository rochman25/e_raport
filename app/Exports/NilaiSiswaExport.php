<?php

namespace App\Exports;

use App\Models\DetailNilai;
use App\Models\Ekstrakurikuler;
use App\Models\Kelas;
use App\Models\KompetensiDasar;
use App\Models\NilaiSiswa;
use App\Models\Pivot\GuruMatpel;
use App\Models\Pivot\KelasSiswa;
use App\Models\TahunAjaran;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class NilaiSiswaExport implements FromView
{
    /**
    * @return \Illuminate\Support\View
    */
    public function __construct(string $id,string $kelas_id, string $tipe_nilai,string $jenis_nilai, string $kd_id = null)
    {
        $this->id = $id;
        $this->kelas_id = $kelas_id;
        $this->tipe_nilai = $tipe_nilai;
        $this->jenis_nilai = $jenis_nilai;
        $this->kd_id = $kd_id;
    }

    public function view(): View
    {
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
        $kd_id = $this->kd_id;
        $kd = KompetensiDasar::find($kd_id);
        $nilai = NilaiSiswa::where('guru_matpel_id', $this->id)
            ->where('kelas_id', $this->kelas_id)
            ->where('tipe_nilai', $this->tipe_nilai)
            ->where('jenis_nilai', $this->jenis_nilai)
            ->when($kd_id, function ($query, $kd_id) {
                return $query->where('kd_id', $kd_id);
            })
            ->first();
        $idNilai = $nilai->id ?? null;
        $siswa = KelasSiswa::where('kelas_id', $this->kelas_id)->get();
        if ($idNilai == null) {
            $nilai_siswa = [];
            // $siswa = [];
            $dNilai = NilaiSiswa::latest()->first();
            $idNilai = $dNilai->id;
            $idNilai++;
        } else {
            $nilai_siswa = DetailNilai::when($idNilai, function ($query, $idNilai) {
                return $query->where('nilai_id', $idNilai);
            })->get()->toArray();
        }
        // dd($nilai_siswa);
        $kelas_id = $this->kelas_id;
        $kelas = Kelas::find($this->kelas_id);
        $jenis_penilaian = "";
        foreach($jnspenilaian as $item){
            if($item['id'] == $this->jenis_nilai){
                if($this->jenis_nilai == "kd"){
                    $jenis_penilaian = $item['val']."/".$kd->kode_kd;
                }else{
                    $jenis_penilaian = $item['val'];
                }
            }
        }
        $tipe_penilaian = "";
        $guru_matpel = GuruMatpel::find($this->id);
        if($this->tipe_nilai == "P"){
            $tipe_penilaian = "PENGETAHUAN";
        }else if($this->tipe_nilai == "K"){
            $tipe_penilaian = "KETRAMPILAN";
        }
        return view('pages.nilai_siswa.export_format', [
            'siswa' => $siswa,
            'kd_id' => $kd_id,
            'nilai' => $nilai,
            'nilai_siswa' => $nilai_siswa,
            'guru_matpel' => $guru_matpel,
            'kelas' => $kelas,
            'tipe_nilai' => $tipe_penilaian,
            'jenis_nilai' => $jenis_penilaian,
            'id_nilai' => $idNilai
        ]);
    }
}
