<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class TransaksiController extends Controller
{
    private function api()
    {
        return rtrim(env('EXPRESS_API'), '/');
    }

    private function token()
    {
        return session('token');
    }

    public function index()
    {
        if (!$this->token()) {
            return redirect('/login');
        }

        $response = Http::withToken($this->token())
            ->get($this->api() . '/api/transaksi/');

        if ($response->failed()) {
            return view('marketplace.transaksi', [
                'transaksi' => []
            ]);
        }

        return view('marketplace.transaksi', [
            'transaksi' => $response->json()
        ]);
    }
}
