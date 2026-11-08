<?php

use App\Http\Controllers\Admin\BerandasController;
use App\Http\Controllers\Admin\BeritaAdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EkstrakurikulerAdminController;
use App\Http\Controllers\Admin\FasilitasAdminController;
use App\Http\Controllers\Admin\KalenderPendidikanAdminController;
use App\Http\Controllers\Admin\KurikulumAdminController;
use App\Http\Controllers\Admin\PpdbAdminController;
use App\Http\Controllers\Admin\PrestasiSiswaAdminController;
use App\Http\Controllers\Admin\ProgramUnggulanAdminController;
use App\Http\Controllers\Admin\RunningTextAdminController;
use App\Http\Controllers\Admin\SejarahAdminController;
use App\Http\Controllers\Admin\TenagaPendidikAdminController;
use App\Http\Controllers\Admin\VisiMisiAdminController;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\EkstrakurikulerController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\KalenderPendidikanController;
use App\Http\Controllers\KurikulumController;
use App\Http\Controllers\PpdbController;
use App\Http\Controllers\PrestasiSiswaController;
use App\Http\Controllers\ProgramUnggulanController;
use App\Http\Controllers\SejarahController;
use App\Http\Controllers\TenagaPendidikController;
use App\Http\Controllers\VisimisiController;

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| FRONTEND
|--------------------------------------------------------------------------
*/


// ============================================================
// BERANDA
// ============================================================

Route::get(
    '/',
    [BerandaController::class, 'index']
)->name('/');


// ============================================================
// BERITA
// ============================================================

Route::get(
    '/berita',
    [BeritaController::class, 'index']
)->name('berita.index');

Route::get(
    '/berita/{slug}',
    [BeritaController::class, 'show']
)->name('berita.show');


// ============================================================
// PROFILE
// ============================================================

// Visi & Misi
Route::get(
    '/profile/visi-misi',
    [VisimisiController::class, 'index']
)->name('visimisi.index');

// Sejarah
Route::get(
    '/profile/sejarah',
    [SejarahController::class, 'index']
)->name('sejarah.index');

// Tenaga Pendidik
Route::get(
    '/profile/tenaga-pendidik',
    [TenagaPendidikController::class, 'index']
)->name('tenaga-pendidik.index');


// ============================================================
// AKADEMIK
// ============================================================

// Kurikulum
Route::get(
    '/akademik/kurikulum',
    [KurikulumController::class, 'index']
)->name('kurikulum.index');

// Ekstrakurikuler
Route::get(
    '/akademik/ekstrakurikuler',
    [EkstrakurikulerController::class, 'index']
)->name('ekstrakurikuler.index');

// Prestasi Siswa
Route::get(
    '/akademik/prestasi-siswa',
    [PrestasiSiswaController::class, 'index']
)->name('prestasi-siswa.index');

// Program Unggulan
Route::get(
    '/akademik/program-unggulan',
    [ProgramUnggulanController::class, 'index']
)->name('program-unggulan.index');

// Kalender Pendidikan
Route::get(
    '/akademik/kalender-pendidikan',
    [KalenderPendidikanController::class, 'index']
)->name('kalender-pendidikan.index');


// ============================================================
// FASILITAS
// ============================================================

Route::get(
    '/fasilitas',
    [FasilitasController::class, 'index']
)->name('fasilitas.index');


// ============================================================
// PPDB
// ============================================================

Route::get(
    '/ppdb',
    [PpdbController::class, 'index']
)->name('ppdb.index');

Route::post(
    '/ppdb',
    [PpdbController::class, 'store']
)->name('ppdb.store');
// ============================================================
// PPDB SUCCESS
// ============================================================

Route::get(
    '/ppdb/success/{nomor_pendaftaran}',
    [PpdbController::class, 'success']
)
    ->where('nomor_pendaftaran', '.*')
    ->name('ppdb.success');


// ============================================================
// PPDB DOWNLOAD
// ============================================================

Route::get(
    '/ppdb/download/{nomor_pendaftaran}',
    [PpdbController::class, 'download']
)
    ->where('nomor_pendaftaran', '.*')
    ->name('ppdb.download');
/*
|--------------------------------------------------------------------------
| AUTHENTICATION
|--------------------------------------------------------------------------
*/


Route::get(
    '/login',
    [AuthController::class, 'showLoginForm']
)->name('login');

Route::post(
    '/login',
    [AuthController::class, 'login']
);

Route::post(
    '/logout',
    [AuthController::class, 'logout']
)->name('logout');



/*
|--------------------------------------------------------------------------
| ADMIN - DASHBOARD & BERANDA
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])
    ->prefix('admin')
    ->group(function () {

        // ====================================================
        // DASHBOARD / PROFILE SEKOLAH
        // ====================================================

        Route::get(
            '/dashboard',
            [DashboardController::class, 'index']
        )->name('admin.dashboard');

        Route::post(
            '/dashboard/update',
            [DashboardController::class, 'update']
        )->name('admin.dashboard.update');


        // ====================================================
        // BERANDA
        // ====================================================

        // ----------------------------------------------------
        // Videotron
        // ----------------------------------------------------

        Route::get(
            '/videotron',
            [BerandasController::class, 'videotron']
        )->name('admin.berandas.videotron');

        Route::put(
            '/videotron',
            [BerandasController::class, 'updateVideotron']
        )->name('admin.berandas.videotron.update');


        // ----------------------------------------------------
        // Sambutan
        // ----------------------------------------------------

        Route::get(
            '/sambutan',
            [BerandasController::class, 'sambutan']
        )->name('admin.berandas.sambutan');

        Route::put(
            '/sambutan',
            [BerandasController::class, 'sambutanUpdate']
        )->name('admin.berandas.sambutan.update');


        // ----------------------------------------------------
        // Keunggulan
        // ----------------------------------------------------

        Route::get(
            '/keunggulan',
            [BerandasController::class, 'keunggulan']
        )->name('admin.berandas.keunggulan');

        Route::get(
            '/keunggulan/create',
            [BerandasController::class, 'keunggulanCreate']
        )->name('admin.berandas.keunggulan.create');

        Route::post(
            '/keunggulan',
            [BerandasController::class, 'keunggulanStore']
        )->name('admin.berandas.keunggulan.store');

        Route::get(
            '/keunggulan/{id}/edit',
            [BerandasController::class, 'keunggulanEdit']
        )->name('admin.berandas.keunggulan.edit');

        Route::put(
            '/keunggulan/{id}',
            [BerandasController::class, 'keunggulanUpdate']
        )->name('admin.berandas.keunggulan.update');

        Route::delete(
            '/keunggulan/{id}',
            [BerandasController::class, 'keunggulanDestroy']
        )->name('admin.berandas.keunggulan.destroy');

        Route::post(
            '/keunggulan/urutan',
            [BerandasController::class, 'updateUrutanKeunggulan']
        )->name('admin.berandas.keunggulan.urutan');


        // ====================================================
        // PROFILE
        // ====================================================

        // ----------------------------------------------------
        // Visi & Misi
        // ----------------------------------------------------

        Route::get(
            '/profile/visi-misi',
            [VisimisiController::class, 'admin']
        )->name('admin.profile.visi-misi');

        Route::put(
            '/profile/visi-misi',
            [VisimisiController::class, 'update']
        )->name('admin.profile.visi-misi.update');


        // ----------------------------------------------------
        // Struktur Organisasi
        // ----------------------------------------------------

        Route::get(
            '/profile/struktur',
            [DashboardController::class, 'struktur']
        )->name('admin.profile.struktur');

        Route::put(
            '/profile/struktur',
            [DashboardController::class, 'updateStruktur']
        )->name('admin.profile.struktur.update');

    });



/*
|--------------------------------------------------------------------------
| ADMIN - BERITA & KEGIATAN
|--------------------------------------------------------------------------
*/

Route::prefix('admin/berandas')
    ->name('admin.berandas.')
    ->middleware(['auth'])
    ->group(function () {

        // ====================================================
        // BERITA
        // ====================================================

        Route::get(
            '/berita',
            [BerandasController::class, 'beritaIndex']
        )->name('berita');

        Route::get(
            '/berita/create',
            [BerandasController::class, 'beritaCreate']
        )->name('berita.create');

        Route::post(
            '/berita',
            [BerandasController::class, 'beritaStore']
        )->name('berita.store');

        Route::get(
            '/berita/{berita}',
            [BerandasController::class, 'beritaShow']
        )->name('berita.show');

        Route::get(
            '/berita/{berita}/edit',
            [BerandasController::class, 'beritaEdit']
        )->name('berita.edit');

        Route::put(
            '/berita/{berita}',
            [BerandasController::class, 'beritaUpdate']
        )->name('berita.update');

        Route::delete(
            '/berita/{berita}',
            [BerandasController::class, 'beritaDestroy']
        )->name('berita.destroy');

    });



/*
|--------------------------------------------------------------------------
| ADMIN - PROFILE - SEJARAH SEKOLAH
|--------------------------------------------------------------------------
*/

Route::prefix('admin/profile/sejarah')
    ->name('admin.profile.sejarah.')
    ->middleware(['auth'])
    ->group(function () {

        Route::get(
            '/',
            [SejarahAdminController::class, 'index']
        )->name('index');

        Route::get(
            '/create',
            [SejarahAdminController::class, 'create']
        )->name('create');

        Route::post(
            '/',
            [SejarahAdminController::class, 'store']
        )->name('store');

        Route::get(
            '/{sejarah}',
            [SejarahAdminController::class, 'show']
        )->name('show');

        Route::get(
            '/{sejarah}/edit',
            [SejarahAdminController::class, 'edit']
        )->name('edit');

        Route::put(
            '/{sejarah}',
            [SejarahAdminController::class, 'update']
        )->name('update');

        Route::delete(
            '/{sejarah}',
            [SejarahAdminController::class, 'destroy']
        )->name('destroy');

    });



/*
|--------------------------------------------------------------------------
| ADMIN - PROFILE - VISI & MISI
|--------------------------------------------------------------------------
*/

Route::prefix('admin/profile/visi-misi')
    ->name('admin.profile.visi-misi.')
    ->middleware(['auth'])
    ->group(function () {

        // ====================================================
        // INDEX
        // ====================================================

        Route::get(
            '/',
            [VisiMisiAdminController::class, 'index']
        )->name('index');


        // ====================================================
        // VISI
        // ====================================================

        Route::post(
            '/visi',
            [VisiMisiAdminController::class, 'storeVisi']
        )->name('visi.store');

        Route::put(
            '/visi/{visi}',
            [VisiMisiAdminController::class, 'updateVisi']
        )->name('visi.update');

        Route::delete(
            '/visi/{visi}',
            [VisiMisiAdminController::class, 'destroyVisi']
        )->name('visi.destroy');


        // ====================================================
        // MISI
        // ====================================================

        Route::post(
            '/misi',
            [VisiMisiAdminController::class, 'storeMisi']
        )->name('misi.store');

        Route::put(
            '/misi/{misi}',
            [VisiMisiAdminController::class, 'updateMisi']
        )->name('misi.update');

        Route::delete(
            '/misi/{misi}',
            [VisiMisiAdminController::class, 'destroyMisi']
        )->name('misi.destroy');

        Route::patch(
            '/misi/{misi}/toggle',
            [VisiMisiAdminController::class, 'toggleMisi']
        )->name('misi.toggle');

        Route::post(
            '/misi/order',
            [VisiMisiAdminController::class, 'updateMisiOrder']
        )->name('misi.order');

    });



/*
|--------------------------------------------------------------------------
| ADMIN - PROFILE - TENAGA PENDIDIK
|--------------------------------------------------------------------------
*/

Route::prefix('admin/profile/tenaga-pendidik')
    ->name('admin.profile.tenaga-pendidik.')
    ->middleware(['auth'])
    ->group(function () {

        // Index
        Route::get(
            '/',
            [TenagaPendidikAdminController::class, 'index']
        )->name('index');

        // Data
        Route::get(
            '/data',
            [TenagaPendidikAdminController::class, 'data']
        )->name('data');

        // Store
        Route::post(
            '/',
            [TenagaPendidikAdminController::class, 'store']
        )->name('store');

        // Order
        Route::post(
            '/order',
            [TenagaPendidikAdminController::class, 'updateOrder']
        )->name('order');

        // Toggle status
        Route::patch(
            '/{tenagaPendidik}/toggle-status',
            [TenagaPendidikAdminController::class, 'toggleStatus']
        )->name('toggle-status');

        // Update
        Route::put(
            '/{tenagaPendidik}',
            [TenagaPendidikAdminController::class, 'update']
        )->name('update');

        // Delete
        Route::delete(
            '/{tenagaPendidik}',
            [TenagaPendidikAdminController::class, 'destroy']
        )->name('destroy');

    });



/*
|--------------------------------------------------------------------------
| ADMIN - AKADEMIK - KURIKULUM
|--------------------------------------------------------------------------
*/

Route::prefix('admin/akademik/kurikulum')
    ->name('admin.akademik.kurikulum.')
    ->middleware(['auth'])
    ->group(function () {

        // Index
        Route::get(
            '/',
            [KurikulumAdminController::class, 'index']
        )->name('index');

        // Data
        Route::get(
            '/data',
            [KurikulumAdminController::class, 'data']
        )->name('data');

        // Store
        Route::post(
            '/',
            [KurikulumAdminController::class, 'store']
        )->name('store');

        // Order
        Route::post(
            '/order',
            [KurikulumAdminController::class, 'updateOrder']
        )->name('order');

        // Toggle status
        Route::patch(
            '/{kurikulum}/toggle-status',
            [KurikulumAdminController::class, 'toggleStatus']
        )->name('toggle-status');

        // Update
        Route::put(
            '/{kurikulum}',
            [KurikulumAdminController::class, 'update']
        )->name('update');

        // Delete
        Route::delete(
            '/{kurikulum}',
            [KurikulumAdminController::class, 'destroy']
        )->name('destroy');

    });



/*
|--------------------------------------------------------------------------
| ADMIN - AKADEMIK - KALENDER PENDIDIKAN
|--------------------------------------------------------------------------
*/

Route::prefix('admin/akademik/kalender-pendidikan')
    ->name('admin.akademik.kalender-pendidikan.')
    ->middleware(['auth'])
    ->group(function () {

        // Index
        Route::get(
            '/',
            [KalenderPendidikanAdminController::class, 'index']
        )->name('index');

        // Data
        Route::get(
            '/data',
            [KalenderPendidikanAdminController::class, 'data']
        )->name('data');

        // Order
        Route::post(
            '/order',
            [KalenderPendidikanAdminController::class, 'updateOrder']
        )->name('order');

        // Store
        Route::post(
            '/',
            [KalenderPendidikanAdminController::class, 'store']
        )->name('store');

        // Toggle status
        Route::patch(
            '/{kalenderPendidikan}/toggle-status',
            [KalenderPendidikanAdminController::class, 'toggleStatus']
        )->name('toggle-status');

        // Update
        Route::put(
            '/{kalenderPendidikan}',
            [KalenderPendidikanAdminController::class, 'update']
        )->name('update');

        // Delete
        Route::delete(
            '/{kalenderPendidikan}',
            [KalenderPendidikanAdminController::class, 'destroy']
        )->name('destroy');

    });



/*
|--------------------------------------------------------------------------
| ADMIN - AKADEMIK - PROGRAM UNGGULAN
|--------------------------------------------------------------------------
*/

Route::prefix('admin/akademik/program-unggulan')
    ->name('admin.akademik.program-unggulan.')
    ->middleware(['auth'])
    ->controller(ProgramUnggulanAdminController::class)
    ->group(function () {

        // ====================================================
        // INDEX
        // ====================================================

        Route::get(
            '/',
            'index'
        )->name('index');


        // ====================================================
        // DATA
        // ====================================================

        Route::get(
            '/data',
            'data'
        )->name('data');


        // ====================================================
        // ORDER
        // ====================================================

        Route::post(
            '/order',
            'order'
        )->name('order');


        // ====================================================
        // CREATE
        // ====================================================

        Route::get(
            '/create',
            'create'
        )->name('create');


        // ====================================================
        // STORE
        // ====================================================

        Route::post(
            '/',
            'store'
        )->name('store');


        // ====================================================
        // EDIT
        // ====================================================

        Route::get(
            '/{programUnggulan}/edit',
            'edit'
        )->name('edit');


        // ====================================================
        // UPDATE
        // ====================================================

        Route::put(
            '/{programUnggulan}',
            'update'
        )->name('update');


        // ====================================================
        // DELETE
        // ====================================================

        Route::delete(
            '/{programUnggulan}',
            'destroy'
        )->name('destroy');


        // ====================================================
        // TOGGLE STATUS
        // ====================================================

        Route::post(
            '/{programUnggulan}/toggle-status',
            'toggleStatus'
        )->name('toggle-status');

    });



/*
|--------------------------------------------------------------------------
| ADMIN - AKADEMIK - EKSTRAKURIKULER
|--------------------------------------------------------------------------
*/

Route::prefix('admin/akademik/ekstrakurikuler')
    ->name('admin.akademik.ekstrakurikuler.')
    ->middleware(['auth'])
    ->controller(EkstrakurikulerAdminController::class)
    ->group(function () {

        // ====================================================
        // INDEX
        // ====================================================

        Route::get(
            '/',
            'index'
        )->name('index');


        // ====================================================
        // DATA
        // ====================================================

        Route::get(
            '/data',
            'data'
        )->name('data');


        // ====================================================
        // ORDER
        // ====================================================

        Route::post(
            '/order',
            'order'
        )->name('order');


        // ====================================================
        // CREATE
        // ====================================================

        Route::get(
            '/create',
            'create'
        )->name('create');


        // ====================================================
        // STORE
        // ====================================================

        Route::post(
            '/',
            'store'
        )->name('store');


        // ====================================================
        // EDIT
        // ====================================================

        Route::get(
            '/{ekstrakurikuler}/edit',
            'edit'
        )->name('edit');


        // ====================================================
        // UPDATE
        // ====================================================

        Route::put(
            '/{ekstrakurikuler}',
            'update'
        )->name('update');


        // ====================================================
        // DELETE
        // ====================================================

        Route::delete(
            '/{ekstrakurikuler}',
            'destroy'
        )->name('destroy');


        // ====================================================
        // TOGGLE STATUS
        // ====================================================

        Route::post(
            '/{ekstrakurikuler}/toggle-status',
            'toggleStatus'
        )->name('toggle-status');

    });



/*
|--------------------------------------------------------------------------
| ADMIN - AKADEMIK - PRESTASI SISWA
|--------------------------------------------------------------------------
*/

Route::prefix('admin/akademik/prestasi-siswa')
    ->name('admin.akademik.prestasi-siswa.')
    ->middleware(['auth'])
    ->controller(PrestasiSiswaAdminController::class)
    ->group(function () {

        Route::get('/', 'index')
            ->name('index');

        Route::get('/data', 'data')
            ->name('data');

        Route::post('/order', 'order')
            ->name('order');

        Route::get('/create', 'create')
            ->name('create');

        Route::post('/', 'store')
            ->name('store');

        Route::get('/{prestasiSiswa}/edit', 'edit')
            ->name('edit');

        Route::put('/{prestasiSiswa}', 'update')
            ->name('update');

        Route::delete('/{prestasiSiswa}', 'destroy')
            ->name('destroy');

        Route::post('/{prestasiSiswa}/toggle-status', 'toggleStatus')
            ->name('toggle-status');
    });



/*
|--------------------------------------------------------------------------
| ADMIN - FASILITAS
|--------------------------------------------------------------------------
*/
Route::prefix('admin/akademik/fasilitas')
    ->name('admin.akademik.fasilitas.')
    ->middleware(['auth'])
    ->controller(FasilitasAdminController::class)
    ->group(function () {

        Route::get('/', 'index')
            ->name('index');

        Route::get('/data', 'data')
            ->name('data');

        Route::post('/order', 'order')
            ->name('order');

        Route::get('/create', 'create')
            ->name('create');

        Route::post('/', 'store')
            ->name('store');

        Route::get('/{fasilitas}/edit', 'edit')
            ->name('edit');

        Route::put('/{fasilitas}', 'update')
            ->name('update');

        Route::delete('/{fasilitas}', 'destroy')
            ->name('destroy');

        Route::post('/{fasilitas}/toggle-status', 'toggleStatus')
            ->name('toggle-status');
    });



Route::prefix('admin/berita')
    ->name('admin.berita.')
    ->middleware(['auth'])
    ->controller(BeritaAdminController::class)
    ->group(function () {

        Route::get('/', 'index')
            ->name('index');

        Route::get('/data', 'data')
            ->name('data');

        Route::get('/create', 'create')
            ->name('create');

        Route::post('/', 'store')
            ->name('store');

        /*
        |--------------------------------------------------------------------------
        | Summernote Upload Image
        |--------------------------------------------------------------------------
        */
        Route::post('/upload-summernote-image', 'uploadSummernoteImage')
            ->name('upload-summernote-image');

        Route::get('/{berita}/edit', 'edit')
            ->name('edit');

        Route::post('/{berita}', 'update')
            ->name('update');

        Route::delete('/{berita}', 'destroy')
            ->name('destroy');

        Route::post('/{berita}/toggle-status', 'toggleStatus')
            ->name('toggle-status');

        Route::post('/{berita}/toggle-featured', 'toggleFeatured')
            ->name('toggle-featured');
    });



/*
|--------------------------------------------------------------------------
| ADMIN - PPDB
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])
    ->prefix('admin')
    ->group(function () {

        // ====================================================
        // INDEX
        // ====================================================

        Route::get(
            '/ppdb',
            [PpdbAdminController::class, 'index']
        )->name('admin.ppdb.index');


        // ====================================================
        // DOWNLOAD EXCEL
        // ====================================================

        Route::get(
            '/ppdb/download-excel',
            [PpdbAdminController::class, 'downloadExcel']
        )->name('admin.ppdb.download-excel');


        // ====================================================
        // UPDATE
        // ====================================================

        Route::put(
            '/ppdb/{id}',
            [PpdbAdminController::class, 'update']
        )->name('admin.ppdb.update');


        // ====================================================
        // DELETE
        // ====================================================

        Route::delete(
            '/ppdb/{id}',
            [PpdbAdminController::class, 'destroy']
        )->name('admin.ppdb.delete');

    });
/*
|--------------------------------------------------------------------------
| ADMIN - BERANDA - RUNNING TEXT
|--------------------------------------------------------------------------
*/

Route::prefix('admin/running-text')
    ->name('admin.berandas.running-text.')
    ->middleware(['auth'])
    ->controller(RunningTextAdminController::class)
    ->group(function () {

        // ====================================================
        // INDEX
        // ====================================================

        Route::get(
            '/',
            'index'
        )->name('index');


        // ====================================================
        // DATA
        // ====================================================

        Route::get(
            '/data',
            'data'
        )->name('data');


        // ====================================================
        // CREATE
        // ====================================================

        Route::get(
            '/create',
            'create'
        )->name('create');


        // ====================================================
        // STORE
        // ====================================================

        Route::post(
            '/',
            'store'
        )->name('store');


        // ====================================================
        // ORDER
        // ====================================================

        Route::post(
            '/order',
            'order'
        )->name('order');


        // ====================================================
        // EDIT
        // ====================================================

        Route::get(
            '/{runningText}/edit',
            'edit'
        )->name('edit');


        // ====================================================
        // UPDATE
        // ====================================================

        Route::put(
            '/{runningText}',
            'update'
        )->name('update');


        // ====================================================
        // DELETE
        // ====================================================

        Route::delete(
            '/{runningText}',
            'destroy'
        )->name('destroy');


        // ====================================================
        // TOGGLE STATUS
        // ====================================================

        Route::post(
            '/{runningText}/toggle-status',
            'toggleStatus'
        )->name('toggle-status');

    });
