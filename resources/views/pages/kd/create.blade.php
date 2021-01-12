@extends('layouts.app')
@section('page')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="card-title">Form Kompetensi Dasar</h4>
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
                                    <div class="form-group @error('kode_kd') has-danger @enderror">
                                        <label for="exampleInputUsername1">Kode Kompetensi Dasar</label>
                                        <input type="text" name="kode_kd" class="form-control">
                                        @error('kode_kd')
                                            <label class="error mt-2 text-danger">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group @error('matpel_id') has-danger @enderror">
                                        <label for="exampleInputUsername1">Mata Pelajaran</label>
                                        <select id="matpel_id" name="matpel_id" class="form-control">
                                            <option value="">-- Pilih Mata Pelajaran --</option>
                                            @foreach ($matpel as $item)
                                                <option value="{{ $item->id }}" @if (request()->get('matpel_id') == $item->id) selected
                                            @endif>
                                            {{ $item->nama_matpel }}
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
                                    <div class="form-group @error('kelas_id') has-danger @enderror">
                                        <label for="exampleInputUsername1">Kelas</label>
                                        <select id="kelas_id" name="kelas_id" class="form-control">
                                            <option value="">-- Pilih Kelas --</option>
                                            @foreach ($kelas as $item)
                                                <option value="{{ $item->id }}" @if (request()->get('kelas_id') == $item->id) selected
                                            @endif>
                                            {{ $item->nama_kelas }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('kelas_id')
                                            <label class="error mt-2 text-danger">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group @error('tahun_ajaran_id') has-danger @enderror">
                                        <label for="exampleInputUsername1">Tahun Ajaran</label>
                                        <select id="tahun_ajaran_id" name="tahun_ajaran_id" class="form-control">
                                            <option value="">-- Pilih Tahun Ajaran --</option>
                                            @foreach ($tahun_ajaran as $item)
                                                <option value="{{ $item->id }}" @if (request()->get('tahun_ajaran_id') == $item->id) selected
                                            @endif>
                                            {{ $item->tahun }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('tahun_ajaran_id')
                                            <label class="error mt-2 text-danger">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group @error('jenis_kd') has-danger @enderror">
                                        <label for="exampleInputUsername1">Jenis Kompetensi Dasar</label>
                                        <select id="jenis_kd" name="jenis_kd" class="form-control">
                                            <option value="">-- Pilih Jenis Kompetensi Dasar --</option>
                                            <option value="P">Pengetahuan</option>
                                            <option value="K">Keterampilan</option>
                                        </select>
                                        @error('jenis_kd')
                                            <label class="error mt-2 text-danger">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group @error('deskripsi') has-danger @enderror">
                                        <label for="deskripsi">Deskripsi</label>
                                        <textarea rows="5" class="form-control" name="deskripsi"></textarea>
                                        @error('deskripsi')
                                            <label class="error mt-2 text-danger">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
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
