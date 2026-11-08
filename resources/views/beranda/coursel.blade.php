@extends('template.app')

@section('title', "Beranda | SMA Islam As-Syafi'iyah 01")

@section('content')

    <!-- 1. HERO CAROUSEL SECTION -->
    <div id="heroCarousel" class="carousel slide carousel-fade shadow-sm" data-bs-ride="carousel" data-bs-interval="5000">
        <!-- Indikator Slide (Titik di bawah) -->
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>

        <!-- Wrapper untuk Slide Gambar -->
        <div class="carousel-inner">
            <!-- Slide 1 -->
            <div class="carousel-item active">
                <!-- Ganti background-color dengan tag <img> jika Anda menggunakan foto asli -->
                <div class="d-flex align-items-center justify-content-center text-white text-center" style="height: 500px; background: linear-gradient(var(--primary-green), var(--primary-green)), url('{{ asset('images/slide-1.jpg') }}'); background-size: cover; background-position: center;">
                    <div class="container px-4">
                        <h1 class="display-4 fw-bold mb-3 animate-slide-down">Membangun Generasi Cerdas & Berakhlakul Karimah</h1>
                        <p class="lead mb-4 mx-auto" style="max-width: 800px;">
                            Selamat datang di website resmi SMA Islam As-Syafi'iyah 01 Jakarta. Kami berkomitmen memberikan pendidikan berkualitas.
                        </p>
                        <a href="#keunggulan" class="btn btn-custom-yellow btn-lg rounded-pill px-5 shadow">Jelajahi Lebih Lanjut</a>
                    </div>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="carousel-item">
                <div class="d-flex align-items-center justify-content-center text-white text-center" style="height: 500px; background: linear-gradient(var(--primary-green), var(--primary-green)), url('{{ asset('images/slide-2.jpg') }}'); background-size: cover; background-position: center;">
                    <div class="container px-4">
                        <h1 class="display-4 fw-bold mb-3">Fasilitas Belajar Modern & Mendukung</h1>
                        <p class="lead mb-4 mx-auto" style="max-width: 800px;">
                            Menyediakan laboratorium komputer, ruang kelas ber-AC, dan lingkungan sekolah yang kondusif.
                        </p>
                        <a href="{{ url('fasilitas') }}" class="btn btn-custom-yellow btn-lg rounded-pill px-5 shadow">Lihat Fasilitas</a>
                    </div>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="carousel-item">
                <div class="d-flex align-items-center justify-content-center text-white text-center" style="height: 500px; background: linear-gradient(var(--primary-green), var(--primary-green)), url('{{ asset('images/slide-3.jpg') }}'); background-size: cover; background-position: center;">
                    <div class="container px-4">
                        <h1 class="display-4 fw-bold mb-3">Penerimaan Peserta Didik Baru (PPDB)</h1>
                        <p class="lead mb-4 mx-auto" style="max-width: 800px;">
                            Pendaftaran tahun ajaran baru telah dibuka. Segera daftarkan putra-putri Anda bersama kami.
                        </p>
                        <a href="{{ url('ppdb') }}" class="btn btn-custom-yellow btn-lg rounded-pill px-5 shadow">Daftar Sekarang</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Navigasi Kiri & Kanan -->
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- 2. SAMBUTAN KEPALA SEKOLAH -->
    <section class="py-5 bg-body-tertiary" id="sambutan-kepala-sekolah">
        <div class="container py-4">
            <div class="row align-items-center g-5">
                <div class="col-lg-4 text-center animate-on-scroll">
                    <div class="p-3 bg-body rounded-4 shadow-sm border">
                        <img src="" alt="Kepala Sekolah" class="img-fluid rounded-3 mb-3" style="max-height: 300px; object-fit: cover; width: 100%;">
                        <h5 class="fw-bold mb-1 text-custom-green">Drs. H. Ahmad Fauzi, M.Pd.</h5>
                        <p class="text-muted small mb-0">Kepala SMA Islam As-Syafi'iyah 01</p>
                    </div>
                </div>
                <div class="col-lg-8 animate-on-scroll">
                    <h6 class="text-custom-green fw-bold text-uppercase tracking-wider">Sambutan Pimpinan</h6>
                    <h2 class="fw-bold mb-4">Mewujudkan Pelajar yang Unggul dalam Prestasi dan Mulia dalam Pekerti</h2>
                    <p class="text-body-secondary mb-3">
                        "Assalamu’alaikum Warahmatullahi Wabarakatuh. Puji syukur kita panjatkan ke hadirat Allah SWT. Selamat datang di portal resmi sekolah kami di Bukit Duri, Jakarta..."
                    </p>
                    <a href="{{ url('profil/sejarah') }}" class="btn btn-outline-success rounded-pill px-4">Baca Selengkapnya &rarr;</a>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. KEUNGGULAN / MENGAPA MEMILIH KAMI -->
    <section id="keunggulan" class="py-5 my-4">
        <div class="container">
            <div class="text-center mb-5 animate-on-scroll">
                <h2 class="fw-bold text-custom-green">Keunggulan Kami</h2>
                <p class="text-body-secondary">Fasilitas dan program unggulan untuk mendukung perkembangan potensi siswa.</p>
                <hr class="w-25 mx-auto border-2 text-custom-green">
            </div>

            <div class="row g-4">
                <div class="col-md-4 animate-on-scroll">
                    <div class="card card-custom h-100 shadow-sm p-4 rounded-4 text-center">
                        <div class="card-body">
                            <div class="bg-custom-green text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                                <h3 class="mb-0">🏫</h3>
                            </div>
                            <h4 class="card-title fw-bold text-custom-green">Fasilitas Lengkap</h4>
                            <p class="card-text text-body-secondary">Ruang kelas ber-AC, Laboratorium IPA, Lab Komputer modern, dan perpustakaan digital.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 animate-on-scroll" style="transition-delay: 0.1s;">
                    <div class="card card-custom h-100 shadow-sm p-4 rounded-4 text-center">
                        <div class="card-body">
                            <div class="bg-custom-green text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                                <h3 class="mb-0">📖</h3>
                            </div>
                            <h4 class="card-title fw-bold text-custom-green">Kurikulum Islami</h4>
                            <p class="card-text text-body-secondary">Integrasi kurikulum nasional dengan pendidikan agama Islam mendalam, Tahsin, dan Tahfidz.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 animate-on-scroll" style="transition-delay: 0.2s;">
                    <div class="card card-custom h-100 shadow-sm p-4 rounded-4 text-center">
                        <div class="card-body">
                            <div class="bg-custom-green text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                                <h3 class="mb-0">👨‍🏫</h3>
                            </div>
                            <h4 class="card-title fw-bold text-custom-green">Pengajar Profesional</h4>
                            <p class="card-text text-body-secondary">Dibimbing oleh tenaga pendidik kompeten, berpengalaman, dan berdedikasi tinggi di bidangnya.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. BERITA & INFORMASI TERBARU -->
    <section class="py-5 bg-body-tertiary">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-5 animate-on-scroll">
                <div>
                    <h2 class="fw-bold text-custom-green mb-1">Berita & Kegiatan Terbaru</h2>
                    <p class="text-body-secondary mb-0">Informasi seputar aktivitas dan agenda sekolah terkini.</p>
                </div>
                <a href="#" class="btn btn-outline-secondary rounded-pill px-4 d-none d-md-inline-block">Lihat Semua</a>
            </div>

            <div class="row g-4">
                <div class="col-md-4 animate-on-scroll">
                    <div class="card card-custom h-100 shadow-sm rounded-4 overflow-hidden">
                        <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 200px;">
                            <span>[ Gambar Berita 1 ]</span>
                        </div>
                        <div class="card-body p-4">
                            <span class="badge bg-custom-green mb-2">Akademik</span>
                            <h5 class="card-title fw-bold">Pelaksanaan Ujian Tengah Semester Berbasis Digital</h5>
                            <p class="card-text text-body-secondary small">Siswa-siswi mengikuti rangkaian ujian menggunakan perangkat komputer sekolah secara tertib...</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 animate-on-scroll" style="transition-delay: 0.1s;">
                    <div class="card card-custom h-100 shadow-sm rounded-4 overflow-hidden">
                        <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 200px;">
                            <span>[ Gambar Berita 2 ]</span>
                        </div>
                        <div class="card-body p-4">
                            <span class="badge bg-custom-green mb-2">Ekstrakurikuler</span>
                            <h5 class="card-title fw-bold">Tim Paskibra Meraih Juara Lomba Tingkat Kota</h5>
                            <p class="card-text text-body-secondary small">Kebanggaan kembali datang dari siswa ekstrakurikuler Paskibra yang sukses membawa pulang piala...</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 animate-on-scroll" style="transition-delay: 0.2s;">
                    <div class="card card-custom h-100 shadow-sm rounded-4 overflow-hidden">
                        <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 200px;">
                            <span>[ Gambar Berita 3 ]</span>
                        </div>
                        <div class="card-body p-4">
                            <span class="badge bg-custom-green mb-2">Kegiatan Islam</span>
                            <h5 class="card-title fw-bold">Peringatan Maulid Nabi Muhammad SAW di Aula Sekolah</h5>
                            <p class="card-text text-body-secondary small">Acara diisi dengan tausiyah, pembacaan shalawat bersama, serta santunan anak yatim piatu...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. LOKASI & KONTAK KAMI (GOOGLE MAPS) -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5 animate-on-scroll">
                <h2 class="fw-bold text-custom-green">Lokasi & Kontak Kami</h2>
                <p class="text-body-secondary">Kunjungi sekolah kami atau hubungi melalui informasi di bawah ini.</p>
                <hr class="w-25 mx-auto border-2 text-custom-green">
            </div>

            <div class="row g-4 align-items-stretch">
                <!-- Kolom Kiri: Informasi Alamat & Kontak -->
                <div class="col-lg-5 animate-on-scroll">
                    <div class="card card-custom h-100 shadow-sm p-4 rounded-4">
                        <h4 class="fw-bold text-custom-green mb-4">{{$master_sekolah->nama}}</h4>
                        <ul class="list-unstyled d-flex flex-column gap-3 text-body-secondary">
                            @if($master_sekolah->alamat)
                            <li class="d-flex align-items-start gap-3">
                                <i class="bi bi-geo-alt-fill text-custom-green fs-4 lh-1"></i>
                                <span>{{$master_sekolah->alamat}}</span>
                            </li>
                            @endif
                            @if($master_sekolah->no_telp)
                            <li class="d-flex align-items-center gap-3">
                                <i class="bi bi-telephone-fill text-custom-green fs-5 lh-1"></i>
                                <span>{{$master_sekolah->no_telp}}</span>
                            </li>
                            @endif
                            @if($master_sekolah->whatsapp)
                            <li class="d-flex align-items-center gap-3">
                                <i class="bi bi-whatsapp text-custom-green fs-5 lh-1"></i>
                                <span>{{$master_sekolah->whatsapp}}</span>
                            </li>
                            @endif
                            @if($master_sekolah->instagram)
                            <li class="d-flex align-items-center gap-3">
                                <i class="bi bi-instagram text-custom-green fs-5 lh-1"></i>
                                <span>{{$master_sekolah->instagram}}</span>
                            </li>
                            @endif
                            @if($master_sekolah->youtube)
                            <li class="d-flex align-items-center gap-3">
                                <i class="bi bi-youtube text-custom-green fs-5 lh-1"></i>
                                <span>{{$master_sekolah->youtube}}</span>
                            </li>
                            @endif
                            @if($master_sekolah->facebook)
                            <li class="d-flex align-items-center gap-3">
                                <i class="bi bi-facebook text-custom-green fs-5 lh-1"></i>
                                <span>{{$master_sekolah->facebook}}</span>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>

                <!-- Kolom Kanan: Google Maps -->
                <div class="col-lg-7 animate-on-scroll">
                    <div class="card card-custom h-100 shadow-sm p-2 rounded-4 overflow-hidden">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.32614135991!2d106.8534687!3d-6.220654!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3861dbad71f%3A0x1632ae98669f654c!2sSekolah%20Menengah%20Atas%20Islam%20As-Syafi'iyah%2001!5e0!3m2!1sid!2sid!4v1787720650330!5m2!1sid!2sid"
                            width="100%"
                            height="100%"
                            style="border:0; min-height: 350px; border-radius: 0.75rem;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
