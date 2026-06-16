<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PembangunanController extends Controller
{
    private function token()
    {
        return session('token');
    }

    public function index(Request $request)
    {
        // Fetch data pembangunan dari Express API
        $response = Http::get(env('EXPRESS_API') . '/pembangunan');
        
        if ($response->successful()) {
            $pembangunan = $response->json();
        } else {
            $pembangunan = [];
        }

        return view('pembangunan.index', compact('pembangunan'));
    }

    public function show($id)
    {
        // Fetch satu data pembangunan by ID
        $response = Http::get(env('EXPRESS_API') . "/pembangunan/{$id}");

        if ($response->successful()) {
            $proyek = $response->json();
            return view('pembangunan.show', compact('proyek'));
        }

        abort(404, 'Proyek Pembangunan tidak ditemukan');
    }

    // ==========================================
    // TAMBAHAN KODE UNTUK FITUR TAMBAH DATA
    // ==========================================

    public function create()
    {
        // Cek apakah user sudah login
        if (!$this->token()) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Tampilkan halaman form (pastikan file resources/views/pembangunan/create.blade.php sudah ada)
        return view('pembangunan.create');
    }

    public function store(Request $request)
    {
        $token = $this->token();
        if (!$token) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        try {
            // Mengirim request POST ke endpoint Express backend
            $response = Http::withToken($token)->post(env('EXPRESS_API') . '/pembangunan', [
                // Sesuaikan field ini dengan struktur kolom yang diminta oleh API Node.js / Express kamu
                'name'        => $request->name,
                'description' => $request->description,
                'budget'      => $request->budget,
                'location'    => $request->location,
                'status'      => $request->status ?? 'Perencanaan', // Default status jika form tidak mengirim status
            ]);

            if ($response->successful()) {
                return redirect()->route('pembangunan.index')->with('success', 'Data pembangunan berhasil ditambahkan!');
            }
            
            return back()->with('error', 'Gagal: ' . $response->body());

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal koneksi server backend.');
        }
    }
}