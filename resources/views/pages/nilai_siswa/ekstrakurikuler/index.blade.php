@extends('layouts.app')
@section('page')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-account-star"></i>
            </span> Nilai Ekstrakurikuler
        </h3>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form action="" method="GET">
                        @csrf
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group @error('kelas_id') has-danger @enderror">
                                    <label for="exampleInputUsername1">Kelas</label>
                                    <select name="kelas_id" class="form-control">
                                        <option value="">-- Pilih Kelas --</option>
                                        @foreach ($kelas as $item)
                                            <option value="{{ $item->kelas['id'] }}" @if (request()->get('kelas_id') == $item->kelas['id'] || $walikelas->kelas_id == $item->kelas['id'])
                                                selected
                                        @endif>
                                        {{ $item->kelas['nama_kelas'] }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('kelas_id')
                                        <label class="error mt-2 text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group @error('ekstra_id') has-danger @enderror">
                                    <label for="exampleInputUsername1">Ekstrakurikuler</label>
                                    <select name="ekstra_id" class="form-control">
                                        <option value="">-- Pilih Ekstrakurikuler --</option>
                                        @foreach ($ekstrakurikuler as $item)
                                            <option value="{{ $item->id }}" @if (request()->get('ekstra_id') == $item->id) selected
                                        @endif>
                                        {{ $item->nama_ekstra }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('ekstra_id')
                                        <label class="error mt-2 text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group @error('tahun_ajaran_id') has-danger @enderror">
                                    <label for="exampleInputUsername1">Tahun Ajaran</label>
                                    <select name="tahun_ajaran_id" class="form-control">
                                        <option value="">-- Pilih Tahun Ajaran --</option>
                                        @foreach ($tahun_ajaran as $item)
                                            <option value="{{ $item->id }}" @if (request()->get('tahun_ajaran_id') == $item->id || $walikelas->tahun_ajaran_id == $item->id)
                                                selected
                                        @endif>
                                        {{ $item->tahun }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('tahun_ajaran_id')
                                        <label class="error mt-2 text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="exampleInputUsername1"></label>
                                    <button
                                        class="btn btn-block btn-gradient-primary btn-md font-weight-medium auth-form-btn"
                                        type="submit">Cari</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="card-title">List Data Siswa</h4>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert bg-success alert-icon-left alert-dismissible mt-5" role="alert">
                            <span class="alert-icon"><i class="fa fa fa-check"></i></span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    <form action="{{ route('insert.ekstra_nilai') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_nilai" value="{{ $nilai->id ?? "" }}">
                        <input type="hidden" name="ekstra_id" value="{{ request()->get('ekstra_id') }}">
                        <input type="hidden" name="kelas_id" value="{{ request()->get('kelas_id') }}">
                        <input type="hidden" name="tahun_ajaran_id" value="{{ request()->get('tahun_ajaran_id') }}">
                        <table class="table table-hover mt-5">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIS</th>
                                    <th>Nama Siswa</th>
                                    <th width="20%">Nilai</th>
                                    <th>Deskripsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php ($no = 1)
                                @forelse ($siswa as $index => $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item['siswa']['nis'] }}</td>
                                        <td>{{ $item['siswa']['nama_lengkap'] }}</td>
                                        <td>
                                            <input type="hidden" name="id_nilai_siswa[]" value="{{ !empty($nilai_siswa) ? $nilai_siswa[$index]['id'] : "" }}">
                                            <input type="hidden" name="siswa_id[]" value="{{ $item['siswa']['id'] }}">
                                            <select name="nilai_huruf[]" class="form-control">
                                                <option value="Baik" @if($nilai_siswa && $nilai_siswa[$index]['siswa_id'] == $item['siswa']['id'] &&$nilai_siswa[$index]['nilai_huruf'] == "Baik") selected @endif>Baik</option>
                                                <option value="Sangat Baik" @if($nilai_siswa && $nilai_siswa[$index]['siswa_id'] == $item['siswa']['id'] && $nilai_siswa[$index]['nilai_huruf'] == "Sangat Baik") selected @endif>Sangat Baik</option>
                                                <option value="Cukup" @if($nilai_siswa && $nilai_siswa[$index]['siswa_id'] == $item['siswa']['id'] && $nilai_siswa[$index]['nilai_huruf'] == "Cukup") selected @endif>Cukup</option>
                                                <option value="Kurang" @if($nilai_siswa && $nilai_siswa[$index]['siswa_id'] == $item['siswa']['id'] && $nilai_siswa[$index]['nilai_huruf'] == "Kurang") selected @endif>Kurang</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" name="deskripsi[]" class="form-control" value="{{ $nilai_siswa[$index]['siswa_id'] == $item['siswa']['id'] ? $nilai_siswa[$index]['deskripsi'] : "" }}">
                                        </td>
                                    @empty
                                    <tr>
                                        <td colspan=" 7" style="text-align: center"> -- Data Kosong --
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
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
@endsection
