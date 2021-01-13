@extends('layouts.app')
@section('page')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="card-title">Form Penilaian</h4>
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
                        <form class="forms-sample" action="{{ route('insert.kompetensi_dasar') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="form-group @error('matpel_id') has-danger @enderror">
                                        <label for="exampleInputUsername1">Jenis Penilaian</label>
                                        <select id="matpel_id" name="matpel_id" class="form-control">
                                            <option value="">-- Pilih Jenis Penilaian --</option>
                                            @foreach ($jnspenilaian as $item)
                                                <option value="{{ $item['id'] }}">
                                            {{ $item['val'] }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('matpel_id')
                                            <label class="error mt-2 text-danger">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group @error('kd_id') has-danger @enderror">
                                        <label for="exampleInputUsername1">Kompetensi Dasar</label>
                                        <select id="matpel_id" name="matpel_id" class="form-control">
                                            <option value="">-- Pilih Kompetensi Dasar --</option>
                                            @foreach ($kds as $item)
                                                <option value="{{ $item->id }}" @if (request()->get('matpel_id') == $item->id) selected
                                            @endif>
                                                {{ $item->kode_kd }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('matpel_id')
                                            <label class="error mt-2 text-danger">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="submit" class="btn btn-gradient-primary mr-2" value="Simpan">
                                    <button type="reset" class="btn btn-light">Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
