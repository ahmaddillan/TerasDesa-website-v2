<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CartController extends Controller
{
    private function api()
    {
        return rtrim(env('EXPRESS_API'), '/');
    }

    private function token()
    {
        return session('token');
    }

    // ===============================
    // GET CART
    // ===============================
    public function index()
    {
        if (!$this->token()) {
            return redirect('/login');
        }

        $response = Http::withToken($this->token())
            ->get($this->api() . '/api/cart');

        if ($response->failed()) {
            return view('marketplace.cart', ['items' => []]);
        }

        $data = $response->json();

        return view('marketplace.cart', [
            'items' => $data['items'] ?? []
        ]);
    }

    public function add(Request $request)
    {
        if (!$this->token()) {
            return redirect('/login');
        }

        $request->validate([
            'product_id' => 'required|integer',
            'quantity'   => 'nullable|integer|min:1',
            'note'       => 'nullable|string'
        ]);

        $response = Http::withToken($this->token())
            ->post($this->api() . '/api/cart', [
                'product_id' => $request->product_id,
                'quantity'   => $request->quantity ?? 1,
                'note'       => $request->note
            ]);

        if ($response->failed()) {
            return back()->with('error', 'Gagal menambahkan ke keranjang');
        }

        // 🔥 LANGSUNG KE HALAMAN CART
        return redirect('/cart')->with('success', 'Produk ditambahkan ke keranjang');
    }

    // ===============================
    // UPDATE QTY
    // ===============================
    public function update(Request $request, $id)
    {
        Http::withToken($this->token())
            ->put($this->api() . "/api/cart/{$id}", [
                'quantity' => $request->quantity
            ]);

        return response()->json(['success' => true]);
    }

    // ===============================
    // DELETE ITEM
    // ===============================
    public function delete($id)
    {
        Http::withToken($this->token())
            ->delete($this->api() . "/api/cart/{$id}");

        return response()->json(['success' => true]);
    }
}
