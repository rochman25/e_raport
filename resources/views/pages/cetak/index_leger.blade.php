@extends('layouts.app')
@section('page')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-note"></i>
            </span> Export Leger
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
                    <div class="row">
                        <div class="col">
                            <a href="{{ route('export.leger',['kelas_id'=>request()->get('kelas_id'),'tahun_ajaran_id'=>request()->get('tahun_ajaran_id')]) }}" class="btn btn-info btn-sm"><i class="mdi mdi-file-excel"></i> Export Leger</a>
                            {{-- <a href="" class="btn btn-info btn-sm"><i class="mdi mdi-printer"></i> Cetak Leger Absensi dan Ekstrakurikuler</a> --}}
                        </div>
                    </div>
                    
                    <table class="table table-hover mt-5">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIS</th>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Tahun Ajaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($siswa as $index => $item)
                                <tr>
                                    <td>{{ ++$index }}</td>
                                    <td>{{ $item['siswa']['nis'] }}</td>
                                    <td>{{ $item['siswa']['nama_lengkap'] }}</td>
                                    <td>{{ $walikelas->kelas->nama_kelas }}</td>
                                    <td>{{ $walikelas->tahun_ajaran->tahun }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" style="text-align: center"> -- Data Kosong -- </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col mt-5">
                            @if ($siswa)
                                {{ $siswa->links('vendor.pagination.custom') }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
