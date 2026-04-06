<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    protected function ensureLoggedIn()
    {
        if (!session('is_logged_in')) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        return null;
    }

    protected function ensureOwner()
    {
        if ($redirect = $this->ensureLoggedIn()) {
            return $redirect;
        }

        $user = User::find(session('user_id'));

        if (!$user || $user->role !== 'owner') {
            return redirect()->route('admin.dashboard')->with('error', 'Akses ditolak. Anda bukan owner.');
        }

        return null;
    }

    public function profile()
    {
        if ($redirect = $this->ensureLoggedIn()) {
            return $redirect;
        }

        $user = User::findOrFail(session('user_id'));
        return view('admin.profile', compact('user'));
    }

    public function ownerProfile()
    {
        if ($redirect = $this->ensureOwner()) {
            return $redirect;
        }

        $user = User::findOrFail(session('user_id'));
        $totalPetugas = User::where('role', 'petugas')->count();

        return view('admin.owner_profile', compact('user', 'totalPetugas'));
    }

    public function petugasProfile()
    {
        if ($redirect = $this->ensureLoggedIn()) {
            return $redirect;
        }

        $user = User::findOrFail(session('user_id'));

        if ($user->role !== 'petugas') {
            return redirect()->route('owner.profile')->with('error', 'Akses halaman petugas hanya untuk petugas.');
        }

        return view('admin.petugas_profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        if ($redirect = $this->ensureLoggedIn()) {
            return $redirect;
        }

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $user = User::findOrFail(session('user_id'));
        $user->name = $data['name'];

        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');

            if ($user->profile_photo && Storage::disk('public')->exists($user->profile_photo)) {
                Storage::disk('public')->delete($user->profile_photo);
            }

            $path = $file->store('profile_photos', 'public');
            $user->profile_photo = $path;
        }

        $user->save();

        session([
            'user_name' => $user->name,
            'user_photo' => $user->profile_photo,
        ]);

        return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui.');
    }

    public function index()
    {
        if ($redirect = $this->ensureOwner()) {
            return $redirect;
        }

        $users = User::orderBy('role', 'desc')->orderBy('name')->get();

        return view('admin.users', compact('users'));
    }

    public function store(Request $request)
    {
        if ($redirect = $this->ensureOwner()) {
            return $redirect;
        }

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:owner,petugas',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => $data['role'],
            'password' => Hash::make($data['password']),
            'email_verified_at' => now(),
        ]);

        return redirect()->route('admin.users')->with('success', 'Akun baru berhasil dibuat.');
    }

    public function edit($id)
    {
        if ($redirect = $this->ensureOwner()) {
            return $redirect;
        }

        $user = User::findOrFail($id);

        return view('admin.edit_user', compact('user'));
    }

    public function update(Request $request, $id)
    {
        if ($redirect = $this->ensureOwner()) {
            return $redirect;
        }

        $user = User::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'role' => 'required|in:owner,petugas',
            'password' => 'nullable|confirmed|min:6',
        ]);

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->role = $data['role'];

        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        $user->save();

        return redirect()->route('admin.users')->with('success', 'Data petugas berhasil diperbarui.');
    }

    public function destroy($id)
    {
        if ($redirect = $this->ensureOwner()) {
            return $redirect;
        }

        $user = User::findOrFail($id);

        if ($user->role === 'owner') {
            return redirect()->route('admin.users')->with('error', 'Akun owner tidak bisa dihapus.');
        }

        $user->delete();

        return redirect()->route('admin.users')->with('success', 'Akun berhasil dihapus.');
    }

    public function resetPassword(Request $request, $id)
    {
        if ($redirect = $this->ensureOwner()) {
            return $redirect;
        }

        $user = User::findOrFail($id);

        if ($user->role === 'owner') {
            return redirect()->route('admin.users')->with('error', 'Password owner tidak bisa direset dari sini.');
        }

        $data = $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user->password = Hash::make($data['password']);
        $user->save();

        return redirect()->route('admin.users')->with('success', 'Password petugas berhasil direset.');
    }
}
