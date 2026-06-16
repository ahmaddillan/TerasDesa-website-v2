<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class CheckoutController extends Controller
{
    private function api()
    {
        return rtrim(env('EXPRESS_API'), '/');
    }

    private function token()
    {
        return session('token');
    }

    // =====================
    // TAMPILKAN CHECKOUT
    // =====================
    public function index()
    {
        if (!$this->token()) return redirect('/login');

        $res = Http::withToken($this->token())
            ->get($this->api() . '/api/cart');

        if ($res->failed()) return redirect('/cart');

        $items = $res->json()['items'] ?? [];
        if (count($items) === 0) return redirect('/cart');

        $total = 0;
        foreach ($items as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('marketplace.checkout', [
            'items' => $items,
            'total' => $total
        ]);
    }

    // =====================
    // PROSES CHECKOUT
    // =====================
    public function process()
    {
        if (!$this->token()) return redirect('/login');

        $res = Http::withToken($this->token())
            ->post($this->api() . '/api/checkout');

        if ($res->failed()) {
            return redirect('/checkout')
                ->with('error', 'Checkout gagal');
        }

        return redirect('/transaksi')
            ->with('success', 'Checkout berhasil');
    }
}
