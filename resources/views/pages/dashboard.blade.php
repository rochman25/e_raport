@extends('layouts.app')
@section('page')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-home"></i>
            </span> Dashboard
        </h3>
    </div>
    <div class="row">
        @if ($baseRole->role['name'] == 'super admin')
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                    <div class="card-body">
                        <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Jumlah Siswa <i
                                class="mdi mdi-account mdi-24px float-right"></i>
                        </h4>
                        <h2 class="mb-5">{{ $siswa }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                    <div class="card-body">
                        <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Jumlah Guru <i class="mdi mdi-account mdi-24px float-right"></i>
                        </h4>
                        <h2 class="mb-5">{{ $guru }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-warning card-img-holder text-white">
                    <div class="card-body">
                        <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Jumlah Kelas <i
                                class="mdi mdi-account mdi-24px float-right"></i>
                        </h4>
                        <h2 class="mb-5">{{ $kelas }}</h2>
                    </div>
                </div>
            </div>
        @else
            <div class="col-md-6 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                    <div class="card-body">
                        <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Mata Pelajaran<i
                                class="mdi mdi-account mdi-24px float-right"></i>
                        </h4>
                        <h2 class="mb-5">{{ $matpel }}</h2>
                        <h6 class="card-text">Jumlah Mata Pelajaran yang diampu.</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-6 stretch-card grid-margin">
                <div class="card bg-gradient-primary card-img-holder text-white">
                    <div class="card-body">
                        <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Kelas<i
                                class="mdi mdi-account mdi-24px float-right"></i>
                        </h4>
                        <h2 class="mb-5">{{ $kelas_matpel }}</h2>
                        <h6 class="card-text">Jumlah Kelas yang diajar.</h6>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
