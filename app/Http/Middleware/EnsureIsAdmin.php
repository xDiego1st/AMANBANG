<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureIsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Ambil pengguna yang terautentikasi
        $user = Auth::user();

        // Cek apakah pengguna adalah SUPER-ADMIN
        if ($user && $user->role !== 'SUPER-ADMIN') {
            return response()->json(['message' => 'Unauthorized: You do not have permission to perform this action.'], 403);
        }

        return $next($request);
    }
}
