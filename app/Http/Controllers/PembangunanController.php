<?php

namespace App\Http\Controllers;

class PembangunanController extends Controller
{
    /**
     * Tampilkan halaman pembangunan
     */
    public function index()
    {
        return view('pembangunan');
    }
}
