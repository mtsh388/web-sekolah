<?php

namespace App\Exports;

use App\Models\Ppdb;
use Illuminate\Support\Enumerable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PpdbExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    /**
     * Data yang akan diekspor ke Excel.
     */
    public function collection(): Enumerable
    {
        return Ppdb::query()
            ->orderByDesc('tahun_pendaftaran')
            ->orderByDesc('created_at')
            ->get()
            ->map(function ($ppdb) {

                return [
                    $ppdb->nomor_pendaftaran,
                    $ppdb->tahun_pendaftaran,

                    // Data siswa
                    $ppdb->nama_lengkap,
                    $ppdb->tempat_lahir,

                    $ppdb->tanggal_lahir
                        ? \Carbon\Carbon::parse($ppdb->tanggal_lahir)->format('d-m-Y')
                        : null,

                    $ppdb->jenis_kelamin,
                    $ppdb->nik,
                    $ppdb->nomor_akta_kelahiran,
                    $ppdb->no_hp_wa,
                    $ppdb->alamat,
                    $ppdb->kondisi_fisik,

                    // Pendidikan
                    $ppdb->sekolah_asal,
                    $ppdb->alamat_sekolah_asal,
                    $ppdb->nisn,
                    $ppdb->mendaftar_sebagai,
                    $ppdb->nomor_ijazah,

                    // Ayah
                    $ppdb->nama_ayah,
                    $ppdb->nik_ayah,
                    $ppdb->no_hp_wa_ayah,
                    $ppdb->pekerjaan_ayah,
                    $ppdb->pendidikan_ayah,
                    $ppdb->alamat_tinggal_ayah,

                    // Ibu
                    $ppdb->nama_ibu,
                    $ppdb->nik_ibu,
                    $ppdb->no_hp_wa_ibu,
                    $ppdb->pekerjaan_ibu,
                    $ppdb->pendidikan_ibu,
                    $ppdb->alamat_tinggal_ibu,

                    // Wali
                    $ppdb->nama_wali,
                    $ppdb->nik_wali,
                    $ppdb->no_hp_wa_wali,
                    $ppdb->pekerjaan_wali,
                    $ppdb->pendidikan_wali,
                    $ppdb->alamat_tinggal_wali,

                    // Status
                    ucfirst($ppdb->status),
                    $ppdb->catatan,

                    // Tanggal
                    $ppdb->created_at
                        ? $ppdb->created_at->format('d-m-Y H:i')
                        : null,
                ];
            });
    }

    /**
     * Header Excel.
     */
    public function headings(): array
    {
        return [
            'Nomor Pendaftaran',
            'Tahun Pendaftaran',

            // Data siswa
            'Nama Lengkap',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Jenis Kelamin',
            'NIK',
            'Nomor Akta Kelahiran',
            'No. HP / WhatsApp',
            'Alamat',
            'Kondisi Fisik',

            // Pendidikan
            'Sekolah Asal',
            'Alamat Sekolah Asal',
            'NISN',
            'Mendaftar Sebagai',
            'Nomor Ijazah',

            // Ayah
            'Nama Ayah',
            'NIK Ayah',
            'No. HP / WhatsApp Ayah',
            'Pekerjaan Ayah',
            'Pendidikan Ayah',
            'Alamat Tinggal Ayah',

            // Ibu
            'Nama Ibu',
            'NIK Ibu',
            'No. HP / WhatsApp Ibu',
            'Pekerjaan Ibu',
            'Pendidikan Ibu',
            'Alamat Tinggal Ibu',

            // Wali
            'Nama Wali',
            'NIK Wali',
            'No. HP / WhatsApp Wali',
            'Pekerjaan Wali',
            'Pendidikan Wali',
            'Alamat Tinggal Wali',

            // Status
            'Status',
            'Catatan',

            // System
            'Tanggal Pendaftaran',
        ];
    }

    /**
     * Styling Excel.
     */
    public function styles(Worksheet $sheet): array
    {
        return [
            // Baris header
            1 => [
                'font' => [
                    'bold' => true,
                ],
            ],
        ];
    }
}
