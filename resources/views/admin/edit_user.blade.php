@extends('layouts.adminapp')

@section('title', 'Edit Petugas')

@section('content')
<div style="margin-bottom:24px;">
    <h2 style="color:#fff;">Edit Akun Petugas</h2>
    <p style="color:rgba(255,255,255,0.7);">Perbarui data petugas dan reset password di halaman ini.</p>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="card-modern" style="padding:20px;">
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" style="display:grid; gap:14px;">
        @csrf
        @method('PUT')

        <div>
            <label style="color: rgba(255, 255, 255, 0.76); font-weight:600;">Nama</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="form-control" style="background:rgba(15,23,42,0.8); border:1px solid rgba(255, 255, 255, 0.76); color:#fff;">
            @error('name')<small style="color:#f87171;">{{ $message }}</small>@enderror
        </div>

        <div>
            <label style="color: rgba(255, 255, 255, 0.76); font-weight:600;">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="form-control" style="background:rgba(15,23,42,0.8); border:1px solid rgba(255, 255, 255, 0.76); color:#fff;">
            @error('email')<small style="color:#f87171;">{{ $message }}</small>@enderror
        </div>

        <div>
            <label style="color: rgba(255, 255, 255, 0.76); font-weight:600;">Jabatan</label>
            <select name="role" required class="form-control" style="background:rgba(15,23,42,0.8); border:1px solid rgba(255, 255, 255, 0.76); color:#fff;">
                <option value="petugas" {{ old('role', $user->role) === 'petugas' ? 'selected' : '' }}>Petugas</option>
                <option value="owner" {{ old('role', $user->role) === 'owner' ? 'selected' : '' }}>Owner</option>
            </select>
            @error('role')<small style="color:#f87171;">{{ $message }}</small>@enderror
        </div>

        <div>
            <label style="color: rgba(255, 255, 255, 0.76); font-weight:600;">Reset Password (opsional)</label>
            <input type="password" name="password" class="form-control" style="background:rgba(15,23,42,0.8); border:1px solid rgba(255, 255, 255, 0.76); color:#fff;" placeholder="Kosongkan untuk tidak mengganti">
            @error('password')<small style="color:#f87171;">{{ $message }}</small>@enderror
        </div>

        <div>
            <label style="color: rgba(255, 255, 255, 0.76); font-weight:600;">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-control" style="background:rgba(15,23,42,0.8); border:1px solid rgba(255, 255, 255, 0.76); color:#f5f2f2;" placeholder="Ulangi password baru">
        </div>

        <button type="submit" class="btn btn-info" style="background-color:#6366f1; border-color:#4f46e5;">Simpan Perubahan</button>
        <a href="{{ route('admin.users') }}" class="btn btn-secondary" style="background:#0f172a; border-color:#334155;">Kembali ke Daftar</a>
    </form>
</div>
@endsection