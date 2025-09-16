<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasDataPengajuan
{
    // Daftar route yang selalu boleh diakses tanpa cek pengajuan
    protected array $whitelistRoutes = [
        'profile.show',     // Route: Route::get('/settings', ProfileSettings::class)->name('profile.show');
        // tambahkan nama route lain jika perlu...
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1) Selalu izinkan jika route sekarang ada di whitelist
        if ($request->routeIs($this->whitelistRoutes)) {
            return $next($request);
        }

        // 2) Pastikan user login
        $user = $request->user();
        if (!$user) {
            // Boleh diarahkan ke login atau 403 sesuai kebutuhan
            abort(403, 'Silakan login untuk mengakses halaman ini.');
        }

        // 3) Cek role PEMOHON saja yang butuh punya data pengajuan
        if (($user->role ?? null) === 'PEMOHON') {
            // exists() lebih hemat daripada count()
            $hasPengajuan = $user->pengajuan()->exists();

            if (!$hasPengajuan) {
                notify()->success('Halo, ' . auth()->user()->name . ' 👋', 'Login Berhasil');
                return redirect()->route('FormPageDataPemohon');
            }
        }

        // 4) Lolos
        return $next($request);
    }
}
