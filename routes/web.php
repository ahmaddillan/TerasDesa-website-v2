<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'form']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'registerForm']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth.session')->group(function () {

    Route::get('/', function () {
        return view('homepage');
    });

    Route::get('/marketplace', fn() => "Halaman Marketplace");
    Route::get('/aset', fn() => "Halaman Aset Desa");
    Route::get('/pembangunan', fn() => "Halaman Pembangunan");

});

