@extends('layouts.adminapp')

@section('title', 'Kelola Petugas')

@section('content')
<div style="margin-bottom:24px;">
    <h2 style="color:#fff;">Kelola Petugas</h2>
    <p style="color:rgba(255,255,255,0.7);">Hanya owner yang bisa membuat atau menghapus akun petugas di sini.</p>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="card-modern" style="margin-bottom:28px;">
    <div class="card-header-modern">
        <h4 style="margin:0;">Tambah Akun Petugas</h4>
    </div>
    <div style="padding:20px;">
        <form action="{{ route('admin.users.store') }}" method="POST" style="display:grid; gap:10px;">
            @csrf

            <input type="text" name="name" placeholder="Nama Petugas" value="{{ old('name') }}" required class="form-control" style="background:rgba(15,23,42,0.8); border:1px solid rgba(148,163,184,0.4); color:#fff;">
            @error('name')<small style="color:#f87171;">{{ $message }}</small>@enderror

            <input type="email" name="email" placeholder="Email Petugas" value="{{ old('email') }}" required class="form-control" style="background:rgba(15,23,42,0.8); border:1px solid rgba(148,163,184,0.4); color:#fff;">
            @error('email')<small style="color:#f87171;">{{ $message }}</small>@enderror

            <label style="color: rgba(226,232,240,0.8); font-weight:600;">Jabatan</label>
            <select name="role" required class="form-control" style="background:rgba(15,23,42,0.8); border:1px solid rgba(148,163,184,0.4); color:#fff;">
                <option value="petugas">Petugas</option>
            </select>

            <input type="password" name="password" placeholder="Password" required class="form-control" style="background:rgba(15,23,42,0.8); border:1px solid rgba(148,163,184,0.4); color:#fff;">
            @error('password')<small style="color:#f87171;">{{ $message }}</small>@enderror

            <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required class="form-control" style="background:rgba(15,23,42,0.8); border:1px solid rgba(148,163,184,0.4); color:#fff;">

            <button type="submit" class="btn btn-info" style="background-color:#6366f1; border-color:#4f46e5;">Buat Petugas</button>
        </form>
    </div>
</div>

<div class="card-modern">
    <div class="card-header-modern">
        <h4 style="margin:0;">Daftar Pengguna</h4>
    </div>
    <div style="overflow-x:auto; padding:20px;">
        <table class="table-modern" style="width:100%;">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Jabatan</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if($user->profile_photo)
                                @php
                                    $photoPath = preg_replace('#^(?:/)?(?:storage/|public/storage/)#', '', $user->profile_photo);
                                @endphp
                                <img src="{{ '/storage/' . ltrim($photoPath, '/') }}" style="width:36px; height:36px; border-radius:50%; object-fit:cover;" alt=""> 
                            @else
                                <div style="width:36px; height:36px; border-radius:50%; background:rgba(99,102,241,0.2); display:flex; align-items:center; justify-content:center; color:#fff; font-size:0.75rem; font-weight:700;">{{ strtoupper(substr($user->name,0,2)) }}</div>
                            @endif
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ ucfirst($user->role) }}</td>
                        <td>{{ $user->created_at->format('d M Y') }}</td>
                        <td style="display:flex; gap:6px; flex-wrap:wrap;">
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-info" style="background:#22c55e; border-color:#16a34a;">Edit</a>
                            @if($user->role !== 'owner')
                                <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" onsubmit="return confirm('Hapus akun {{ $user->name }}?');" style="display:inline-flex;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" style="background:#dc2626; border-color:#b91c1c;">Hapus</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align:center; color:rgba(255,255,255,0.5);">Belum ada akun</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
