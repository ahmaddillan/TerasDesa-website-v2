<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WishlistController extends Controller
{
    // Menampilkan halaman semua wishlist
    public function index(Request $request)
    {
        $token = session('token');
        if (!$token) return redirect('/login');

        $response = Http::withToken($token)->get('http://localhost:3000/api/wishlist', [
            'stock' => $request->query('stock')
        ]);

        $items = $response->json()['data'] ?? [];
        return view('marketplace.wishlist', compact('items'));
    }

    // Menambah ke Wishlist
    public function store(Request $request)
    {
        $token = session('token');
        Http::withToken($token)->post('http://localhost:3000/api/wishlist', [
            'product_id' => $request->product_id
        ]);

        return back()->with('success', 'Ditambahkan ke wishlist');
    }

    // Menghapus dari Wishlist (Toggle Off)
    public function destroy($id)
    {
        $token = session('token');
        Http::withToken($token)->delete("http://localhost:3000/api/wishlist/{$id}");

        return back()->with('success', 'Dihapus dari wishlist');
    }
}