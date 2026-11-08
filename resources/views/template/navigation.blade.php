<header class="sticky-header">
@include('template.running-text')

<nav class="navbar navbar-expand-lg bg-body shadow-sm py-3">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-3" href="{{ url('/') }}">
            <img src="{{ asset('images/' . $master_sekolah->logo) }}" alt="Logo SMA Islam As-Syafi'iyah 01" width="55" height="55" class="d-inline-block align-text-top">
            <span class="text-custom-green fw-bold fs-6 lh-sm">
                {{$master_sekolah->nama}}<br>
            </span>
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto fw-medium gap-2 align-items-lg-center">

                <!-- Beranda -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active fw-bold text-custom-green' : '' }}" href="{{ url('/') }}">Beranda</a>
                </li>
                <!-- Berita -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('berita') ? 'active fw-bold text-custom-green' : '' }}" href="{{ url('berita') }}">Berita</a>
                </li>

                <!-- Menu Profil dengan Sub-menu (Dropdown) -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->is('profile*') ? 'active fw-bold text-custom-green' : '' }}" href="#" id="navbarDropdownProfil" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Profil
                    </a>
                    <ul class="dropdown-menu shadow border-0" aria-labelledby="navbarDropdownProfil">
                        <li>
                            <a class="dropdown-item d-flex align-items-center gap-2 {{ request()->is('profile/sejarah') ? 'active bg-custom-green text-white' : '' }}" href="{{ url('profile/sejarah') }}">
                                Sejarah Sekolah
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center gap-2 {{ request()->is('profile/visi-misi') ? 'active bg-custom-green text-white' : '' }}" href="{{ url('profile/visi-misi') }}">
                                Visi & Misi
                            </a>
                        </li>

                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center gap-2 {{ request()->is('profile/tenaga-pendidik') ? 'active bg-custom-green text-white' : '' }}" href="{{ url('profile/tenaga-pendidik') }}">
                                Tenaga Pendidik
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Akademik -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->is('akademik*') ? 'active fw-bold text-custom-green' : '' }}" href="#" id="navbarDropdownProfil" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Akademik
                    </a>
                    <ul class="dropdown-menu shadow border-0" aria-labelledby="navbarDropdownProfil">
                        <li>
                            <a class="dropdown-item d-flex align-items-center gap-2 {{ request()->is('akademik/kurikulum') ? 'active bg-custom-green text-white' : '' }}" href="{{ url('akademik/kurikulum') }}">
                                Kurikulum
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center gap-2 {{ request()->is('akademik/kalender-pendidikan') ? 'active bg-custom-green text-white' : '' }}" href="{{ url('akademik/kalender-pendidikan') }}">
                                Kalender Pendidikan
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center gap-2 {{ request()->is('akademik/program-unggulan') ? 'active bg-custom-green text-white' : '' }}" href="{{ url('akademik/program-unggulan') }}">
                                Program Unggulan
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center gap-2 {{ request()->is('akademik/ekstrakurikuler') ? 'active bg-custom-green text-white' : '' }}" href="{{ url('akademik/ekstrakurikuler') }}">
                                Ekstrakurikuler
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center gap-2 {{ request()->is('akademik/prestasi-siswa') ? 'active bg-custom-green text-white' : '' }}" href="{{ url('akademik/prestasi-siswa') }}">
                                Prestasi Siswa
                            </a>
                        </li>

                    </ul>
                </li>

                <!-- Fasilitas -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('fasilitas') ? 'active fw-bold text-custom-green' : '' }}" href="{{ url('fasilitas') }}">Fasilitas</a>
                </li>
                <!-- PPDB -->

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('ppdb') ? 'active fw-bold text-custom-green' : '' }}" href="{{ url('ppdb') }}">PPDB</a>
                </li>
                <!-- Wadah Pengatur Tombol (Dark Mode & Switch Bahasa) -->
                <li class="nav-item ms-lg-2 my-2 my-lg-0 d-flex align-items-center justify-content-between justify-content-lg-start gap-2">

                    <!-- Tombol Toggle Dark/Light Mode -->
                    <button id="theme-toggle" class="btn btn-outline-secondary rounded-pill btn-sm d-flex align-items-center gap-2 px-3 py-2">
                        <span id="theme-icon">🌙</span> <span id="theme-text">Dark Mode</span>
                    </button>

                    <!-- Switch Bahasa (ID / EN) - Diberi kelas ms-auto untuk layar mobile agar terdorong ke kanan -->
                    <div class="form-check form-switch custom-lang-switch d-flex align-items-center gap-1 m-0 p-0 ms-auto ms-lg-0">
                        <span class="small fw-bold text-muted" id="lang-label-id" style="font-size: 0.75rem;">ID</span>
                        <input class="form-check-input m-0" type="checkbox" role="switch" id="languageSwitch" style="width: 2.8em; height: 1.4em; cursor: pointer;">
                        <span class="small fw-bold text-muted" id="lang-label-en" style="font-size: 0.75rem;">EN</span>
                    </div>

                    <!-- Elemen Asli Google Translate (Disembunyikan) -->
                    <div id="google_translate_element" style="display: none;"></div>

                </li>
            </ul>
        </div>
    </div>
</nav>
</header>
