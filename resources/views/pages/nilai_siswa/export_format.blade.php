<table width="100%" border="1">
    <tr>
        <th colspan="1"><b>IMPORT DATA NILAI SISWA</b></th>
    </tr>
    <tr>
        <th colspan="1"><b>KELAS</b></th>
        {{-- <th>:</th> --}}
        <th>{{ ":".$kelas->nama_kelas }}</th>
    </tr>
    <tr>
        <th colspan="1"><b>MATA PELAJARAN</b></th>
        {{-- <th>:</th> --}}
        <th>{{ ":".$guru_matpel->mata_pelajaran->nama_matpel }}</th>
    </tr>
    <tr>
        <th colspan="1"><b>TIPE PENILAIAN</b></th>
        {{-- <th>:</th> --}}
        <th>{{ ":".$tipe_nilai }}</th>
    </tr>
    <tr>
        <th colspan="1"><b>JENIS PENILAIAN</b></th>
        {{-- <th>:</th> --}}
        <th>{{ ":".$jenis_nilai }}</th>
    </tr>
    <tr>
        <th colspan="1"><b>GURU</b></th>
        {{-- <th>:</th> --}}
        <th>{{ ":".$guru_matpel->guru->gelar_depan . ' ' . $guru_matpel->guru->nama . ', ' . $guru_matpel->guru->gelar_belakang }}</th>
    </tr>
</table>

<table>
    <tr style="background-color:#FF0000">
        <th style="text-align: center; vertical-align: middle;">NO</th>
        <th style="text-align: center; vertical-align: middle;">ID SISWA</th>
        <th style="text-align: center; vertical-align: middle;">NIS</th>
        <th style="text-align: center; vertical-align: middle;">NAMA</th>
        <th style="text-align: center; vertical-align: middle;">NILAI</th>
    </tr>
    @php ($no = 1)
    @foreach ($siswa as $index => $item)
        <tr style="background-color:#FF0000">
            <th style="text-align: center; vertical-align: middle;">{{ $no++ }}</th>
            <th style="text-align: center; vertical-align: middle;">{{ $item->siswa->id }}</th>
            <th style="text-align: center; vertical-align: middle;">{{ $item->siswa->nis }}</th>
            <th style="text-align: center; vertical-align: middle;">{{ strtoupper($item->siswa->nama_lengkap) }}</th>
            <th style="text-align: center; vertical-align: middle;">{{ !empty($nilai_siswa[$index]['siswa_id']) ? ($nilai_siswa[$index]['siswa_id'] == $item->siswa->id ? $nilai_siswa[$index]['nilai_angka'] : '0') : '0' }}</th>
        </tr>
    @endforeach
</table>

<p>* Catatan : Cukup Rubah Data Nilai Saja.</p>
