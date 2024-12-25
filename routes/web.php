<?php

use App\Events\testingEvent;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UmumController;

// Route::get('/', function () {
//     return view('welcome');
// });

// Admin
Route::get('/admin/dashboard', [AdminController::class, 'dashboardAdmin'])->name('admin.dashboard');
Route::get('/admin/rangkuman', [AdminController::class, 'rangkuman'])->name('admin.rangkuman');
Route::get('/admin/tabel-ph', [AdminController::class, 'tabelPH'])->name('admin.tabel.PH');
Route::get('/admin/tabel-tds', [AdminController::class, 'tabelTDS'])->name('admin.tabel.TDS');
Route::get('/admin/tabel-udara', [AdminController::class, 'tabelUdara'])->name('admin.tabel.udara');
Route::get('/admin/tabel-arus', [AdminController::class, 'tabelArus'])->name('admin.tabel.arus');

// Umum
Route::get('/', [UmumController::class, 'dashboardUmum'])->name('umum.dashboard');
Route::get('/rangkuman', [UmumController::class, 'rangkuman'])->name('umum.rangkuman');
Route::get('/tabel-ph', [UmumController::class, 'tabelPH'])->name('umum.tabel.PH');
Route::get('/tabel-tds', [UmumController::class, 'tabelTDS'])->name('umum.tabel.TDS');
Route::get('/tabel-udara', [UmumController::class, 'tabelUdara'])->name('umum.tabel.udara');
Route::get('/tabel-arus', [UmumController::class, 'tabelArus'])->name('umum.tabel.arus');
Route::get('/tabel-reservoir', [UmumController::class, 'tabelReservoir'])->name('umum.tabel.reservoir');
