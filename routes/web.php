<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MarketplaceController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\ProfileController;

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
Route::get('/marketplace', [MarketplaceController::class, 'index'])->name('marketplace.index');
Route::get('/marketplace/create', [MarketplaceController::class, 'create'])->name('marketplace.create');
Route::get('/marketplace/{id}', [MarketplaceController::class, 'show'])->name('marketplace.show');
Route::post('/marketplace', [MarketplaceController::class, 'store'])->name('marketplace.store');
Route::post('/marketplace/cart/{id}', [MarketplaceController::class, 'addToCart'])->name('marketplace.addToCart');
Route::delete('/marketplace/{id}', [MarketplaceController::class, 'destroy'])->name('marketplace.destroy');

// 4. Rute HOME & MIDDLEWARE
Route::middleware('auth.session')->group(function () {
    Route::get('/', function () {
        return view('homepage');
    });

    Route::get('/aset', function () {
        return view('assets.aset');
    });

    Route::get('/pembangunan', fn() => "Halaman Pembangunan");

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::post('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo');
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

