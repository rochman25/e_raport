<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
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

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'viewLogin'])->name('auth.login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('auth.login.action');
});

Route::middleware(['auth'])->group(function(){
    //auth
    Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');

    //dashboard
    Route::get('/home', [HomeController::class,'index'])->name('view.home');

    //system
    //roles
    Route::get('/roles',[RoleController::class,'index'])->name('view.role');
    Route::post('/roles',[RoleController::class,'store'])->name('insert.role');
    Route::post('/roles/delete',[RoleController::class,'destroy'])->name('delete.role');
    //master_data

});
