@extends('layouts.app')
@section('page')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-note"></i>
            </span> Ubah Catatan Walikelas
        </h3>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="card-title">Form Catatan Walikelas</h4>
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
                    <form class="forms-sample" action="{{ route('update.catatan',$catatan->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="kelas_id" value="{{ $catatan->kelas_id }}">
                        <input type="hidden" name="tahun_ajaran_id" value="{{ $catatan->tahun_ajaran_id }}">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form group @error('siswa_id') has-danger @enderror">
                                    <label for="siswa_id">Siswa</label>
                                    <select name="siswa_id" id="siswa_id" class="form-control">
                                        <option value="">-- Pilih Siswa --</option>
                                        @foreach ($siswa as $item)
                                            <option value="{{ $item->id }}" @if($catatan->siswa_id == $item->id) selected @endif>{{ $item->nis . ' - ' . $item->nama_lengkap }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('siswa_id')
                                        <label id="nameError" class="error mt-2 text-danger"
                                            for="siswa_id">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="form-group @error('catatan') has-danger @enderror">
                                    <label for="catatan">Catatan</label>
                                    <textarea name="catatan" class="form-control" rows=4>{{ $catatan->catatan }}</textarea>
                                    @error('catatan')
                                        <label id="nameError" class="error mt-2 text-danger" for="catatan">{{ $message }}</label>
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
