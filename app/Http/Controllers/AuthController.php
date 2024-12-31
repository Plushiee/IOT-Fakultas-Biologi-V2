<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    // Login
    public function authLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'url' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');

        if (User::where('email', $request->email)->count() == 0) {
            return response()->json([
                'error' => 'Email atau password salah.',
            ], 401);
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            Log::info('User logged in: ', ['user_id' => Auth::id(), 'session_id' => session()->getId()]);

            if (Auth::user()->role === 'admin') {
                session()->flash('success', 'Login berhasil!');
                return response()->json([
                    'message' => 'Login berhasil.',
                    'redirect' => '/admin' . $request->input('url'), // Ubah sesuai role pengguna
                ], 200);
            } elseif (Auth::user()->role === 'admin-master') {
                session()->flash('success', 'Login berhasil!');
                return response()->json([
                    'message' => 'Login berhasil.',
                    'redirect' => '/admin-master' . $request->input('url'), // Ubah sesuai role pengguna
                ], 200);
            }
        }

        return response()->json([
            'error' => 'Kesalahan pada backend.',
        ], 401);
    }

    // Logout
    public function logout(Request $request)
    {
        if (Auth::logout()) {
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            session()->flash('success', 'Login berhasil!');
            return response()->json([
                'message' => 'Logout berhasil.',
                'redirect' => '/dashboard', // Ubah sesuai role pengguna
            ], 200);
        }

        return response()->json([
            'error' => 'Kesalahan pada backend.',
        ], 401);
    }
}
