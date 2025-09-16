<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpFoundation\Response;

class CleanExpiredTokens
{
    public function handle($request, Closure $next)
    {
        // Hapus token yang sudah kedaluwarsa
        PersonalAccessToken::where('expires_at', '<', Carbon::now())->delete();

        return $next($request);
    }
}
