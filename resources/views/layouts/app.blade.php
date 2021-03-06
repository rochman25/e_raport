<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ config('app.name', 'E - Raport') }}</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" />
    @stack('styles')
</head>

<body>
    <div class="container-scroller">
        @include('partials.navbar')
        <div class="container-fluid page-body-wrapper">
            @include('partials.sidebar')

            <div class="main-panel">
                <div class="content-wrapper">
                    {{-- page --}}
                    @yield('page')
                </div>
                {{-- footer --}}
                @include('partials.footer')
            </div>
        </div>
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    {{-- <script src="{{ asset('assets/vendors/chart.js/Chart.min.js') }}"></script> --}}
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/js/misc.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    {{-- <script src="{{ asset('assets/js/dashboard.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/js/todolist.js') }}"></script> --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript">
        $('#role_change').on('change', function() {
            // alert($(this).val())
            var url = "{{ route('auth.change_role') }}"
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    role_name:$(this).val()
                },
                success: function(response) {
                    if (response.success) {
                        console.log(response)
                        // swal("Sukses!", "Data berhasil dihapus", "success");
                        setTimeout(location.reload.bind(location), 100);
                    } else {
                        swal("Error", "Maaf terjadi kesalahan", "error");
                    }
                }
            });
        });

    </script>
    @stack('scripts')
</body>

</html>
