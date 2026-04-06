@extends('layouts.adminapp')

@section('title', 'Profil Petugas')

@section('content')
<div style="margin-bottom:24px;">
    <h2 style="color:#fff;">Profil Petugas</h2>
    <p style="color:rgba(255,255,255,0.7);">Halaman khusus petugas untuk melihat dan memperbarui info pribadi.</p>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="card-modern" style="display:flex; gap:20px; flex-wrap:wrap; padding:20px;">
    <div style="min-width:160px; width:160px; height:160px; border-radius:16px; border:1px solid rgba(255,255,255,0.12); overflow:hidden;">
        @if($user->profile_photo_url)
            <img src="{{ $user->profile_photo_url }}" alt="Foto Petugas" style="width:100%; height:100%; object-fit:cover;">
        @else
            <div style="width:100%; height:100%; display:flex; justify-content:center; align-items:center; background:rgba(99,102,241,0.2); color:#fff; font-size:36px; font-weight:800;">{{ strtoupper(substr($user->name,0,2)) }}</div>
        @endif
    </div>
    <div style="flex:1; min-width:220px;">
        <h3 style="margin:0 0 6px 0; color:#fff;">{{ $user->name }}</h3>
        <p style="margin:0; color:rgba(255,255,255,0.8);">Email: {{ $user->email }}</p>
        <p style="margin:4px 0; color:rgba(255,255,255,0.8);">Jabatan: {{ ucfirst($user->role) }}</p>
        <div style="margin-top:12px; display:flex; gap:8px;"><a href="{{ route('profile') }}" class="btn btn-secondary" style="background:#0f172a; border-color:#334155;">Edit Profil</a></div>
    </div>
</div>
@endsection