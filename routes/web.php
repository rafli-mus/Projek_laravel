<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\SuratMasukController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
});

Route::middleware('auth')->group(function () {
    Route::get('/', fn () => view('dashboard'))->name('dashboard');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/surat-masuk', [SuratMasukController::class, 'index'])->name('surat-masuk.index');
    Route::resource('surat-masuk', SuratMasukController::class)
        ->except(['index', 'show'])
        ->parameters(['surat-masuk' => 'id'])
        ->middleware('can:manage-letters');
    Route::get('/surat-masuk/{id}', [SuratMasukController::class, 'show'])->name('surat-masuk.show');

    Route::get('/surat-keluar', [SuratKeluarController::class, 'index'])->name('surat-keluar.index');
    Route::resource('surat-keluar', SuratKeluarController::class)
        ->except(['index', 'show'])
        ->parameters(['surat-keluar' => 'id'])
        ->middleware('can:manage-letters');
    Route::get('/surat-keluar/{id}', [SuratKeluarController::class, 'show'])->name('surat-keluar.show');
});
