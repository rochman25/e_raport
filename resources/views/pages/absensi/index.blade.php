@extends('layouts.app')
@section('page')
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
                                            <option value="{{ $item->kelas['id'] }}" @if (request()->get('kelas_id') == $item->kelas['id'])
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
                                <div class="form-group @error('tahun_ajaran_id') has-danger @enderror">
                                    <label for="exampleInputUsername1">Tahun Ajaran</label>
                                    <select name="tahun_ajaran_id" class="form-control">
                                        <option value="">-- Pilih Tahun Ajaran --</option>
                                        @foreach ($tahun_ajaran as $item)
                                            <option value="{{ $item->id }}" @if (request()->get('tahun_ajaran_id') == $item->id)
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
                    <form action="{{ route('insert.absensi') }}" method="POST">
                        @csrf
                        <input type="hidden" name="kelas_id" value="{{ request()->get('kelas_id') }}">
                        <input type="hidden" name="tahun_ajaran_id" value="{{ request()->get('tahun_ajaran_id') }}">
                        <table class="table table-hover mt-5">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIS</th>
                                    <th>Nama Siswa</th>
                                    <th>Sakit</th>
                                    <th>Izin</th>
                                    <th>Alpha</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($no = 1)
                                    @forelse ($siswa as $index => $item)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item['siswa']['nis'] }}</td>
                                            <td>{{ $item['siswa']['nama_lengkap'] }}</td>
                                            <td>
                                                <input type="hidden" name="id_nilai_siswa[]"
                                                    value="{{ !empty($nilai_siswa[$index]['id']) ? $nilai_siswa[$index]['id'] : '' }}">
                                                <input type="hidden" name="siswa_id[]" value="{{ $item['siswa']['id'] }}">
                                                <input class="form-control" type="number" name="sakit[]" value="{{ !empty($nilai_siswa[$index]['id']) ? $nilai_siswa[$index]['siswa_id'] == $item['siswa']['id'] ? $nilai_siswa[$index]['sakit'] : '0' : '0' }}">
                                            </td>
                                            <td>
                                                <input class="form-control" type="number" name="izin[]" value="{{ !empty($nilai_siswa[$index]['id']) ? $nilai_siswa[$index]['siswa_id'] == $item['siswa']['id'] ? $nilai_siswa[$index]['izin'] : '0' : '0' }}">
                                            </td>
                                            <td>
                                                <input class="form-control" type="number" name="alpha[]" value="{{ !empty($nilai_siswa[$index]['id']) ? $nilai_siswa[$index]['siswa_id'] == $item['siswa']['id'] ? $nilai_siswa[$index]['alpha'] : '0' : '0' }}">
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
