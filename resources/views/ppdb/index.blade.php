@extends('template.app')

@section('title', 'PPDB | SMA Islam As-Syafi\'iyah 01')

@section('content')

    {{-- ============================================================
        HERO
    ============================================================ --}}
    <section class="py-5 bg-custom-green text-white">
        <div class="container py-4">

            <div class="text-center">

                <span class="badge bg-white text-custom-green rounded-pill px-3 py-2 mb-3">
                    <i class="bi bi-mortarboard-fill me-1"></i>
                    Penerimaan Peserta Didik Baru
                </span>

                <h1 class="display-5 fw-bold mb-3">
                    Formulir PPDB
                </h1>

                <p class="lead mb-0 opacity-75">
                    Silakan lengkapi data calon siswa dengan benar.
                </p>

            </div>

        </div>
    </section>


    {{-- ============================================================
        FORM
    ============================================================ --}}
    <section class="py-5">

        <div class="container">

            {{-- Error --}}
            @if ($errors->any())

                <div class="alert alert-danger rounded-4 mb-4">

                    <div class="fw-bold mb-2">
                        <i class="bi bi-exclamation-triangle me-1"></i>
                        Terdapat kesalahan:
                    </div>

                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>

                </div>

            @endif


            <form action="{{ route('ppdb.store') }}"
                  method="POST">

                @csrf


                {{-- ====================================================
                    A. DATA CALON SISWA
                ==================================================== --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4">

                    <div class="card-header bg-custom-green text-white p-4 border-0">

                        <h4 class="mb-1 fw-bold">
                            <i class="bi bi-person-vcard me-2"></i>
                            A. Data Calon Siswa
                        </h4>

                        <small class="opacity-75">
                            Lengkapi identitas calon siswa.
                        </small>

                    </div>


                    <div class="card-body p-4">

                        <div class="row g-3">

                            {{-- Nama --}}
                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Nama Lengkap Calon Siswa
                                    <span class="text-danger">*</span>
                                </label>

                                <input type="text"
                                       name="nama_lengkap"
                                       class="form-control"
                                       value="{{ old('nama_lengkap') }}"
                                       placeholder="Masukkan nama lengkap"
                                       required>

                            </div>


                            {{-- Tempat Lahir --}}
                            <div class="col-md-3">

                                <label class="form-label fw-semibold">
                                    Tempat Lahir
                                    <span class="text-danger">*</span>
                                </label>

                                <input type="text"
                                       name="tempat_lahir"
                                       class="form-control"
                                       value="{{ old('tempat_lahir') }}"
                                       placeholder="Contoh: Jakarta"
                                       required>

                            </div>


                            {{-- Tanggal Lahir --}}
                            <div class="col-md-3">

                                <label class="form-label fw-semibold">
                                    Tanggal Lahir
                                    <span class="text-danger">*</span>
                                </label>

                                <input type="date"
                                       name="tanggal_lahir"
                                       class="form-control"
                                       value="{{ old('tanggal_lahir') }}"
                                       required>

                            </div>


                            {{-- Jenis Kelamin --}}
                            <div class="col-md-4">

                                <label class="form-label fw-semibold">
                                    Jenis Kelamin
                                    <span class="text-danger">*</span>
                                </label>

                                <select name="jenis_kelamin"
                                        class="form-select select2"
                                        required>

                                    <option value="">
                                        Pilih Jenis Kelamin
                                    </option>

                                    <option value="Laki-laki"
                                        {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>
                                        Laki-laki
                                    </option>

                                    <option value="Perempuan"
                                        {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                                        Perempuan
                                    </option>

                                </select>

                            </div>


                            {{-- Kondisi Fisik --}}
                            <div class="col-md-8">

                                <label class="form-label fw-semibold">
                                    Kondisi Fisik
                                </label>

                                <input type="text"
                                       name="kondisi_fisik"
                                       class="form-control"
                                       value="{{ old('kondisi_fisik') }}"
                                       placeholder="Baik / Berkebutuhan Khusus / Gangguan ...">

                            </div>


                            {{-- NIK --}}
                            <div class="col-md-4">

                                <label class="form-label fw-semibold">
                                    Nomor Induk Kependudukan (NIK)
                                    <span class="text-danger">*</span>
                                </label>

                                <input type="text"
                                       name="nik"
                                       class="form-control"
                                       value="{{ old('nik') }}"
                                       maxlength="16"
                                       inputmode="numeric"
                                       placeholder="16 digit NIK"
                                       required>

                            </div>


                            {{-- Akta --}}
                            <div class="col-md-4">

                                <label class="form-label fw-semibold">
                                    Nomor Akta Kelahiran
                                </label>

                                <input type="text"
                                       name="nomor_akta_kelahiran"
                                       class="form-control"
                                       value="{{ old('nomor_akta_kelahiran') }}"
                                       placeholder="Nomor akta kelahiran">

                            </div>


                            {{-- HP --}}
                            <div class="col-md-4">

                                <label class="form-label fw-semibold">
                                    Nomor HP / WhatsApp
                                    <span class="text-danger">*</span>
                                </label>

                                <input type="text"
                                       name="no_hp_wa"
                                       class="form-control"
                                       value="{{ old('no_hp_wa') }}"
                                       placeholder="08xxxxxxxxxx"
                                       required>

                            </div>


                            {{-- Alamat --}}
                            <div class="col-12">

                                <label class="form-label fw-semibold">
                                    Alamat
                                    <span class="text-danger">*</span>
                                </label>

                                <textarea name="alamat"
                                          class="form-control"
                                          rows="3"
                                          placeholder="Alamat lengkap calon siswa"
                                          required>{{ old('alamat') }}</textarea>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- ====================================================
                    B. DATA PENDIDIKAN
                ==================================================== --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4">

                    <div class="card-header bg-custom-green text-white p-4 border-0">

                        <h4 class="mb-1 fw-bold">
                            <i class="bi bi-building me-2"></i>
                            B. Data Pendidikan
                        </h4>

                        <small class="opacity-75">
                            Informasi pendidikan sebelumnya.
                        </small>

                    </div>


                    <div class="card-body p-4">

                        <div class="row g-3">

                            {{-- Sekolah --}}
                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Sekolah Asal
                                    <span class="text-danger">*</span>
                                </label>

                                <input type="text"
                                       name="sekolah_asal"
                                       class="form-control"
                                       value="{{ old('sekolah_asal') }}"
                                       placeholder="Nama sekolah asal"
                                       required>

                            </div>


                            {{-- NISN --}}
                            <div class="col-md-3">

                                <label class="form-label fw-semibold">
                                    NISN
                                </label>

                                <input type="text"
                                       name="nisn"
                                       class="form-control"
                                       value="{{ old('nisn') }}"
                                       maxlength="10"
                                       inputmode="numeric"
                                       placeholder="10 digit NISN">

                            </div>


                            {{-- Mendaftar --}}
                            <div class="col-md-3">

                                <label class="form-label fw-semibold">
                                    Mendaftar Sebagai
                                    <span class="text-danger">*</span>
                                </label>

                                <select name="mendaftar_sebagai"
                                        class="form-select select2"
                                        required>

                                    <option value="">
                                        Pilih
                                    </option>

                                    <option value="Siswa Baru"
                                        {{ old('mendaftar_sebagai') == 'Siswa Baru' ? 'selected' : '' }}>
                                        Siswa Baru
                                    </option>

                                    <option value="Siswa Mutasi"
                                        {{ old('mendaftar_sebagai') == 'Siswa Mutasi' ? 'selected' : '' }}>
                                        Siswa Mutasi
                                    </option>

                                    <option value="Lainnya"
                                        {{ old('mendaftar_sebagai') == 'Lainnya' ? 'selected' : '' }}>
                                        Lainnya
                                    </option>

                                </select>

                            </div>


                            {{-- Alamat Sekolah --}}
                            <div class="col-md-8">

                                <label class="form-label fw-semibold">
                                    Alamat Sekolah Asal
                                    <span class="text-danger">*</span>
                                </label>

                                <textarea name="alamat_sekolah_asal"
                                          class="form-control"
                                          rows="3"
                                          placeholder="Nama Sekolah, Kecamatan, Kelurahan, Kota, Provinsi"
                                          required>{{ old('alamat_sekolah_asal') }}</textarea>

                            </div>


                            {{-- Ijazah --}}
                            <div class="col-md-4">

                                <label class="form-label fw-semibold">
                                    Nomor Ijazah
                                </label>

                                <input type="text"
                                       name="nomor_ijazah"
                                       class="form-control"
                                       value="{{ old('nomor_ijazah') }}"
                                       placeholder="Nomor ijazah">

                            </div>

                        </div>

                    </div>

                </div>


                {{-- ====================================================
                    C. DATA ORANG TUA / WALI
                ==================================================== --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4">

                    <div class="card-header bg-custom-green text-white p-4 border-0">

                        <h4 class="mb-1 fw-bold">
                            <i class="bi bi-people-fill me-2"></i>
                            C. Data Orang Tua / Wali
                        </h4>

                        <small class="opacity-75">
                            Lengkapi informasi orang tua atau wali calon siswa.
                        </small>

                    </div>


                    <div class="card-body p-4">

                        <div class="row g-4">

                            {{-- =================================================
                                AYAH
                            ================================================== --}}
                            <div class="col-lg-4">

                                <div class="border rounded-4 p-4 h-100">

                                    <h5 class="fw-bold text-custom-green mb-4">
                                        <i class="bi bi-person me-2"></i>
                                        Data Ayah
                                    </h5>


                                    <div class="mb-3">

                                        <label class="form-label fw-semibold">
                                            Nama Ayah
                                        </label>

                                        <input type="text"
                                               name="nama_ayah"
                                               class="form-control"
                                               value="{{ old('nama_ayah') }}">

                                    </div>


                                    <div class="mb-3">

                                        <label class="form-label fw-semibold">
                                            NIK Ayah
                                        </label>

                                        <input type="text"
                                               name="nik_ayah"
                                               class="form-control"
                                               value="{{ old('nik_ayah') }}"
                                               maxlength="16"
                                               inputmode="numeric">

                                    </div>


                                    <div class="mb-3">

                                        <label class="form-label fw-semibold">
                                            No. HP / WA
                                        </label>

                                        <input type="text"
                                               name="no_hp_wa_ayah"
                                               class="form-control"
                                               value="{{ old('no_hp_wa_ayah') }}">

                                    </div>


                                    <div class="mb-3">

                                        <label class="form-label fw-semibold">
                                            Pekerjaan
                                        </label>

                                        <input type="text"
                                               name="pekerjaan_ayah"
                                               class="form-control"
                                               value="{{ old('pekerjaan_ayah') }}">

                                    </div>


                                    <div class="mb-3">

                                        <label class="form-label fw-semibold">
                                            Pendidikan
                                        </label>

                                        <input type="text"
                                               name="pendidikan_ayah"
                                               class="form-control"
                                               value="{{ old('pendidikan_ayah') }}">

                                    </div>


                                    <div>

                                        <label class="form-label fw-semibold">
                                            Alamat Tinggal
                                        </label>

                                        <textarea name="alamat_tinggal_ayah"
                                                  class="form-control"
                                                  rows="3">{{ old('alamat_tinggal_ayah') }}</textarea>

                                    </div>

                                </div>

                            </div>


                            {{-- =================================================
                                IBU
                            ================================================== --}}
                            <div class="col-lg-4">

                                <div class="border rounded-4 p-4 h-100">

                                    <h5 class="fw-bold text-custom-green mb-4">
                                        <i class="bi bi-person me-2"></i>
                                        Data Ibu
                                    </h5>


                                    <div class="mb-3">

                                        <label class="form-label fw-semibold">
                                            Nama Ibu
                                        </label>

                                        <input type="text"
                                               name="nama_ibu"
                                               class="form-control"
                                               value="{{ old('nama_ibu') }}">

                                    </div>


                                    <div class="mb-3">

                                        <label class="form-label fw-semibold">
                                            NIK Ibu
                                        </label>

                                        <input type="text"
                                               name="nik_ibu"
                                               class="form-control"
                                               value="{{ old('nik_ibu') }}"
                                               maxlength="16"
                                               inputmode="numeric">

                                    </div>


                                    <div class="mb-3">

                                        <label class="form-label fw-semibold">
                                            No. HP / WA
                                        </label>

                                        <input type="text"
                                               name="no_hp_wa_ibu"
                                               class="form-control"
                                               value="{{ old('no_hp_wa_ibu') }}">

                                    </div>


                                    <div class="mb-3">

                                        <label class="form-label fw-semibold">
                                            Pekerjaan
                                        </label>

                                        <input type="text"
                                               name="pekerjaan_ibu"
                                               class="form-control"
                                               value="{{ old('pekerjaan_ibu') }}">

                                    </div>


                                    <div class="mb-3">

                                        <label class="form-label fw-semibold">
                                            Pendidikan
                                        </label>

                                        <input type="text"
                                               name="pendidikan_ibu"
                                               class="form-control"
                                               value="{{ old('pendidikan_ibu') }}">

                                    </div>


                                    <div>

                                        <label class="form-label fw-semibold">
                                            Alamat Tinggal
                                        </label>

                                        <textarea name="alamat_tinggal_ibu"
                                                  class="form-control"
                                                  rows="3">{{ old('alamat_tinggal_ibu') }}</textarea>

                                    </div>

                                </div>

                            </div>


                            {{-- =================================================
                                WALI
                            ================================================== --}}
                            <div class="col-lg-4">

                                <div class="border rounded-4 p-4 h-100">

                                    <h5 class="fw-bold text-custom-green mb-4">
                                        <i class="bi bi-person-badge me-2"></i>
                                        Data Wali
                                    </h5>


                                    <div class="mb-3">

                                        <label class="form-label fw-semibold">
                                            Nama Wali
                                        </label>

                                        <input type="text"
                                               name="nama_wali"
                                               class="form-control"
                                               value="{{ old('nama_wali') }}">

                                    </div>


                                    <div class="mb-3">

                                        <label class="form-label fw-semibold">
                                            NIK Wali
                                        </label>

                                        <input type="text"
                                               name="nik_wali"
                                               class="form-control"
                                               value="{{ old('nik_wali') }}"
                                               maxlength="16"
                                               inputmode="numeric">

                                    </div>


                                    <div class="mb-3">

                                        <label class="form-label fw-semibold">
                                            No. HP / WA
                                        </label>

                                        <input type="text"
                                               name="no_hp_wa_wali"
                                               class="form-control"
                                               value="{{ old('no_hp_wa_wali') }}">

                                    </div>


                                    <div class="mb-3">

                                        <label class="form-label fw-semibold">
                                            Pekerjaan
                                        </label>

                                        <input type="text"
                                               name="pekerjaan_wali"
                                               class="form-control"
                                               value="{{ old('pekerjaan_wali') }}">

                                    </div>


                                    <div class="mb-3">

                                        <label class="form-label fw-semibold">
                                            Pendidikan
                                        </label>

                                        <input type="text"
                                               name="pendidikan_wali"
                                               class="form-control"
                                               value="{{ old('pendidikan_wali') }}">

                                    </div>


                                    <div>

                                        <label class="form-label fw-semibold">
                                            Alamat Tinggal
                                        </label>

                                        <textarea name="alamat_tinggal_wali"
                                                  class="form-control"
                                                  rows="3">{{ old('alamat_tinggal_wali') }}</textarea>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- ====================================================
                    PERSETUJUAN
                ==================================================== --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4">

                    <div class="card-body p-4">

                        <div class="form-check">

                            <input class="form-check-input"
                                   type="checkbox"
                                   id="persetujuan"
                                   required>

                            <label class="form-check-label"
                                   for="persetujuan">

                                Saya menyatakan bahwa data yang saya isi
                                adalah benar dan dapat dipertanggungjawabkan.

                            </label>

                        </div>

                    </div>

                </div>


                {{-- ====================================================
                    BUTTON
                ==================================================== --}}
                <div class="text-center">

                    <button type="submit"
                            class="btn btn-custom-green btn-lg rounded-pill px-5">

                        <i class="bi bi-send me-2"></i>
                        Kirim Pendaftaran

                    </button>

                </div>

            </form>

        </div>

    </section>

@endsection


{{-- ================================================================
    SELECT2
================================================================ --}}
@push('scripts')

    <script>
        $(document).ready(function () {

            $('.select2').select2({
                theme: 'bootstrap-5',
                width: '100%',
                placeholder: 'Pilih...',
                allowClear: true
            });

        });
    </script>

@endpush
