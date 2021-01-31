<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="nav-profile-image">
                    <img src="{{ asset('assets/images/faces/face1.png') }}" alt="profile">
                    <span class="login-status online"></span>
                    <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                    <span class="font-weight-bold mb-2">{{ Auth::user()->name }}</span>
                    <span class="text-secondary text-small">{{ Auth::user()->username }}</span>
                </div>
                {{-- <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
                --}}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('view.home') }}">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>
        @if ($baseRole->role['name'] == 'guru')
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false"
                    aria-controls="ui-basic">
                    <span class="menu-title">Penilaian Siswa</span>
                    <i class="menu-arrow"></i>
                    <i class="mdi mdi-table menu-icon"></i>
                </a>
                <div class="collapse" id="ui-basic">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="{{ route('view.kompetensi_dasar') }}">Kompetensi
                                Dasar</a>
                        </li>
                        <li class="nav-item"> <a class="nav-link" href="{{ route('view.nilai_siswa') }}">Nilai Siswa</a>
                        </li>
                        <li class="nav-item"> <a class="nav-link" href="{{ route('view.sikap_spiritual') }}">Nilai Sikap
                                Spiritual</a>
                        </li>
                        <li class="nav-item"> <a class="nav-link" href="{{ route('view.sikap_sosial') }}">Nilai Sikap
                                Sosial</a>
                        </li>
                    </ul>
                </div>
            </li>
            @if (count($baseRole->user->guru['walikelas']) > 0)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('view.kelas_saya', $baseRole->user->guru['id']) }}">
                        <span class="menu-title">Kelas Saya</span>
                        <i class="mdi mdi-table menu-icon"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('view.absensi') }}" aria-expanded="false">
                        <span class="menu-title">Absensi</span>
                        <i class="mdi mdi-calendar menu-icon"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('view.ekstra_nilai') }}" aria-expanded="false">
                        <span class="menu-title">Ekstrakurikuler</span>
                        <i class="mdi mdi-basketball menu-icon"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('view.prestasi') }}" aria-expanded="false">
                        <span class="menu-title">Prestasi</span>
                        <i class="mdi mdi-trophy menu-icon"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('view.catatan') }}" aria-expanded="false">
                        <span class="menu-title">Catatan</span>
                        <i class="mdi mdi-note menu-icon"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#ui-cetak" aria-expanded="false"
                        aria-controls="ui-cetak">
                        <span class="menu-title">Cetak Laporan</span>
                        <i class="menu-arrow"></i>
                        <i class="mdi mdi-file menu-icon"></i>
                    </a>
                    <div class="collapse" id="ui-cetak">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="{{ route('view.cetak_raport') }}">Cetak Raport</a>
                            </li>
                            <li class="nav-item"> <a class="nav-link" href="{{ route('view.cetak_leger') }}">Export Leger</a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif
        @else
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false"
                    aria-controls="ui-basic">
                    <span class="menu-title">Master Data</span>
                    <i class="menu-arrow"></i>
                    <i class="mdi mdi-table menu-icon"></i>
                </a>
                <div class="collapse" id="ui-basic">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="{{ route('view.tahun') }}">Tahun Ajaran</a>
                        </li>
                        <li class="nav-item"> <a class="nav-link" href="{{ route('view.mata_pelajaran') }}">Mata
                                Pelajaran</a>
                        </li>
                        <li class="nav-item"> <a class="nav-link" href="{{ route('view.guru') }}">Guru</a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{ route('view.siswa') }}">Siswa</a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{ route('view.kelas') }}">Kelas</a></li>
                        <li class="nav-item"> <a class="nav-link"
                                href="{{ route('view.ekstrakurikuler') }}">Ekstrakurikuler</a></li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic2" aria-expanded="false"
                    aria-controls="ui-basic2">
                    <span class="menu-title">Pengaturan Data</span>
                    <i class="menu-arrow"></i>
                    <i class="mdi mdi-apps menu-icon"></i>
                </a>
                <div class="collapse" id="ui-basic2">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="{{ route('view.kompetensi_dasar') }}">Kompetensi
                                Dasar</a>
                        </li>
                        <li class="nav-item"> <a class="nav-link" href="{{ route('view.setup_kelas') }}">Kelas</a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{ route('view.walikelas') }}">Walikelas</a>
                        </li>
                        <li class="nav-item"> <a class="nav-link" href="{{ route('view.setup_matpel') }}">Mata
                                Pelajaran</a></li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#general-pages" aria-expanded="false"
                    aria-controls="general-pages">
                    <span class="menu-title">Sistem</span>
                    <i class="menu-arrow"></i>
                    <i class="mdi mdi-medical-bag menu-icon"></i>
                </a>
                <div class="collapse" id="general-pages">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="{{ route('view.role') }}"> Role </a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{ route('view.user') }}"> Pengguna </a></li>
                    </ul>
                </div>
            </li>
        @endif
        <li class="nav-item sidebar-actions">
            <span class="nav-link">
                <div class="mt-4">
                    <div class="border-bottom">
                        <p class="text-primary">E-Raport V.1.0</p>
                    </div>
                </div>
            </span>
        </li>
    </ul>
</nav>
