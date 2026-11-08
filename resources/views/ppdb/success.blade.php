@extends('template.app')

@section('title', 'Pendaftaran PPDB Berhasil')

@section('content')

    <style>
        .success-page {
            min-height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 60px 15px;
            background: #f8faf9;
        }

        .success-card {
            width: 100%;
            max-width: 700px;
            background: #ffffff;
            border-radius: 24px;
            padding: 45px 35px;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.08);
            text-align: center;
        }

        .success-icon {
            width: 90px;
            height: 90px;
            margin: 0 auto 25px;
            border-radius: 50%;
            background: #198754;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 45px;
            box-shadow: 0 10px 25px rgba(25, 135, 84, 0.25);
        }

        .success-title {
            font-size: 30px;
            font-weight: 700;
            color: #198754;
            margin-bottom: 12px;
        }

        .success-description {
            color: #6c757d;
            font-size: 16px;
            line-height: 1.7;
            margin-bottom: 30px;
        }

        .registration-box {
            background: #f8f9fa;
            border: 2px dashed #198754;
            border-radius: 18px;
            padding: 25px 20px;
            margin-bottom: 30px;
        }

        .registration-label {
            font-size: 14px;
            color: #6c757d;
            margin-bottom: 8px;
        }

        .registration-number {
            font-size: 28px;
            font-weight: 800;
            color: #198754;
            letter-spacing: 1px;
            word-break: break-word;
        }

        .student-info {
            text-align: left;
            background: #ffffff;
            border: 1px solid #e9ecef;
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 25px;
        }

        .student-info-title {
            font-size: 17px;
            font-weight: 700;
            color: #198754;
            margin-bottom: 15px;
        }

        .student-info-row {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            padding: 9px 0;
            border-bottom: 1px solid #f1f1f1;
        }

        .student-info-row:last-child {
            border-bottom: none;
        }

        .student-info-label {
            color: #6c757d;
            font-size: 14px;
        }

        .student-info-value {
            color: #212529;
            font-weight: 600;
            font-size: 14px;
            text-align: right;
        }

        .btn-custom-green {
            background: #198754;
            border-color: #198754;
            color: #ffffff;
            transition: all 0.3s ease;
        }

        .btn-custom-green:hover {
            background: #157347;
            border-color: #157347;
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(25, 135, 84, 0.25);
        }

        .download-info {
            color: #6c757d;
            font-size: 13px;
            line-height: 1.6;
            margin-top: 15px;
        }

        .download-success {
            border-radius: 14px;
            font-size: 14px;
        }

        @media (max-width: 576px) {

            .success-page {
                padding: 35px 15px;
            }

            .success-card {
                padding: 35px 20px;
                border-radius: 20px;
            }

            .success-title {
                font-size: 24px;
            }

            .registration-number {
                font-size: 21px;
            }

            .student-info-row {
                flex-direction: column;
                gap: 3px;
            }

            .student-info-value {
                text-align: left;
            }
        }
    </style>


    <div class="success-page">

        <div class="success-card">

            {{-- ============================================================
                 ICON SUCCESS
            ============================================================= --}}
            <div class="success-icon">
                <i class="bi bi-check-lg"></i>
            </div>


            {{-- ============================================================
                 TITLE
            ============================================================= --}}
            <h1 class="success-title">
                Pendaftaran Berhasil!
            </h1>


            <p class="success-description">
                Terima kasih telah melakukan pendaftaran
                Penerimaan Peserta Didik Baru (PPDB)
                <strong>{{ $master_sekolah->nama_sekolah ?? 'SMA Islam As-Syafi\'iyah 01' }}</strong>.
                <br>
                Data pendaftaran Anda telah berhasil disimpan.
            </p>


            {{-- ============================================================
                 NOMOR PENDAFTARAN
            ============================================================= --}}
            <div class="registration-box">

                <div class="registration-label">
                    Nomor Pendaftaran Anda
                </div>

                <div class="registration-number">
                    {{ $ppdb->nomor_pendaftaran }}
                </div>

            </div>


            {{-- ============================================================
                 DATA CALON SISWA
            ============================================================= --}}
            <div class="student-info">

                <div class="student-info-title">
                    <i class="bi bi-person-vcard me-2"></i>
                    Data Pendaftar
                </div>


                @if(!empty($ppdb->nama_lengkap))
                    <div class="student-info-row">

                        <div class="student-info-label">
                            Nama Lengkap
                        </div>

                        <div class="student-info-value">
                            {{ $ppdb->nama_lengkap }}
                        </div>

                    </div>
                @endif


                @if(!empty($ppdb->nisn))
                    <div class="student-info-row">

                        <div class="student-info-label">
                            NISN
                        </div>

                        <div class="student-info-value">
                            {{ $ppdb->nisn }}
                        </div>

                    </div>
                @endif


                @if(!empty($ppdb->asal_sekolah))
                    <div class="student-info-row">

                        <div class="student-info-label">
                            Asal Sekolah
                        </div>

                        <div class="student-info-value">
                            {{ $ppdb->asal_sekolah }}
                        </div>

                    </div>
                @endif


                @if(!empty($ppdb->jenis_kelamin))
                    <div class="student-info-row">

                        <div class="student-info-label">
                            Jenis Kelamin
                        </div>

                        <div class="student-info-value">
                            {{ $ppdb->jenis_kelamin }}
                        </div>

                    </div>
                @endif


                <div class="student-info-row">

                    <div class="student-info-label">
                        Tahun Pendaftaran
                    </div>

                    <div class="student-info-value">
                        {{ $ppdb->tahun_pendaftaran }}
                    </div>

                </div>

            </div>


            {{-- ============================================================
                 DOWNLOAD BUTTON
            ============================================================= --}}
            <div class="mb-2">

                <a
                    href="{{ route('ppdb.download', [
                        'nomor_pendaftaran' => $ppdb->nomor_pendaftaran
                    ]) }}"
                    id="btnDownload"
                    class="btn btn-custom-green btn-lg rounded-pill px-4"
                >
                    <i class="bi bi-download me-2"></i>
                    Download Bukti Pendaftaran
                </a>

            </div>


            {{-- ============================================================
                 DOWNLOAD INFORMATION
            ============================================================= --}}
            <div class="download-info">

                <i class="bi bi-info-circle me-1"></i>

                Silakan download dan simpan bukti pendaftaran
                sebagai dokumen penting untuk proses PPDB.

            </div>


            {{-- ============================================================
                 DOWNLOAD SUCCESS STATUS
            ============================================================= --}}
            <div
                id="downloadStatus"
                class="alert alert-success download-success d-none mt-4 mb-0"
            >

                <i class="bi bi-check-circle-fill me-2"></i>

                <strong>Berhasil!</strong>
                Bukti pendaftaran telah berhasil didownload.

            </div>


        </div>

    </div>
    <script>

        document.addEventListener('DOMContentLoaded', function () {

            // ============================================================
            // ELEMENT
            // ============================================================

            const btnDownload =
                document.getElementById('btnDownload');

            const downloadStatus =
                document.getElementById('downloadStatus');


            // ============================================================
            // CEK ELEMENT
            // ============================================================

            if (!btnDownload) {

                console.error(
                    'Element #btnDownload tidak ditemukan.'
                );

                return;

            }


            // ============================================================
            // STATUS DOWNLOAD
            // ============================================================

            let sudahDownload = false;


            // ============================================================
            // DOWNLOAD PDF
            // ============================================================

            btnDownload.addEventListener(
                'click',
                async function (event) {

                    event.preventDefault();


                    const url = this.href;


                    // Simpan teks asli tombol
                    const originalText = this.innerHTML;


                    // ====================================================
                    // LOADING
                    // ====================================================

                    this.classList.add('disabled');

                    this.style.pointerEvents = 'none';

                    this.innerHTML = `
                <span
                    class="spinner-border spinner-border-sm me-2"
                    role="status"
                    aria-hidden="true"
                ></span>

                Menyiapkan Bukti Pendaftaran...
            `;


                    try {

                        // =================================================
                        // REQUEST PDF
                        // =================================================

                        const response = await fetch(
                            url,
                            {
                                method: 'GET',

                                headers: {
                                    'Accept': 'application/pdf'
                                }
                            }
                        );


                        // =================================================
                        // CEK STATUS
                        // =================================================

                        if (!response.ok) {

                            throw new Error(
                                'Server mengembalikan status HTTP ' +
                                response.status
                            );

                        }


                        // =================================================
                        // CEK CONTENT TYPE
                        // =================================================

                        const contentType =
                            response.headers.get(
                                'Content-Type'
                            ) || '';


                        if (
                            !contentType.includes(
                                'application/pdf'
                            )
                        ) {

                            console.error(
                                'Content-Type:',
                                contentType
                            );

                            throw new Error(
                                'Response bukan file PDF.'
                            );

                        }


                        // =================================================
                        // AMBIL BLOB
                        // =================================================

                        const blob =
                            await response.blob();


                        // =================================================
                        // NAMA FILE DEFAULT
                        // =================================================

                        let filename =
                            'Bukti-Pendaftaran-' +
                            @json($ppdb->nomor_pendaftaran) +
                                '.pdf';


                        // =================================================
                        // AMBIL CONTENT DISPOSITION
                        // =================================================

                        const contentDisposition =
                            response.headers.get(
                                'Content-Disposition'
                            );


                        if (contentDisposition) {

                            const match =
                                contentDisposition.match(
                                    /filename\*?=(?:UTF-8'')?["']?([^;"']+)["']?/i
                                );


                            if (
                                match &&
                                match[1]
                            ) {

                                filename =
                                    decodeURIComponent(
                                        match[1]
                                    );

                            }

                        }


                        // =================================================
                        // CREATE BLOB URL
                        // =================================================

                        const blobUrl =
                            window.URL.createObjectURL(
                                blob
                            );


                        // =================================================
                        // CREATE DOWNLOAD LINK
                        // =================================================

                        const link =
                            document.createElement('a');


                        link.href =
                            blobUrl;


                        link.download =
                            filename;


                        link.style.display =
                            'none';


                        document.body.appendChild(
                            link
                        );


                        link.click();


                        link.remove();


                        // =================================================
                        // RELEASE BLOB
                        // =================================================

                        setTimeout(
                            function () {

                                window.URL.revokeObjectURL(
                                    blobUrl
                                );

                            },
                            1000
                        );


                        // =================================================
                        // DOWNLOAD SUCCESS
                        // =================================================

                        sudahDownload =
                            true;


                        // =================================================
                        // HIDE DOWNLOAD BUTTON
                        // =================================================

                        btnDownload.classList.add(
                            'd-none'
                        );


                        // =================================================
                        // SHOW SUCCESS STATUS
                        // =================================================

                        if (downloadStatus) {

                            downloadStatus.classList.remove(
                                'd-none'
                            );

                        }

                    } catch (error) {

                        // =================================================
                        // ERROR
                        // =================================================

                        console.error(
                            'Download PDF error:',
                            error
                        );


                        alert(
                            'Bukti pendaftaran gagal didownload.\n\n' +
                            'Silakan coba lagi.'
                        );


                        // =================================================
                        // RESTORE BUTTON
                        // =================================================

                        btnDownload.classList.remove(
                            'disabled'
                        );


                        btnDownload.style.pointerEvents =
                            '';


                        btnDownload.innerHTML =
                            originalText;

                    }

                }
            );


            // ============================================================
            // CEGAH BACK BUTTON
            // ============================================================

            history.pushState(
                null,
                '',
                location.href
            );


            window.addEventListener(
                'popstate',
                function () {

                    if (!sudahDownload) {

                        alert(
                            'Silakan download bukti pendaftaran terlebih dahulu.'
                        );


                        history.pushState(
                            null,
                            '',
                            location.href
                        );

                    }

                }
            );


            // ============================================================
            // CEGAH REFRESH / CLOSE
            // ============================================================

            window.addEventListener(
                'beforeunload',
                function (event) {

                    if (!sudahDownload) {

                        event.preventDefault();

                        event.returnValue = '';

                    }

                }
            );

        });

    </script>
@endsection

