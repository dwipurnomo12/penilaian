<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\CekAbsensiController;
use App\Http\Controllers\CekNilaiController;
use App\Http\Controllers\GuruController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\LaporanAbsensiController;
use App\Http\Controllers\LaporanNilaiController;
use App\Http\Controllers\MataPelajaranController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TahunAjaranController;
use App\Models\MataPelajaran;
use App\Models\Penilaian;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Auth::routes();
Route::get('/home', [HomeController::class, 'index']);
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::middleware(['auth', 'IsAdmin'])->group(function () {
    Route::resource('/siswa', SiswaController::class);
    Route::resource('/kelas', KelasController::class);
    Route::resource('/mata-pelajaran', MataPelajaranController::class);
    Route::resource('/guru', GuruController::class);
    Route::resource('/tahun-ajaran', TahunAjaranController::class);
});
Route::middleware(['auth', 'IsGuru'])->group(function () {
    Route::get('/penilaian/filter-data', [PenilaianController::class, 'filterData']);
    Route::resource('/penilaian', PenilaianController::class);
    Route::get('/penilaian/{mata_pelajaran_id}/{siswa_id}/edit', [PenilaianController::class, 'edit'])->name('penilaian.editData');

    Route::get('/absensi/filter-data', [AbsensiController::class, 'filterData']);
    Route::resource('/absensi', AbsensiController::class);

    Route::get('/laporan-nilai/filter-data', [LaporanNilaiController::class, 'filterData']);
    Route::get('/laporan-nilai', [LaporanNilaiController::class, 'index']);
    Route::get('/laporan-nilai/{siswa_id}', [LaporanNilaiController::class, 'cetakNilai'])->name('cetakNilai');
    Route::get('/laporan-nilai/cetak-laporan/{tahun_ajaran_id}', [LaporanNilaiController::class, 'cetakLaporan'])->name('cetakLaporan');

    Route::get('/laporan-absensi/filter-data', [LaporanAbsensiController::class, 'filterData']);
    Route::get('/laporan-absensi', [LaporanAbsensiController::class, 'index']);
    Route::get('/laporan-absensi/laporan-absensi/{tahun_ajaran_id}', [LaporanAbsensiController::class, 'cetakLaporan'])->name('cetakLaporanAbsensi');
});
Route::middleware(['auth', 'IsSiswa'])->group(function () {
    Route::get('/cek-nilai/filter-data', [CekNilaiController::class, 'filterData']);
    Route::get('/cek-nilai', [CekNilaiController::class, 'index']);
    Route::get('/cek-nilai/cetak-nilai/{tahun_ajaran_id}', [CekNilaiController::class, 'cetakNilai'])->name('cetakLaporanSiswa');

    Route::get('/cek-absensi', [CekAbsensiController::class, 'index']);
    Route::get('/cek-absensi/cetak-absensi', [CekAbsensiController::class, 'cetakAbsensi']);
});
