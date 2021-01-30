<html>

<head>
    <title>Nilai Raport</title>
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
            text-align: center
        }

        h5.subtitle {
            text-align: justify;
            margin-top: 80px;

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
    <div class='header'>
        <table width="100%">
            <tr>
                <td>Nama Sekolah</td>
                <td>:</td>
                <td>SMP NEGERI 3 KESUGIHAN</td>
                <td>Kelas</td>
                <td>:</td>
                <td>{{ $kelas->nama_kelas }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td>Jl. Raya Kuripan-Kuripan Kec. Kesugihan</td>
                <td>Tahun Ajaran</td>
                <td>:</td>
                <td>{{ $tahun_ajaran->tahun }}</td>
            </tr>
            <tr>
                <td>Nama Peserta Didik</td>
                <td>:</td>
                <td>{{ strtoupper($siswa->nama_lengkap) }}</td>
            </tr>
            <tr>
                <td>Nomor Induk/NISN</td>
                <td>:</td>
                <td>{{ strtoupper($siswa->nis) }}</td>
            </tr>
        </table>
        <hr>
    </div>
    <div class='footer'>
        <b style="font-size: 8px"><i>RAPOR - {{ strtoupper($siswa->nama_lengkap) }}</i></b>
    </div>

    <div class="content">

        <h4 class="title">PENCAPAIAN KOMPETENSI PESERTA DIDIK</h4>
        <h5>A. SIKAP</h5>
        <h5>1. Sikap Spiritual</h5>
        <table class="table" width="100%" border="1px">
            <tr>
                <th width="25%">Predikat</th>
                <th width="75%">Deskripsi</th>
            </tr>
            <tr>
                <td>
                    @if ($nilai_sikap_spiritual)
                        <p style="text-align: center">{{ $nilai_sikap_spiritual->predikat }}</p>
                    @else
                        <h1>&nbsp;</h1>
                    @endif
                </td>
                <td>
                    @if ($nilai_sikap_spiritual)
                        <p style="text-align: justify;margin:10px">{{ $nilai_sikap_spiritual->deskripsi }}</p>
                    @else
                        <h1>&nbsp;</h1>
                    @endif
                </td>
            </tr>
        </table>
        <h5>2. Sikap Sosial</h5>
        <table class="table" width="100%" border="1px">
            <tr>
                <th width="25%">Predikat</th>
                <th width="75%">Deskripsi</th>
            </tr>
            <tr>
                <td>
                    @if ($nilai_sikap_sosial)
                        <p style="text-align: center">{{ $nilai_sikap_sosial->predikat }}</p>
                    @else
                        <h1>&nbsp;</h1>
                    @endif
                </td>
                <td>
                    @if ($nilai_sikap_sosial)
                        <p style="text-align: justify;margin:10px">{{ $nilai_sikap_sosial->deskripsi }}</p>
                    @else
                        <h1>&nbsp;</h1>
                    @endif
                </td>
            </tr>
        </table>
        <p></p>
        <h5 class="subtitle">B. PENGETAHUAN DAN KETERAMPILAN</h5>
        <table class="table" width="100%" border="1px">
            <tr>
                <th width="5%" style="border-bottom:0px">No</th>
                <th width="55%" style="border-bottom:0px">Mata Pelajaran</th>
                <th colspan="2">Pengetahuan</th>
            </tr>
            <tr>
                <th style="border-top: 0px"></th>
                <th style="border-top: 0px"></th>
                <th width="15%">Nilai</th>
                <th width="15%">Predikat</th>
            </tr>
            @if ($nilai_pengetahuan)
                @foreach ($nilai_pengetahuan as $index => $item)
                    <tr>
                        <td>
                            <p style="text-align: center;margin:5px">{{ ++$index . '.' }}</p>
                        </td>
                        <td>
                            <p style="text-align: center;margin:5px">{{ $item['matpel_nama'] }}</p>
                        </td>
                        <td>
                            <p style="text-align: center;margin:5px">{{ $item['ratarata'] }}</p>
                        </td>
                        <td>
                            <p style="text-align: center;margin:5px">
                                @if ($item['ratarata'] > 88)
                                    {{ 'A' }}
                                @elseif($item['ratarata'] >= 78)
                                    {{ 'B' }}
                                @else
                                    {{ 'C' }}
                                @endif
                            </p>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td>
                        <h1>&nbsp;</h1>
                    </td>
                    <td>
                        <h1>&nbsp;</h1>
                    </td>
                    <td>
                        <h1>&nbsp;</h1>
                    </td>
                    <td>
                        <h1>&nbsp;</h1>
                    </td>
                </tr>
            @endif
        </table>
        <p class="page"></p>
        <h5 class="subtitle"></h5>
        <table class="table" width="100%" border="1px">
            <tr>
                <th width="5%" style="border-bottom:0px">No</th>
                <th width="55%" style="border-bottom:0px">Mata Pelajaran</th>
                <th colspan="2">Ketrampilan</th>
            </tr>
            <tr>
                <th style="border-top: 0px"></th>
                <th style="border-top: 0px"></th>
                <th width="15%">Nilai</th>
                <th width="15%">Predikat</th>
            </tr>
            @if ($nilai_ketrampilan)
                @foreach ($nilai_ketrampilan as $index => $item)
                    <tr>
                        <td>
                            <p style="text-align: center;margin:5px">{{ ++$index . '.' }}</p>
                        </td>
                        <td>
                            <p style="text-align: center;margin:5px">{{ $item['matpel_nama'] }}</p>
                        </td>
                        <td>
                            <p style="text-align: center;margin:5px">{{ $item['ratarata'] }}</p>
                        </td>
                        <td>
                            <p style="text-align: center;margin:5px">
                                @if ($item['ratarata'] > 88)
                                    {{ 'A' }}
                                @elseif($item['ratarata'] >= 78)
                                    {{ 'B' }}
                                @else
                                    {{ 'C' }}
                                @endif
                            </p>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td>
                        <h1>&nbsp;</h1>
                    </td>
                    <td>
                        <h1>&nbsp;</h1>
                    </td>
                    <td>
                        <h1>&nbsp;</h1>
                    </td>
                    <td>
                        <h1>&nbsp;</h1>
                    </td>
                </tr>
            @endif
        </table>
        <p class="page"></p>
        <h5 class="subtitle">C. EKSTRAKURIKULER</h5>
        <table class="table" width="100%" border="1px">
            <tr>
                <th width="5%">No</th>
                <th width="35%">Kegiatan Ekstrakurikuler</th>
                <th width="15%">Predikat</th>
                <th width="45%">Keterangan</th>
            </tr>
            @if ($nilai_ekstra)
                @foreach ($nilai_ekstra as $index => $item)
                    <tr>
                        <td>
                            <p style="text-align: center;margin:5px">{{ ++$index . '.' }}</p>
                        </td>
                        <td>
                            <p style="text-align: center;margin:5px">{{ $item->ekstra->nama_ekstra }}</p>
                        </td>
                        <td>
                            <p style="text-align: center;margin:5px">{{ $item->detail_nilai[0]['nilai_huruf'] }}</p>
                        </td>
                        <td>
                            <p style="text-align: justify;margin:5px">{{ $item->detail_nilai[0]['deskripsi'] }}</p>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td>
                        <h1>&nbsp;</h1>
                    </td>
                    <td>
                        <h1>&nbsp;</h1>
                    </td>
                    <td>
                        <h1>&nbsp;</h1>
                    </td>
                    <td>
                        <h1>&nbsp;</h1>
                    </td>
                </tr>
            @endif
        </table>
        <h5>D. PRESTASI</h5>
        <table class="table" width="100%" border="1px">
            <tr>
                <th width="5%">No</th>
                <th width="40%">Jenis Kegiatan</th>
                <th width="55%">Keterangan</th>
            </tr>
            @if ($prestasi)
                @foreach ($prestasi as $index => $item)
                    <tr>
                        <td>
                            <p style="text-align: center;margin:5px">{{ ++$index . '.' }}</p>
                        </td>
                        <td>
                            <p style="text-align: center;margin:5px">{{ $item->jenis_kegiatan }}</p>
                        </td>
                        <td>
                            <p style="text-align: justify;margin:5px">{{ $item->keterangan }}</p>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td>
                        <h1>&nbsp;</h1>
                    </td>
                    <td>
                        <h1>&nbsp;</h1>
                    </td>
                    <td>
                        <h1>&nbsp;</h1>
                    </td>
                </tr>
            @endif
        </table>
        <h5>E. KETIDAKHADIRAN</h5>
        <table class="table" style="width:50%" width="50%" border="1px">
            <tr class="border_bottom">
                <td style="" width="40%">Sakit</td>
                <td style="">:</td>
                <td style="">
                    {{ !empty($ketidakhadiran) ? $ketidakhadiran->sakit : 0 }} hari
                </td>
            </tr>
            <tr class="border_bottom">
                <td style="border-right:0px" width="40%">Izin</td>
                <td style="border-right:0px">:</td>
                <td style="border-right:0px">
                    {{ !empty($ketidakhadiran) ? $ketidakhadiran->izin : 0 }} hari
                </td>
            </tr>
            <tr class="border_bottom">
                <td style="border-right:0px" width="40%">Tanpa Keterangan</td>
                <td style="border-right:0px">:</td>
                <td style="border-right:0px">
                    {{ !empty($ketidakhadiran) ? $ketidakhadiran->alpha : 0 }} hari
                </td>
            </tr>
        </table>
        <h5>F. CATATAN WALI KELAS</h5>
        <table class="table" style="width:100%" width="50%" border="1px">
            @if ($catatan)
                <tr class="border_bottom">
                    <td>
                        <p style="margin:10px; text-align: justify">{{ $catatan->catatan }}</p>
                    </td>
                </tr>
            @else
                <tr class="border_bottom">
                    <td>
                        <h6>&nbsp;</h6>
                    </td>
                </tr>
            @endif

        </table>
        <H5>G. TANGGAPAN ORANG TUA / WALI</H5>
        <table class="table" style="width:100%" width="50%" border="1px">
            <tr class="border_bottom">
                <td>
                    <h6>&nbsp;</h6>
                </td>
            </tr>
        </table>
        <p class="page"></p>
        <h5 class="subtitle"></h5>
        <table width="100%" style="margin-top:10px">
            <tr>
                <td width="70%">Mengetahui Orang Tua / Wali</td>
                <td style="text-align: left">Kesugihan , {{ $tglNow }}</td>
            </tr>
            <tr>
                <td></td>
                <td style="text-align: left">Wali Kelas,</td>
            </tr>
            <tr>
                <td>
                    <p>&nbsp;</p>
                </td>
                <td style="text-align: left"></td>
            </tr>
            <tr>
                <td>..............</td>
                <td style="text-align: left"><b><u>{{ !empty($guru->gelar_depan) ? $guru->gelar_depan. ". ":"".$guru->nama.", ".$guru->gelar_belakang }}</u></b></td>
            </tr>
            <tr>
                <td></td>
                <td style="text-align: left">{{ "NIP . ".$guru->nip }}</td>
            </tr>
        </table>
        <table width="100%">
            <tr>
                <td style="text-align: center">Mengetahui Kepala Sekolah</td>
            </tr>
            <tr>
                <td>
                    <p>&nbsp;</p>
                </td>
            </tr>
            <tr>
                <td style="text-align: center">
                    <b><u>{{ $tahun_ajaran->nama_ks }}</u></b>
                </td>
            </tr>
            <tr>
                <td style="text-align: center">
                    {{ "NIP . ".$tahun_ajaran->nip_ks }}
                </td>
            </tr>
        </table>

    </div>
    {{-- <script type="text/php">
        if ( isset($pdf) ) {
            $font = Font_Metrics::get_font("helvetica", "bold");
            $pdf->page_text(72, 18, "Header: {PAGE_NUM} of {PAGE_COUNT}", $font, 6, array(0,0,0));
        }
    </script> --}}
    {{-- <script type="text/php">
        if (isset($pdf)) {
                $text = "page {PAGE_NUM} / {PAGE_COUNT}";
                $size = 10;
                $font = $fontMetrics->getFont("Verdana");
                $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
                $x = ($pdf->get_width() - $width) / 2;
                $y = $pdf->get_height() - 35;
                $pdf->page_text($x, $y, $text, $font, $size);
            }
    </script> --}}
</body>

</html>
