<?php

use App\Http\Controllers\AkunController;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataKeluargaController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KelulusanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\RegisterController;
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
//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', [LoginController::class, 'showLogin'])->name('login');
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/processLogin', [LoginController::class, 'processLogin'])->name('processLogin');
Route::get('/processLogout', [LoginController::class, 'processLogout'])->name('processLogout');
Route::get('/register', [RegisterController::class, 'showRegister'])->name('register');
Route::post('/processRegister', [RegisterController::class, 'processRegister'])->name('processRegister');

Route::group(['middleware' => ['auth', 'level:1, 2, 3']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/biodata', [BiodataController::class, 'index'])->name('biodata');
    Route::post('/biodata/create', [BiodataController::class, 'processBiodata'])->name('processBiodata');
    Route::get('/jurusan', [JurusanController::class, 'index'])->name('jurusan');
    Route::post('/storePostJurusan', [JurusanController::class, 'storePostJurusan'])->name('storePostJurusan');
    // Route::post('/jurusan/create', [JurusanController::class, 'processJurusan'])->name('processJurusan');
    Route::get('/nilai', [NilaiController::class, 'index'])->name('nilai');
    Route::post('/storePostNilai', [NilaiController::class, 'storePostNilai'])->name('storePostNilai');
    Route::get('/prestasi', [PrestasiController::class, 'index'])->name('prestasi');
    Route::post('/storePrestasi', [PrestasiController::class, 'storePrestasi'])->name('storePrestasi');
    Route::get('/datakeluarga', [DataKeluargaController::class, 'index'])->name('datakeluarga');
    Route::post('/datakeluarga/create', [DataKeluargaController::class, 'processDataKeluarga'])->name('processDataKeluarga');
    // Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
    Route::get('/kelulusan', [KelulusanController::class, 'index'])->name('kelulusan');
    Route::post('/processKelulusan', [KelulusanController::class, 'processKelulusan'])->name('processKelulusan');
    Route::post('/processJadwal', [DashboardController::class, 'processJadwal'])->name('processJadwal');
    Route::get('/akun', [AkunController::class, 'index'])->name('akun');
    Route::post('/processReset', [AkunController::class, 'processReset'])->name('processReset');
});
