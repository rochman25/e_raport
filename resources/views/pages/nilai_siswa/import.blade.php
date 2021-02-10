@extends('layouts.app')
@section('page')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="card-title">Import Nilai Siswa</h4>
                                @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible">
                                        <p>Simpan Data Gagal</p>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                @if ($message = Session::get('success'))
                                    <div class="alert bg-success alert-icon-left alert-dismissible mt-5" role="alert">
                                        <span class="alert-icon"><i class="fa fa fa-check"></i></span>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <form class="forms-sample" action="{{ route('import.nilai_siswa', $id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="kelas_id" value="{{ request()->get('kelas_id') }}">
                            <input type="hidden" name="tipe_nilai" value="{{ request()->get('tipe_nilai') }}">
                            <input type="hidden" name="jenis_nilai" value="{{ request()->get('jenis_nilai') }}">
                            @if(request()->get('kd_id'))
                                <input type="hidden" name="kd_id" value="{{ request()->get('kd_id') }}">
                            @endif
                            <div class="row">
                                <div class="col">
                                    <div class="form-group @error('file') has-danger @enderror">
                                        <label for="file">File Nilai (excel)</label>
                                        <input type="file" name="file" class="form-control">
                                        @error('file')
                                            <label class="error mt-2 text-danger">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <button type="submit" id="cek-nilai" class="btn btn-info"><i class="mdi mdi-check"></i>
                                        Import</button>
                                    @if (request()->get('kd_id'))
                                        <a href="{{ route('view.nilai_siswa.import', [$id, 'kelas_id' => request()->get('kelas_id'), 'tipe_nilai' => request()->get('tipe_nilai'), 'jenis_nilai' => request()->get('jenis_nilai'),'kd_id' => request()->get('kd_id'),'format'=>'download']) }}"
                                            class="btn btn-success mx-1" style="float: right"><i
                                                class="mdi mdi-download"></i> Download Format</a>
                                    @else
                                        <a href="{{ route('view.nilai_siswa.import', [$id, 'kelas_id' => request()->get('kelas_id'), 'tipe_nilai' => request()->get('tipe_nilai'), 'jenis_nilai' => request()->get('jenis_nilai'),'format'=>'download']) }}"
                                            class="btn btn-success mx-1" style="float: right"><i
                                                class="mdi mdi-download"></i> Download Format</a>
                                    @endif
                                </div>
                            </div>
                        </form>

                        @if ($nilai_siswa)
                            <div class="row" style="margin-top:20px">
                                <div class="col">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">NIS</th>
                                                <th scope="col">Nama Siswa</th>
                                                <th scope="col">Nilai</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
