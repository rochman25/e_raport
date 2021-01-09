@extends('layouts.app')
@section('page')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-account-star"></i>
            </span> Tambah Pengguna
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
                    <form class="forms-sample" action="{{ route('insert.user') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div id="formRole" class="form-group @error('role_id') has-danger @enderror">
                                    <label for="role">Role</label>
                                    <select name="role_id" class="form-control" id="role">
                                        <option value="">-- Pilih Role --</option>
                                        @foreach ($roles as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('role_id')
                                        <label id="roleError" class="error mt-2 text-danger" for="name">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="form-group @error('username') has-danger @enderror">
                                    <label for="exampleInputUsername1">Username</label>
                                    <input type="text" id="username" name="username" class="form-control"
                                        placeholder="Username">
                                    @error('username')
                                        <label id="usernameError" class="error mt-2 text-danger"
                                            for="password">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="form-group @error('password') has-danger @enderror">
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
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div id="formGuru" class="form-group @error('guru_id') has-danger @enderror">
                                    <label for="exampleInputUsername1">Guru</label>
                                    <select id="guruid" name="guru_id" class="form-control">
                                        <option value="">-- Pilih Guru --</option>
                                        @foreach ($guru as $item)
                                            <option value="{{ $item->id }}" data-nip="{{ $item->nip }}"
                                                data-nama="{{ $item->gelar_depan . ' ' . $item->nama . ' ' . $item->gelar_belakang }}">
                                                {{ $item->nip . ' ' . $item->gelar_depan . ' ' . $item->nama . ' ' . $item->gelar_belakang }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('guru_id')
                                        <label class="error mt-2 text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="form-group @error('name') has-danger @enderror">
                                    <label for="name">Nama</label>
                                    <input type="text" name="name" class="form-control" id="name"
                                        placeholder="Masukkan Nama Pengguna">
                                    @error('name')
                                        <label id="nameError" class="error mt-2 text-danger" for="name">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="form-group @error('email') has-danger @enderror">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                        placeholder="Masukkan Email Pengguna">
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
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#formGuru').css('display', 'none')
            $('#guruid').val("");
            $('#formRole').on('change', function() {
                var role = $('#formRole option:selected').text();
                if (role === "guru") {
                    $('#formGuru').css('display', 'block')
                } else {
                    $('#formGuru').css('display', 'none')
                    $('#guruid').val("");
                    $('#username').val("");
                    $('#username').attr('readonly', false);
                    $('#name').val("");
                }
            });
            $('#guruid').on('change', function() {
                $('#username').val($('#guruid option:selected').data('nip'))
                $('#username').attr('readonly', true);
                $('#name').val($('#guruid option:selected').data('nama'))
            });
        });

    </script>
@endpush
