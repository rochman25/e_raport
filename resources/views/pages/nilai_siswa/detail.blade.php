@extends('layouts.app')
@section('page')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-account-star"></i>
            </span> Detail Nilai Siswa
        </h3>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row" style="margin-bottom:10px">
                        <div class="col">
                            <table class="table borderless">
                                <tr>
                                    <td style="padding:0px" width="10%">Nama Lengkap</td>
                                    <td width="2%">:</td>
                                    <td>{{ $siswa->nama_lengkap }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:0px" width="10%">NIS</td>
                                    <td width="2%">:</td>
                                    <td>{{ $siswa->nis }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    {{-- <div class="row">
                        <div class="col-2">
                            Nama Lengkap
                        </div>
                        <div class="col-1">
                            :
                        </div>
                        <div class="col-6">
                            {{ $siswa->nama_lengkap }}
                        </div>
                    </div> --}}
                    {{-- <div class="row" style="margin-bottom:10px">
                        <div class="col-2">
                            NIS
                        </div>
                        <div class="col-1">
                            :
                        </div>
                        <div class="col-6">
                            {{ $siswa->nis }}
                        </div>
                    </div> --}}
                    <form action="" method="GET">
                        @csrf
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group @error('kelas_id') has-danger @enderror">
                                    <label for="exampleInputUsername1">Kelas</label>
                                    <select name="kelas_id" class="form-control">
                                        <option value="">-- Pilih Kelas --</option>
                                        @foreach ($kelas as $item)
                                            <option value="{{ $item->kelas->id }}" @if (request()->get('kelas_id') == $item->kelas->id) selected @endif>
                                                {{ $item->kelas->nama_kelas }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('kelas_id')
                                        <label class="error mt-2 text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            {{-- <div class="col-4">
                            <div class="col">
                                <div class="form-group @error('matpel_id') has-danger @enderror">
                                    <label for="exampleInputUsername1">Mata Pelajaran</label>
                                    <select id="matpel_id" name="matpel_id" class="form-control">
                                        <option value="">-- Pilih Mata Pelajaran --</option>
                                        @foreach ($matpel as $item)
                                            <option value="{{ $item->guruMatpel->mata_pelajaran->id }}" @if (request()->get('matpel_id') == $item->guruMatpel->mata_pelajaran->id) selected
                                        @endif>
                                        {{ $item->guruMatpel->mata_pelajaran->nama_matpel }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('matpel_id')
                                        <label class="error mt-2 text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                        </div> --}}
                            {{-- <div class="col-4">
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
                        </div> --}}
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
                            <h4 class="card-title">List Data Nilai Siswa</h4>
                        </div>
                    </div>

                    <table class="table table-hover mt-5">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Mata Pelajaran</th>
                                <th>Kelas</th>
                                <th>UTS</th>
                                <th>UAS</th>
                                <th>Kompetensi Dasar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($matpel as $index => $item)
                                <tr>
                                    <td>{{ ++$index }}</td>
                                    <td>{{ $item->guruMatpel->mata_pelajaran->nama_matpel ?? '' }}</td>
                                    <td>{{ $item->kelas_->nama_kelas ?? '' }}</td>
                                    <td>{{ $item->uts }}</td>
                                    <td>{{ $item->uas }}</td>
                                    <td>{{ $item->kd }}</td>
                                    {{-- <td>{{ $item->tipe_nilai."/".$item->jenis_nilai }}</td> --}}
                                    {{-- <td>{{ $item_angka ?? "" }}</td> --}}
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" style="text-align: center"> -- Data Kosong -- </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{-- <div class="row">
                    <div class="col mt-5">
                        {{ $nilai_siswa->links('vendor.pagination.custom') }}
                    </div>
                </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
