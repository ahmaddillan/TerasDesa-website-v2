<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homepage');
});


Route::get('/marketplace', function () {
    return "Halaman Marketplace (Belum dibuat)";
});

Route::get('/aset', function () {
    return "Halaman Aset Desa (Belum dibuat)";
});

Route::get('/pembangunan', function () {
    return "Halaman Pembangunan (Belum dibuat)";
});

Route::get('/login', function () {
    return "Halaman Login (Belum dibuat)";
});