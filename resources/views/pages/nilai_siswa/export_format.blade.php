<table width="100%" border="1">
    <tr>
        <th colspan="4"><b>IMPORT DATA NILAI SISWA</b></th>
    </tr>
    <tr>
        <th colspan="2"><b>KELAS</b></th>
        <th>:</th>
        <th width="50px">{{ $kelas->nama_kelas }}</th>
    </tr>
    <tr>
        <th colspan="2"><b>MATA PELAJARAN</b></th>
        <th>:</th>
        <th width="50px">{{ $nilai->guru_matpel->mata_pelajaran->nama_matpel }}</th>
    </tr>
    <tr>
        <th colspan="2"><b>TIPE PENILAIAN</b></th>
        <th>:</th>
        <th width="50px">{{ $tipe_nilai }}</th>
    </tr>
    <tr>
        <th colspan="2"><b>JENIS PENILAIAN</b></th>
        <th>:</th>
        <th width="50px">{{ $jenis_nilai }}</th>
    </tr>
    <tr>
        <th colspan="2"><b>GURU</b></th>
        <th>:</th>
        <th width="50px">{{ $nilai->guru_matpel->guru->gelar_depan . ' ' . $nilai->guru_matpel->guru->nama . ', ' . $nilai->guru_matpel->guru->gelar_belakang }}</th>
    </tr>
</table>

<table>
    <tr style="background-color:#FF0000">
        <th style="text-align: center; vertical-align: middle;">NO</th>
        <th style="text-align: center; vertical-align: middle;">NIS</th>
        <th style="text-align: center; vertical-align: middle;">NAMA</th>
        <th style="text-align: center; vertical-align: middle;">NILAI</th>
    </tr>
    @foreach ($siswa as $index => $item)
        <tr style="background-color:#FF0000">
            <th style="text-align: center; vertical-align: middle;">{{ ++$index }}</th>
            <th style="text-align: center; vertical-align: middle;">{{ $item->siswa->nis }}</th>
            <th style="text-align: center; vertical-align: middle;">{{ strtoupper($item->siswa->nama_lengkap) }}</th>
            <th style="text-align: center; vertical-align: middle;">{{ 0 }}</th>
        </tr>
    @endforeach
</table>

<p>* Catatan : Cukup Rubah Data Nilai Saja.</p>
