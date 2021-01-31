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
                    <form class="forms-sample" action="{{ route('update.siswa',$siswa->id) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group @error('nis') has-danger @enderror">
                                    <label for="nis">NIS</label>
                                    <input type="text" name="nis" class="form-control" id="nis"
                                        placeholder="Masukkan NIS Siswa" value="{{ $siswa->nis }}">
                                    @error('nis')
                                        <label id="usernameError" class="error mt-2 text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group @error('nama_lengkap') has-danger @enderror">
                                    <label for="nama">Nama Lengkap</label>
                                    <input type="text" name="nama_lengkap" class="form-control" id="nama"
                                        placeholder="Masukkan Nama Siswa" value="{{ $siswa->nama_lengkap }}">
                                    @error('nama_lengkap')
                                        <label id="nameError" class="error mt-2 text-danger" for="nama">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form group @error('nama_panggilan') has-danger @enderror">
                                    <label for="nama_panggilan">Nama Panggilan</label>
                                    <input type="text" name="nama_panggilan" class="form-control" id="nama_panggilan"
                                        placeholder="Masukkan Nama Panggilan Siswa" value="{{ $siswa->nama_panggilan }}">
                                    @error('nama_panggilan')
                                        <label id="nameError" class="error mt-2 text-danger"
                                            for="nama_panggilan">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group @error('nama_lengkap') has-danger @enderror">
                                    <label for="nama">Jenis Kelamin</label>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="jk"
                                                        id="membershipRadios1" value="L" @if($siswa->jk == "L") checked @endif> Laki - Laki <i
                                                        class="input-helper"></i></label>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="jk"
                                                        id="membershipRadios2" value="P" @if($siswa->jk == "P") checked @endif> Perempuan <i
                                                        class="input-helper"></i></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group @error('pob') has-danger @enderror">
                                    <label for="pob">Tempat Lahir</label>
                                    <input type="text" name="pob" class="form-control" id="pob"
                                        placeholder="Masukkan Tempat Lahir Siswa" value="{{ $siswa->pob }}">
                                    @error('pob')
                                        <label id="usernameError" class="error mt-2 text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group @error('dob') has-danger @enderror">
                                    <label for="dob">Tanggal Lahir</label>
                                    <input type="date" name="dob" class="form-control" id="dob"
                                        placeholder="Masukkan Tanggal Lahir Siswa" value={{ $siswa->dob }}>
                                    @error('dob')
                                        <label id="nameError" class="error mt-2 text-danger" for="dob">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group @error('agama') has-danger @enderror">
                                    <label for="agama">Agama</label>
                                    <select name="agama" class="form-control">
                                        <option value="">-- Pilih Agama Siswa --</option>
                                        @foreach ($agama as $item)
                                            <option value="{{ $item }}" @if($siswa->agama == $item) selected @endif>{{ $item }}</option>
                                        @endforeach
                                    </select>
                                    @error('agama')
                                        <label id="usernameError" class="error mt-2 text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group @error('alamat') has-danger @enderror">
                                    <label for="alamat">Alamat</label>
                                    <textarea name="alamat" class="form-control" rows=4>{{ $siswa->alamat }}</textarea>
                                    @error('alamat')
                                        <label id="nameError" class="error mt-2 text-danger" for="alamat">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="card-title">Form Orang Tua</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form group @error('nama_ayah') has-danger @enderror">
                                    <label for="nama_ayah">Nama Ayah</label>
                                    <input type="text" name="nama_ayah" class="form-control" id="nama_ayah"
                                        placeholder="Masukkan Nama Ayah Siswa" value="{{ $siswa->nama_ayah }}">
                                    @error('nama_ayah')
                                        <label id="nameError" class="error mt-2 text-danger"
                                            for="nama_ayah">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form group @error('nama_ibu') has-danger @enderror">
                                    <label for="nama_ibu">Nama Ibu</label>
                                    <input type="text" name="nama_ibu" class="form-control" id="nama_ibu"
                                        placeholder="Masukkan Nama Ibu Siswa" value="{{ $siswa->nama_ibu }}">
                                    @error('nama_ibu')
                                        <label id="nameError" class="error mt-2 text-danger"
                                            for="nama_ibu">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="form group @error('pekerjaan_ayah') has-danger @enderror">
                                    <label for="pekerjaan_ayah">Pekerjaan Ayah</label>
                                    <input type="text" name="pekerjaan_ayah" class="form-control" id="pekerjaan_ayah"
                                        placeholder="Masukkan Nama Ayah Siswa" value="{{ $siswa->pekerjaan_ayah }}">
                                    @error('pekerjaan_ayah')
                                        <label id="nameError" class="error mt-2 text-danger"
                                            for="pekerjaan_ayah">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form group @error('pekerjaan_ibu') has-danger @enderror">
                                    <label for="pekerjaan_ibu">Pekerjaan Ibu</label>
                                    <input type="text" name="pekerjaan_ibu" class="form-control" id="pekerjaan_ibu"
                                        placeholder="Masukkan Pekerjaan Ibu Siswa" value="{{ $siswa->pekerjaan_ibu }}">
                                    @error('pekerjaan_ibu')
                                        <label id="nameError" class="error mt-2 text-danger"
                                            for="pekerjaan_ibu">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="form group @error('no_telphone_ortu') has-danger @enderror">
                                    <label for="no_telphone_ortu">No Telphone Orang Tua</label>
                                    <input type="text" name="no_telphone_ortu" class="form-control" id="no_telphone_ortu"
                                        placeholder="Masukkan Nomor Telphone Orang Tua Siswa" value="{{ $siswa->no_telphone_ortu }}">
                                    @error('no_telphone_ortu')
                                        <label id="nameError" class="error mt-2 text-danger"
                                            for="no_telphone_ortu">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form group @error('alamat_ortu') has-danger @enderror">
                                    <label for="alamat_ortu">Alamat Orang Tua</label>
                                    <textarea type="text" name="alamat_ortu" class="form-control" id="alamat_ortu"
                                        placeholder="Masukkan Alamat Orang Tua Siswa" rows=4>{{ $siswa->alamat_ortu }}</textarea>
                                    @error('alamat_ortu')
                                        <label id="nameError" class="error mt-2 text-danger"
                                            for="alamat_ortu">{{ $message }}</label>
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
