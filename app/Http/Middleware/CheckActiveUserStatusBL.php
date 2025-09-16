<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckActiveUserStatusBL
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if ($user && $user->active_until && now()->greaterThan($user->active_until)) {
            $user->tokens()->delete();
            auth()->logout();
            return response()->json(['message' => 'Account has expired'], 403);
        }

        return $next($request);
    }
}
