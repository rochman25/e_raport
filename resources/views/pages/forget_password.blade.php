@extends('layouts.app_empty')
@section('page')
    <div class="row flex-grow">
        <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left p-5">
                <div class="brand-logo">
                    <center><img src="../../assets/images/logo.png"></center>
                </div>
                @error('error')
                    <div class="alert alert-danger" role="alert">
                        <i class="mdi mdi-alert-circle"></i> {{ $message }}
                    </div>
                @enderror
                <h4>Lupa Password.</h4>
                <h6 class="font-weight-light">Silahkan masukkan email anda.</h6>
                <form class="pt-3" action="{{ route('auth.forget.password.action') }}" method="POST">
                    @csrf
                    <input type="hidden" name="token" value="{{ request()->get('token') ?? "" }}">
                    <div class="form-group @error('email') has-danger @enderror">
                        <input type="email" name="email" class="form-control form-control-lg" id="exampleInputEmail1"
                            placeholder="Email">
                        @error('email')
                            <label id="firstname-error" class="error mt-2 text-danger" for="email">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn"
                            type="submit">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
