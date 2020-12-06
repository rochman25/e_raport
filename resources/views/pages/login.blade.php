@extends('layouts.app_empty')
@section('page')
    <div class="row flex-grow">
        <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left p-5">
                <div class="brand-logo">
                    <img src="../../assets/images/logo.svg">
                </div>
                @error('loginError')
                    <div class="alert alert-danger" role="alert">
                        <i class="mdi mdi-alert-circle"></i> {{ $message }}
                    </div>
                @enderror
                <h4>Hello! Selamat Datang.</h4>
                <h6 class="font-weight-light">Silahkan masuk untuk melanjutkan.</h6>
                <form class="pt-3" action="{{ route('auth.login.action') }}" method="POST">
                    @csrf
                    <div class="form-group @error('username') has-danger @enderror">
                        <input type="text" name="username" class="form-control form-control-lg" id="exampleInputEmail1"
                            placeholder="Username">
                        @error('username')
                            <label id="firstname-error" class="error mt-2 text-danger" for="firstname">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="form-group @error('username') has-danger @enderror">
                        <input type="password" name="password" class="form-control form-control-lg"
                            id="exampleInputPassword1" placeholder="Password">
                        @error('password')
                            <label id="passworderror" class="error mt-2 text-danger" for="password">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn"
                            type="submit">Masuk</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
