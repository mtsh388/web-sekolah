@extends('admin.template.admin')

@section('title', 'PPDB')

@section('content-admin')

    <div class="container-fluid">

        {{-- ============================================================
            HEADER
        ============================================================ --}}
        <div class="app-content-header">

            <div class="container-fluid mt-3">

                <div class="row">

                    <div class="col-sm-6">

                        <h1 class="mb-0 fs-3">
                            PPDB
                        </h1>

                    </div>

                    <div class="col-sm-6">

                        <ol class="breadcrumb float-sm-end">

                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}">
                                    Dashboard
                                </a>
                            </li>

                            <li class="breadcrumb-item active">
                                PPDB
                            </li>

                        </ol>

                    </div>

                </div>

            </div>

        </div>


        {{-- ============================================================
            CONTENT
        ============================================================ --}}
        <div class="app-content">

            <div class="container-fluid">


                {{-- ====================================================
                    STATISTIK
                ==================================================== --}}
                <div class="row g-3 mb-4">

                    {{-- Total --}}
                    <div class="col-lg col-md-4 col-sm-6">

                        <div class="card border-0 shadow-sm h-100">

                            <div class="card-body">

                                <div class="d-flex align-items-center">

                                    <div
                                        class="rounded-circle d-flex align-items-center justify-content-center"
                                        style="
                                        width: 48px;
                                        height: 48px;
                                        background: rgba(0,131,84,.10);
                                        color: #008354;
                                    "
                                    >
                                        <i class="bi bi-people fs-5"></i>
                                    </div>

                                    <div class="ms-3">

                                        <div class="text-muted small">
                                            Total Pendaftar
                                        </div>

                                        <h4 class="mb-0 fw-bold">
                                            {{ number_format($totalPendaftar) }}
                                        </h4>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- Menunggu --}}
                    <div class="col-lg col-md-4 col-sm-6">

                        <div class="card border-0 shadow-sm h-100">

                            <div class="card-body">

                                <div class="d-flex align-items-center">

                                    <div
                                        class="rounded-circle d-flex align-items-center justify-content-center"
                                        style="
                                        width: 48px;
                                        height: 48px;
                                        background: rgba(255,193,7,.12);
                                        color: #d39e00;
                                    "
                                    >
                                        <i class="bi bi-clock-history fs-5"></i>
                                    </div>

                                    <div class="ms-3">

                                        <div class="text-muted small">
                                            Menunggu
                                        </div>

                                        <h4 class="mb-0 fw-bold">
                                            {{ number_format($totalMenunggu) }}
                                        </h4>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- Verifikasi --}}
                    <div class="col-lg col-md-4 col-sm-6">

                        <div class="card border-0 shadow-sm h-100">

                            <div class="card-body">

                                <div class="d-flex align-items-center">

                                    <div
                                        class="rounded-circle d-flex align-items-center justify-content-center"
                                        style="
                                        width: 48px;
                                        height: 48px;
                                        background: rgba(13,110,253,.10);
                                        color: #0d6efd;
                                    "
                                    >
                                        <i class="bi bi-shield-check fs-5"></i>
                                    </div>

                                    <div class="ms-3">

                                        <div class="text-muted small">
                                            Diverifikasi
                                        </div>

                                        <h4 class="mb-0 fw-bold">
                                            {{ number_format($totalDiverifikasi) }}
                                        </h4>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- Diterima --}}
                    <div class="col-lg col-md-4 col-sm-6">

                        <div class="card border-0 shadow-sm h-100">

                            <div class="card-body">

                                <div class="d-flex align-items-center">

                                    <div
                                        class="rounded-circle d-flex align-items-center justify-content-center"
                                        style="
                                        width: 48px;
                                        height: 48px;
                                        background: rgba(25,135,84,.10);
                                        color: #198754;
                                    "
                                    >
                                        <i class="bi bi-check-circle fs-5"></i>
                                    </div>

                                    <div class="ms-3">

                                        <div class="text-muted small">
                                            Diterima
                                        </div>

                                        <h4 class="mb-0 fw-bold">
                                            {{ number_format($totalDiterima) }}
                                        </h4>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- Ditolak --}}
                    <div class="col-lg col-md-4 col-sm-6">

                        <div class="card border-0 shadow-sm h-100">

                            <div class="card-body">

                                <div class="d-flex align-items-center">

                                    <div
                                        class="rounded-circle d-flex align-items-center justify-content-center"
                                        style="
                                        width: 48px;
                                        height: 48px;
                                        background: rgba(220,53,69,.10);
                                        color: #dc3545;
                                    "
                                    >
                                        <i class="bi bi-x-circle fs-5"></i>
                                    </div>

                                    <div class="ms-3">

                                        <div class="text-muted small">
                                            Ditolak
                                        </div>

                                        <h4 class="mb-0 fw-bold">
                                            {{ number_format($totalDitolak) }}
                                        </h4>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- ====================================================
                    DATA PPDB
                ==================================================== --}}
                <div class="card shadow-sm border-0">

                    {{-- Header --}}
                    <div class="card-header bg-body border-bottom">

                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">

                            <div>

                                <h5 class="mb-1 fw-bold">
                                    Data Pendaftar PPDB
                                </h5>

                                <small class="text-muted">
                                    Kelola dan pantau data calon siswa
                                </small>

                            </div>


                            <a
                                href="{{ route('admin.ppdb.download-excel') }}"
                                class="btn btn-success"
                            >
                                <i class="bi bi-file-earmark-excel me-1"></i>
                                Download Excel
                            </a>

                        </div>

                    </div>


                    {{-- Filter --}}
                    <div class="card-body border-bottom">

                        <form
                            action="{{ route('admin.ppdb.index') }}"
                            method="GET"
                        >

                            <div class="row g-2 align-items-end">

                                {{-- Search --}}
                                <div class="col-lg-5">

                                    <label class="form-label small fw-semibold">
                                        Pencarian
                                    </label>

                                    <div class="input-group">

                                    <span class="input-group-text">
                                        <i class="bi bi-search"></i>
                                    </span>

                                        <input
                                            type="text"
                                            name="search"
                                            class="form-control"
                                            placeholder="Nama, nomor pendaftaran, NISN, NIK..."
                                            value="{{ request('search') }}"
                                        >

                                    </div>

                                </div>


                                {{-- Tahun --}}
                                <div class="col-lg-2 col-md-4">

                                    <label class="form-label small fw-semibold">
                                        Tahun
                                    </label>

                                    <select
                                        name="tahun"
                                        class="form-select"
                                    >

                                        <option value="">
                                            Semua Tahun
                                        </option>

                                        @foreach($tahunPendaftarans as $tahun)

                                            <option
                                                value="{{ $tahun }}"
                                                @selected(request('tahun') == $tahun)
                                            >
                                                {{ $tahun }}
                                            </option>

                                        @endforeach

                                    </select>

                                </div>


                                {{-- Status --}}
                                <div class="col-lg-2 col-md-4">

                                    <label class="form-label small fw-semibold">
                                        Status
                                    </label>

                                    <select
                                        name="status"
                                        class="form-select"
                                    >

                                        <option value="">
                                            Semua Status
                                        </option>

                                        <option
                                            value="menunggu"
                                            @selected(request('status') === 'menunggu')
                                        >
                                            Menunggu
                                        </option>

                                        <option
                                            value="diverifikasi"
                                            @selected(request('status') === 'diverifikasi')
                                        >
                                            Diverifikasi
                                        </option>

                                        <option
                                            value="diterima"
                                            @selected(request('status') === 'diterima')
                                        >
                                            Diterima
                                        </option>

                                        <option
                                            value="ditolak"
                                            @selected(request('status') === 'ditolak')
                                        >
                                            Ditolak
                                        </option>

                                    </select>

                                </div>


                                {{-- Tombol --}}
                                <div class="col-lg-3 col-md-4">

                                    <div class="d-flex gap-2">

                                        <button
                                            type="submit"
                                            class="btn btn-success"
                                        >
                                            <i class="bi bi-filter me-1"></i>
                                            Filter
                                        </button>

                                        <a
                                            href="{{ route('admin.ppdb.index') }}"
                                            class="btn btn-outline-secondary"
                                        >
                                            <i class="bi bi-arrow-counterclockwise"></i>
                                            Reset
                                        </a>

                                    </div>

                                </div>

                            </div>

                        </form>

                    </div>


                    {{-- Table --}}
                    <div class="card-body p-0">

                        <div class="table-responsive">

                            <table class="table table-hover align-middle mb-0">

                                <thead class="table-light">

                                <tr>

                                    <th class="ps-4">
                                        #
                                    </th>

                                    <th>
                                        Pendaftaran
                                    </th>

                                    <th>
                                        Calon Siswa
                                    </th>

                                    <th>
                                        Sekolah Asal
                                    </th>

                                    <th>
                                        Mendaftar Sebagai
                                    </th>

                                    <th>
                                        No. WhatsApp
                                    </th>

                                    <th>
                                        Status
                                    </th>

                                    <th class="text-center">
                                        Aksi
                                    </th>

                                </tr>

                                </thead>

                                <tbody>

                                @forelse($ppdbs as $index => $ppdb)

                                    <tr>

                                        <td class="ps-4 text-muted">
                                            {{ $ppdbs->firstItem() + $index }}
                                        </td>

                                        <td>

                                            <div class="fw-semibold">
                                                {{ $ppdb->nomor_pendaftaran }}
                                            </div>

                                            <small class="text-muted">
                                                Tahun {{ $ppdb->tahun_pendaftaran }}
                                            </small>

                                        </td>

                                        <td>

                                            <div class="fw-semibold">
                                                {{ $ppdb->nama_lengkap }}
                                            </div>

                                            <small class="text-muted">
                                                {{ $ppdb->jenis_kelamin ?? '-' }}
                                            </small>

                                        </td>

                                        <td>
                                            {{ $ppdb->sekolah_asal ?? '-' }}
                                        </td>

                                        <td>
                                            {{ $ppdb->mendaftar_sebagai ?? '-' }}
                                        </td>

                                        <td>

                                            @if($ppdb->no_hp_wa)

                                                <span class="text-nowrap">
                                                    {{ $ppdb->no_hp_wa }}
                                                </span>

                                            @else

                                                -

                                            @endif

                                        </td>

                                        <td>

                                            @switch($ppdb->status)

                                                @case('menunggu')

                                                    <span class="badge text-bg-warning">
                                                        Menunggu
                                                    </span>

                                                    @break

                                                @case('diverifikasi')

                                                    <span class="badge text-bg-primary">
                                                        Diverifikasi
                                                    </span>

                                                    @break

                                                @case('diterima')

                                                    <span class="badge text-bg-success">
                                                        Diterima
                                                    </span>

                                                    @break

                                                @case('ditolak')

                                                    <span class="badge text-bg-danger">
                                                        Ditolak
                                                    </span>

                                                    @break

                                            @endswitch

                                        </td>

                                        <td class="text-center">

                                            <button
                                                type="button"
                                                class="btn btn-sm btn-outline-success"
                                                data-bs-toggle="modal"
                                                data-bs-target="#detailPpdb{{ $ppdb->id }}"
                                                title="Lihat Detail"
                                            >
                                                <i class="bi bi-eye"></i>
                                            </button>

                                        </td>

                                    </tr>


                                    {{-- ====================================================
                                        MODAL DETAIL
                                    ==================================================== --}}
                                    <div
                                        class="modal fade"
                                        id="detailPpdb{{ $ppdb->id }}"
                                        tabindex="-1"
                                        aria-hidden="true"
                                    >

                                        <div class="modal-dialog modal-xl modal-dialog-scrollable">

                                            <div class="modal-content">

                                                <div class="modal-header">

                                                    <div>

                                                        <h5 class="modal-title fw-bold">
                                                            Detail Pendaftaran
                                                        </h5>

                                                        <small class="text-muted">
                                                            {{ $ppdb->nomor_pendaftaran }}
                                                        </small>

                                                    </div>

                                                    <button
                                                        type="button"
                                                        class="btn-close"
                                                        data-bs-dismiss="modal"
                                                    ></button>

                                                </div>


                                                <div class="modal-body">

                                                    {{-- DATA SISWA --}}
                                                    <div class="mb-4">

                                                        <h6 class="fw-bold text-success border-bottom pb-2">
                                                            <i class="bi bi-person me-1"></i>
                                                            Data Calon Siswa
                                                        </h6>

                                                        <div class="row g-3">

                                                            <div class="col-md-6">
                                                                <small class="text-muted d-block">
                                                                    Nama Lengkap
                                                                </small>
                                                                <strong>
                                                                    {{ $ppdb->nama_lengkap }}
                                                                </strong>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <small class="text-muted d-block">
                                                                    Tempat Lahir
                                                                </small>
                                                                {{ $ppdb->tempat_lahir ?? '-' }}
                                                            </div>

                                                            <div class="col-md-3">
                                                                <small class="text-muted d-block">
                                                                    Tanggal Lahir
                                                                </small>
                                                                {{ optional($ppdb->tanggal_lahir)->format('d-m-Y') ?? '-' }}
                                                            </div>

                                                            <div class="col-md-4">
                                                                <small class="text-muted d-block">
                                                                    Jenis Kelamin
                                                                </small>
                                                                {{ $ppdb->jenis_kelamin ?? '-' }}
                                                            </div>

                                                            <div class="col-md-4">
                                                                <small class="text-muted d-block">
                                                                    NIK
                                                                </small>
                                                                {{ $ppdb->nik ?? '-' }}
                                                            </div>

                                                            <div class="col-md-4">
                                                                <small class="text-muted d-block">
                                                                    NISN
                                                                </small>
                                                                {{ $ppdb->nisn ?? '-' }}
                                                            </div>

                                                            <div class="col-md-6">
                                                                <small class="text-muted d-block">
                                                                    No. Akta Kelahiran
                                                                </small>
                                                                {{ $ppdb->nomor_akta_kelahiran ?? '-' }}
                                                            </div>

                                                            <div class="col-md-6">
                                                                <small class="text-muted d-block">
                                                                    No. HP / WhatsApp
                                                                </small>
                                                                {{ $ppdb->no_hp_wa ?? '-' }}
                                                            </div>

                                                            <div class="col-12">
                                                                <small class="text-muted d-block">
                                                                    Alamat
                                                                </small>
                                                                {{ $ppdb->alamat ?? '-' }}
                                                            </div>

                                                            <div class="col-12">
                                                                <small class="text-muted d-block">
                                                                    Kondisi Fisik
                                                                </small>
                                                                {{ $ppdb->kondisi_fisik ?? '-' }}
                                                            </div>

                                                        </div>

                                                    </div>


                                                    {{-- PENDIDIKAN --}}
                                                    <div class="mb-4">

                                                        <h6 class="fw-bold text-success border-bottom pb-2">
                                                            <i class="bi bi-mortarboard me-1"></i>
                                                            Data Pendidikan
                                                        </h6>

                                                        <div class="row g-3">

                                                            <div class="col-md-6">
                                                                <small class="text-muted d-block">
                                                                    Sekolah Asal
                                                                </small>
                                                                {{ $ppdb->sekolah_asal ?? '-' }}
                                                            </div>

                                                            <div class="col-md-6">
                                                                <small class="text-muted d-block">
                                                                    NISN
                                                                </small>
                                                                {{ $ppdb->nisn ?? '-' }}
                                                            </div>

                                                            <div class="col-md-6">
                                                                <small class="text-muted d-block">
                                                                    Mendaftar Sebagai
                                                                </small>
                                                                {{ $ppdb->mendaftar_sebagai ?? '-' }}
                                                            </div>

                                                            <div class="col-md-6">
                                                                <small class="text-muted d-block">
                                                                    Nomor Ijazah
                                                                </small>
                                                                {{ $ppdb->nomor_ijazah ?? '-' }}
                                                            </div>

                                                            <div class="col-12">
                                                                <small class="text-muted d-block">
                                                                    Alamat Sekolah Asal
                                                                </small>
                                                                {{ $ppdb->alamat_sekolah_asal ?? '-' }}
                                                            </div>

                                                        </div>

                                                    </div>


                                                    {{-- AYAH --}}
                                                    <div class="mb-4">

                                                        <h6 class="fw-bold text-success border-bottom pb-2">
                                                            <i class="bi bi-person-vcard me-1"></i>
                                                            Data Ayah
                                                        </h6>

                                                        <div class="row g-3">

                                                            <div class="col-md-6">
                                                                <small class="text-muted d-block">
                                                                    Nama Ayah
                                                                </small>
                                                                {{ $ppdb->nama_ayah ?? '-' }}
                                                            </div>

                                                            <div class="col-md-6">
                                                                <small class="text-muted d-block">
                                                                    NIK Ayah
                                                                </small>
                                                                {{ $ppdb->nik_ayah ?? '-' }}
                                                            </div>

                                                            <div class="col-md-4">
                                                                <small class="text-muted d-block">
                                                                    No. HP / WhatsApp
                                                                </small>
                                                                {{ $ppdb->no_hp_wa_ayah ?? '-' }}
                                                            </div>

                                                            <div class="col-md-4">
                                                                <small class="text-muted d-block">
                                                                    Pekerjaan
                                                                </small>
                                                                {{ $ppdb->pekerjaan_ayah ?? '-' }}
                                                            </div>

                                                            <div class="col-md-4">
                                                                <small class="text-muted d-block">
                                                                    Pendidikan
                                                                </small>
                                                                {{ $ppdb->pendidikan_ayah ?? '-' }}
                                                            </div>

                                                            <div class="col-12">
                                                                <small class="text-muted d-block">
                                                                    Alamat Tinggal
                                                                </small>
                                                                {{ $ppdb->alamat_tinggal_ayah ?? '-' }}
                                                            </div>

                                                        </div>

                                                    </div>


                                                    {{-- IBU --}}
                                                    <div class="mb-4">

                                                        <h6 class="fw-bold text-success border-bottom pb-2">
                                                            <i class="bi bi-person-vcard me-1"></i>
                                                            Data Ibu
                                                        </h6>

                                                        <div class="row g-3">

                                                            <div class="col-md-6">
                                                                <small class="text-muted d-block">
                                                                    Nama Ibu
                                                                </small>
                                                                {{ $ppdb->nama_ibu ?? '-' }}
                                                            </div>

                                                            <div class="col-md-6">
                                                                <small class="text-muted d-block">
                                                                    NIK Ibu
                                                                </small>
                                                                {{ $ppdb->nik_ibu ?? '-' }}
                                                            </div>

                                                            <div class="col-md-4">
                                                                <small class="text-muted d-block">
                                                                    No. HP / WhatsApp
                                                                </small>
                                                                {{ $ppdb->no_hp_wa_ibu ?? '-' }}
                                                            </div>

                                                            <div class="col-md-4">
                                                                <small class="text-muted d-block">
                                                                    Pekerjaan
                                                                </small>
                                                                {{ $ppdb->pekerjaan_ibu ?? '-' }}
                                                            </div>

                                                            <div class="col-md-4">
                                                                <small class="text-muted d-block">
                                                                    Pendidikan
                                                                </small>
                                                                {{ $ppdb->pendidikan_ibu ?? '-' }}
                                                            </div>

                                                            <div class="col-12">
                                                                <small class="text-muted d-block">
                                                                    Alamat Tinggal
                                                                </small>
                                                                {{ $ppdb->alamat_tinggal_ibu ?? '-' }}
                                                            </div>

                                                        </div>

                                                    </div>


                                                    {{-- WALI --}}
                                                    <div class="mb-4">

                                                        <h6 class="fw-bold text-success border-bottom pb-2">
                                                            <i class="bi bi-person-badge me-1"></i>
                                                            Data Wali
                                                        </h6>

                                                        <div class="row g-3">

                                                            <div class="col-md-6">
                                                                <small class="text-muted d-block">
                                                                    Nama Wali
                                                                </small>
                                                                {{ $ppdb->nama_wali ?? '-' }}
                                                            </div>

                                                            <div class="col-md-6">
                                                                <small class="text-muted d-block">
                                                                    NIK Wali
                                                                </small>
                                                                {{ $ppdb->nik_wali ?? '-' }}
                                                            </div>

                                                            <div class="col-md-4">
                                                                <small class="text-muted d-block">
                                                                    No. HP / WhatsApp
                                                                </small>
                                                                {{ $ppdb->no_hp_wa_wali ?? '-' }}
                                                            </div>

                                                            <div class="col-md-4">
                                                                <small class="text-muted d-block">
                                                                    Pekerjaan
                                                                </small>
                                                                {{ $ppdb->pekerjaan_wali ?? '-' }}
                                                            </div>

                                                            <div class="col-md-4">
                                                                <small class="text-muted d-block">
                                                                    Pendidikan
                                                                </small>
                                                                {{ $ppdb->pendidikan_wali ?? '-' }}
                                                            </div>

                                                            <div class="col-12">
                                                                <small class="text-muted d-block">
                                                                    Alamat Tinggal
                                                                </small>
                                                                {{ $ppdb->alamat_tinggal_wali ?? '-' }}
                                                            </div>

                                                        </div>

                                                    </div>


                                                    {{-- STATUS --}}
                                                    <div>

                                                        <h6 class="fw-bold text-success border-bottom pb-2">
                                                            <i class="bi bi-clipboard-check me-1"></i>
                                                            Status PPDB
                                                        </h6>

                                                        <div class="row g-3">

                                                            <div class="col-md-4">

                                                                <small class="text-muted d-block">
                                                                    Status
                                                                </small>

                                                                @switch($ppdb->status)

                                                                    @case('menunggu')
                                                                        <span class="badge text-bg-warning">
                                                                            Menunggu
                                                                        </span>
                                                                        @break

                                                                    @case('diverifikasi')
                                                                        <span class="badge text-bg-primary">
                                                                            Diverifikasi
                                                                        </span>
                                                                        @break

                                                                    @case('diterima')
                                                                        <span class="badge text-bg-success">
                                                                            Diterima
                                                                        </span>
                                                                        @break

                                                                    @case('ditolak')
                                                                        <span class="badge text-bg-danger">
                                                                            Ditolak
                                                                        </span>
                                                                        @break

                                                                @endswitch

                                                            </div>

                                                            <div class="col-md-8">

                                                                <small class="text-muted d-block">
                                                                    Catatan
                                                                </small>

                                                                {{ $ppdb->catatan ?? '-' }}

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>


                                                <div class="modal-footer">

                                                    <button
                                                        type="button"
                                                        class="btn btn-secondary"
                                                        data-bs-dismiss="modal"
                                                    >
                                                        Tutup
                                                    </button>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                @empty

                                    <tr>

                                        <td
                                            colspan="8"
                                            class="text-center py-5"
                                        >

                                            <div class="text-muted">

                                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>

                                                <div class="fw-semibold">
                                                    Belum ada data pendaftar
                                                </div>

                                                <small>
                                                    Data pendaftaran PPDB akan muncul di sini.
                                                </small>

                                            </div>

                                        </td>

                                    </tr>

                                @endforelse

                                </tbody>

                            </table>

                        </div>

                    </div>


                    {{-- Pagination --}}
                    @if($ppdbs->hasPages())

                        <div class="card-footer bg-body">

                            {{ $ppdbs->links() }}

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

@endsection
