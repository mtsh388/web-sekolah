<!DOCTYPE html>
<html lang="id" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', '')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/Logo.png') }}">
    <!-- Bootstrap 5.3 CSS CDN -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-icons.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('assets/css/fontawesome.all.min.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css"
          rel="stylesheet">


    <style>
        :root {
            --primary-green: {{ $master_sekolah->warna_utama }};
            --primary-yellow: {{$master_sekolah->warna_kedua}};
            --text-green: {{$master_sekolah->warna_utama}}; /* Hijau gelap untuk teks di light mode */
            --card-shadow: rgba(0,0,0,0.1);
        }
        /* Warna Khusus Mengikuti Logo */
        .text-custom-green { color: var(--text-green) !important; }
        .bg-custom-green { background-color: var(--primary-green) !important; }
        .btn-custom-yellow {
            background-color: var(--primary-yellow);
            color: var(--primary-green) !important;
            font-weight: bold;
        }
        .btn-custom-yellow:hover {
            background-color: var(--primary-yellow) !important;
            color: var(--primary-green) !important;
            transform: translateY(-3px);
            transition: all 0.3s ease;
        }

    </style>
</head>
<body class="bg-body text-body">
<script src="{{ asset('assets/js/jquery-4.0.0.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<div id="preloader" class="preloader-container bg-body flex-column">
    <img src="{{ asset('images/' . $master_sekolah->logo) }}" alt="Loading Logo" class="preloader-logo mb-2">
    <span id="preloader-percentage" class="fw-bold fs-4 text-custom-green">0%</span>
</div>
<!-- Navbar Bootstrap -->
<!-- Menggunakan bg-body agar otomatis menjadi gelap/terang -->
@include('template.navigation')

<main>
@yield('content')
</main>
<!-- Section Kontak & Peta Lokasi -->

<!-- Footer Modern & Informatif -->
<footer class="bg-custom-green text-white pt-5 pb-3 mt-5">
    <div class="container">
        <div class="row g-4 mb-4">

            <!-- Kolom 1: Profil Singkat & Logo -->
            <div class="col-lg-4 col-md-6">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <img src="{{ asset('images/' . $master_sekolah->logo) }}" alt="Logo SMA Islam As-Syafi'iyah 01" width="50" height="50">
                    <h5 class="fw-bold mb-0 text-white">{{$master_sekolah->nama}}</h5>
                </div>
                <p class="text-white-50 small mb-3">
                    Membentuk generasi penerus bangsa yang cerdas, berakhlakul karimah, unggul dalam prestasi, dan berwawasan global berlandaskan nilai-nilai Islam.
                </p>
                <div class="d-flex gap-2">
                    <a
                        href="https://wa.me/{{ '62' . ltrim($master_sekolah->whatsapp, '0') }}"
                        class="btn btn-outline-light btn-sm rounded-circle d-flex align-items-center justify-content-center"
                        style="width: 35px; height: 35px;"
                        title="WhatsApp"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        <i class="bi bi-whatsapp"></i>
                    </a>

                    <a
                        href="{{ $master_sekolah->facebook }}"
                        class="btn btn-outline-light btn-sm rounded-circle d-flex align-items-center justify-content-center"
                        style="width: 35px; height: 35px;"
                        title="Facebook"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        <i class="bi bi-facebook"></i>
                    </a>

                    <a
                        href="{{ $master_sekolah->instagram }}"
                        class="btn btn-outline-light btn-sm rounded-circle d-flex align-items-center justify-content-center"
                        style="width: 35px; height: 35px;"
                        title="Instagram"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        <i class="bi bi-instagram"></i>
                    </a>

                    <a
                        href="{{ $master_sekolah->youtube }}"
                        class="btn btn-outline-light btn-sm rounded-circle d-flex align-items-center justify-content-center"
                        style="width: 35px; height: 35px;"
                        title="YouTube"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        <i class="bi bi-youtube"></i>
                    </a>

                    <a
                        href="mailto:{{ $master_sekolah->email }}"
                        class="btn btn-outline-light btn-sm rounded-circle d-flex align-items-center justify-content-center"
                        style="width: 35px; height: 35px;"
                        title="Email"
                    >
                        <i class="bi bi-envelope-fill"></i>
                    </a>
                </div>
            </div>

            <!-- Kolom 2: Tautan Cepat (Quick Links) -->
            <div class="col-lg-2 col-md-6">
                <h6 class="fw-bold text-uppercase mb-3 text-warning">Tautan Cepat</h6>
                <ul class="list-unstyled d-flex flex-column gap-2 small">
                    <li><a href="{{ url('/') }}" class="text-white-50 text-decoration-none hover-link">Beranda</a></li>
                    <li><a href="{{ url('profil/sejarah') }}" class="text-white-50 text-decoration-none hover-link">Sejarah Sekolah</a></li>
                    <li><a href="{{ url('profil/visi-misi') }}" class="text-white-50 text-decoration-none hover-link">Visi & Misi</a></li>
                    <li><a href="{{ url('akademik') }}" class="text-white-50 text-decoration-none hover-link">Akademik</a></li>
                    <li><a href="{{ url('fasilitas') }}" class="text-white-50 text-decoration-none hover-link">Fasilitas</a></li>
                </ul>
            </div>

            <!-- Kolom 3: Layanan & Informasi -->
            <div class="col-lg-2 col-md-6">
                <h6 class="fw-bold text-uppercase mb-3 text-warning">Kesiswaan</h6>
                <ul class="list-unstyled d-flex flex-column gap-2 small">
                    <li><a href="#" class="text-white-50 text-decoration-none hover-link">Ekstrakurikuler</a></li>
                    <li><a href="#" class="text-white-50 text-decoration-none hover-link">Prestasi Siswa</a></li>
                    <li><a href="#" class="text-white-50 text-decoration-none hover-link">PPDB 2026/2027</a></li>
                    <li><a href="#" class="text-white-50 text-decoration-none hover-link">Kalender Akademik</a></li>
                </ul>
            </div>

            <!-- Kolom 4: Kontak & Alamat -->
            <div class="col-lg-4 col-md-6">
                <h6 class="fw-bold text-uppercase mb-3 text-warning">Hubungi Kami</h6>
                <ul class="list-unstyled d-flex flex-column gap-3 small text-white-50">
                    @if($master_sekolah->alamat)
                    <li class="d-flex align-items-start gap-2">
                        <i class="bi bi-geo-alt-fill text-warning fs-5 lh-1"></i>
                        <span>{{$master_sekolah->alamat}}</span>
                    </li>
                    @endif
                    @if($master_sekolah->no_telp)
                    <li class="d-flex align-items-center gap-2">
                        <i class="bi bi-telephone-fill text-warning fs-5 lh-1"></i>
                        <span>{{$master_sekolah->no_telp}}</span>
                    </li>
                    @endif
                    @if($master_sekolah->whatsapp)
                    <li class="d-flex align-items-center gap-2">
                        <i class="bi bi-whatsapp text-warning fs-5 lh-1"></i>
                        <span>{{$master_sekolah->whatsapp}}</span>
                    </li>
                    @endif
                    @if($master_sekolah->email)
                    <li class="d-flex align-items-center gap-2">
                        <i class="bi bi-envelope text-warning fs-5 lh-1"></i>
                        <span>{{$master_sekolah->email}}</span>
                    </li>
                    @endif
                    @if($master_sekolah->instagram)
                    <li class="d-flex align-items-center gap-2">
                        <i class="bi bi-instagram text-warning fs-5 lh-1"></i>
                        <span>{{$master_sekolah->instagram}}</span>
                    </li>
                    @endif
                    @if($master_sekolah->youtube)
                    <li class="d-flex align-items-center gap-2">
                        <i class="bi bi-youtube text-warning fs-5 lh-1"></i>
                        <span>{{$master_sekolah->youtube}}</span>
                    </li>
                    @endif
                    @if($master_sekolah->facebook)
                    <li class="d-flex align-items-center gap-2">
                        <i class="bi bi-facebook text-warning fs-5 lh-1"></i>
                        <span>{{$master_sekolah->facebook}}</span>
                    </li>
                    @endif
                </ul>
            </div>

        </div>

        <!-- Garis Pemisah & Copyright -->
        <hr class="border-light opacity-25 my-4">
        <div class="row align-items-center">
            <div class="col-md-12 text-center">
                <p class="mb-0 small text-white-50">&copy; 2026 {{$master_sekolah->nama}}. Hak Cipta Dilindungi.</p>
            </div>
        </div>
    </div>
</footer>
<a href="https://wa.me/6281234567890?text=Halo%20SMA%20Islam%20As-Syafi'iyah%2001%20Jakarta,%20saya%20ingin%20bertanya..."
   id="whatsappBtn"
   class="btn btn-success rounded-circle shadow d-flex align-items-center justify-content-center"
   target="_blank"
   title="Hubungi Kami via WhatsApp">
    <i class="bi bi-whatsapp fs-4"></i>
</a>
<button id="backToTopBtn" class="btn btn-custom-green text-dark rounded-circle shadow" title="Kembali ke atas">
    <i class="bi bi-arrow-up"></i>
</button>

<!-- Bootstrap 5.3 JS Bundle -->
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

<!-- Script Animasi Scroll & Logika Dark/Light Mode -->
<script src="{{ asset('assets/js/script.js') }}"></script>
<script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'id', // Bahasa asli website (Indonesia)
            includedLanguages: 'en,id,ar', // Pilihan bahasa (Inggris, Indonesia, Arab)
            layout: google.translate.TranslateElement.InlineLayout.SIMPLE
        }, 'google_translate_element');
    }
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</body>
</html>
