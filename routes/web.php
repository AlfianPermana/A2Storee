<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\BarangController;
use App\Http\Controllers\PesananController;

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


Route::middleware('auth')->group(function () {
    Route::resource('barangs', BarangController::class);
    Route::resource('pesanans', PesananController::class);
    Route::get('laporan', [PesananController::class, 'laporan'])->name('pesanans.laporan');
    Route::get('ExportExcel', [PesananController::class, 'ExportExcel'])->name('pesanans.export');
    Route::post('order/{barang}', [PesananController::class, 'order'])->name('pesanans.order');
    Route::get('checkout', [PesananController::class, 'checkout'])->name('pesanans.checkout');
});

Auth::routes();
Route::get('/', function () {
    return redirect()->route('barangs.index');
});
