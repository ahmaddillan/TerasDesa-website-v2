<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MarketPlaceController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\PembangunanController;

// 1. Rute LOGIN & REGISTER
Route::get('/login', [AuthController::class, 'form']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'registerForm']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/forgot-password', [AuthController::class, 'forgotPasswordForm']);
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);

// 2. Rute WISHLIST
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
Route::post('/wishlist/add', [WishlistController::class, 'store'])->name('wishlist.store');
Route::delete('/wishlist/{id}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');

// 3. Rute MARKETPLACE
Route::get('/marketplace', [MarketPlaceController::class, 'index'])->name('marketplace.index');
Route::get('/marketplace/create', [MarketPlaceController::class, 'create'])->name('marketplace.create');
Route::get('/marketplace/{id}', [MarketPlaceController::class, 'show'])->name('marketplace.show');
Route::post('/marketplace', [MarketPlaceController::class, 'store'])->name('marketplace.store');
Route::post('/marketplace/cart/{id}', [MarketPlaceController::class, 'addToCart'])->name('marketplace.addToCart');
Route::delete('/marketplace/{id}', [MarketPlaceController::class, 'destroy'])->name('marketplace.destroy');

// 4. Rute HOME & MIDDLEWARE
Route::middleware('auth.session')->group(function () {
    Route::get('/', function () {
        return view('homepage');
    });

    Route::get('/aset', function () {
        return view('assets.aset');
    });

    // RUTE PEMBANGUNAN
    Route::get('/pembangunan', [PembangunanController::class, 'index'])->name('pembangunan.index');
    
    // Tambahan rute untuk create dan store (harus di atas rute {id})
    Route::get('/pembangunan/create', [PembangunanController::class, 'create'])->name('pembangunan.create');
    Route::post('/pembangunan', [PembangunanController::class, 'store'])->name('pembangunan.store');
    
    Route::get('/pembangunan/{id}', [PembangunanController::class, 'show'])->name('pembangunan.show');
});

//5. Rute ASET
Route::get('/aset/{id}/edit', function () {
    return view('assets.edit');
});
Route::get('/aset/create', function () {
    return view('assets.create');
});

Route::get('/cart', [CartController::class, 'index']);
Route::post('/cart/add', [CartController::class, 'add']);
Route::put('/cart/{id}', [CartController::class, 'update']);
Route::delete('/cart/{id}', [CartController::class, 'delete']);

Route::get('/checkout', [CheckoutController::class, 'index']);
Route::post('/checkout', [CheckoutController::class, 'process']);

Route::get('/transaksi', [TransaksiController::class, 'index']);