<?php

namespace App\Http\Controllers\API\LUNA;

use App\Http\Controllers\API\BaseController;
use App\Models\UserBL;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends BaseController
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required_without:email',
            'email' => 'required_without:username|email',
            'password' => 'required',
            'hwid' => 'required',
            'software' => 'required|in:python,bem',
        ], [
            'username.required_without' => 'Username atau email diperlukan.',
            'email.required_without' => 'Email atau username diperlukan.',
            'password.required' => 'Password diperlukan.',
            'hwid.required' => 'HWID diperlukan.',
            'software.required' => 'Software login diperlukan.',
            'software.in' => 'Software harus bernilai python atau bem.',
        ]);

        $field = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $user = UserBL::where($field, $request->$field)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->sendError('Unauthorized', ['error' => 'Username dan Password tidak valid.'], 401);
        }

        if (!$user->isActive()) {
            return $this->sendError('Unauthorized', ['error' => "Akun Anda Sudah Melewati Batas Waktu Pemakaian. Pada Tgl {$user->active_until}, Silahkan Melakukan Pembaruan Pembayaran / Perpanjangan Masa Aktif"], 403);
        }

        // Skip HWID and multi-login checks for SUPER-ADMIN
        if ($user->role !== 'SUPER-ADMIN') {
            // Check if HWID is null, if so, set it
            if (is_null($user->hwid)) {
                $user->hwid = $request->hwid;
                $user->save();
            } elseif ($user->hwid !== $request->hwid) {
                return $this->sendError('Unauthorized', ['error' => 'HWID tidak cocok.'], 403);
            }
        }

        // Logika khusus untuk login Python
        // if ($request->software === 'python' && $user->role !== 'SUPER-ADMIN') {
        //     // Cek apakah user sudah memiliki token aktif di Python
        //     $pythonToken = $user->tokens()->where('name', 'python')->first();

        //     if ($pythonToken) {
        //         // Jika user sudah memiliki token di Python, tolak login baru
        //         return $this->sendError('Unauthorized', ['error' => 'User sudah login di perangkat Python lain.'], 403);
        //     }
        // }

        // Logika khusus untuk BEM dan Python
        if ($request->software === 'bem') {
            // Cek apakah user sudah login dari Python
            $pythonToken = $user->tokens()->where('name', 'python')->first();

            if (!$pythonToken) {
                return $this->sendError('Unauthorized', ['error' => 'User belum login dari Python.'], 403);
            }

            // Hapus semua token yang berasal dari login BEM sebelumnya
            $user->tokens()->where('name', 'bem')->delete();
        }

        // Hapus semua token BEM sebelumnya jika login dari Python
        if ($user->role !== 'SUPER-ADMIN' && $request->software === 'python') {
            $user->tokens()->where('name', 'python')->delete();
        }

        // Buat token baru berdasarkan software
        $tokenResult = $user->createToken($request->software);

        // Tentukan tanggal expired berdasarkan active_until
        $expiryDate = $user->active_until ? Carbon::parse($user->active_until) : Carbon::now()->addDay();

        // Atur expires_at pada token yang baru dibuat
        $accessToken = $tokenResult->accessToken;
        $accessToken->expires_at = $expiryDate;
        $accessToken->save();

        // Simpan informasi login terakhir
        $user->last_login_at = now();
        $user->last_login_ip = $request->ip();
        $user->save();

        // Kembalikan semua informasi pengguna beserta token dan masa aktif
        $userData = [
            'name' => $user->name,
            'username' => $user->username,
            'email' => $user->email,
            'active_until' => $user->active_until,
            'token' => $tokenResult->plainTextToken,
        ];

        return $this->sendResponse($userData, 'Login berhasil.');
    }

    public function logout(Request $request)
    {
        // Hapus semua token saat logout
        $request->user()->tokens()->delete();

        return $this->sendResponse([], 'Logout berhasil.');
    }
    // Ganti password untuk pengguna yang sedang login
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ], [
            'current_password.required' => 'Password saat ini diperlukan.',
            'new_password.required' => 'Password baru diperlukan.',
            'new_password.min' => 'Password baru harus memiliki minimal 8 karakter.',
            'new_password.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ]);

        $user = $request->user();

        // Cek apakah password saat ini valid
        if (!Hash::check($request->current_password, $user->password)) {
            return $this->sendError('Unauthorized', ['error' => 'Password saat ini tidak valid.'], 401);
        }

        // Update password
        $user->password = Hash::make($request->new_password);
        $user->save();

        return $this->sendResponse([], 'Password berhasil diubah.');
    }

    // Metode untuk memeriksa HWID dan mendapatkan informasi pengguna
    public function checkHwidLogin(Request $request)
    {
        $request->validate([
            'hwid' => 'required',
        ], [
            'hwid.required' => 'HWID diperlukan.',
        ]);

        // Cari pengguna berdasarkan HWID
        $user = UserBL::where('hwid', $request->hwid)->first();

        // Jika HWID tidak ditemukan
        if (!$user) {
            return $this->sendError('HWID tidak ditemukan', ['error' => "HWID Belum Tedaftar / tidak ditemukan, Silahkan Login Di BotConfig Terlebih Dahulu"], code: 500);
        }
        $userData = [
            'name' => $user->name,
            'username' => $user->username,
            'email' => $user->email,
            'last_login_at' => $user->last_login_at,
            'last_login_ip' => $user->last_login_ip,
            'last_seen' => $user->last_seen,
            'active_until' => $user->active_until,
        ];
        if (!$user->isActive()) {
            return $this->sendError('Unauthorized', ['error' => "Akun Anda Sudah Melewati Batas Waktu Pemakaian. Pada Tgl {$user->active_until}, Silahkan Melakukan Pembaruan Pembayaran / Perpanjangan Masa Aktif"], 403);
        } else {
            // $pythonToken = $user->tokens()->where('name', 'python')->first();

            // if (!$pythonToken) {
            //     return $this->sendError('Unauthorized', ['error' => 'User belum login dari BotConfig.'], 403);
            // }
            return $this->sendResponse($userData, 'HWID Terdaftar');

        }
    }
}
