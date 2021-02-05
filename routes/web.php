<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CatatanWalikelasController;
use App\Http\Controllers\CetakController;
use App\Http\Controllers\EkstrakurikulerController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KompetensiDasarController;
use App\Http\Controllers\MatpelController;
use App\Http\Controllers\NilaiSikapController;
use App\Http\Controllers\NilaiSiswaController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SetupKelasController;
use App\Http\Controllers\SetupMatpelController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TahunAjarController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WaliKelasController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware(['guest'])->group(function () {
    Route::get('/', [AuthController::class, 'viewLogin']);
    Route::get('/login', [AuthController::class, 'viewLogin'])->name('auth.login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('auth.login.action');
});

Route::middleware(['auth'])->group(function () {
    //auth
    Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');

    //dashboard
    Route::get('/home', [HomeController::class, 'index'])->name('view.home');

    //change role
    Route::post('/change_role',[AuthController::class,'changeRole'])->name('auth.change_role');

    //system
    //roles
    Route::get('/roles', [RoleController::class, 'index'])->name('view.role');
    Route::post('/roles', [RoleController::class, 'store'])->name('insert.role');
    Route::post('/roles/delete', [RoleController::class, 'destroy'])->name('delete.role');

    //pengguna
    Route::get('users', [UserController::class, 'index'])->name('view.user');
    Route::get('users/create', [UserController::class, 'create'])->name('view.user.insert');
    Route::post('users/store', [UserController::class, 'store'])->name('insert.user');
    Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('view.user.edit');
    Route::post('users/{id}/update', [UserController::class, 'update'])->name('update.user');
    Route::post('users/delete', [UserController::class, 'destroy'])->name('delete.user');
    Route::post('users/{id}/reset_password', [UserController::class, 'resetPassword'])->name('reset_password.user');

    //master_data
    //tahun ajar
    Route::get('tahun', [TahunAjarController::class, 'index'])->name('view.tahun');
    Route::get('tahun/create', [TahunAjarController::class, 'create'])->name('view.tahun.insert');
    Route::post('tahun/store', [TahunAjarController::class, 'store'])->name('insert.tahun');
    Route::get('tahun/{id}/edit', [TahunAjarController::class, 'edit'])->name('view.tahun.edit');
    Route::post('tahun/{id}/update', [TahunAjarController::class, 'update'])->name('update.tahun');
    Route::post('tahun/delete', [TahunAjarController::class, 'destroy'])->name('delete.tahun');
    Route::post('tahun/status', [TahunAjarController::class, 'status'])->name('status.tahun');

    //kelas
    Route::get('kelas', [KelasController::class, 'index'])->name('view.kelas');
    Route::get('kelas/create', [KelasController::class, 'create'])->name('view.kelas.insert');
    Route::post('kelas/store', [KelasController::class, 'store'])->name('insert.kelas');
    Route::get('kelas/{id}/edit', [KelasController::class, 'edit'])->name('view.kelas.edit');
    Route::post('kelas/{id}/update', [KelasController::class, 'update'])->name('update.kelas');
    Route::post('kelas/delete', [KelasController::class, 'destroy'])->name('delete.kelas');


    //matpel
    Route::get('mata_pelajaran', [MatpelController::class, 'index'])->name('view.mata_pelajaran');
    Route::get('mata_pelajaran/create', [MatpelController::class, 'create'])->name('view.mata_pelajaran.insert');
    Route::post('mata_pelajaran/store', [MatpelController::class, 'store'])->name('insert.mata_pelajaran');
    Route::get('mata_pelajaran/{id}/edit', [MatpelController::class, 'edit'])->name('view.mata_pelajaran.edit');
    Route::post('mata_pelajaran/{id}/update', [MatpelController::class, 'update'])->name('update.mata_pelajaran');
    Route::post('mata_pelajaran/delete', [MatpelController::class, 'destroy'])->name('delete.mata_pelajaran');

    //guru
    Route::get('guru', [GuruController::class, 'index'])->name('view.guru');
    Route::get('guru/create', [GuruController::class, 'create'])->name('view.guru.insert');
    Route::post('guru/store', [GuruController::class, 'store'])->name('insert.guru');
    Route::get('guru/{id}/edit', [GuruController::class, 'edit'])->name('view.guru.edit');
    Route::post('guru/{id}/update', [GuruController::class, 'update'])->name('update.guru');
    Route::post('guru/delete', [GuruController::class, 'destroy'])->name('delete.guru');

    //siswa
    Route::get('siswa', [SiswaController::class, 'index'])->name('view.siswa');
    Route::get('siswa/create', [SiswaController::class, 'create'])->name('view.siswa.insert');
    Route::post('siswa/store', [SiswaController::class, 'store'])->name('insert.siswa');
    Route::get('siswa/{id}/edit', [SiswaController::class, 'edit'])->name('view.siswa.edit');
    Route::post('siswa/{id}/update', [SiswaController::class, 'update'])->name('update.siswa');
    Route::post('siswa/delete', [SiswaController::class, 'destroy'])->name('delete.siswa');

    //walikelas
    Route::get('setup_wali', [WaliKelasController::class, 'index'])->name('view.walikelas');
    Route::post('setup_wali/store', [WaliKelasController::class, 'store'])->name('insert.walikelas');
    Route::post('setup_wali/delete', [WaliKelasController::class, 'destroy'])->name('delete.walikelas');
    Route::get('kelas_saya/{id}',[WaliKelasController::class,'show'])->name('view.kelas_saya');

    //setup_kelas
    Route::get('setup_class', [SetupKelasController::class, 'index'])->name('view.setup_kelas');
    Route::get('setup_class/create', [SetupKelasController::class, 'create'])->name('view.setup_kelas.insert');
    Route::post('setup_class/store', [SetupKelasController::class, 'store'])->name('insert.setup_kelas');
    Route::get('setup_class/{id}/edit', [SetupKelasController::class, 'edit'])->name('view.setup_kelas.edit');
    Route::post('setup_class/{id}/update', [SetupKelasController::class, 'update'])->name('update.setup_kelas');
    Route::post('setup_class/delete', [SetupKelasController::class, 'destroy'])->name('delete.setup_kelas');

    //setup_matpel
    Route::get('setup_matpel', [SetupMatpelController::class, 'index'])->name('view.setup_matpel');
    Route::get('setup_matpel/create', [SetupMatpelController::class, 'create'])->name('view.setup_matpel.insert');
    Route::post('setup_matpel/store', [SetupMatpelController::class, 'store'])->name('insert.setup_matpel');
    Route::get('setup_matpel/{id}/edit', [SetupMatpelController::class, 'edit'])->name('view.setup_matpel.edit');
    Route::post('setup_matpel/{id}/update', [SetupMatpelController::class, 'update'])->name('update.setup_matpel');
    Route::post('setup_matpel/delete', [SetupMatpelController::class, 'destroy'])->name('delete.setup_matpel');

    //kompetensi Dasar
    Route::get('kompetensi_dasar', [KompetensiDasarController::class, 'index'])->name('view.kompetensi_dasar');
    Route::get('kompetensi_dasar/create', [KompetensiDasarController::class, 'create'])->name('view.kompetensi_dasar.insert');
    Route::post('kompetensi_dasar/store', [KompetensiDasarController::class, 'store'])->name('insert.kompetensi_dasar');
    Route::get('kompetensi_dasar/{id}/edit', [KompetensiDasarController::class, 'edit'])->name('view.kompetensi_dasar.edit');
    Route::post('kompetensi_dasar/{id}/update', [KompetensiDasarController::class, 'update'])->name('update.kompetensi_dasar');
    Route::post('kompetensi_dasar/delete', [KompetensiDasarController::class, 'destroy'])->name('delete.kompetensi_dasar');

    //nilai siswa
    Route::get('nilai_siswa', [NilaiSiswaController::class, 'index'])->name('view.nilai_siswa');
    Route::get('nilai_siswa/create', [NilaiSiswaController::class, 'create'])->name('view.nilai_siswa.insert');
    Route::post('nilai_siswa/store', [NilaiSiswaController::class, 'store'])->name('insert.nilai_siswa');
    Route::get('nilai_siswa/{id}/edit', [NilaiSiswaController::class, 'edit'])->name('view.nilai_siswa.edit');
    Route::post('nilai_siswa/{id}/update', [NilaiSiswaController::class, 'update'])->name('update.nilai_siswa');
    Route::post('nilai_siswa/delete', [NilaiSiswaController::class, 'destroy'])->name('delete.nilai_siswa');
    Route::get('nilai_siswa/{id}/print',[NilaiSiswaController::class, 'createPDF'])->name('print.nilai_siswa');
    Route::get('nilai_siswa/{id}/detail',[NilaiSiswaController::class,'detailNilaiSiswa'])->name('detail.nilai_siswa');

    //ekstrakurikuler
    Route::get('ekstrakurikuler', [EkstrakurikulerController::class, 'index'])->name('view.ekstrakurikuler');
    Route::post('ekstrakurikuler/store', [EkstrakurikulerController::class, 'store'])->name('insert.ekstrakurikuler');
    Route::post('ekstrakurikuler/delete', [EkstrakurikulerController::class, 'destroy'])->name('delete.ekstrakurikuler');

    //Prestasi
    Route::get('prestasi', [PrestasiController::class, 'index'])->name('view.prestasi');
    Route::get('prestasi/create', [PrestasiController::class, 'create'])->name('view.prestasi.insert');
    Route::post('prestasi/store', [PrestasiController::class, 'store'])->name('insert.prestasi');
    Route::get('prestasi/{id}/edit', [PrestasiController::class, 'edit'])->name('view.prestasi.edit');
    Route::post('prestasi/{id}/update', [PrestasiController::class, 'update'])->name('update.prestasi');
    Route::post('prestasi/delete', [PrestasiController::class, 'destroy'])->name('delete.prestasi');


    //nilai ekstra
    Route::get('ekstra_nilai', [NilaiSiswaController::class, 'ekstra_view'])->name('view.ekstra_nilai');
    Route::post('ekstra_nilai/store', [NilaiSiswaController::class, 'ekstra_store'])->name('insert.ekstra_nilai');

    //catatan
    Route::get('catatan', [CatatanWalikelasController::class, 'index'])->name('view.catatan');
    Route::get('catatan/create', [CatatanWalikelasController::class, 'create'])->name('view.catatan.insert');
    Route::post('catatan/store', [CatatanWalikelasController::class, 'store'])->name('insert.catatan');
    Route::get('catatan/{id}/edit', [CatatanWalikelasController::class, 'edit'])->name('view.catatan.edit');
    Route::post('catatan/{id}/update', [CatatanWalikelasController::class, 'update'])->name('update.catatan');
    Route::post('catatan/delete', [CatatanWalikelasController::class, 'destroy'])->name('delete.catatan');

    //absensi
    Route::get('absensi', [AbsensiController::class, 'index'])->name('view.absensi');
    Route::post('absensi/store', [AbsensiController::class, 'store'])->name('insert.absensi');

    //nilai sikap
    Route::get('sikap_spiritual', [NilaiSikapController::class, 'index_spiritual'])->name('view.sikap_spiritual');
    Route::post('sikap_spiritual/store', [NilaiSikapController::class, 'store_spiritual'])->name('insert.sikap_spiritual');

    Route::get('sikap_sosial', [NilaiSikapController::class, 'index_sosial'])->name('view.sikap_sosial');
    Route::post('sikap_sosial/store', [NilaiSikapController::class, 'store_sosial'])->name('insert.sikap_sosial');

    //cetak
    Route::get('cetak_raport',[CetakController::class,'view_raport_data'])->name('view.cetak_raport');
    Route::get('cover_raport',[CetakController::class,'view_cover_raport_data'])->name('view.cetak_cover_raport');
    Route::get('cetak_leger',[CetakController::class,'view_leger_data'])->name('view.cetak_leger');
    Route::get('cetak_raport/print',[CetakController::class,'cetak_raport'])->name('print.raport');
    Route::get('cetak_cover_raport/print',[CetakController::class,'cetak_cover_raport'])->name('print.cover_raport');
    Route::get('export_leger',[CetakController::class,'cetak_leger'])->name('export.leger');
});
