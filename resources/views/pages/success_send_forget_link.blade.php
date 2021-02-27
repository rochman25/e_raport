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
                <h6 class="font-weight-light">Kami sudah mengirimkan link untuk mereset password anda, harap segera cek email Anda.</h6>
                
            </div>
        </div>
    </div>
@endsection
