<table width="100%" border="1">
    <thead>
        <tr>
            <th colspan="4"><b>SMP NEGERI 3 KESUGIHAN</b></th>
        </tr>
        <tr>
            <th colspan="4"><b>LEGER NILAI SISWA KELAS {{ $kelas->nama_kelas }}</b></th>
        </tr>
        <tr>
            <th colspan="4"><b>TAHUN AJARAN : {{ $tahun_ajaran->tahun }}</b></th>
        </tr>
        <tr style="background-color:#FF0000">
            <th style="text-align: center; vertical-align: middle;" rowspan="4">NO</th>
            <th style="text-align: center; vertical-align: middle;" rowspan="4">NIS</th>
            <th style="text-align: center; vertical-align: middle;" rowspan="4">NAMA</th>
            <th style="text-align: center;" colspan="{{ count($mata_pelajaran) * 4 + 4 }}">NILAI MATA PELAJARAN</th>
            <th style="text-align: center; vertical-align: middle;" rowspan="3" colspan="3">KETIDAKHADIRAN</th>
            <th style="text-align: center; vertical-align: middle;" rowspan="2" colspan="4">EKSTRA KURIKULER</th>
        </tr>
        <tr>
            @foreach ($mata_pelajaran as $item)
                <th style="text-align: center; vertical-align: middle;" colspan="4">
                    {{ $item->guruMatpel->mata_pelajaran->nama_matpel }}</th>
            @endforeach
            <th style="text-align: center; vertical-align: middle;" colspan="4">Rata - Rata</th>
        </tr>
        <tr>
            @foreach ($mata_pelajaran as $item)
                <th style="text-align: center; vertical-align: middle;" colspan="2">Pengetahuan</th>
                <th style="text-align: center; vertical-align: middle;" colspan="2">Ketrampilan</th>
            @endforeach
            <th style="text-align: center; vertical-align: middle;" colspan="2">Pengetahuan</th>
            <th style="text-align: center; vertical-align: middle;" colspan="2">Ketrampilan</th>
            <th style="text-align: center; vertical-align: middle;" colspan="4">Ekskul 1</th>
        </tr>
        <tr>
            @for($i=0; $i<((count($mata_pelajaran)*2)+2); $i++) <th style="text-align: center; vertical-align: middle;">
                Nilai</th>
                <th style="text-align: center; vertical-align: middle;">Predikat</th>
                @endfor
                <th style="text-align: center; vertical-align: middle;">S</th>
                <th style="text-align: center; vertical-align: middle;">I</th>
                <th style="text-align: center; vertical-align: middle;">A</th>
                <th style="text-align: center; vertical-align: middle;" colspan="2">Ekskul</th>
                <th style="text-align: center; vertical-align: middle;" colspan="2">Nilai</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($nilai_siswa as $item)
            <tr>
                <td style="text-align: center;">{{ $item['no'] }}</td>
                <td style="text-align: center;">{{ $item['nis'] }}</td>
                <td width="50px" style="text-align: center;">{{ $item['nama'] }}</td>
                @php
                    $jml = 0;
                    $total_p = 0;
                    $total_k = 0;
                @endphp
                @foreach ($item['nilai_p'] as $index_p => $item_p)
                    <td style="text-align: center;">{{ $item_p['nilai_angka'] }}</td>
                    <td style="text-align: center;">{{ $item_p['predikat'] }}</td>
                    <td style="text-align: center;">{{ $item['nilai_k'][$index_p]['nilai_angka'] }}</td>
                    <td style="text-align: center;">{{ $item['nilai_k'][$index_p]['predikat'] }}</td>
                    @php
                        $jml++;
                        $total_p += $item_p['nilai_angka'];
                        $total_k += $item['nilai_k'][$index_p]['nilai_angka'];
                    @endphp
                @endforeach
                <td style="text-align: center;">{{ $total_p / $jml }}</td>
                <td style="text-align: center;">
                    @if (($total_p / $jml) > 88)
                        {{ 'A' }}
                    @elseif(($total_p / $jml) >= 78)
                        {{ 'B' }}
                    @else
                        {{ 'C' }}
                    @endif
                </td>
                <td style="text-align: center;">{{ $total_k / $jml }}</td>
                <td style="text-align: center;">
                    @if (($total_k / $jml) > 88)
                        {{ 'A' }}
                    @elseif(($total_k / $jml) >= 78)
                        {{ 'B' }}
                    @else
                        {{ 'C' }}
                    @endif
                </td>
                <td style="text-align: center;">{{ $item['nilai_absent']['sakit'] ?? "" }}</td>
                <td style="text-align: center;">{{ $item['nilai_absent']['izin'] ?? "" }}</td>
                <td style="text-align: center;">{{ $item['nilai_absent']['alpha'] ?? "" }}</td>
                <td style="text-align: center;" colspan="2">{{ $item['nilai_ekskul']['ekskul'] ?? "" }}</td>
                <td style="text-align: center;" colspan="2">{{ $item['nilai_ekskul']['nilai'] ?? "" }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
