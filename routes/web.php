<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\MagangController;
use App\Http\Controllers\KepaniitiaanController;
use App\Http\Controllers\TridharmaController;
use App\Http\Controllers\LombaController;
use App\Http\Controllers\FakultasController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\UkmController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\VerifikasiController;
use App\Http\Controllers\TipeAktifitasMahasiswaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserAktifitasMahasiswaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/verifikasi', [VerifikasiController::class, 'index'])->name('verifikasi');

Route::get('prodi/by-fakultas/{id}', [ProdiController::class, 'byFakultas'])
    ->name('prodi.byFakultas');



Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('tipe', TipeAktifitasMahasiswaController::class)->names('tipe');
    Route::resource('user-aktifitas-mahasiswa', UserAktifitasMahasiswaController::class)->names('user-aktifitas-mahasiswa');
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
});




Route::resource('kepanitiaan', KepaniitiaanController::class)->names([
    'index' => 'kepanitiaan',
    'create' => 'kepanitiaan.create',
    'store' => 'kepanitiaan.store',
    'show' => 'kepanitiaan.show',
    'edit' => 'kepanitiaan.edit',
    'update' => 'kepanitiaan.update',
    'destroy' => 'kepanitiaan.destroy'
]);

Route::resource('magang', MagangController::class)->names([
    'index' => 'magang',
    'create' => 'magang.create',
    'store' => 'magang.store',
    'show' => 'magang.show',
    'edit' => 'magang.edit',
    'update' => 'magang.update',
    'destroy' => 'magang.destroy'
]);

Route::resource('tridharma', TridharmaController::class)->names([
    'index' => 'tridharma',
    'create' => 'tridharma.create',
    'store' => 'tridharma.store',
    'show' => 'tridharma.show',
    'edit' => 'tridharma.edit',
    'update' => 'tridharma.update',
    'destroy' => 'tridharma.destroy'
]);

Route::resource('lomba', LombaController::class)->names([
    'index' => 'lomba',
    'create' => 'lomba.create',
    'store' => 'lomba.store',
    'show' => 'lomba.show',
    'edit' => 'lomba.edit',
    'update' => 'lomba.update',
    'destroy' => 'lomba.destroy'
]);

Route::resource('ukm', UkmController::class)->names([
    'index' => 'ukm.index',
    'create' => 'ukm.create',
    'store' => 'ukm.store',
    'show' => 'ukm.show',
    'edit' => 'ukm.edit',
    'update' => 'ukm.update',
    'destroy' => 'ukm.destroy',
]);



Route::get('/cetak', [\App\Http\Controllers\RelatedRecordController::class, 'index'])->name('cetak');

Route::resource('related-records', \App\Http\Controllers\RelatedRecordController::class)->names([
    'index' => 'related-records.index',
    'create' => 'related-records.create',
    'store' => 'related-records.store',
    'show' => 'related-records.show',
    'edit' => 'related-records.edit',
    'update' => 'related-records.update',
    'destroy' => 'related-records.destroy'
]);

Route::post('related-records/{id}/verify', [\App\Http\Controllers\RelatedRecordController::class, 'verify'])->name('related-records.verify');

Route::get('/kesimpulan', function () {
    return view('kesimpulan');
})->name('kesimpulan');


require __DIR__ . '/auth.php';
