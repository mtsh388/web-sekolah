@extends('admin.template.admin')

@section('title', "Profile Sekolah | Dashboard")

@section('content-admin')
    <!-- Pickr Classic Theme CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/classic.min.css"/>

    <!--begin::App Content Header-->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0 fs-3">Profile Sekolah</h1>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Profile Sekolah</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Kelola Data</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!--end::App Content Header-->

    <!--begin::App Content-->
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-custom shadow-sm border-0 rounded-4 mb-4">
                        <div class="card-header bg-custom-green text-white py-3 rounded-top-4">
                            <h5 class="mb-0 fw-bold"><i class="bi bi-building-gear me-2"></i> Form Kelola Data Profil Sekolah</h5>
                        </div>
                        <div class="card-body p-4">

                            <!-- Notifikasi Sukses -->
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <!-- Alert Error Global -->
                            @if($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <ul class="mb-0">
                                        <li>Terdapat kesalahan pengisian, silakan periksa form di bawah.</li>
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <!-- Form Input -->
                            <form action="{{ route('admin.dashboard.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row g-3">
                                    <!-- Nama Sekolah -->
                                    <div class="col-md-6">
                                        <label for="nama" class="form-label fw-bold">Nama Sekolah <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $sekolah->nama ?? '') }}" required placeholder="Contoh: SMA Islam As-Syafi'iyah 01">
                                        @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- No Telepon -->
                                    <div class="col-md-6">
                                        <label for="no_telp" class="form-label fw-bold">No. Telepon</label>
                                        <input type="text" class="form-control @error('no_telp') is-invalid @enderror" id="no_telp" name="no_telp" value="{{ old('no_telp', $sekolah->no_telp ?? '') }}" placeholder="Contoh: 081285870177">
                                        @error('no_telp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Alamat -->
                                    <div class="col-md-12">
                                        <label for="alamat" class="form-label fw-bold">Alamat Lengkap <span class="text-danger">*</span></label>
                                        <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3" required placeholder="Masukkan alamat lengkap sekolah...">{{ old('alamat', $sekolah->alamat ?? '') }}</textarea>
                                        @error('alamat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Email -->
                                    <div class="col-md-4">
                                        <label for="email" class="form-label fw-bold">Email Sekolah</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $sekolah->email ?? '') }}" placeholder="admin@sekolah.sch.id">
                                        @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- WhatsApp -->
                                    <div class="col-md-4">
                                        <label for="whatsapp" class="form-label fw-bold">No. WhatsApp</label>
                                        <input type="text" class="form-control @error('whatsapp') is-invalid @enderror" id="whatsapp" name="whatsapp" value="{{ old('whatsapp', $sekolah->whatsapp ?? '') }}" placeholder="Contoh: 081285870177">
                                        @error('whatsapp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Logo -->
                                    <div class="col-md-4">
                                        <label for="logo" class="form-label fw-bold">Upload Logo Sekolah</label>

                                        @if(isset($sekolah) && $sekolah->logo)
                                            <div class="mb-2">
                                                <img src="{{ asset('images/' . $sekolah->logo) }}" alt="Logo Tersimpan" class="img-thumbnail rounded" style="max-height: 80px;">
                                            </div>
                                        @endif

                                        <input type="file" class="form-control @error('logo') is-invalid @enderror" id="logo" name="logo" accept="image/*">
                                        <small class="text-muted d-block mt-1">Format: PNG, JPG (Maks. 2MB). Biarkan kosong jika tidak ingin mengubah.</small>
                                        @error('logo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Instagram -->
                                    <div class="col-md-4">
                                        <label for="instagram" class="form-label fw-bold">Instagram (Username / Link)</label>
                                        <input type="text" class="form-control @error('instagram') is-invalid @enderror" id="instagram" name="instagram" value="{{ old('instagram', $sekolah->instagram ?? '') }}" placeholder="@smaislamassyafiiyah01">
                                        @error('instagram')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- YouTube -->
                                    <div class="col-md-4">
                                        <label for="youtube" class="form-label fw-bold">YouTube (Channel / Link)</label>
                                        <input type="text" class="form-control @error('youtube') is-invalid @enderror" id="youtube" name="youtube" value="{{ old('youtube', $sekolah->youtube ?? '') }}" placeholder="Nama Channel / Link YouTube">
                                        @error('youtube')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- TikTok -->
                                    <div class="col-md-4">
                                        <label for="tiktok" class="form-label fw-bold">TikTok (Username / Link)</label>
                                        <input type="text" class="form-control @error('tiktok') is-invalid @enderror" id="tiktok" name="tiktok" value="{{ old('tiktok', $sekolah->tiktok ?? '') }}" placeholder="@smaislamassyafiiyah01">
                                        @error('tiktok')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Warna Utama -->
                                    <div class="col-md-6">
                                        <label for="warna_utama" class="form-label fw-bold">Warna Utama Tema</label>
                                        <div class="d-flex gap-3 align-items-center">
                                            <!-- Elemen untuk merender Pickr -->
                                            <div id="pickr-utama"></div>

                                            <!-- Input Tersembunyi untuk menyimpan data ke database -->
                                            <input type="hidden" id="warna_utama" name="warna_utama" value="{{ old('warna_utama', $sekolah->warna_utama ?? '#0b4d26') }}">

                                            <span class="text-muted small">Pilih warna dominan (contoh: Hijau Tua).</span>
                                        </div>
                                        @error('warna_utama')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Warna Kedua -->
                                    <div class="col-md-6">
                                        <label for="warna_kedua" class="form-label fw-bold">Warna Kedua Tema (Aksen)</label>
                                        <div class="d-flex gap-3 align-items-center">
                                            <!-- Elemen untuk merender Pickr -->
                                            <div id="pickr-kedua"></div>

                                            <!-- Input Tersembunyi untuk menyimpan data ke database -->
                                            <input type="hidden" id="warna_kedua" name="warna_kedua" value="{{ old('warna_kedua', $sekolah->warna_kedua ?? '#f7ca18') }}">

                                            <span class="text-muted small">Pilih warna aksen/sekunder (contoh: Kuning).</span>
                                        </div>
                                        @error('warna_kedua')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Link Google Maps -->
                                    <div class="col-md-12">
                                        <label for="link_gmap" class="form-label fw-bold">Embed Link Google Maps (Iframe URL / Source)</label>
                                        <textarea class="form-control mb-2 @error('link_gmap') is-invalid @enderror" id="link_gmap" name="link_gmap" rows="3" placeholder="https://www.google.com/maps/embed?pb=...">{{ old('link_gmap', $sekolah->link_gmap ?? '') }}</textarea>

                                        @error('link_gmap')
                                        <div class="invalid-feedback mb-2">{{ $message }}</div>
                                        @enderror

                                        @if(isset($sekolah) && $sekolah->link_gmap)
                                            <div class="card bg-light border-0 shadow-sm mt-3">
                                                <div class="card-body p-2 text-center">
                                                    <span class="badge bg-secondary mb-2">Preview Peta Saat Ini</span>
                                                    <div class="w-100 overflow-hidden rounded" style="height: 250px;">
                                                        <iframe src="{{ $sekolah->link_gmap }}" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <small class="text-muted d-block mt-1">Masukkan tautan URL embed dari Google Maps (hanya bagian `src="..."`).</small>
                                    </div>
                                </div>

                                <!-- Tombol Aksi -->
                                <div class="d-flex justify-content-end gap-2 mt-4">
                                    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary px-4 rounded-pill">Batal</a>
                                    <button type="submit" class="btn btn-custom-green text-white px-4 rounded-pill fw-bold">Simpan Perubahan</button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::App Content-->

    <!-- Pickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/pickr.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Pengaturan Umum Pickr
            const pickrConfig = {
                theme: 'classic',
                components: {
                    preview: true,
                    opacity: false, // Dimatikan agar fokus ke warna HEX murni
                    hue: true,
                    interaction: {
                        hex: true,
                        input: true,
                        clear: false,
                        save: true
                    }
                },
                strings: {
                    save: 'Terapkan Warna'
                }
            };

            // 1. Inisialisasi Pickr Warna Utama
            const inputUtama = document.getElementById('warna_utama');
            const pickrUtama = Pickr.create({
                el: '#pickr-utama',
                default: inputUtama.value || '#0b4d26', // Ambil warna dari value input hidden
                ...pickrConfig
            });

            // Saat tombol 'Terapkan Warna' diklik
            pickrUtama.on('save', (color, instance) => {
                inputUtama.value = color.toHEXA().toString(); // Simpan HEX ke input hidden
                instance.hide(); // Tutup palet
            });

            // 2. Inisialisasi Pickr Warna Kedua
            const inputKedua = document.getElementById('warna_kedua');
            const pickrKedua = Pickr.create({
                el: '#pickr-kedua',
                default: inputKedua.value || '#f7ca18',
                ...pickrConfig
            });

            // Saat tombol 'Terapkan Warna' diklik
            pickrKedua.on('save', (color, instance) => {
                inputKedua.value = color.toHEXA().toString();
                instance.hide();
            });
        });
    </script>
@endsection
