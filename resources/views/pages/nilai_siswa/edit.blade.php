@extends('layouts.app')
@section('page')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="card-title">Form Penilaian</h4>
                                @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible">
                                        <p>Simpan Data Gagal</p>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                @if ($message = Session::get('success'))
                                    <div class="alert bg-success alert-icon-left alert-dismissible mt-5" role="alert">
                                        <span class="alert-icon"><i class="fa fa fa-check"></i></span>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <form class="forms-sample" action="{{ route('update.nilai_siswa', $id) }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <input type="hidden" name="id_nilai" value="{{ $nilai->id ?? '' }}">
                                    <input type="hidden" name="kelas_id" value="{{ $kelas_id }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group @error('tipe_nilai') has-danger @enderror">
                                        <label for="exampleInputUsername1">Tipe Penilaian</label>
                                        <select id="tipe_nilai" name="tipe_nilai" class="form-control">
                                            <option value="">-- Pilih Tipe Penilaian --</option>
                                            <option value="P" @if (request()->get('tipe_nilai') == 'P') selected
                                                @endif>Pengetahuan</option>
                                            <option value="K" @if (request()->get('tipe_nilai') == 'K') selected
                                                @endif>Keterampilan</option>
                                        </select>
                                        @error('tipe_nilai')
                                            <label class="error mt-2 text-danger">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group @error('jenis_nilai') has-danger @enderror">
                                        <label for="exampleInputUsername1">Jenis Penilaian</label>
                                        <select id="jenis_nilai" name="jenis_nilai" class="form-control">
                                            <option value="">-- Pilih Jenis Penilaian --</option>
                                            @foreach ($jnspenilaian as $item)
                                                <option @if (request()->get('jenis_nilai') == $item['id'])
                                                    selected
                                            @endif value="{{ $item['id'] }}">
                                            {{ $item['val'] }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('jenis_nilai')
                                            <label class="error mt-2 text-danger">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="kd_id">
                                <div class="col">
                                    <div class="form-group @error('kd_id') has-danger @enderror">
                                        <label for="exampleInputUsername1">Kompetensi Dasar</label>
                                        <select id="kd_idd" name="kd_id" class="form-control">
                                            <option value="">-- Pilih Kompetensi Dasar --</option>
                                            @foreach ($kds as $item)
                                                <option value="{{ $item->id }}" @if (request()->get('kd_id') == $item->id) selected
                                            @endif>
                                            {{ $item->kode_kd." - ".$item->matpel->nama_matpel }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('kd_id')
                                            <label class="error mt-2 text-danger">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <a href="{{ route('print.nilai_siswa',[$id,'kelas' => $kelas_id,'tipe_nilai'=>request()->get('tipe_nilai'),'jenis_nilai'=>request()->get('jenis_nilai')]) }}" class="btn btn-success mx-1">Download PDF</a>
                                    <button type="button" id="cek-nilai" class="btn btn-info" style="float: right">Cek
                                        Nilai</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">NIS</th>
                                                <th scope="col">Nama Siswa</th>
                                                <th scope="col">Nilai</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (request()->tipe_nilai == null && request()->jenis_nilai == null)
                                                <tr>
                                                    <td colspan=5 class="text-center">-- Belum ada data nilai siswa, harap
                                                        pilih tipe penilaian dan jenis penilaian. --
                                                    </td>
                                                </tr>
                                            @else
                                                @php($no = 1)
                                                    @forelse ($siswa as $index => $item)
                                                        <tr>
                                                            <th scope="row">{{ $no++ }}</th>
                                                            <td>{{ $item->siswa->nis }}</td>
                                                            <td>{{ $item->siswa->nama_lengkap }}</td>
                                                            <td>
                                                                <input type="hidden" name="id_nilai_siswa[]"
                                                                    value="{{ !empty($nilai_siswa) ? $nilai_siswa[$index]['id'] : '' }}">
                                                                <input type="hidden" class="form-control" name="siswa_id[]"
                                                                    value="{{ $item->siswa->id }}">
                                                                <input type="number" class="form-control" name="nilai[]"
                                                                    value="{{ !empty($nilai_siswa) ? ($nilai_siswa[$index]['siswa_id'] == $item->siswa->id ? $nilai_siswa[$index]['nilai_angka'] : '0') : '0' }}">
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan=5 class="text-center">-- Belum ada data siswa di kelas ini.
                                                                --
                                                            </td>
                                                        </tr>
                                                @endforelse
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <input type="submit" class="btn btn-gradient-primary mr-2" value="Simpan">
                                        <button type="reset" class="btn btn-light">Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @push('scripts')
        <script type="text/javascript">
            $(document).ready(function() {
                var jenis_nilai = $("#jenis_nilai").val();
                var tipe_nilai = $("#tipe_nilai").val();
                var kd_id = $("#kd_idd").val();
                var cek = false;
                if(jenis_nilai == "kd"){
                    $('#kd_id').show()
                }else{
                    $('#kd_id').hide()
                }
                $('#jenis_nilai').change(function(e) {
                    jenis_nilai = $(this).val();
                    if (jenis_nilai == "kd") {
                        $('#kd_id').show()
                    } else {
                        $('#kd_id').val("")
                        $('#kd_id').hide();
                    }
                });
                $('#tipe_nilai').change(function(e) {
                    tipe_nilai = $(this).val();
                })
                $('#kd_idd').change(function(e){
                    kd_id = $(this).val()
                });
                $('#cek-nilai').click(function() {
                    if (tipe_nilai == "") {
                        cek = false
                        alert("Harap Pilih Tipe Nilai")
                    } else {
                        if (jenis_nilai == "") {
                            alert("Harap Pilih Jenis Nilai")
                            cek = false;
                        } else if (jenis_nilai == "kd") {
                            if (kd_id == "") {
                                cek = false;
                                alert("Harap Pilih Kompetensi Dasar")
                            } else {
                                cek = true
                            }
                        } else {
                            cek = true;
                        }
                    }

                    if (cek) {
                        var url = ""
                        if(kd_id == ""){
                            url = '{{ route("view.nilai_siswa.edit",[$id,"kelas" => $kelas_id,"tipe_nilai"=>":tipe_nilai","jenis_nilai"=>":jenis_nilai"]) }}';
                            url = url.replace('%3Atipe_nilai',tipe_nilai)
                            url = url.replace('%3Ajenis_nilai',jenis_nilai)
                            url = url.replace('amp;','')
                            url = url.replace('amp;','')
                        }else{
                            url = '{{ route("view.nilai_siswa.edit",[$id,"kelas" => $kelas_id,"tipe_nilai"=>":tipe_nilai","jenis_nilai"=>":jenis_nilai","kd_id"=>":kd_id"]) }}';
                            url = url.replace('%3Atipe_nilai',tipe_nilai)
                            url = url.replace('%3Ajenis_nilai',jenis_nilai)
                            url = url.replace('%3Akd_id',kd_id)
                            url = url.replace('amp;','')
                            url = url.replace('amp;','')
                            url = url.replace('amp;','')
                        }
                        // + "&tipe_nilai=" + tipe_nilai + "&jenis_nilai=" +
                        //     jenis_nilai;
                        // console.log(url)
                        // alert(url)
                        $(location).attr('href', url);
                    }

                });
            })

        </script>
    @endpush
