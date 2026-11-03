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

    Route::resource('surat-masuk', SuratMasukController::class)
        ->parameters(['surat-masuk' => 'id'])
        ->middlewareFor(['create', 'store', 'edit', 'update', 'destroy'], 'can:manage-letters');

    Route::resource('surat-keluar', SuratKeluarController::class)
        ->parameters(['surat-keluar' => 'id'])
        ->middlewareFor(['create', 'store', 'edit', 'update', 'destroy'], 'can:manage-letters');
});
