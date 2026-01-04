<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Tampilkan halaman profile
     */
    public function show()
    {
        return view('profile', [
            'user' => auth()->user(),
        ]);
    }

    /**
     * Update data profile
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'nullable|string|max:255',
            'email'    => 'required|email|max:255',
            'phone'    => 'nullable|string|max:30',
            'address'  => 'nullable|string|max:255',
            'notif'    => 'nullable|string|max:50',
            'role'     => 'nullable|string|max:50',
            'bio'      => 'nullable|string|max:255',
            'password' => 'nullable|string|min:8',
        ]);

        // Jika password diisi → update
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return back()->with('success', 'Profil berhasil diperbarui');
    }
}
