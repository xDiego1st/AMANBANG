<?php

namespace App\Http\Controllers\API\LUNA;

use App\Http\Controllers\API\BaseController;
use App\Http\Resources\UserBLResources;
use App\Models\UserBL;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserBLController extends BaseController
{
    // Menampilkan semua pengguna
    public function index()
    {
        $users = UserBL::all();
        return $this->sendResponse(UserBLResources::collection($users), 'Users retrieved successfully.');
    }

    // Menyimpan pengguna baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'username' => 'required|string|max:255|unique:users_bl',
            'password' => 'required|string|min:8',
            'email' => 'required|email|unique:users_bl',
            'role' => 'required|in:SUPER-ADMIN,USER',
            'no_wa' => 'nullable|string',
            'active_until' => 'nullable|date',
        ], [
            'username.required' => 'Username diperlukan.',
            'username.unique' => 'Username sudah terdaftar.',
            'password.required' => 'Password diperlukan.',
            'email.required' => 'Email diperlukan.',
            'email.unique' => 'Email sudah terdaftar.',
            'role.required' => 'Peran diperlukan.',
            'role.in' => 'Peran tidak valid.',
        ]);

        $user = UserBL::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'role' => $request->role,
            'no_wa' => $request->no_wa,
            'status_account' => 1,
            'active_until' => $request->active_until ? Carbon::parse($request->active_until) : null,
        ]);

        return $this->sendResponse(new UserBLResources($user), 'User created successfully.');
    }

    // Menampilkan pengguna berdasarkan ID
    public function show($id)
    {
        $user = UserBL::find($id);

        if (!$user) {
            return $this->sendError('User not found.');
        }

        return $this->sendResponse(new UserBLResources($user), 'User retrieved successfully.');
    }

    // Memperbarui pengguna berdasarkan ID
    public function update(Request $request, $id)
    {
        $user = UserBL::find($id);

        if (!$user) {
            return $this->sendError('User not found.');
        }

        $request->validate([
            'name' => 'sometimes|string|max:255',
            'password' => 'sometimes|string|min:8',
            'email' => 'sometimes|email|unique:users_bl,email,' . $user->id,
            'no_wa' => 'sometimes|string',
            'active_until' => 'sometimes|date',
            'hwid' => 'sometimes|string|min:6',
            'status_account' => 'sometimes',
        ]);

        $user->name = $request->name ?? $user->name;
        $user->email = $request->email ?? $user->email;
        $user->no_wa = $request->no_wa ?? $user->no_wa;
        $user->hwid = $request->hwid ?? $user->hwid;
        $user->active_until = $request->active_until ? Carbon::parse($request->active_until) : $user->active_until;
        $user->status_account = $request->status_account ?? $user->status_account;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return $this->sendResponse(new UserBLResources($user), 'User updated successfully.');
    }

    // Menghapus pengguna berdasarkan ID
    public function destroy($id)
    {
        $user = UserBL::find($id);

        if (!$user) {
            return $this->sendError('User not found.');
        }

        $user->delete();

        return $this->sendResponse(new UserBLResources($user), 'User deleted successfully.');
    }

    // Reset password untuk pengguna berdasarkan ID
    public function resetPassword(Request $request, $id)
    {
        $request->validate([
            'new_password' => 'required|string|min:8|confirmed',
        ], [
            'new_password.required' => 'Password baru diperlukan.',
            'new_password.min' => 'Password baru harus memiliki minimal 8 karakter.',
            'new_password.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ]);

        $user = UserBL::find($id);

        if (!$user) {
            return $this->sendError('User not found.');
        }

        // Update password
        $user->password = Hash::make($request->new_password);
        $user->save();

        return $this->sendResponse(new UserBLResources($user), 'Password pengguna berhasil direset.');
    }

    // Memperbarui masa aktif akun pengguna
    public function updateActiveUntil(Request $request, $id)
    {
        $request->validate([
            'days' => 'nullable|integer|min:0',
            'months' => 'nullable|integer|min:0',
            'years' => 'nullable|integer|min:0',
            'specific_date' => 'nullable|date|after_or_equal:today',
        ], [
            'days.integer' => 'Jumlah hari harus berupa bilangan bulat.',
            'months.integer' => 'Jumlah bulan harus berupa bilangan bulat.',
            'years.integer' => 'Jumlah tahun harus berupa bilangan bulat.',
            'specific_date.date' => 'Tanggal tidak valid.',
            'specific_date.after_or_equal' => 'Tanggal harus sama atau setelah hari ini.',
        ]);

        // Pastikan minimal satu dari parameter ini ada
        if (!$request->days && !$request->months && !$request->years && !$request->specific_date) {
            return $this->sendError('Validation Error', ['error' => 'Salah satu dari jumlah hari, bulan, tahun, atau tanggal spesifik harus diberikan.'], 422);
        }

        $user = UserBL::find($id);

        if (!$user) {
            return $this->sendError('User not found.');
        }

        // Dapatkan nilai active_until yang ada sebelumnya
        $activeUntil = $user->active_until ? Carbon::parse($user->active_until) : now();

        // Hitung tanggal baru
        if ($request->days) {
            $activeUntil->addDays($request->days);
        }
        if ($request->months) {
            $activeUntil->addMonths($request->months);
        }
        if ($request->years) {
            $activeUntil->addYears($request->years);
        }
        if ($request->specific_date) {
            $activeUntil = Carbon::parse($request->specific_date); // Menggunakan tanggal spesifik
        }

        // Simpan perubahan ke active_until
        $user->active_until = $activeUntil;
        $user->save();

        return $this->sendResponse(new UserBLResources($user), 'Masa aktif pengguna berhasil diperbarui.');
    }
    public function resetHWID(Request $request, $id)
    {
        $user = UserBL::find($id);

        if (!$user) {
            return $this->sendError('User not found.');
        }

        // Reset HWID
        $user->hwid = null;
        $user->save();

        // Logout the user by deleting their tokens
        $user->tokens()->delete();

        return $this->sendResponse(new UserBLResources($user), 'HWID reset successfully and user logged out.');
    }
    public function checkTokenLogin($token)
    {
        // Pisahkan ID dari token menggunakan karakter '|'
        $tokenParts = explode('|', $token);
        $plainToken = isset($tokenParts[1]) ? $tokenParts[1] : $token;

        // Cari token di tabel personal_access_tokens dengan hash dari plain token
        $tokenData = DB::table('personal_access_tokens')
            ->where('token', hash('sha256', $plainToken))
            ->first();

        if (!$tokenData) {
            return $this->sendError('Invalid token or user not logged in.');
        }

        // Dapatkan user dari token
        $user = UserBL::find($tokenData->tokenable_id);

        if (!$user) {
            return $this->sendError('User not found.');
        }

        // Kirim response sukses dengan data user
        return $this->sendResponse(new UserBLResources($user), 'Token is valid, user is logged in.');
    }
    public function getActiveUsers()
    {
        // Ambil semua token aktif di tabel personal_access_tokens
        $activeTokens = DB::table('personal_access_tokens')
            ->distinct()
            ->pluck('tokenable_id');

        // Ambil pengguna yang sedang login berdasarkan tokenable_id
        $activeUsers = UserBL::whereIn('id', $activeTokens)->get();

        if ($activeUsers->isEmpty()) {
            return $this->sendError('No users are currently logged in.');
        }

        // Kembalikan response dengan data user yang aktif
        return $this->sendResponse(UserBLResources::collection($activeUsers), 'Active users retrieved successfully.');
    }
}
