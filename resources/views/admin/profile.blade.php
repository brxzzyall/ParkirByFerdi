@extends('layouts.adminapp')

@section('title', 'Profil Saya')

@section('content')
<div style="margin-bottom:24px;">
    <h2 style="color:#fff;">Profil Saya</h2>
    <p style="color:rgba(255,255,255,0.7);">Ubah nama akun Anda di sini.</p>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="card-modern" style="padding:20px;">
    <form action="{{ route('profile.update') }}" method="POST" style="display:grid; gap:14px;" enctype="multipart/form-data">
        @csrf

        <div style="display:flex; align-items:center; gap:18px; flex-wrap:wrap;">
            <div style="width:108px; height:108px; border-radius:50%; overflow:hidden; border:1px solid rgba(148,163,184,0.5); background:rgba(255,255,255,0.08);">
                @if($user->profile_photo_url)
                    <img src="{{ $user->profile_photo_url }}" alt="Foto Profil" style="width:100%; height:100%; object-fit:cover;">
                @else
                    <div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center; color:rgba(148,163,184,0.9); background: rgba(15,23,42,0.8); font-weight:700;">{{ substr($user->name, 0, 2) }}</div>
                @endif
            </div>
            <div style="flex:1; min-width:180px;">
                <label style="color: rgba(226,232,240,0.8); font-weight:600;">Foto Profil</label>
                <input type="file" name="profile_photo" class="form-control" style="background: rgba(15,23,42,0.8); border:1px solid rgba(148,163,184,0.4); color:#fff;" accept="image/*">
                @error('profile_photo')
                    <small style="color:#f87171; display:block; margin-top:4px;">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div>
            <label style="color: rgba(226,232,240,0.8); font-weight:600;">Nama</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="form-control" style="background:rgba(15,23,42,0.8); border:1px solid rgba(148,163,184,0.4); color:#fff;">
            @error('name')
                <small style="color:#f87171; display:block; margin-top:4px;">{{ $message }}</small>
            @enderror
        </div>

        <div>
            <label style="color: rgba(226,232,240,0.8); font-weight:600;">Jabatan</label>
            <input type="text" value="{{ ucfirst($user->role) }}" readonly class="form-control" style="background:rgba(15,23,42,0.8); border:1px solid rgba(148,163,184,0.4); color:#fff;">
        </div>

        <button type="submit" class="btn btn-info" style="background-color:#6366f1; border-color:#4f46e5;">Simpan Perubahan</button>
    </form>
</div>
@endsection