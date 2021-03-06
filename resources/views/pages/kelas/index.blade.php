@extends('layouts.app')
@section('page')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-account-star"></i>
            </span> Kelas
        </h3>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="card-title">List Data Kelas</h4>
                        </div>
                        <div class="col-md-6">
                            <button style="float: right" type="button" data-toggle="modal" data-target="#exampleModal-4"
                                class="btn btn-sm btn-outline-primary btn-fw">Tambah</button>
                        </div>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger mt-5">
                            <ul>
                                <li>Simpan data gagal.</li>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
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

                    <table class="table table-hover mt-5">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Terakhir diupdate</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($kelas as $index => $item)
                                <tr>
                                    <td>{{ ++$index }}</td>
                                    <td>{{ $item->nama_kelas }}</td>
                                    <td class="text-info"> {{ $item->updated_at->isoFormat('dddd, D MMMM Y') }}</td>
                                    <td>
                                        <button class="btn btn-success btn-sm btnUbah" data-id="{{ $item->id }}"
                                            data-name="{{ $item->nama_kelas }}" data-kode="{{ $item->kode_kelas }}" data-tingkat="{{ $item->tingkat }}" data-toggle="modal"
                                            data-target="#exampleModal-4">ubah</button>
                                        <button data-id="{{ $item->id }}" class="btn btn-danger btn-sm btnHapus">hapus</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" style="text-align: center"> -- Data Kosong -- </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col mt-5">
                            {{ $kelas->links('vendor.pagination.custom') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal-4" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Tambah Kelas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formRole" action="{{ route('insert.kelas') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Kode Kelas:</label>
                            <input type="hidden" id="idKelas" class="form-control" name="id" id="recipient-name">
                            <input type="text" id="kodeKelas" class="form-control" name="kode_kelas" required
                                placeholder="ex: admin" id="recipient-name">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Nama Kelas:</label>
                            <input type="text" id="namaKelas" class="form-control" name="nama_kelas" required
                                placeholder="ex: admin" id="recipient-name">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Tingkat Kelas:</label>
                            <select name="tingkat" id="tingkat" class="form-control" required>
                                <option value="">-- Pilih Tingkat --</option>
                                <option value="VII">VII</option>
                                <option value="VIII">VIII</option>
                                <option value="IX">IX</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <button type="reset" class="btn btn-light" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $('.btnUbah').on('click', function name(params) {
            let id = $(this).data('id');
            let name = $(this).data('name');
            let kode = $(this).data('kode');
            let tingkat = $(this).data('tingkat');

            $('#idKelas').val(id);
            $('#namaKelas').val(name);
            $('#kodeKelas').val(kode);
            $('#tingkat').val(tingkat);
            // console.log($(this).data())
        });

        $('#exampleModal-4').on('hidden.bs.modal', function() {
            $('#idKelas').val(null)
            $('#namaKelas').val(null);
            $('#kodeKelas').val(null);
            $('#tingkat').val(null);
        });

        $(document).on('click','.btnHapus' ,function name(params) {
            const url = "{{ route('delete.kelas') }}";
            const idBtn = $(this).data('id');
            swal({
                title: "Konfirmasi",
                text: "Apakah anda yakin ingin menghapus ?",
                icon: "warning",
                buttons: {
                    confirm: {
                        text: "Ya",
                        value: true,
                        visible: true,
                        className: "",
                        closeModal: false
                    },
                    cancel: {
                        text: "Tidak",
                        value: null,
                        visible: true,
                        className: "",
                        closeModal: true,
                    }

                }
            }).then(isConfirm => {
                if (isConfirm) {
                    $.ajax({
                        url: url,
                        type: "POST",
                        data:  {
                            _token: "{{ csrf_token() }}",
                            id: idBtn                           
                        },
                        success: function(response) {
                            if (response.success) {
                                swal("Sukses!", "Data berhasil dihapus", "success");
                                setTimeout(location.reload.bind(location), 1000);
                            } else {
                                swal("Error", "Maaf terjadi kesalahan", "error");
                            }
                        }
                    });
                } else {
                    swal.close();
                }
            });
        })

    </script>
@endpush
