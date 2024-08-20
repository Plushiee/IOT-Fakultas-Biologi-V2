<?php

use App\Events\testingEvent;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [MainController::class, 'dashboard'])->name('main.dashboard');
Route::get('/tabel-ph', [MainController::class, 'tabelPH'])->name('main.tabelPH');
Route::get('/tabel-tds', [MainController::class, 'tabelTDS'])->name('main.tabelTDS');
Route::get('/tabel-udara', [MainController::class, 'tabelUdara'])->name('main.tabelUdara');
Route::get('/tabel-arus', [MainController::class, 'tabelArus'])->name('main.tabelArus');
