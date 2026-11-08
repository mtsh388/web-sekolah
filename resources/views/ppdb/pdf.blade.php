<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <title>
        Bukti Pendaftaran PPDB -
        {{ $ppdb->nomor_pendaftaran }}
    </title>

    <style>

        @page {
            margin: 25px 30px 30px 30px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #263238;
            background: #ffffff;
        }

        /* ============================================================
           WARNA
        ============================================================ */

        .green {
            color: #198754;
        }

        .bg-green {
            background-color: #198754;
        }

        .light-green {
            background-color: #edf8f2;
        }

        .dark {
            color: #263238;
        }

        .muted {
            color: #6c757d;
        }


        /* ============================================================
           HEADER
        ============================================================ */

        .header {
            width: 100%;
            border-bottom: 3px solid #198754;
            padding-bottom: 14px;
            margin-bottom: 18px;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
        }

        .logo-cell {
            width: 80px;
            vertical-align: middle;
        }

        .logo {
            width: 68px;
            height: 68px;
            object-fit: contain;
        }

        .school-cell {
            vertical-align: middle;
            padding-left: 8px;
        }

        .school-name {
            font-size: 17px;
            font-weight: bold;
            color: #198754;
            margin-bottom: 3px;
        }

        .school-address {
            font-size: 9px;
            line-height: 1.5;
            color: #6c757d;
        }

        .document-cell {
            width: 145px;
            text-align: right;
            vertical-align: middle;
        }

        .document-label {
            font-size: 9px;
            color: #6c757d;
            text-transform: uppercase;
            margin-bottom: 4px;
        }

        .document-title {
            font-size: 13px;
            font-weight: bold;
            color: #198754;
        }


        /* ============================================================
           TITLE
        ============================================================ */

        .title-section {
            text-align: center;
            margin-bottom: 18px;
        }

        .title {
            font-size: 19px;
            font-weight: bold;
            color: #263238;
            margin-bottom: 5px;
        }

        .subtitle {
            font-size: 10px;
            color: #6c757d;
        }


        /* ============================================================
           REGISTRATION NUMBER
        ============================================================ */

        .registration-box {
            width: 100%;
            background-color: #edf8f2;
            border: 1px solid #b8dfc8;
            border-radius: 8px;
            padding: 13px;
            text-align: center;
            margin-bottom: 18px;
        }

        .registration-label {
            font-size: 9px;
            color: #6c757d;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        .registration-number {
            font-size: 20px;
            font-weight: bold;
            color: #198754;
            letter-spacing: 1px;
        }


        /* ============================================================
           SECTION
        ============================================================ */

        .section {
            margin-bottom: 16px;
        }

        .section-header {
            background-color: #198754;
            color: #ffffff;
            padding: 7px 10px;
            font-size: 11px;
            font-weight: bold;
            border-radius: 5px 5px 0 0;
        }

        .section-header-table {
            width: 100%;
            border-collapse: collapse;
        }

        .section-header-number-cell {
            width: 24px;
            vertical-align: middle;
        }

        .section-header-number {
            width: 18px;
            height: 18px;
            background-color: #ffffff;
            color: #198754;
            text-align: center;
            vertical-align: middle;
            font-size: 9px;
            font-weight: bold;
            border-radius: 50%;
            line-height: 16px;
        }

        .section-header-title {
            vertical-align: middle;
            padding-left: 2px;
            line-height: 18px;
        }


        /* ============================================================
           DATA TABLE
        ============================================================ */

        .data-table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #dee2e6;
        }

        .data-table tr {
            page-break-inside: avoid;
        }

        .data-table td {
            padding: 7px 9px;
            border-bottom: 1px solid #e9ecef;
            vertical-align: top;
        }

        .data-table tr:last-child td {
            border-bottom: none;
        }

        .data-table .label {
            width: 30%;
            color: #6c757d;
            background-color: #f8f9fa;
        }

        .data-table .value {
            width: 70%;
            font-weight: bold;
            color: #263238;
        }


        /* ============================================================
           TWO COLUMN
        ============================================================ */

        .two-column {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .two-column td {
            width: 50%;
            vertical-align: top;
        }

        .two-column .left {
            padding-right: 7px;
        }

        .two-column .right {
            padding-left: 7px;
        }


        /* ============================================================
           STATUS
        ============================================================ */

        .status-box {
            background-color: #fff8e1;
            border: 1px solid #ffe082;
            padding: 10px;
            border-radius: 5px;
            margin-top: 5px;
        }

        .status-title {
            font-size: 9px;
            color: #8a6d1d;
            margin-bottom: 3px;
        }

        .status-value {
            font-size: 12px;
            font-weight: bold;
            color: #8a6d1d;
            text-transform: uppercase;
        }


        /* ============================================================
           INFORMATION
        ============================================================ */

        .info-box {
            background-color: #f8f9fa;
            border-left: 4px solid #198754;
            padding: 10px 12px;
            margin-top: 15px;
            line-height: 1.6;
            color: #495057;
        }

        .info-title {
            font-weight: bold;
            color: #198754;
            margin-bottom: 3px;
        }


        /* ============================================================
           SIGNATURE
        ============================================================ */

        .signature-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }

        .signature-table td {
            width: 50%;
            text-align: center;
            vertical-align: top;
        }

        .signature-space {
            height: 55px;
        }

        .signature-name {
            font-weight: bold;
            text-decoration: underline;
        }


        /* ============================================================
           FOOTER
        ============================================================ */

        .footer {
            border-top: 1px solid #dee2e6;
            margin-top: 20px;
            padding-top: 9px;
            font-size: 8px;
            color: #868e96;
            line-height: 1.5;
        }

        .footer-table {
            width: 100%;
            border-collapse: collapse;
        }

        .footer-left {
            text-align: left;
        }

        .footer-right {
            text-align: right;
        }


        /* ============================================================
           PAGE NUMBER
        ============================================================ */

        .page-number:after {
            content: counter(page);
        }

    </style>

</head>


<body>


{{-- ================================================================
     HEADER SEKOLAH
================================================================= --}}

<div class="header">

    <table class="header-table">

        <tr>

            <td class="logo-cell">

                @if(
                    isset($master_sekolah) &&
                    !empty($master_sekolah->logo)
                )

                    @php
                        $logoPath = public_path(
                            'images/' . $master_sekolah->logo
                        );
                    @endphp

                    @if(file_exists($logoPath))

                        <img
                            src="{{ $logoPath }}"
                            class="logo"
                        >

                    @endif

                @endif

            </td>


            <td class="school-cell">

                <div class="school-name">

                    {{ $master_sekolah->nama_sekolah
                        ?? 'SMA ISLAM AS-SYAFI’IYAH 01' }}

                </div>


                <div class="school-address">

                    {{ $master_sekolah->alamat
                        ?? 'Jakarta' }}

                    @if(
                        isset($master_sekolah->telepon) &&
                        $master_sekolah->telepon
                    )

                        <br>
                        Telp. {{ $master_sekolah->telepon }}

                    @endif

                </div>

            </td>


            <td class="document-cell">

                <div class="document-label">
                    Dokumen Resmi
                </div>

                <div class="document-title">
                    PPDB
                </div>

            </td>

        </tr>

    </table>

</div>


{{-- ================================================================
     JUDUL
================================================================= --}}

<div class="title-section">

    <div class="title">
        BUKTI PENDAFTARAN PPDB
    </div>

    <div class="subtitle">
        Penerimaan Peserta Didik Baru
        Tahun Pelajaran
        {{ $ppdb->tahun_pendaftaran }}
    </div>

</div>


{{-- ================================================================
     NOMOR PENDAFTARAN
================================================================= --}}

<div class="registration-box">

    <div class="registration-label">
        Nomor Pendaftaran
    </div>

    <div class="registration-number">
        {{ $ppdb->nomor_pendaftaran }}
    </div>

</div>


{{-- ================================================================
     DATA CALON SISWA
================================================================= --}}

<div class="section">

    <div class="section-header">

        <table class="section-header-table">

            <tr>

                <td class="section-header-number-cell">

                    <div class="section-header-number">
                        1
                    </div>

                </td>

                <td class="section-header-title">
                    DATA CALON SISWA
                </td>

            </tr>

        </table>

    </div>


    <table class="data-table">

        <tr>

            <td class="label">
                Nama Lengkap
            </td>

            <td class="value">
                {{ $ppdb->nama_lengkap }}
            </td>

        </tr>


        <tr>

            <td class="label">
                Tempat, Tanggal Lahir
            </td>

            <td class="value">

                {{ $ppdb->tempat_lahir }}

                @if($ppdb->tanggal_lahir)

                    ,
                    {{ \Carbon\Carbon::parse(
                        $ppdb->tanggal_lahir
                    )->translatedFormat('d F Y') }}

                @endif

            </td>

        </tr>


        <tr>

            <td class="label">
                Jenis Kelamin
            </td>

            <td class="value">
                {{ $ppdb->jenis_kelamin }}
            </td>

        </tr>


        <tr>

            <td class="label">
                NIK
            </td>

            <td class="value">
                {{ $ppdb->nik }}
            </td>

        </tr>


        @if($ppdb->nomor_akta_kelahiran)

            <tr>

                <td class="label">
                    Nomor Akta Kelahiran
                </td>

                <td class="value">
                    {{ $ppdb->nomor_akta_kelahiran }}
                </td>

            </tr>

        @endif


        @if($ppdb->nisn)

            <tr>

                <td class="label">
                    NISN
                </td>

                <td class="value">
                    {{ $ppdb->nisn }}
                </td>

            </tr>

        @endif


        <tr>

            <td class="label">
                Nomor HP / WhatsApp
            </td>

            <td class="value">
                {{ $ppdb->no_hp_wa }}
            </td>

        </tr>


        <tr>

            <td class="label">
                Alamat
            </td>

            <td class="value">
                {{ $ppdb->alamat }}
            </td>

        </tr>


        @if($ppdb->kondisi_fisik)

            <tr>

                <td class="label">
                    Kondisi Fisik
                </td>

                <td class="value">
                    {{ $ppdb->kondisi_fisik }}
                </td>

            </tr>

        @endif

    </table>

</div>


{{-- ================================================================
     DATA PENDIDIKAN
================================================================= --}}

<div class="section">

    <div class="section-header">

        <table class="section-header-table">

            <tr>

                <td class="section-header-number-cell">

                    <div class="section-header-number">
                        2
                    </div>

                </td>

                <td class="section-header-title">
                    DATA PENDIDIKAN
                </td>

            </tr>

        </table>

    </div>


    <table class="data-table">

        <tr>

            <td class="label">
                Sekolah Asal
            </td>

            <td class="value">
                {{ $ppdb->sekolah_asal }}
            </td>

        </tr>


        <tr>

            <td class="label">
                Alamat Sekolah
            </td>

            <td class="value">
                {{ $ppdb->alamat_sekolah_asal }}
            </td>

        </tr>


        <tr>

            <td class="label">
                Mendaftar Sebagai
            </td>

            <td class="value">
                {{ $ppdb->mendaftar_sebagai }}
            </td>

        </tr>


        @if($ppdb->nomor_ijazah)

            <tr>

                <td class="label">
                    Nomor Ijazah
                </td>

                <td class="value">
                    {{ $ppdb->nomor_ijazah }}
                </td>

            </tr>

        @endif

    </table>

</div>


{{-- ================================================================
     DATA ORANG TUA / WALI
================================================================= --}}

<div class="section">

    <div class="section-header">

        <table class="section-header-table">

            <tr>

                <td class="section-header-number-cell">

                    <div class="section-header-number">
                        3
                    </div>

                </td>

                <td class="section-header-title">
                    DATA ORANG TUA / WALI
                </td>

            </tr>

        </table>

    </div>


    <table class="two-column">

        <tr>

            {{-- ====================================================
                 AYAH
            ===================================================== --}}

            <td class="left">

                <table class="data-table">

                    <tr>

                        <td
                            colspan="2"
                            style="
                                background-color:#edf8f2;
                                color:#198754;
                                font-weight:bold;
                            "
                        >
                            DATA AYAH
                        </td>

                    </tr>


                    @if($ppdb->nama_ayah)

                        <tr>

                            <td class="label">
                                Nama
                            </td>

                            <td class="value">
                                {{ $ppdb->nama_ayah }}
                            </td>

                        </tr>

                        <tr>

                            <td class="label">
                                NIK
                            </td>

                            <td class="value">
                                {{ $ppdb->nik_ayah }}
                            </td>

                        </tr>

                        <tr>

                            <td class="label">
                                Pekerjaan
                            </td>

                            <td class="value">
                                {{ $ppdb->pekerjaan_ayah }}
                            </td>

                        </tr>

                        <tr>

                            <td class="label">
                                Pendidikan
                            </td>

                            <td class="value">
                                {{ $ppdb->pendidikan_ayah }}
                            </td>

                        </tr>

                        <tr>

                            <td class="label">
                                No. HP/WA
                            </td>

                            <td class="value">
                                {{ $ppdb->no_hp_wa_ayah }}
                            </td>

                        </tr>

                    @else

                        <tr>

                            <td
                                colspan="2"
                                style="
                                    text-align:center;
                                    color:#6c757d;
                                "
                            >
                                Tidak diisi
                            </td>

                        </tr>

                    @endif

                </table>

            </td>


            {{-- ====================================================
                 IBU
            ===================================================== --}}

            <td class="right">

                <table class="data-table">

                    <tr>

                        <td
                            colspan="2"
                            style="
                                background-color:#edf8f2;
                                color:#198754;
                                font-weight:bold;
                            "
                        >
                            DATA IBU
                        </td>

                    </tr>


                    @if($ppdb->nama_ibu)

                        <tr>

                            <td class="label">
                                Nama
                            </td>

                            <td class="value">
                                {{ $ppdb->nama_ibu }}
                            </td>

                        </tr>

                        <tr>

                            <td class="label">
                                NIK
                            </td>

                            <td class="value">
                                {{ $ppdb->nik_ibu }}
                            </td>

                        </tr>

                        <tr>

                            <td class="label">
                                Pekerjaan
                            </td>

                            <td class="value">
                                {{ $ppdb->pekerjaan_ibu }}
                            </td>

                        </tr>

                        <tr>

                            <td class="label">
                                Pendidikan
                            </td>

                            <td class="value">
                                {{ $ppdb->pendidikan_ibu }}
                            </td>

                        </tr>

                        <tr>

                            <td class="label">
                                No. HP/WA
                            </td>

                            <td class="value">
                                {{ $ppdb->no_hp_wa_ibu }}
                            </td>

                        </tr>

                    @else

                        <tr>

                            <td
                                colspan="2"
                                style="
                                    text-align:center;
                                    color:#6c757d;
                                "
                            >
                                Tidak diisi
                            </td>

                        </tr>

                    @endif

                </table>

            </td>

        </tr>

    </table>


    {{-- ============================================================
         WALI
    ============================================================= --}}

    @if($ppdb->nama_wali)

        <div style="margin-top:10px;">

            <table class="data-table">

                <tr>

                    <td
                        colspan="2"
                        style="
                            background-color:#edf8f2;
                            color:#198754;
                            font-weight:bold;
                        "
                    >
                        DATA WALI
                    </td>

                </tr>


                <tr>

                    <td class="label">
                        Nama
                    </td>

                    <td class="value">
                        {{ $ppdb->nama_wali }}
                    </td>

                </tr>


                <tr>

                    <td class="label">
                        NIK
                    </td>

                    <td class="value">
                        {{ $ppdb->nik_wali }}
                    </td>

                </tr>


                <tr>

                    <td class="label">
                        Pekerjaan
                    </td>

                    <td class="value">
                        {{ $ppdb->pekerjaan_wali }}
                    </td>

                </tr>


                <tr>

                    <td class="label">
                        Pendidikan
                    </td>

                    <td class="value">
                        {{ $ppdb->pendidikan_wali }}
                    </td>

                </tr>


                <tr>

                    <td class="label">
                        No. HP/WA
                    </td>

                    <td class="value">
                        {{ $ppdb->no_hp_wa_wali }}
                    </td>

                </tr>

            </table>

        </div>

    @endif

</div>


{{-- ================================================================
     STATUS PENDAFTARAN
================================================================= --}}

<div class="status-box">

    <div class="status-title">
        STATUS PENDAFTARAN
    </div>

    <div class="status-value">
        {{ $ppdb->status ?? 'Menunggu' }}
    </div>

</div>


{{-- ================================================================
     INFORMASI
================================================================= --}}

<div class="info-box">

    <div class="info-title">
        Informasi Penting
    </div>

    Simpan dokumen ini sebagai bukti bahwa Anda telah
    melakukan pendaftaran PPDB. Nomor pendaftaran
    <strong>{{ $ppdb->nomor_pendaftaran }}</strong>
    dapat digunakan untuk keperluan proses administrasi
    PPDB selanjutnya.

</div>


{{-- ================================================================
     TANDA TANGAN
================================================================= --}}

<table class="signature-table">

    <tr>

        <td>

            <div>
                Calon Peserta Didik
            </div>

            <div class="signature-space"></div>

            <div class="signature-name">
                {{ $ppdb->nama_lengkap }}
            </div>

        </td>


        <td>

            <div>
                Panitia PPDB
            </div>

            <div class="signature-space"></div>

            <div class="signature-name">
                Panitia PPDB
            </div>

        </td>

    </tr>

</table>


{{-- ================================================================
     FOOTER
================================================================= --}}

<div class="footer">

    <table class="footer-table">

        <tr>

            <td class="footer-left">

                Dokumen ini dibuat secara otomatis oleh
                sistem PPDB sekolah.

                <br>

                Nomor Pendaftaran:
                {{ $ppdb->nomor_pendaftaran }}

            </td>


            <td class="footer-right">

                Dicetak:
                {{ now()->format('d/m/Y H:i') }}

                <br>

                Halaman
                <span class="page-number"></span>

            </td>

        </tr>

    </table>

</div>


</body>

</html>
