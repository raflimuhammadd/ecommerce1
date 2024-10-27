<?php

use App\Http\Controllers\api\LoginController;
use App\Http\Controllers\api\ProdukController;
use App\Http\Controllers\api\RegisterController;
use App\Http\Controllers\api\TransaksiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware(["auth:sanctum"])->group(function () {
Route::get('/produk', [ProdukController::class, 'index']);

Route::get('/transaksi', [TransaksiController::class, 'index']);
Route::get('/transaksi/{id}', [TransaksiController::class, 'show']);
Route::put('/transaksi/{id}', [TransaksiController::class, 'update']);
// });

Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);