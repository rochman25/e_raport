<!DOCTYPE html>
<html>
<head>
    <title>Rekap Nilai Siswa</title>
    <style>
        @page {
            margin: 25px 25px;
        }
        .table,
        .table td,
        .table th {
            border: 1px solid black;
            padding: 5px 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        footer {
            position: fixed;
            bottom: 0px;
            left: 0px;
            right: 0px;
            height: 50px;
        }
    </style>
</head>
<body>
    <header>
        <table style="border:0px;padding:5px 20px;width:auto">
            <tr>
                <td>Guru </td>
                <td> : </td>
                <td>{{ " ".$guru_matpel->guru->gelar_depan . ' ' . $guru_matpel->guru->nama . ', ' . $guru_matpel->guru->gelar_belakang }}</td>
            </tr>
            <tr>
                <td>Mata Pelajaran </td>
                <td> : </td>
                <td>{{ " ".$guru_matpel->mata_pelajaran->nama_matpel}}</td>
            </tr>
            <tr>
                <td>Kelas</td>
                <td>:</td>
                <td>{{ " ".$kelas->nama_kelas }}</td>
            </tr>
            <tr>
                <td>Tahun Ajaran</td>
                <td>:</td>
                <td>{{ " ".$guru_matpel->tahun_ajaran->tahun }}</td>
            </tr>
        </table>
    </header>
    <center><h3 style="padding:5px 20px;">Rekap Nilai {{ $jnspenilaian[array_search(request()->get('jenis_nilai'), array_column($jnspenilaian, 'id'))]['val'] }} Siswa</h3></center>
    <table class='table table-bordered' width="100%">
        <tr>
            <th>No</th>
            <th>NIS</th>
            <th>Nama Siswa</th>
            <th>Nilai</th>
        </tr>
        @php ($no=1)
        @foreach ($siswa as $index => $item)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item->siswa->nis }}</td>
                <td>{{ strtoupper($item->siswa->nama_lengkap) }}</td>
                <td>{{ !empty($nilai_siswa) ? ($nilai_siswa[$index]['siswa_id'] == $item->siswa->id ? $nilai_siswa[$index]['nilai_angka'] : '0') : '0' }}</td>
            </tr>
        @endforeach
    </table>
    <footer>
        <p><i>Generate Tanggal : {{ date('m/d/Y H:i:s') }} @ {{ config('app.name', 'E - Raport') }} </i></p>
    </footer>
</body>
</html>
