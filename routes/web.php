<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\TanggapanController;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/home', [PesananController::class, 'index'])->name('home');
    Route::resource('pesanan', PesananController::class);
    
});

Route::get('/pesanan/{id}', [PesananController::class, 'show'])->name('pesanan.show');


Route::resource('tanggapan', TanggapanController::class)->middleware('auth');
Route::resource('paket', PaketController::class)->middleware('auth');


Route::put('tanggapan/{tanggapan}', [TanggapanController::class, 'update'])->name('tanggapan.update');

