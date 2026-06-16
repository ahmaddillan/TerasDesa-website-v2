<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProfileController extends Controller
{
    public function index()
    {
        $response = Http::withToken(
            session('token')
        )->get(
            env('EXPRESS_API') . '/api/user/profile'
        );

        $res = $response->json();

        if (!$res['success']) {

            return redirect('/')
                ->with('error', $res['message']);

        }

        $user = $res['data'];

        return view(
            'profile.index',
            compact('user')
        );
    }


    public function update(Request $request)
    {

        $response = Http::withToken(
            session('token')
        )->put(
            env('EXPRESS_API') . '/api/user/profile',
            [

                'name' => $request->name,

                'no_hp' => $request->no_hp

            ]
        );

        $res = $response->json();

        if (!$res['success']) {

            return back()
                ->with('error', $res['message']);

        }

        session([
            'user_name' => $res['data']['name'],
            'user_photo' => $res['data']['photo']
        ]);

        return back()
            ->with(
                'success',
                'Profile berhasil diupdate'
            );

    }


    public function updatePhoto(Request $request)
    {

        if (!$request->hasFile('photo')) {

            return back()
                ->with(
                    'error',
                    'File tidak ditemukan'
                );

        }

        $response = Http::withToken(
            session('token')
        )
        ->attach(
            'photo',
            fopen(
                $request
                    ->file('photo')
                    ->getRealPath(),

                'r'
            ),

            $request
                ->file('photo')
                ->getClientOriginalName()
        )
        ->put(
            env('EXPRESS_API')
            . '/api/user/profile/photo'
        );


        $res = $response->json();
        
        // 1. CEK APAKAH RESPONS NULL (BUKAN JSON)
        if (is_null($res)) {
            
            
            return back()->with('error', 'Terjadi kesalahan pada server API. Respons tidak valid.');
        }

        // 2. CEK STATUS SUCCESS
        if (!isset($res['success']) || !$res['success']) {
            return back()->with('error', $res['message'] ?? 'Gagal mengupdate foto profile');
        }

        if (isset($res['data']['photo'])) {
            session(['user_photo' => $res['data']['photo']]);
        }
        

        return back()->with('success', 'Foto profile berhasil diupdate');
        
        
        if (!$res['success']) {

            return back()
                ->with(
                    'error',
                    $res['message']
                );

        }


        return back()
            ->with(
                'success',
                'Foto profile berhasil diupdate'
            );

    }
}
