@extends('layouts.app')
@push('styles')
    {{--
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/dualistbox/src/bootstrap-duallistbox.css') }}">
@endpush
@section('page')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="card-title">Form Pengaturan Kelas</h4>
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
                        <form class="forms-sample" action="{{ route('insert.setup_kelas') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="form-group @error('kelas_id') has-danger @enderror">
                                        <label for="exampleInputUsername1">Kelas</label>
                                        <select id="kelas_id" name="kelas_id" class="form-control">
                                            <option value="">-- Pilih Kelas --</option>
                                            @foreach ($kelas as $item)
                                                <option value="{{ $item->id }}" @if(request()->get('kelas_id') == $item->id) selected @endif>
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
                                                <option value="{{ $item->id }}" @if(request()->get('tahun_ajaran_id') == $item->id) selected @endif>
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
                            <div class="row" style="margin-top:20px">
                                <div class="col">
                                    <div class="form-group">
                                        <select name="siswa_id[]" multiple="multiple" class="duallistbox-multi-selection">
                                            @foreach ($siswa as $item)
                                                <option value="{{ $item->id }}">{{ $item->nis . " " . $item->nama_lengkap }}</option>
                                            @endforeach
                                        </select>
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
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('assets/vendors/dualistbox/dist/jquery.bootstrap-duallistbox.min.js') }}"></script>
    <script type="text/javascript">
        (function(window, document, $) {
            'use strict';
            var kelas = $('#kelas_id option:selected').text();
            var tahun = $('#tahun_ajaran_id option:selected').text()

            $('#kelas_id').on('change',function(e) {
                kelas = $(this).text();
                $('.dualisbox-multi-selection').bootstrapDualListbox('refresh')
            })

            // Multi selection Dual Listbox
            $('.duallistbox-multi-selection').bootstrapDualListbox({
                nonSelectedListLabel: 'Data Siswa',
                selectedListLabel: 'Data Siswa yang masuk Kelas',
                preserveSelectionOnMove: 'moved',
                moveOnSelect: false,
                iconsPrefix: 'mdi',
                iconMove: '>',
                iconRemove: '<'
            });
        })(window, document, jQuery);

    </script>
@endpush
