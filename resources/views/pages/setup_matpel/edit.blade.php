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
                                <h4 class="card-title">Form Pengaturan Mata Pelajaran</h4>
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
                        <form class="forms-sample" action="{{ route('update.setup_matpel', $guru_matpel->id) }}"
                            method="POST">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="form-group @error('guru_id') has-danger @enderror">
                                        <label for="exampleInputUsername1">Guru</label>
                                        <select name="guru_id" class="form-control">
                                            @foreach ($guru as $item)
                                                <option value="{{ $item->id }}" @if ($guru_matpel->guru_id == $item->id) selected
                                            @endif>
                                            {{ $item->nip . ' ' . $item->gelar_depan . ' ' . $item->nama . ' ' . $item->gelar_belakang }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('guru_id')
                                            <label class="error mt-2 text-danger">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group @error('matpel_id') has-danger @enderror">
                                        <label for="exampleInputUsername1">Mata Pelajaran</label>
                                        <select name="matpel_id" class="form-control">
                                            @foreach ($matpel as $item)
                                                <option value="{{ $item->id }}" @if ($guru_matpel->matpel_id == $item->id) selected
                                            @endif>
                                            {{ $item->kode_matpel . ' ' . $item->nama_matpel }}
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
                                    <div class="form-group @error('tahun_ajaran_id') has-danger @enderror">
                                        <label for="exampleInputUsername1">Tahun Ajaran</label>
                                        <select name="tahun_ajaran_id" class="form-control">
                                            {{-- <option value="">-- Pilih Tahun Ajaran --
                                            </option> --}}
                                            @foreach ($tahun_ajaran as $item)
                                                <option value="{{ $item->id }}" @if ($guru_matpel->tahun_ajaran_id == $item->id) selected
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
                            <div class="row" style="margin-top:20px">
                                <div class="col">
                                    <div class="form-group">
                                        <select name="kelas_id[]" multiple="multiple" class="duallistbox-multi-selection">
                                            @php($x = '')
                                                @foreach ($kelas as $item)
                                                    @foreach ($guru_matpel->kelas as $item2)
                                                        @if ($item2->kelas_id == $item->id)
                                                            @php($x = 1)
                                                        @endif
                                                    @endforeach
                                                    @if ($x == 1)
                                                        <option value="{{ $item->id }}" selected>{{ $item->nama_kelas }}</option>
                                                    @else
                                                        <option value="{{ $item->id }}">{{ $item->nama_kelas }}</option>
                                                    @endif
                                                    @php($x = '')
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
                // Multi selection Dual Listbox
                $('.duallistbox-multi-selection').bootstrapDualListbox({
                    nonSelectedListLabel: 'Kelas',
                    selectedListLabel: 'Kelas diampu',
                    preserveSelectionOnMove: 'moved',
                    moveOnSelect: false,
                });

                $('.remove').click(function(){
                    $('.duallistbox-multi-selection').bootstrapDualListbox('refresh',true);
                });

                $('.move').click(function(){
                    $('.duallistbox-multi-selection').bootstrapDualListbox('refresh',true);
                });
            })(window, document, jQuery);
        </script>
    @endpush