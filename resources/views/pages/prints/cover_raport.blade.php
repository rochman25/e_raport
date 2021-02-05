<html>

<head>
    <title>Cover Raport</title>
    <style>
        @page {
            margin: 100px 25px;
        }

        div.header {
            position: fixed;
            top: -60px;
            left: 0px;
            right: 0px;
            height: 50px;
            margin: 20px;
        }

        div.footer {
            position: fixed;
            bottom: -60px;
            left: 0px;
            right: 0px;
            height: 50px;
            margin: 20px;
        }

        div.content {
            margin-top: 80px;
            margin-left: 20px;
            margin-right: 20px;
        }

        h4.title {
            text-align: center;
            font-size: 25px;
        }

        h5.subtitle {
            text-align: center;
            margin-top: 80px;
            font-size: 20px;
        }

        .page {
            page-break-after: always;
        }

        .page:last-child {
            page-break-after: never;
        }

        .page-number:before {
            content: "Page "counter(page);
        }

        .table,
        .table td,
        .table th {
            border: 1px solid black;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        tr.border_bottom td {
            border-bottom: 1px solid black;
            border-right: 0px;
            border-left: 0px;
        }


        h1 {
            min-height: 300px;
        }

    </style>
</head>

<body>
    <div class='footer'>
        <b style="font-size: 13px"><i>| {{ strtoupper($siswa->nama_lengkap) . ' | ' . $siswa->nis }}</i></b>
    </div>
    <div class="content">
        <center>
            <img src="{{ public_path('assets/images/tut_wuri_handayani.png') }}" width="150px">
        </center>
        <h4 class="title">RAPOR<br>
            SEKOLAH MENENGAH PERTAMA<br>
            ( SMP )</h4>
        <h4 style="text-align: center;margin-bottom:1px; margin-top:100px">Nama Peserta Didik</h4>
        {{-- <center> --}}
        <table class="table" style="width:300px; margin-left: auto;
            margin-right: auto;" border="1px">
            <tr class="border_bottom">
                <td>
                    <p style="margin:10px; text-align: center; font-weight: bold">
                        {{ strtoupper($siswa->nama_lengkap) }}</p>
                </td>
            </tr>
        </table>

        <h4 style="text-align: center;margin-bottom:1px; margin-top:35px">NISN / NIS</h4>
        {{-- <center> --}}
        <table class="table" style="width:300px; margin-left: auto;
            margin-right: auto;" border="1px">
            <tr class="border_bottom">
                <td>
                    <p style="margin:10px; text-align: center; font-weight: bold">{{ strtoupper($siswa->nis) }}</p>
                </td>
            </tr>
        </table>
        <h4 class="title" style="margin-top:150px">KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN<br>
            REPUBLIK INDONESIA</h4>
        <p class="page"></p>
        <h5 class="subtitle">RAPOR<br>
            SEKOLAH MENENGAH PERTAMA<br>
            ( SMP )</h5>
        <table width="100%" style="margin:30px">
            <tr>
                <td width="25%">Nama Sekolah</td>
                <td width="5%">:</td>
                <td>SMP NEGERI 3 KESUGIHAN</td>
            </tr>
            <tr>
                <td width="25%">NPSN</td>
                <td width="5%">:</td>
                <td>20300533</td>
            </tr>
            <tr>
                <td width="25%">NIS/NSS/NDS</td>
                <td width="5%">:</td>
                <td>201030103182</td>
            </tr>
            <tr>
                <td width="25%">Alamat Sekolah</td>
                <td width="5%">:</td>
                <td>Jl. Raya Kuripan-Kuripan Kec. Kesugihan
                    Kode Pos : 53274, Telp. 02825071471</td>
            </tr>
            <tr>
                <td width="25%">Kelurahan / Desa</td>
                <td width="5%">:</td>
                <td>Kuripan</td>
            </tr>
            <tr>
                <td width="25%">Kecamatan</td>
                <td width="5%">:</td>
                <td>Kesugihan</td>
            </tr>
            <tr>
                <td width="25%">Kota / Kabupaten</td>
                <td width="5%">:</td>
                <td>Cilacap</td>
            </tr>
            <tr>
                <td width="25%">Provinsi</td>
                <td width="5%">:</td>
                <td>Prov. Jawa Tengah</td>
            </tr>
            <tr>
                <td width="25%">Website</td>
                <td width="5%">:</td>
                <td>http://www.smp3ksg.sch.id</td>
            </tr>
            <tr>
                <td width="25%">Email</td>
                <td width="5%">:</td>
                <td>smpnegeri3kesugihan@gmail.com</td>
            </tr>
        </table>
        <p class="page"></p>
        <h5 class="subtitle">PETUNJUK PENGISIAN</h5>
        <p style="text-align: justify; margin-top:50px;margin-left:10px; margin-right:10px;">Rapor merupakan ringkasan
            hasil penilaian terhadap seluruh aktivitas pembelajaran yang dilakukan
            peserta didik dalam kurun waktu tertentu. Rapor dipergunakan selama peserta didik yang bersangkutan
            mengikuti seluruh program pembelajaran di Sekolah Menengah Pertama tersebut. Berikut ini petunjuk
            untuk mengisi rapor:</p>
        <ol style="text-align: justify">
            <li>Identitas sekolah diisi dengan data yang sesuai dengan keberadaan Sekolah Menengah Pertama.</li>
            <li>Keterangan tentang diri peserta didik diisi lengkap.</li>
            <li>Rapor dilengkapi dengan pas foto peserta didik ukuran (3 x 4) cm berwarna.</li>
            <li>Deskripsi sikap spiritual dan sikap sosial diambil dari catatan (jurnal) perkembangan sikap peserta
                didik yang ditulis oleh guru mata pelajaran, guru BK, dan wali kelas.</li>
            <li>Capaian peserta didik dalam pengetahuan dan keterampilan ditulis dalam bentuk angka, predikat,
                dan deskripsi untuk masing-masing mata pelajaran.</li>
            <li>Laporan ekstrakurikuler diisi dengan nama dan nilai kegiatan ekstrakurikuler yang diikuti oleh
                peserta didik.</li>
            <li>Saran-saran diisi dengan hal-hal yang perlu mendapatkan perhatian peserta didik.</li>
            <li>Prestasi diisi dengan jenis prestasi peserta didik yang diraih dalam bidang akademik dan
                non-akademik.</li>
            <li>Ketidakhadiran ditulis dengan data akumulasi ketidakhadiran peserta didik karena sakit, izin, atau
                tanpa keterangan selama satu semester.</li>
            <li>Tanggapan orangtua/wali adalah tanggapan atas pencapaian hasil belajar peserta didik.</li>
            <li>Keterangan pindah keluar sekolah diisi dengan alasan kepindahan. Sedangkan pindah masuk diisi
                dengan sekolah asal.</li>
            <li>KKM (Kriteria Ketuntasan Minimal) diisi dengan nilai minimal pencapaian ketuntasan kompetensi
                belajar peserta didik yang ditetapkan oleh satuan pendidikan</li>
            <li>Nilai diisi dengan nilai pencapaian kompetensi belajar peserta didik.</li>
            <li>Predikat untuk aspek pengetahuan dan keterampilan diisi dengan huruf A, B, C, atau D sesuai
                panjang interval dan KKM yang sudah ditetapkan oleh satuan pendidikan.</li>
            <li>Predikat untuk aspek sikap diisi dengan Sangat Baik, Baik, Cukup, atau Kurang.</li>
            <li>Deskripsi diisi uraian tentang pencapaian kompetensi peserta didik.</li>
        </ol>
        <p class="page"></p>
        <h5 class="subtitle">KETERANGAN TENTANG DIRI PESERTA DIDIK</h5>

        <table width="100%" style="margin:30px">
            <tr>
                <td width="5%">1. </td>
                <td width="35%">Nama Peserta Didik (Lengkap)</td>
                <td width="5%">:</td>
                <td>{{ strtoupper($siswa->nama_lengkap) }}</td>
            </tr>
            <tr>
                <td width="5%">2. </td>
                <td width="35%">Nomor Induk/NISN</td>
                <td width="5%">:</td>
                <td>{{ $siswa->nis }}</td>
            </tr>
            <tr>
                <td width="5%">3. </td>
                <td width="35%">Tempat ,Tanggal Lahir</td>
                <td width="5%">:</td>
                <td>{{ $siswa->pob . ', ' . $tglLahir }}</td>
            </tr>
            <tr>
                <td width="5%">4. </td>
                <td width="35%">Jenis Kelamin</td>
                <td width="5%">:</td>
                <td>
                @if ($siswa->jk == 'L') {{ 'Laki - Laki' }} @else
                        {{ 'Perempuan' }} @endif
                </td>
            </tr>
            <tr>
                <td width="5%">5. </td>
                <td width="35%">Agama</td>
                <td width="5%">:</td>
                <td>{{ $siswa->agama }}</td>
            </tr>
            <tr>
                <td width="5%">6. </td>
                <td width="35%">Alamat Peserta Didik</td>
                <td width="5%">:</td>
                <td>{{ $siswa->alamat }}</td>
            </tr>
            <tr>
                <td width="5%">7. </td>
                <td width="35%">Nama Orang Tua</td>
                <td width="5%"></td>
                <td></td>
            </tr>
            <tr>
                <td width="5%"></td>
                <td width="35%">a. Ayah</td>
                <td width="5%">:</td>
                <td>{{ $siswa->nama_ayah }}</td>
            </tr>
            <tr>
                <td width="5%"></td>
                <td width="35%">b. Ibu</td>
                <td width="5%">:</td>
                <td>{{ $siswa->nama_ibu }}</td>
            </tr>
            <tr>
                <td width="5%">8. </td>
                <td width="35%">Alamat Orang Tua</td>
                <td width="5%">:</td>
                <td>{{ $siswa->alamat_ortu }}</td>
            </tr>
            <tr>
                <td width="5%"></td>
                <td width="35%">Nomor Telepon Orang Tua</td>
                <td width="5%">:</td>
                <td>{{ $siswa->no_telphone_ortu }}</td>
            </tr>
            <tr>
                <td width="5%">9. </td>
                <td width="35%">Pekerjaan Orang Tua</td>
                <td width="5%"></td>
                <td></td>
            </tr>
            <tr>
                <td width="5%"></td>
                <td width="35%">a. Ayah</td>
                <td width="5%">:</td>
                <td>{{ $siswa->pekerjaan_ayah }}</td>
            </tr>
            <tr>
                <td width="5%"></td>
                <td width="35%">b. Ibu</td>
                <td width="5%">:</td>
                <td>{{ $siswa->pekerjaan_ibu }}</td>
            </tr>
        </table>

        <table width="100%" style="margin-top:10px">
            <tr>
                <td width="70%"></td>
                <td style="text-align: left">Kesugihan , {{ $tglNow }}</td>
            </tr>
            <tr>
                <td width="70%"></td>
                <td style="text-align: left">Kepala Sekolah,</td>
            </tr>
            <tr>
                <td>
                    <p>&nbsp;</p>
                </td>
                <td style="text-align: left"></td>
            </tr>
            <tr>
                <td width="70%"></td>
                <td style="text-align: left"><b><u>{{ $tahun_ajaran->nama_ks }}</u></b></td>
            </tr>
            <tr>
                <td></td>
                <td style="text-align: left">{{ 'NIP . ' . $tahun_ajaran->nip_ks }}</td>
            </tr>
        </table>
        {{-- </center> --}}
    </div>
</body>

</html>
