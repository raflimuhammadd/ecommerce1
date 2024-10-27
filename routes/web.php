<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;


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

Route::get('/', [userController::class, 'index']);


Route::middleware('auth')->group(function () {
    Route::get('/shop', [userController::class, 'shop'])->name('shop');
    Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
    Route::put('/keranjang/{id}', [KeranjangController::class, 'update'])->name('keranjang.update');
    Route::delete('/keranjang/{id}', [KeranjangController::class, 'destroy'])->name('keranjang.destroy');
    Route::post('/keranjang/store', [KeranjangController::class, 'store'])->name('keranjang.store');
    Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
    Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');

    Route::get('/generatePDF/{id_transaksi}', [CheckoutController::class, 'generatePDF'])->name('generatePDF');
    Route::get('/coba', [CheckoutController::class, 'coba'])->name('coba');
});

Route::fallback(function () {
    return view('pages.404');
});

Auth::routes();

Route::middleware('auth', 'auth.user')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboardAdmin');

        Route::get('/produk', [ProdukController::class, 'index'])->name('produk');
        Route::get('/produk/create', [ProdukController::class, 'create'])->name('produk.create');
        Route::post('/produk/store', [ProdukController::class, 'store'])->name('produk.store');
        // Route::get('/produk/show/{id}', [ProdukController::class, 'show']);
        Route::get('/produk/edit/{id}', [ProdukController::class, 'edit']);
        Route::put('/admin/produk/update/{id}', [ProdukController::class, 'update'])->name('produk.update');
        Route::get('/produk/delete/{id}', [ProdukController::class, 'destroy'])->name('hapus');

        Route::get('/pembeli', [PembeliController::class, 'index'])->name('pembeli');
        Route::get('/pembeli/show/{id}', [PembeliController::class, 'show'])->name('showTransaksi');
        Route::get('/pembeli/edit/{id}', [PembeliController::class, 'edit'])->name('editTransaksi');
        Route::put('/pembeli/update/{id}', [PembeliController::class, 'update'])->name('updateTransaksi');
    });
});

// Route::middleware('auth', 'auth.admin')->group(function(){
//     Route::get('/admin', [AdminController::class,'index'])->name('admin.index');
// });

Route::get('login/google', [LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback', [LoginController::class, 'redirectToGoogleCallback']);

Route::get('/generate', function () {
    \Illuminate\Support\Facades\Artisan::call('storage:link');
    echo 'ok';
});
