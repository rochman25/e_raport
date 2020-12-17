<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="nav-profile-image">
                    <img src="{{asset('assets/images/faces/face1.jpg')}}" alt="profile">
                    <span class="login-status online"></span>
                    <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                    <span class="font-weight-bold mb-2">{{ Auth::user()->name }}</span>
                    <span class="text-secondary text-small">{{ Auth::user()->username }}</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('view.home') }}">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
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
