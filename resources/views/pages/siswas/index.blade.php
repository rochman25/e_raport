@extends('layouts.app')
@section('page')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-account-star"></i>
            </span> Siswa
        </h3>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="card-title">List Data Siswa</h4>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('view.siswa.insert') }}" style="float: right"
                                class="btn btn-sm btn-outline-primary btn-fw">Tambah</a>
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
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>Terakhir diupdate</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($siswas as $index => $item)
                                <tr>
                                    <td>{{ ++$index }}</td>
                                    <td>{{ $item->nis }}</td>
                                    <td>{{ $item->nama_lengkap }}</td>
                                    <td class="text-info"> {{ $item->updated_at->isoFormat('dddd, D MMMM Y') }}</td>
                                    <td>
                                        <a href="{{ route('view.siswa.edit', $item->id) }}"
                                            class="btn btn-success btn-sm">ubah</a>
                                        <button data-id="{{ $item->id }}" class="btn btn-danger btn-sm btnHapus">hapus</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" style="text-align: center"> -- Data Kosong -- </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col mt-5">
                            {{ $siswas->links('vendor.pagination.custom') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $(document).on('click', '.btnHapus', function name(params) {
            const url = "{{ route('delete.siswa') }}";
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
                        data: {
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
