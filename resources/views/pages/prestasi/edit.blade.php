@extends('layouts.app')
@section('page')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-trophy"></i>
            </span> Tambah Prestasi
        </h3>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="card-title">Form Prestasi</h4>
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible">
                                    <p>Simpan Data Gagal</p>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                    <form class="forms-sample" action="{{ route('update.prestasi',$prestasi->id) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form group @error('siswa_id') has-danger @enderror">
                                    <label for="siswa_id">Siswa</label>
                                    <select name="siswa_id" id="siswa_id" class="form-control">
                                        <option value="">-- Pilih Siswa --</option>
                                        @foreach ($siswa as $item)
                                            <option value="{{ $item->id }}" @if($prestasi->siswa_id == $item->id) selected @endif>{{ $item->nis . ' - ' . $item->nama_lengkap }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('siswa_id')
                                        <label id="nameError" class="error mt-2 text-danger"
                                            for="siswa_id">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group @error('jenis_kegiatan') has-danger @enderror">
                                    <label for="jenis_kegiatan">Jenis Kegiatan</label>
                                    <input type="text" name="jenis_kegiatan" class="form-control" id="jenis_kegiatan"
                                        placeholder="Masukkan Jenis Kegiatan" value="{{ $prestasi->jenis_kegiatan }}">
                                    @error('jenis_kegiatan')
                                        <label id="usernameError" class="error mt-2 text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group @error('keterangan') has-danger @enderror">
                                    <label for="keterangan">Keterangan</label>
                                    <textarea name="keterangan" class="form-control" rows=4>{{ $prestasi->keterangan }}</textarea>
                                    @error('keterangan')
                                        <label id="nameError" class="error mt-2 text-danger" for="keterangan">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-gradient-primary mr-2">Simpan</button>
                                <button type="reset" class="btn btn-light">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
