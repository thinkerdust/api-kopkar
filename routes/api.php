<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\AnggotaController;
use App\Http\Controllers\API\PinjamanController;
use App\Http\Controllers\API\BarangController;
use App\Http\Controllers\API\PotongController;
use App\Http\Controllers\API\TabunganController;
use App\Http\Controllers\API\ProdukController;
use App\Http\Controllers\API\TokoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/auth/login', [AuthController::class, 'login'])->middleware('log.api');
Route::post('/auth/register', [AuthController::class, 'register'])->middleware('log.api');

Route::middleware(['auth:sanctum', 'log.api'])->group( function () {

    // Auth
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::post('/auth/change_password', [AuthController::class, 'change_password']);
    Route::get('/auth/check_password', [AuthController::class, 'check_validation_password']);

    // Anggota 
    Route::get('/anggota/profil', [AnggotaController::class, 'index']);
    Route::post('/anggota/transaksi_sukarela', [AnggotaController::class, 'transaksi_simpanan_sukarela']);

    // Pinjaman
    Route::get('/pinjaman/jenis', [PinjamanController::class, 'jenis_pinjaman']);
    Route::post('/pinjaman/detail', [PinjamanController::class, 'detail_pinjaman']);

    // Barang
    Route::get('/barang/kategori', [BarangController::class, 'kategori']);
    Route::post('/barang', [BarangController::class, 'barang']);

    // Potong
    Route::get('/potong', [PotongController::class, 'potong']);

    // Tabungan
    Route::get('/tabungan', [TabunganController::class, 'index']);
    Route::get('/tabungan/jenis', [TabunganController::class, 'jenis_tabungan']);
    Route::post('/tabungan/detail', [TabunganController::class, 'detail_tabungan']);

    // Produk
    Route::get('/produk', [ProdukController::class, 'index']);

    // Toko
    Route::post('/toko/transaksi', [TokoController::class, 'transaksi']);
});