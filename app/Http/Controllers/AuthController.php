<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (session('is_logged_in')) {
            return redirect()->route('admin.dashboard');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $defaultEmail = env('APP_ADMIN_EMAIL', 'kesg#&@fksefk@gmail.com');
        $defaultPassword = env('APP_ADMIN_PASSWORD', 'password');

        $user = User::where('email', $credentials['email'])->first();

        // Jika belum ada user dan email login sama default, buat akun default otomatis
        if (!$user && $credentials['email'] === $defaultEmail) {
            $user = User::create([
                'name' => 'Owner',
                'email' => $defaultEmail,
                'role' => 'owner',
                'email_verified_at' => now(),
                'password' => Hash::make($defaultPassword),
            ]);
        }

        $passwordCorrect = false;

        if ($user) {
            // Check password with proper hashing
            $passwordCorrect = Hash::check($credentials['password'], $user->password);
        }

        if (!$user || !$passwordCorrect) {
            // Jika ada akun tapi password salah, beri pesan spesifik
            if ($user) {
                return back()->withErrors(['email' => 'Password salah, silakan coba lagi.'])->withInput();
            }

            return back()->withErrors(['email' => 'Akun tidak ditemukan. Pastikan email sudah terdaftar atau jalankan php artisan db:seed.'])->withInput();
        }

        session([
            'is_logged_in' => true,
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_email' => $user->email,
            'user_role' => $user->role,
            'user_photo' => $user->profile_photo,
        ]);

        if ($user->role === 'owner') {
            return redirect()->route('owner.profile');
        }

        return redirect()->route('petugas.profile');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();

        return redirect()->route('login')->with('success', 'Logout berhasil.');
    }
}
