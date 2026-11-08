<!DOCTYPE html>
<html lang="id" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin | SMA Islam As-Syafi'iyah 01</title>

    <!-- Favicon / Logo pada Tab Browser -->
    <link rel="icon" type="image/png" href="{{ asset('images/Logo.png') }}">

    <!-- Bootstrap 5.3 CSS CDN -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body class="bg-body text-body d-flex align-items-center justify-content-center" style="min-height: 100vh;">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5 col-lg-4">
            <div class="card card-custom shadow-sm p-4 rounded-4 border">
                <div class="card-body">

                    <!-- Logo & Judul -->
                    <div class="text-center mb-4">
                        <img src="{{ asset('images/' . $master_sekolah->logo) }}" alt="Logo" width="70" class="mb-2">
                        <h3 class="fw-bold text-custom-green">CMS Admin Login</h3>
                        <p class="text-body-secondary small">{{$master_sekolah->nama}}</p>
                    </div>

                    <!-- Tampilkan Error Jika Ada -->
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show small" role="alert">
                            {{ $errors->first() }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Form Login -->
                    <form action="{{ url('/login') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label small fw-bold">Alamat Email</label>
                            <div class="input-group">
                                <span class="input-group-text bg-body text-body-secondary"><i class="bi bi-envelope-fill"></i></span>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="admin@smaislamassyafiiyah01.sch.id">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label small fw-bold">Kata Sandi (Password)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-body text-body-secondary"><i class="bi bi-lock-fill"></i></span>
                                <!-- Tambahkan id="password" dan pastikan tipenya type="password" -->
                                <input type="password" class="form-control" id="password" name="password" required placeholder="••••••••">
                                <!-- Tombol untuk Toggle Show/Hide -->
                                <button class="btn btn-outline-secondary border" type="button" id="togglePassword">
                                    <i class="bi bi-eye-slash" id="eyeIcon"></i>
                                </button>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-custom-green text-dark fw-bold py-2 rounded-pill shadow-sm">
                                Masuk ke Sistem
                            </button>
                        </div>
                    </form>

                    <div class="text-center mt-4">
                        <a href="{{ url('/') }}" class="text-decoration-none small text-body-secondary">
                            &larr; Kembali ke Beranda Website
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap 5.3 JS Bundle -->
<script src="{{ asset('assets/js/jquery-4.0.0.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#togglePassword').click(function() {
            const passwordInput = $('#password');
            const eyeIcon = $('#eyeIcon');

            // Cek tipe input saat ini
            if (passwordInput.attr('type') === 'password') {
                passwordInput.attr('type', 'text');
                eyeIcon.removeClass('bi-eye-slash').addClass('bi-eye'); // Ubah ikon jadi mata terbuka
            } else {
                passwordInput.attr('type', 'password');
                eyeIcon.removeClass('bi-eye').addClass('bi-eye-slash'); // Ubah ikon jadi mata tercoret
            }
        });
    });
</script>
</body>
</html>
