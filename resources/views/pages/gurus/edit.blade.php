@extends('layouts.app')
@section('page')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-account-star"></i>
            </span> Ubah Guru
        </h3>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="card-title">Form Guru</h4>
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
                    <form class="forms-sample" action="{{ route('update.guru',$guru->id) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group @error('nip') has-danger @enderror">
                                    <label for="exampleInputUsername1">NIP</label>
                                    <input type="text" name="nip" class="form-control" id="exampleInputUsername1"
                                        placeholder="Masukkan NIP Guru" value="{{ $guru->nip }}">
                                    @error('nip')
                                        <label id="usernameError" class="error mt-2 text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="form-group form-group @error('gelar_depan') has-danger @enderror">
                                    <label for="exampleInputConfirmPassword1">Gelar Depan</label>
                                    <input type="text" name="gelar_depan" class="form-control"
                                        id="exampleInputConfirmPassword1" value="{{ $guru->gelar_depan }}" placeholder="Masukkan Gelar Depan Guru.">
                                    @error('gelar_depan')
                                        <label id="usernameError" class="error mt-2 text-danger"
                                            for="password">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group @error('nama') has-danger @enderror">
                                    <label for="nama">Nama</label>
                                    <input type="text" name="nama" class="form-control" id="nama"
                                        placeholder="Masukkan Nama Guru" value="{{ $guru->nama }}">
                                    @error('nama')
                                        <label id="nameError" class="error mt-2 text-danger" for="nama">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="form-group form-group @error('gelar_belakang') has-danger @enderror">
                                    <label for="exampleInputConfirmPassword1">Gelar Belakang</label>
                                    <input type="text" name="gelar_belakang" class="form-control"
                                        id="exampleInputConfirmPassword1" value="{{ $guru->gelar_belakang }}" placeholder="Masukkan Gelar Belakang Guru.">
                                    @error('gelar_belakang')
                                        <label id="usernameError" class="error mt-2 text-danger"
                                            for="password">{{ $message }}</label>
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
