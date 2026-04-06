@extends('layouts.master')

@section('title', 'Login Admin')

@section('styles')
<style>
    body {
        background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #0f172a 100%) !important;
        color: #e2e8f0 !important;
    }
    .bg-white,
    .card,
    .table,
    .form-control,
    .btn {
        background-color: transparent !important;
        border-color: rgba(148, 163, 184, 0.45) !important;
        color: #e2e8f0 !important;
    }
    .form-control::placeholder,
    .form-control-label {
        color: rgba(226, 232, 240, 0.8) !important;
    }
    .alert {
        background-color: rgba(15, 23, 42, 0.85) !important;
        border-color: rgba(148, 163, 184, 0.45) !important;
        color: #ffffff !important;
    }
    .alert-success {
        background-color: rgba(34, 197, 94, 0.2) !important;
        color: #dcfce7 !important;
    }
    .alert-danger {
        background-color: rgba(239, 68, 68, 0.2) !important;
        color: #fee2e2 !important;
    }
</style>
@endsection

@section('content')
<div class="glass" style="max-width:420px; margin:70px auto 24px; padding:32px; border-radius:24px; border: 1px solid rgba(255,255,255,0.12); box-shadow: 0 24px 80px rgba(0, 0, 0, 0.22);">
    <h2 style="margin-bottom:16px; color: #f8fafc; font-weight:800;" class="text-gradient">Masuk ke Dashboard</h2>
    <p style="margin-bottom:24px; color: rgba(255,255,255,0.7);">Gunakan akun admin untuk mengelola riwayat parkir.</p>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login.post') }}" autocomplete="off">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label" style="color: rgba(226,232,240,0.95);">Email</label>
            <input type="email" name="email" id="email" class="form-control form-control-dark" value="{{ old('email') }}" required autofocus>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label" style="color: rgba(226,232,240,0.95);">Password</label>
            <input type="password" name="password" id="password" class="form-control form-control-dark" required>
        </div>
        <button type="submit" class="btn btn-primary w-100 custom-login-btn">Login</button>
    </form>
</div>

<style>
    .custom-login-btn {
        background-color: #22c55e !important; /* hijau modern */
        border-color: #16a34a !important;
        color: #ffffff !important;
        box-shadow: 0 4px 12px rgba(34, 197, 94, 0.35);
        transition: background-color 0.2s ease, transform 0.2s ease;
    }
    .custom-login-btn:hover {
        background-color: #16a34a !important;
        border-color: #15803d !important;
        color: #ffffff !important;
        transform: translateY(-1px);
    }
    .form-control-dark {
        background-color: rgba(15, 23, 42, 0.88);
        border-color: rgba(100, 116, 139, 0.55);
        color: #e2e8f0;
        box-shadow: none;
    }
    .form-control-dark:focus {
        background-color: rgba(15, 23, 42, 0.98);
        border-color: #4f46e5;
        color: #ffffff;
        box-shadow: 0 0 0 0.25rem rgba(99, 102, 241, 0.35);
    }
    .alert {
        background-color: rgba(15, 23, 42, 0.85); 
        border: 1px solid rgba(148, 163, 184, 0.55); 
        color: #ffffff;
        padding: 12px 14px;
        border-radius: 8px;
    }
    .alert-success {
        background-color: rgba(34, 197, 94, 0.2);
        border-color: rgba(34, 197, 94, 0.45);
        color: #dcfce7;
    }
    .alert-danger {
        background-color: rgba(239, 68, 68, 0.2);
        border-color: rgba(239, 68, 68, 0.45);
        color: #fee2e2;
    }
</style>
@endsection
