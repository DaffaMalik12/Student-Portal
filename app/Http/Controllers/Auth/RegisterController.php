<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\UserAccount; // Pastikan ini benar
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:user_accounts', // <-- UBAH DI SINI
            'password' => 'required|string|min:8|confirmed',
        ]);

        UserAccount::create([ // Pastikan 'UserAccount' menggunakan U besar
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/register')->with('success', 'Berhasil mendaftar!');
    }
}