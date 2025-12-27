<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MarketplaceController extends Controller
{

    //Menampilkan semua produk atau hasil pencarian
    public function index(Request $request)
    {
        $search = $request->query('search');
        
        // Panggil API Express untuk mengambil semua produk
        $response = Http::get('http://localhost:3000/api/products', [
            'search' => $search
        ]);

        $products = $response->json()['data'] ?? [];

        return view('marketplace.show', compact('products'));
    }

    //CREATE - Menampilkan form tambah produk
    public function create()
    {
        // Cek apakah user sudah login melalui session token
        if (!session()->has('token')) {
            return redirect('/login')->with('error', 'Silakan login untuk menjual barang.');
        }
        
        // Pastikan file view ini ada di folder resources/views/marketplace/create.blade.php
        return view('marketplace.create');
    }

    //STORE - Mengirim data produk baru ke Express
    public function store(Request $request)
    {
        $token = session('token');
        if (!$token) return redirect('/login');

        try {
            $kirim = Http::withToken($token);
            
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $kirim->attach(
                    'image', 
                    file_get_contents($file), 
                    $file->getClientOriginalName()
                );
            }

            $response = $kirim->post('http://localhost:3000/api/products', [
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'stock' => $request->stock ?? 1,
            ]);

            if ($response->successful()) {
                return redirect()->route('marketplace.index')->with('success', 'Barang berhasil dijual!');
            }
            
            return back()->with('error', 'Gagal: ' . $response->body());

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal koneksi server backend.');
        }
    }

    //SHOW - Menampilkan detail produk & Identifikasi Wishlist (Tombol Merah)
    public function show($id)
    {
        try {
            //Ambil Data Produk dari Express
            $response = Http::get("http://localhost:3000/api/products/{$id}");
            
            if ($response->failed()) {
                return redirect()->route('marketplace.index')->with('error', 'Produk tidak ditemukan');
            }

            $product = $response->json()['data'];

            //Identifikasi ID User dari Token (untuk tombol Hapus Milik Sendiri)
            $currentUserId = null;
            $isWishlisted = false;
            $token = session('token');

            if ($token) {
                //Decode Payload JWT untuk mendapatkan user ID yang sedang login
                try {
                    $tokenParts = explode('.', $token);
                    if (count($tokenParts) == 3) {
                        $payload = base64_decode($tokenParts[1]);
                        $userData = json_decode($payload, true);
                        $currentUserId = $userData['id'] ?? null;
                    }
                } catch (\Exception $e) {
                    $currentUserId = null;
                }

                //LOGIKA TOGGLE: Cek apakah produk ini sudah ada di database Wishlist Express
                // Panggil endpoint GET /api/wishlist milik user yang sedang login
                $wishResponse = Http::withToken($token)->get('http://localhost:3000/api/wishlist');
                
                if ($wishResponse->successful()) {
                    $wishlistData = $wishResponse->json()['data'] ?? [];
                    //Cek apakah ID produk detail ini ada di dalam koleksi wishlist user
                    $isWishlisted = collect($wishlistData)->contains('id', (int)$id);
                }
            }

            //Kirim $product, $currentUserId, dan status $isWishlisted ke view
            return view('marketplace.detail', compact('product', 'currentUserId', 'isWishlisted'));

        } catch (\Exception $e) {
            return redirect()->route('marketplace.index')->with('error', 'Gagal koneksi server');
        }
    }

    //ADD TO CART - Menyimpan item ke session cart
    public function addToCart(Request $request, $id)
    {
        $cartItem = [
            'product_id' => $id,
            'qty'        => $request->qty,
            'note'       => $request->note,
            'added_at'   => now()
        ];
        
        session()->push('cart', $cartItem);
        
        return redirect()->route('marketplace.index')->with('success', 'Barang masuk keranjang!');
    }

    //DESTROY - Menghapus produk hanya Pemilik
    public function destroy($id)
    {
        $token = session('token');

        if (!$token) {
            return redirect('/login')->with('error', 'Anda harus login dahulu.');
        }

        try {
            $response = Http::withToken($token)->delete("http://localhost:3000/api/products/{$id}");

            if ($response->successful()) {
                return redirect()->route('marketplace.index')->with('success', 'Produk berhasil dihapus!');
            }

            return back()->with('error', 'Gagal menghapus: ' . $response->body());

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan koneksi saat menghapus produk.');
        }
    }
}