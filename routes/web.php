<?php

use App\Events\testingEvent;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminMasterController;
use App\Http\Controllers\UmumController;

// Route::get('/', function () {
//     return view('welcome');
// });

// Admin
Route::get('/admin/dashboard', [AdminController::class, 'dashboardAdmin'])->name('admin.dashboard');
Route::get('/admin/rangkuman', [AdminController::class, 'rangkuman'])->name('admin.rangkuman');
Route::get('/admin/rangkuman/cetak', [AdminController::class, 'rangkumanCetak'])->name('admin.rangkuman.cetak');
Route::get('/admin/tabel-ph', [AdminController::class, 'tabelPH'])->name('admin.tabel.PH');
Route::get('/admin/tabel-tds', [AdminController::class, 'tabelTDS'])->name('admin.tabel.TDS');
Route::get('/admin/tabel-udara', [AdminController::class, 'tabelUdara'])->name('admin.tabel.udara');
Route::get('/admin/tabel-arus', [AdminController::class, 'tabelArus'])->name('admin.tabel.arus');
Route::get('/admin/tabel-reservoir', [AdminController::class, 'tabelReservoir'])->name('admin.tabel.reservoir');

// Admin Master
Route::get('/admin-master/dashboard', [AdminMasterController::class, 'dashboardAdmin'])->name('admin-master.dashboard');
Route::get('/admin-master/rangkuman', [AdminMasterController::class, 'rangkuman'])->name('admin-master.rangkuman');
Route::get('/admin-master/rangkuman/cetak', [AdminMasterController::class, 'rangkumanCetak'])->name('admin-master.rangkuman.cetak');
Route::get('/admin-master/tabel-ph', [AdminMasterController::class, 'tabelPH'])->name('admin-master.tabel.PH');
Route::get('/admin-master/tabel-tds', [AdminMasterController::class, 'tabelTDS'])->name('admin-master.tabel.TDS');
Route::get('/admin-master/tabel-udara', [AdminMasterController::class, 'tabelUdara'])->name('admin-master.tabel.udara');
Route::get('/admin-master/tabel-arus', [AdminMasterController::class, 'tabelArus'])->name('admin-master.tabel.arus');
Route::get('/admin-master/tabel-reservoir', [AdminMasterController::class, 'tabelReservoir'])->name('admin-master.tabel.reservoir');
Route::get('/admin-master/pengaturan-akun', [AdminMasterController::class, 'pengaturanAkun'])->name('admin-master.akun.pengaturan');
Route::get('/admin-master/daftar-admin', [AdminMasterController::class, 'daftarAdmin'])->name('admin-master.akun.daftar-admin');
Route::get('/admin-master/daftar-admin/view/{id}', [AdminMasterController::class, 'viewAdmin'])->name('admin-master.akun.daftar-admin.view');


// Umum
Route::get('/', [UmumController::class, 'dashboardUmum'])->name('umum.dashboard');
Route::get('/rangkuman', [UmumController::class, 'rangkuman'])->name('umum.rangkuman');
Route::get('/rangkuman/cetak', [UmumController::class, 'rangkumanCetak'])->name('umum.rangkuman.cetak');
Route::get('/tabel-ph', [UmumController::class, 'tabelPH'])->name('umum.tabel.PH');
Route::get('/tabel-tds', [UmumController::class, 'tabelTDS'])->name('umum.tabel.TDS');
Route::get('/tabel-udara', [UmumController::class, 'tabelUdara'])->name('umum.tabel.udara');
Route::get('/tabel-arus', [UmumController::class, 'tabelArus'])->name('umum.tabel.arus');
Route::get('/tabel-reservoir', [UmumController::class, 'tabelReservoir'])->name('umum.tabel.reservoir');
