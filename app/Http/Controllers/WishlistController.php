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

        $response = Http::withToken($token)->get(env('EXPRESS_API') . '/wishlist', [
            'stock' => $request->query('stock')
        ]);

        $items = $response->json()['data'] ?? [];
        return view('marketplace.wishlist', compact('items'));
    }

    // Menambah ke Wishlist
    public function store(Request $request)
    {
        $token = session('token');
        Http::withToken($token)->post(env('EXPRESS_API') . '/wishlist', [
            'product_id' => $request->product_id
        ]);

        return back()->with('success', 'Ditambahkan ke wishlist');
    }

    // Menghapus dari Wishlist (Toggle Off)
    public function destroy($id)
    {
        $token = session('token');
        Http::withToken($token)->delete(env('EXPRESS_API') . "/wishlist/{$id}");

        return back()->with('success', 'Dihapus dari wishlist');
    }
}