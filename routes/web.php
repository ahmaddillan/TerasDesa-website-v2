<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MarketplaceController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CartController;

// 1. Rute LOGIN & REGISTER
Route::get('/login', [AuthController::class, 'form']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'registerForm']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);

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
});


//5. Rute ASET
Route::get('/aset/{id}/edit', function () {
    return view('assets.edit');
});
Route::get('/aset/create', function () {
    return view('assets.create');
});

// 5. Rute CART
Route::get('/cart', function () {
    return view('index');
});

// 6. Rute CHECKOUT
Route::get('/checkout', function () {
    return view('checkout');
});

// 7. Rute TRANSAKSI
Route::get('/transaksi', function () {
    return view('transaksi');
});
