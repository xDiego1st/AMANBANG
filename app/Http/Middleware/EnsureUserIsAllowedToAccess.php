<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class EnsureUserIsAllowedToAccess
{
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
        // try {
        //     $userRole = auth()->user()->role;
        //     $currentRouteName = Route::currentRouteName();
        //     if (in_array($currentRouteName, $this->userAccessRole()[$userRole])) {
        //         return $next($request);
        //     } else {
        //         if ($userRole == "SUPER-ADMIN" || $userRole == "ADMIN" || $userRole == 'VERIFIKATOR') {
        //             return $next($request);
        //         } else {
        //             abort(403, 'Unauthorized action');
        //         }
        //     }
        // } catch (\Throwable $th) {
        //     return redirect()->route('Home');
        //     // abort(403, 'You are not Allowed to access this page. ' . $userRole);
        //     // return $next($request);
        // }
    }
    // public function handle(Request $request, Closure $next)
    // {
    //     if (config('APP_DEBUG') == "true") {
    //         return $next($request);
    //     } else {
    //         try {
    //             $userRole = auth()->user()->role;
    //             $currentRouteName = Route::currentRouteName();
    //             if (in_array($currentRouteName, $this->userAccessRole()[$userRole])) {
    //                 return $next($request);
    //             } else {
    //                 if ($userRole == "SUPER-ADMIN" || $userRole == "ADMIN") {
    //                     return $next($request);
    //                 } else {
    //                     abort(403, 'Unauthorized action');
    //                 }
    //             }
    //         } catch (\Throwable $th) {
    //             return redirect()->route('dashboard');
    //             // abort(403, 'You are not Allowed to access this page. ' . $userRole);
    //             // return $next($request);
    //         }
    //     }
    // }
    private function userAccessRole()
    {
        //Tambahkan Manual route yang diperbolehkan pada role tertentu
        return [
            // 'user' => [
            //     'dashboard',
            // ],
            'SUPER-ADMIN' => [
                // Can Access All Page
            ],
            'ADMIN' => [
                // Can Access All Page
            ],
            'VERIFIKATOR' => [
                // Can Access All Page
                'profile.show',
                'media.show',
                'media.download',
            ],
            'PEMOHON' => [
                'pemohon.dashboard',
                'profile.show',
                'FormPageDataPemohon',
                'detail.dokumen',
                'pemohon.pengajuan',
                'pemohon.detail.pengajuan',
            ],
        ];
    }
}
