@extends('layouts.app')
@section('page')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-account-star"></i>
            </span> Tambah Siswa
        </h3>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="card-title">Form Siswa</h4>
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
                    <form class="forms-sample" action="{{ route('insert.guru') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group @error('nis') has-danger @enderror">
                                    <label for="exampleInputUsername1">NIS</label>
                                    <input type="text" name="nis" class="form-control" id="exampleInputUsername1"
                                        placeholder="Masukkan NIP Siswa">
                                    @error('nis')
                                        <label id="usernameError" class="error mt-2 text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group @error('nama_lengkap') has-danger @enderror">
                                    <label for="nama">Nama Lengkap</label>
                                    <input type="text" name="nama_lengkap" class="form-control" id="nama"
                                        placeholder="Masukkan Nama Siswa">
                                    @error('nama')
                                        <label id="nameError" class="error mt-2 text-danger" for="nama">{{ $message }}</label>
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
