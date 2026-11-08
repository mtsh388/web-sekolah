<aside
    class="app-sidebar bg-custom-green shadow"
    data-bs-theme="dark"
>

    <!-- ============================================================
         SIDEBAR BRAND
    ============================================================= -->

    <div class="sidebar-brand">

        <a
            href="{{ route('admin.dashboard') }}"
            class="brand-link"
        >

            <img
                src="{{ asset('images/' . $master_sekolah->logo) }}"
                alt="{{ $master_sekolah->nama }}"
                class="brand-image opacity-75 shadow"
            >

            <span
                class="brand-text fw-light"
                style="font-size: 1rem"
            >
                {{ $master_sekolah->nama }}
            </span>

        </a>

    </div>


    <!-- ============================================================
         SIDEBAR WRAPPER
    ============================================================= -->

    <div class="sidebar-wrapper">

        <nav
            class="mt-2"
            aria-label="Main navigation"
        >

            <ul
                class="nav sidebar-menu flex-column"
                data-lte-toggle="treeview"
                data-accordion="false"
                id="navigation"
            >


                <!-- ====================================================
                     PROFILE SEKOLAH
                ===================================================== -->

                <li class="nav-item">

                    <a
                        href="{{ route('admin.dashboard') }}"
                        class="nav-link
                            {{ request()->routeIs('admin.dashboard*') ? 'active' : '' }}
                        "
                    >

                        <i class="nav-icon bi bi-building-gear"></i>

                        <p>
                            Profile Sekolah
                        </p>

                    </a>

                </li>


                <!-- ====================================================
                     HEADER HALAMAN
                ===================================================== -->

                <li class="nav-header">
                    HALAMAN
                </li>


                <!-- ====================================================
                     BERANDA
                ===================================================== -->

                <li class="nav-item
                    {{ request()->routeIs('admin.berandas.*') ? 'menu-open' : '' }}
                ">

                    <a
                        href="#"
                        class="nav-link
                            {{ request()->routeIs('admin.berandas.*') ? 'active' : '' }}
                        "
                    >

                        <i class="nav-icon bi bi-house"></i>

                        <p>

                            Beranda

                            <i class="nav-arrow bi bi-chevron-right"></i>

                        </p>

                    </a>


                    <ul class="nav nav-treeview">


                        <!-- Running Text -->

                        <li class="nav-item">

                            <a
                                href="{{ route('admin.berandas.running-text.index') }}"
                                class="nav-link
                                    {{ request()->routeIs('admin.berandas.running-text.*') ? 'active' : '' }}
                                "
                            >

                                <i class="nav-icon bi bi-sliders"></i>

                                <p>
                                    Running Text
                                </p>

                            </a>

                        </li>
                        <!-- Videotron -->

                        <li class="nav-item">

                            <a
                                href="{{ route('admin.berandas.videotron') }}"
                                class="nav-link
                                    {{ request()->routeIs('admin.berandas.videotron*') ? 'active' : '' }}
                                "
                            >

                                <i class="nav-icon bi bi-sliders"></i>

                                <p>
                                    Videotron
                                </p>

                            </a>

                        </li>


                        <!-- Sambutan -->

                        <li class="nav-item">

                            <a
                                href="{{ route('admin.berandas.sambutan') }}"
                                class="nav-link
                                    {{ request()->routeIs('admin.berandas.sambutan*') ? 'active' : '' }}
                                "
                            >

                                <i class="nav-icon bi bi-chat-quote"></i>

                                <p>
                                    Sambutan
                                </p>

                            </a>

                        </li>


                        <!-- Keunggulan Kami -->

                        <li class="nav-item">

                            <a
                                href="{{ route('admin.berandas.keunggulan') }}"
                                class="nav-link
                                    {{ request()->routeIs('admin.berandas.keunggulan*') ? 'active' : '' }}
                                "
                            >

                                <i class="nav-icon bi bi-stars"></i>

                                <p>
                                    Keunggulan Kami
                                </p>

                            </a>

                        </li>


                    </ul>

                </li>


                <!-- ====================================================
                     PROFIL
                ===================================================== -->

                <li class="nav-item
                    {{ request()->routeIs('admin.profile.*') ? 'menu-open' : '' }}
                ">

                    <a
                        href="#"
                        class="nav-link
                            {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}
                        "
                    >

                        <i class="nav-icon bi bi-person-vcard"></i>

                        <p>

                            Profil

                            <i class="nav-arrow bi bi-chevron-right"></i>

                        </p>

                    </a>


                    <ul class="nav nav-treeview">


                        <!-- Sejarah Sekolah -->

                        <li class="nav-item">

                            <a
                                href="{{ route('admin.profile.sejarah.index') }}"
                                class="nav-link
                                    {{ request()->routeIs('admin.profile.sejarah.*') ? 'active' : '' }}
                                "
                            >

                                <i class="nav-icon bi bi-clock-history"></i>

                                <p>
                                    Sejarah Sekolah
                                </p>

                            </a>

                        </li>


                        <!-- Visi & Misi -->

                        <li class="nav-item">

                            <a
                                href="{{ route('admin.profile.visi-misi.index') }}"
                                class="nav-link
                                    {{ request()->routeIs('admin.profile.visi-misi.*') ? 'active' : '' }}
                                "
                            >

                                <i class="nav-icon bi bi-bullseye"></i>

                                <p>
                                    Visi & Misi
                                </p>

                            </a>

                        </li>


                        <!-- Struktur Organisasi -->

                        <li class="nav-item">

                            <a
                                href="{{ route('admin.profile.struktur') }}"
                                class="nav-link
                                    {{ request()->routeIs('admin.profile.struktur*') ? 'active' : '' }}
                                "
                            >

                                <i class="nav-icon bi bi-diagram-3"></i>

                                <p>
                                    Struktur Organisasi
                                </p>

                            </a>

                        </li>


                        <!-- Tenaga Pendidik -->

                        <li class="nav-item">

                            <a
                                href="{{ route('admin.profile.tenaga-pendidik.index') }}"
                                class="nav-link
                                    {{ request()->routeIs('admin.profile.tenaga-pendidik.*') ? 'active' : '' }}
                                "
                            >

                                <i class="nav-icon bi bi-person-workspace"></i>

                                <p>
                                    Tenaga Pendidik
                                </p>

                            </a>

                        </li>

                    </ul>

                </li>


                <!-- ====================================================
                     AKADEMIK
                ===================================================== -->

                <li class="nav-item
                    {{ request()->routeIs('admin.akademik.*') ? 'menu-open' : '' }}
                ">

                    <a
                        href="#"
                        class="nav-link
                            {{ request()->routeIs('admin.akademik.*') ? 'active' : '' }}
                        "
                    >

                        <i class="nav-icon bi bi-mortarboard"></i>

                        <p>

                            Akademik

                            <i class="nav-arrow bi bi-chevron-right"></i>

                        </p>

                    </a>


                    <ul class="nav nav-treeview">


                        <!-- ====================================================
                             KURIKULUM
                        ===================================================== -->

                        <li class="nav-item">

                            <a
                                href="{{ route('admin.akademik.kurikulum.index') }}"
                                class="nav-link
                                    {{ request()->routeIs('admin.akademik.kurikulum.*') ? 'active' : '' }}
                                "
                            >

                                <i class="nav-icon bi bi-journal-text"></i>

                                <p>
                                    Kurikulum
                                </p>

                            </a>

                        </li>


                        <!-- ====================================================
                             KALENDER PENDIDIKAN
                        ===================================================== -->

                        <li class="nav-item">

                            <a
                                href="{{ route('admin.akademik.kalender-pendidikan.index') }}"
                                class="nav-link
                                    {{ request()->routeIs('admin.akademik.kalender-pendidikan.*') ? 'active' : '' }}
                                "
                            >

                                <i class="nav-icon bi bi-calendar-date"></i>

                                <p>
                                    Kalender Pendidikan
                                </p>

                            </a>

                        </li>


                        <!-- ====================================================
                             PROGRAM UNGGULAN
                        ===================================================== -->

                        <li class="nav-item">

                            <a
                                href="{{ route('admin.akademik.program-unggulan.index') }}"
                                class="nav-link
                                    {{ request()->routeIs('admin.akademik.program-unggulan.*') ? 'active' : '' }}
                                "
                            >

                                <i class="nav-icon bi bi-stars"></i>

                                <p>
                                    Program Unggulan
                                </p>

                            </a>

                        </li>


                        <!-- ====================================================
                             EKSTRAKURIKULER
                        ===================================================== -->

                        <li class="nav-item">

                            <a
                                href="{{ route('admin.akademik.ekstrakurikuler.index') }}"
                                class="nav-link
                                    {{ request()->routeIs('admin.akademik.ekstrakurikuler.*') ? 'active' : '' }}
                                "
                            >

                                <i class="nav-icon bi bi-puzzle"></i>

                                <p>
                                    Ekstrakurikuler
                                </p>

                            </a>

                        </li>


                        <!-- ====================================================
                             PRESTASI SISWA
                        ===================================================== -->

                        <li class="nav-item">

                            <a
                                href="{{ route('admin.akademik.prestasi-siswa.index') }}"
                                class="nav-link
                                    {{ request()->routeIs('admin.akademik.prestasi-siswa.*') ? 'active' : '' }}
                                "
                            >

                                <i class="nav-icon bi bi-trophy"></i>

                                <p>
                                    Prestasi Siswa
                                </p>

                            </a>

                        </li>

                    </ul>

                </li>


                <!-- ====================================================
                     FASILITAS
                ===================================================== -->

                <li class="nav-item">

                    <a
                        href="{{ route('admin.akademik.fasilitas.index') }}"
                        class="nav-link
                            {{ request()->routeIs('admin.akademik.fasilitas.*') ? 'active' : '' }}
                        "
                    >

                        <i class="nav-icon bi bi-buildings"></i>

                        <p>
                            Fasilitas
                        </p>

                    </a>

                </li>


                <!-- ====================================================
                     BERITA
                ===================================================== -->

                <li class="nav-item">

                    <a
                        href="{{ route('admin.berita.index') }}"
                        class="nav-link
                            {{ request()->routeIs('admin.berita.*') ? 'active' : '' }}
                        "
                    >

                        <i class="nav-icon bi bi-newspaper"></i>

                        <p>
                            Berita
                        </p>

                    </a>

                </li>


                <!-- ====================================================
                     PPDB
                ===================================================== -->

                <li class="nav-item">

                    <a
                        href="{{ route('admin.ppdb.index') }}"
                        class="nav-link
                            {{ request()->routeIs('admin.ppdb*') ? 'active' : '' }}
                        "
                    >

                        <i class="nav-icon bi bi-person-plus"></i>

                        <p>
                            PPDB
                        </p>

                    </a>

                </li>


            </ul>

        </nav>

    </div>

</aside>
