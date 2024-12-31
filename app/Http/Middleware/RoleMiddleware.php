<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Pastikan pengguna sudah terautentikasi
        if (!Auth::check()) {
            return redirect()->route('umum.dashboard')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Periksa apakah role pengguna sesuai dengan salah satu role yang diterima di parameter middleware
        if (!in_array(Auth::user()->role, $roles)) {
            // Redirect ke halaman dashboard berdasarkan role pengguna
            switch (Auth::user()->role) {
                case 'admin':
                    return redirect()->route('admin.dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
                case 'admin-master':
                    return redirect()->route('admin-master.dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
                default:
                    return redirect()->route('umum.dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
            }
        }

        // Jika role sesuai, lanjutkan permintaan
        return $next($request);
    }
}
