<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function form() {
        return view('auth.login');
    }

    public function registerForm() {
        return view('auth.register');
    }

     public function login(Request $request)
    {
        $response = Http::post(env('EXPRESS_API').'/auth/login', [
            'email'    => $request->email,
            'password' => $request->password,
        ]);

       $res = $response->json();


        if ($res['success'] == true) {
            session([
                'token' => $res['data']['token'],
                'user_name'  => $res['data']['name'],
            ]);

            return redirect('/');
        }

        return back()->with('error', $res['message']);
    }

    public function register(Request $req) {
        $res = Http::post(env('EXPRESS_API').'/auth/register', $req->all());
        $json = $res->json();

        if (!$json['success']) return back()->withErrors($json['message']);

        return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    public function logout() {
        session()->flush();
        return redirect('/login')->with('success', 'Logout berhasil!');
    }
}

