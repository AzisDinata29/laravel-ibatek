<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\MagangController;
use App\Http\Controllers\KepaniitiaanController;
use App\Http\Controllers\TridharmaController;
use App\Http\Controllers\LombaController;
use App\Http\Controllers\FakultasController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\UkmController;
use App\Http\Controllers\TipeAktifitasMahasiswaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AktifitasMahasiswaController;
use App\Http\Controllers\UserAktifitasMahasiswaController;
use App\Http\Controllers\VerifikasiAktifitasMahasiswaController;
use App\Http\Controllers\UserPrintAktifitasMahasiswaController;
use App\Http\Controllers\LaporanController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('prodi/by-fakultas/{id}', [ProdiController::class, 'byFakultas'])->name('prodi.byFakultas');
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('fakultas', FakultasController::class)->names([
        'index' => 'fakultas',
        'create' => 'fakultas.create',
        'store' => 'fakultas.store',
        'show' => 'fakultas.show',
        'edit' => 'fakultas.edit',
        'update' => 'fakultas.update',
        'destroy' => 'fakultas.destroy'
    ])->parameters([
        'fakultas' => 'fakultas',
    ]);

    Route::resource('prodi', ProdiController::class)->names([
        'index' => 'prodi',
        'create' => 'prodi.create',
        'store' => 'prodi.store',
        'show' => 'prodi.show',
        'edit' => 'prodi.edit',
        'update' => 'prodi.update',
        'destroy' => 'prodi.destroy',
    ]);
    Route::resource('users', UserController::class)->middleware('auth')->names([
        'index' => 'user',
        'create' => 'user.create',
        'store' => 'user.store',
        'show' => 'user.show',
        'edit' => 'user.edit',
        'update' => 'user.update',
        'destroy' => 'user.destroy'
    ]);

    Route::resource('admins', AdminController::class)->middleware('auth')->names([
        'index' => 'admin',
        'create' => 'admin.create',
        'store' => 'admin.store',
        'show' => 'admin.show',
        'edit' => 'admin.edit',
        'update' => 'admin.update',
        'destroy' => 'admin.destroy'
    ]);

    Route::resource('organisasi', OrganizationController::class)->names([
        'index' => 'organisasi',
        'create' => 'organisasi.create',
        'store' => 'organisasi.store',
        'show' => 'organisasi.show',
        'edit' => 'organisasi.edit',
        'update' => 'organisasi.update',
        'destroy' => 'organisasi.destroy'
    ]);

    Route::resource('tipe', TipeAktifitasMahasiswaController::class)->names('tipe');
    Route::resource('verifikasi-aktifitas-mahasiswa', VerifikasiAktifitasMahasiswaController::class)->names('verifikasi-aktifitas-mahasiswa');
    Route::get(
        '/aktifitas-mahasiswa/{id}/cetak',
        [AktifitasMahasiswaController::class, 'cetak']
    )->name('aktifitas-mahasiswa.cetak');
    Route::resource('aktifitas-mahasiswa', AktifitasMahasiswaController::class)->names('aktifitas-mahasiswa');
    Route::resource('user-aktifitas-mahasiswa', UserAktifitasMahasiswaController::class)->names('user-aktifitas-mahasiswa');
    Route::resource('user/aktifitas-mahasiswa', UserPrintAktifitasMahasiswaController::class)->names('user-detail');
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/cetak', [LaporanController::class, 'cetak'])->name('laporan.cetak');
});

require __DIR__ . '/auth.php';
