<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ObjekWisataController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\NewsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::apiResource('objekwisata', ObjekWisataController::class);
Route::apiResource('user', UserController::class);
Route::apiResource('transaksi', TransaksiController::class);
Route::apiResource('pembayaran', PembayaranController::class);
Route::put('updatePassword/{email}', [UserController::class, 'updatePassword']);
Route::put('updateTanggal/{id}', [TransaksiController::class, 'updateTanggal']);
Route::get('sumPembayaranDalamTransaksi/{idtransaksi}', [PembayaranController::class, 'sumPembayaranDalamTransaksi']);
Route::get('showTransactionsByUserId/{iduser}', [TransaksiController::class, 'showTransactionsByUserId']);
Route::apiResource('news', NewsController::class);
Route::get('showByPulau/{pulau}', [ObjekWisataController::class, 'showByPulau']);
Route::put('updateImage/{id}', [UserController::class, 'updateImage']);
Route::put('updateDenda/{id}', [PembayaranController::class, 'updateDenda']);
