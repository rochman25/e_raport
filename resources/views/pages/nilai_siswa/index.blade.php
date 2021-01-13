@extends('layouts.app')
@section('page')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-account-star"></i>
            </span> Nilai Siswa
        </h3>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form action="" method="GET">
                        @csrf
                        <div class="row">
                            {{-- <div class="col-4">
                                <div class="form-group @error('kelas_id') has-danger @enderror">
                                    <label for="exampleInputUsername1">Kelas</label>
                                    <select name="kelas_id" class="form-control">
                                        <option value="">-- Pilih Kelas --</option>
                                        @foreach ($guruMatpel[0]->kelas as $item)
                                            <option value="{{ $item->id }}" @if (request()->get('kelas_id') == $item->id) selected
                                        @endif>
                                        {{ $item->nama_kelas }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('kelas_id')
                                        <label class="error mt-2 text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div> --}}
                            <div class="col-4">
                                <div class="col">
                                    <div class="form-group @error('matpel_id') has-danger @enderror">
                                        <label for="exampleInputUsername1">Mata Pelajaran</label>
                                        <select id="matpel_id" name="matpel_id" class="form-control">
                                            <option value="">-- Pilih Mata Pelajaran --</option>
                                            @foreach ($guruMatpel as $item)
                                                <option value="{{ $item->mata_pelajaran->id }}" @if (request()->get('matpel_id') == $item->id) selected
                                            @endif>
                                            {{ $item->mata_pelajaran->nama_matpel }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('matpel_id')
                                            <label class="error mt-2 text-danger">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group @error('tahun_ajaran_id') has-danger @enderror">
                                    <label for="exampleInputUsername1">Tahun Ajaran</label>
                                    <select name="tahun_ajaran_id" class="form-control">
                                        <option value="">-- Pilih Tahun Ajaran --</option>
                                        @foreach ($tahun_ajaran as $item)
                                            <option value="{{ $item->id }}" @if (request()->get('tahun_ajaran_id') == $item->id) selected
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
                            <h4 class="card-title">List Data Kelas</h4>
                        </div>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger mt-5">
                            <ul>
                                <li>Simpan data gagal.</li>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
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

                    <table class="table table-hover mt-5">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kelas</th>
                                <th>Mata Pelajaran</th>
                                <th>Tahun Ajaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($guruMatpel[0]->kelas as $index => $item)
                                <tr>
                                    <td>{{ ++$index }}</td>
                                    <td>{{ $item->kelas_->nama_kelas }}</td>
                                    <td>{{ $item->guruMatpel->mata_pelajaran->nama_matpel }}</td>
                                    <td>{{ $item->guruMatpel->tahun_ajaran->tahun }}</td>
                                    <td>
                                        <a
                                            href="{{ route('view.nilai_siswa.edit', $item->kelas_id) }}"
                                            class="btn btn-success btn-sm">Nilai</a>
                                        {{-- <button data-siswaid="{{ $item->id }}" data-kelasid="{{ $item->kelas_id }}"
                                            data-tahunajaranid={{ $item->tahun_ajaran_id }}
                                            class="btn btn-danger btn-sm btnHapus">hapus</button> --}}
                                    </td>
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
                            {{ $siswa->links('vendor.pagination.custom') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
