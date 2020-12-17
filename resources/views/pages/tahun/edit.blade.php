@extends('layouts.app')
@section('page')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-account-star"></i>
            </span> Ubah Tahun Ajaran
        </h3>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="card-title">Form Tahun Ajaran</h4>
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
                    <form class="forms-sample" action="{{ route('update.tahun',$tahun->id) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group @error('tahun') has-danger @enderror">
                                    <label for="exampleInputUsername1">Tahun Ajaran</label>
                                    <input type="text" name="tahun" class="form-control" id="exampleInputUsername1"
                                        placeholder="Masukkan Tahun Ajaran" value="{{ $tahun->tahun }}">
                                    @error('tahun')
                                        <label class="error mt-2 text-danger" for="exampleInputUsername1">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="form-group @error('semester') has-danger @enderror">
                                    <label for="exampleInputSemester">Semester</label>
                                    <input type="number" name="semester" class="form-control" id="exampleInputSemester"
                                        placeholder="Masukkan Semester" value="{{ $tahun->semester }}">
                                    @error('semester')
                                        <label class="error mt-2 text-danger" for="exampleInputSemester">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group @error('nip_ks') has-danger @enderror">
                                    <label for="nip_ks">NIP Kepala Sekolah</label>
                                    <input type="text" name="nip_ks" class="form-control" id="nip_ks"
                                        placeholder="Masukkan NIP Kepala Sekolah" value="{{ $tahun->nip_ks }}">
                                    @error('name')
                                        <label id="nameError" class="error mt-2 text-danger" for="name">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="form-group @error('nama_ks') has-danger @enderror">
                                    <label for="nama_ks">Nama Kepala Sekolah</label>
                                    <input type="text" name="nama_ks" class="form-control" id="nama_ks"
                                        placeholder="Masukkan Nama Kepala Sekolah" value="{{ $tahun->nama_ks }}">
                                    @error('nama_ks')
                                        <label class="error mt-2 text-danger" for="nama_ks">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="form-group @error('active') has-danger @enderror">
                                    <label for="exampleInputEmail1">Status</label>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="active"
                                                id="membershipRadios1" value="1" @if($tahun->active) checked="" @endif> Aktif <i
                                                class="input-helper"></i></label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="active"
                                                id="membershipRadios2" value="0" @if(!$tahun->active) checked="" @endif> Tidak Aktif <i
                                                class="input-helper"></i></label>
                                    </div>
                                    @error('active')
                                        <label class="error mt-2 text-danger">{{ $message }}</label>
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
