@extends('layouts.app')
@section('page')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-account-star"></i>
            </span> Ubah Pengguna
        </h3>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="card-title">Form Pengguna</h4>
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
                    <form class="forms-sample" action="{{ route('update.user',$user->id) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group @error('role_id') has-danger @enderror">
                                    <label for="role">Role</label>
                                    <select name="role_id" class="form-control" id="role">
                                        <option value="">-- Pilih Role --</option>
                                        @foreach ($roles as $item)
                                            <option value="{{ $item->id }}" @if($user->role[0]->id == $item->id) selected @endif>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('role_id')
                                        <label id="roleError" class="error mt-2 text-danger" for="name">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="form-group @error('username') has-danger @enderror">
                                    <label for="exampleInputUsername1">Username</label>
                                    <input type="text" name="username" class="form-control" id="exampleInputUsername1"
                                        placeholder="Username" value="{{ $user->username }}">
                                    @error('username')
                                        <label id="usernameError" class="error mt-2 text-danger"
                                            for="password">{{ $message }}</label>
                                    @enderror
                                </div>
                                {{-- <div class="form-group @error('password') has-danger @enderror">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                                        placeholder="Masukkan Password Pengguna">
                                    @error('password')
                                        <label id="usernameError" class="error mt-2 text-danger"
                                            for="password">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="form-group form-group @error('password') has-danger @enderror">
                                    <label for="exampleInputConfirmPassword1">Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="form-control"
                                        id="exampleInputConfirmPassword1" placeholder="Masukkan Password Pengguna kembali.">
                                    @error('password')
                                        <label id="usernameError" class="error mt-2 text-danger"
                                            for="password">{{ $message }}</label>
                                    @enderror
                                </div> --}}
                            </div>
                            <div class="col-md-6">
                                <div class="form-group @error('name') has-danger @enderror">
                                    <label for="name">Nama</label>
                                    <input type="text" name="name" class="form-control" id="name"
                                        placeholder="Masukkan Nama Pengguna" value="{{ $user->name }}">
                                    @error('name')
                                        <label id="nameError" class="error mt-2 text-danger" for="name">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="form-group @error('email') has-danger @enderror">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                        placeholder="Masukkan Email Pengguna" value="{{ $user->email }}">
                                    @error('email')
                                        <label id="nameError" class="error mt-2 text-danger" for="name">{{ $message }}</label>
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
