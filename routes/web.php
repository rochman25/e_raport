<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MatpelController;
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
    Route::get('/', [AuthController::class, 'viewLogin'])->name('auth.login');
    Route::get('/login', [AuthController::class, 'viewLogin'])->name('auth.login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('auth.login.action');
});

Route::middleware(['auth'])->group(function () {
    //auth
    Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');

    //dashboard
    Route::get('/home', [HomeController::class, 'index'])->name('view.home');

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
});
