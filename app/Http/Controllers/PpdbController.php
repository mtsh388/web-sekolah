<?php

namespace App\Http\Controllers;

use App\Models\Ppdb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
class PpdbController extends Controller
{
    /**
     * Menampilkan halaman formulir PPDB
     */
    public function index()
    {
        return view('ppdb.index');
    }

    /**
     * Menyimpan pendaftaran PPDB
     */
    public function store(Request $request)
    {
        // ============================================================
        // VALIDASI
        // ============================================================

        $validated = $request->validate([
            // --------------------------------------------------------
            // A. DATA CALON SISWA
            // --------------------------------------------------------

            'nama_lengkap' => [
                'required',
                'string',
                'max:255',
            ],

            'tempat_lahir' => [
                'required',
                'string',
                'max:100',
            ],

            'tanggal_lahir' => [
                'required',
                'date',
            ],

            'jenis_kelamin' => [
                'required',
                'in:Laki-laki,Perempuan',
            ],

            'alamat' => [
                'required',
                'string',
            ],

            'kondisi_fisik' => [
                'nullable',
                'string',
                'max:255',
            ],

            'nik' => [
                'required',
                'digits:16',
            ],

            'nomor_akta_kelahiran' => [
                'nullable',
                'string',
                'max:100',
            ],

            'no_hp_wa' => [
                'required',
                'string',
                'max:20',
            ],

            // --------------------------------------------------------
            // B. DATA PENDIDIKAN
            // --------------------------------------------------------

            'sekolah_asal' => [
                'required',
                'string',
                'max:255',
            ],

            'alamat_sekolah_asal' => [
                'required',
                'string',
            ],

            'nisn' => [
                'nullable',
                'digits:10',
            ],

            'mendaftar_sebagai' => [
                'required',
                'string',
                'max:100',
            ],

            'nomor_ijazah' => [
                'nullable',
                'string',
                'max:100',
            ],

            // --------------------------------------------------------
            // C. DATA AYAH
            // --------------------------------------------------------

            'nama_ayah' => [
                'required_without_all:nama_ibu,nama_wali',
                'nullable',
                'string',
                'max:255',
            ],

            'nik_ayah' => [
                'required_with:nama_ayah',
                'nullable',
                'digits:16',
            ],

            'no_hp_wa_ayah' => [
                'required_with:nama_ayah',
                'nullable',
                'string',
                'max:20',
            ],

            'pekerjaan_ayah' => [
                'required_with:nama_ayah',
                'nullable',
                'string',
                'max:100',
            ],

            'pendidikan_ayah' => [
                'required_with:nama_ayah',
                'nullable',
                'string',
                'max:100',
            ],

            'alamat_tinggal_ayah' => [
                'required_with:nama_ayah',
                'nullable',
                'string',
            ],



            // --------------------------------------------------------
            // DATA IBU
            // --------------------------------------------------------

            'nama_ibu' => [
                'required_without_all:nama_ayah,nama_wali',
                'nullable',
                'string',
                'max:255',
            ],

            'nik_ibu' => [
                'required_with:nama_ibu',
                'nullable',
                'digits:16',
            ],

            'no_hp_wa_ibu' => [
                'required_with:nama_ibu',
                'nullable',
                'string',
                'max:20',
            ],

            'pekerjaan_ibu' => [
                'required_with:nama_ibu',
                'nullable',
                'string',
                'max:100',
            ],

            'pendidikan_ibu' => [
                'required_with:nama_ibu',
                'nullable',
                'string',
                'max:100',
            ],

            'alamat_tinggal_ibu' => [
                'required_with:nama_ibu',
                'nullable',
                'string',
            ],

            // --------------------------------------------------------
            // DATA WALI
            // --------------------------------------------------------

            'nama_wali' => [
                'required_without_all:nama_ayah,nama_ibu',
                'nullable',
                'string',
                'max:255',
            ],

            'nik_wali' => [
                'required_with:nama_wali',
                'nullable',
                'digits:16',
            ],

            'no_hp_wa_wali' => [
                'required_with:nama_wali',
                'nullable',
                'string',
                'max:20',
            ],

            'pekerjaan_wali' => [
                'required_with:nama_wali',
                'nullable',
                'string',
                'max:100',
            ],

            'pendidikan_wali' => [
                'required_with:nama_wali',
                'nullable',
                'string',
                'max:100',
            ],

            'alamat_tinggal_wali' => [
                'required_with:nama_wali',
                'nullable',
                'string',
            ],
        ], [
            'nama_lengkap.required' => 'Nama lengkap calon siswa wajib diisi.',
            'tempat_lahir.required' => 'Tempat lahir wajib diisi.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'alamat.required' => 'Alamat wajib diisi.',
            'nik.required' => 'NIK wajib diisi.',
            'nik.digits' => 'NIK harus terdiri dari 16 digit.',
            'nisn.digits' => 'NISN harus terdiri dari 10 digit.',
            'no_hp_wa.required' => 'Nomor HP/WA wajib diisi.',
            'sekolah_asal.required' => 'Sekolah asal wajib diisi.',
            'alamat_sekolah_asal.required' => 'Alamat sekolah asal wajib diisi.',
            'mendaftar_sebagai.required' => 'Pilihan pendaftaran wajib dipilih.',
            // Minimal salah satu
            'nama_ayah.required_without_all' =>
                'Data Ayah, Ibu, atau Wali minimal salah satu harus diisi.',

            'nama_ibu.required_without_all' =>
                'Data Ayah, Ibu, atau Wali minimal salah satu harus diisi.',

            'nama_wali.required_without_all' =>
                'Data Ayah, Ibu, atau Wali minimal salah satu harus diisi.',


            // Ayah
            'nik_ayah.required_with' =>
                'NIK Ayah wajib diisi jika data Ayah diisi.',

            'nik_ayah.digits' =>
                'NIK Ayah harus terdiri dari 16 digit.',

            'no_hp_wa_ayah.required_with' =>
                'No. HP/WA Ayah wajib diisi jika data Ayah diisi.',

            'pekerjaan_ayah.required_with' =>
                'Pekerjaan Ayah wajib diisi jika data Ayah diisi.',

            'pendidikan_ayah.required_with' =>
                'Pendidikan Ayah wajib diisi jika data Ayah diisi.',

            'alamat_tinggal_ayah.required_with' =>
                'Alamat tinggal Ayah wajib diisi jika data Ayah diisi.',


            // Ibu
            'nik_ibu.required_with' =>
                'NIK Ibu wajib diisi jika data Ibu diisi.',

            'nik_ibu.digits' =>
                'NIK Ibu harus terdiri dari 16 digit.',

            'no_hp_wa_ibu.required_with' =>
                'No. HP/WA Ibu wajib diisi jika data Ibu diisi.',

            'pekerjaan_ibu.required_with' =>
                'Pekerjaan Ibu wajib diisi jika data Ibu diisi.',

            'pendidikan_ibu.required_with' =>
                'Pendidikan Ibu wajib diisi jika data Ibu diisi.',

            'alamat_tinggal_ibu.required_with' =>
                'Alamat tinggal Ibu wajib diisi jika data Ibu diisi.',


            // Wali
            'nik_wali.required_with' =>
                'NIK Wali wajib diisi jika data Wali diisi.',

            'nik_wali.digits' =>
                'NIK Wali harus terdiri dari 16 digit.',

            'no_hp_wa_wali.required_with' =>
                'No. HP/WA Wali wajib diisi jika data Wali diisi.',

            'pekerjaan_wali.required_with' =>
                'Pekerjaan Wali wajib diisi jika data Wali diisi.',

            'pendidikan_wali.required_with' =>
                'Pendidikan Wali wajib diisi jika data Wali diisi.',

            'alamat_tinggal_wali.required_with' =>
                'Alamat tinggal Wali wajib diisi jika data Wali diisi.',
        ]);

        // ============================================================
        // PROSES SIMPAN DENGAN TRANSACTION (AMAN DARI NOMOR GANDA)
        // ============================================================

        $ppdb = DB::transaction(function () use ($validated) {
            $tahun = date('Y') . '/' . date('Y', strtotime('+1 year'));

            // lockForUpdate() mencegah pendaftar lain membaca nomor terakhir yang sama di waktu bersamaan
            $lastPpdb = \App\Models\Ppdb::where('tahun_pendaftaran', $tahun)
                ->lockForUpdate()
                ->orderBy('id', 'desc')
                ->first();

            if ($lastPpdb) {
                // Pecah string berdasarkan '-' lalu ambil bagian paling akhir (angka)
                $parts = explode('-', $lastPpdb->nomor_pendaftaran);
                $lastUrutan = (int) end($parts);
                $nextUrutan = $lastUrutan + 1;
            } else {
                // Jika belum ada data di tahun tersebut, mulai dari 1
                $nextUrutan = 1;
            }

            // Format urutan menjadi 3 digit (contoh: 001, 002, 010, dst.)
            $formatUrutan = str_pad($nextUrutan, 3, '0', STR_PAD_LEFT);

            // ============================================================
            // DATA TAMBAHAN & SIMPAN
            // ============================================================
            $validated['nomor_pendaftaran'] = 'SMA-' . $tahun . '-' . $formatUrutan;
            $validated['tahun_pendaftaran'] = $tahun;
            $validated['status'] = 'menunggu';

            return Ppdb::create($validated);
        });

        // ============================================================
        // REDIRECT
        // ============================================================

        return redirect()
            ->route('ppdb.success', [
                'nomor_pendaftaran' => $ppdb->nomor_pendaftaran,
            ])
            ->with(
                'success',
                'Pendaftaran PPDB berhasil dikirim.'
            );
    }

    /**
     * Halaman setelah pendaftaran berhasil
     */
    /**
     * Halaman setelah pendaftaran berhasil
     */
    /**
     * Halaman setelah pendaftaran berhasil
     */
    public function success(string $nomor_pendaftaran)
    {
        $ppdb = Ppdb::where(
            'nomor_pendaftaran',
            $nomor_pendaftaran
        )->firstOrFail();

        return view(
            'ppdb.success',
            compact('ppdb')
        );
    }

    /**
     * Download bukti pendaftaran
     */
    /**
     * Download bukti pendaftaran
     */
    /**
     * Download bukti pendaftaran
     */
    public function download(string $nomor_pendaftaran)
    {
        $ppdb = Ppdb::where(
            'nomor_pendaftaran',
            $nomor_pendaftaran
        )->firstOrFail();

        $ppdb->update([
            'sudah_download' => true,
        ]);

        $pdf = Pdf::loadView(
            'ppdb.pdf',
            compact('ppdb')
        );

        $pdf->setPaper('A4', 'portrait');

        return $pdf->download(
            'Bukti-Pendaftaran-' .
            str_replace(
                '/',
                '-',
                $ppdb->nomor_pendaftaran
            ) .
            '.pdf'
        );
    }
}
