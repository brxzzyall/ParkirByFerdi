@extends('layouts.master')

@section('title', 'Parkir Manager - Smart Parking Solution')

@section('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    html, body {
        height: 100%;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #fff;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        overflow-x: hidden;
    }

    .navbar {
        background: rgba(30, 30, 50, 0.95);
        backdrop-filter: blur(15px);
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        padding: 1.2rem 0;
        position: sticky;
        top: 0;
        z-index: 1000;
    }

    .navbar .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 2rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .navbar-brand {
        font-size: 1.6rem;
        font-weight: 700;
        color: #fff;
        display: flex;
        align-items: center;
        gap: 0.875rem;
        text-decoration: none;
        letter-spacing: -0.5px;
    }

    .brand-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
    }

    .navbar-nav {
        display: flex;
        gap: 2rem;
    }

    .navbar-nav a {
        color: rgba(255, 255, 255, 0.85);
        text-decoration: none;
        font-weight: 500;
        font-size: 0.95rem;
        transition: color 0.3s ease;
        position: relative;
    }

    .navbar-nav a::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 0;
        height: 2px;
        background: linear-gradient(90deg, #667eea, #764ba2);
        transition: width 0.3s ease;
    }

    .navbar-nav a:hover {
        color: #fff;
    }

    .navbar-nav a:hover::after {
        width: 100%;
    }

    .navbar-nav form {
        display: inline;
    }

    .navbar-nav button {
        color: rgba(255, 255, 255, 0.85);
        background: none;
        border: none;
        font-weight: 500;
        font-size: 0.95rem;
        cursor: pointer;
        transition: color 0.3s ease;
        padding: 0;
    }

    .navbar-nav button:hover {
        color: #fff;
    }

    .hero-section {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 60px 20px;
        position: relative;
        overflow: hidden;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 600px;
        height: 600px;
        background: rgba(255, 255, 255, 0.08);
        border-radius: 50%;
        filter: blur(50px);
        animation: float 6s ease-in-out infinite;
    }

    .hero-section::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -5%;
        width: 400px;
        height: 400px;
        background: rgba(0, 0, 0, 0.1);
        border-radius: 50%;
        filter: blur(40px);
    }

    .hero-content {
        text-align: center;
        z-index: 10;
        color: #fff;
        max-width: 700px;
        animation: fadeInUp 0.8s ease 0.2s both;
    }

    .hero-content h1 {
        font-size: 3.5rem;
        font-weight: 800;
        line-height: 1.2;
        margin-bottom: 1.5rem;
        text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        letter-spacing: -1px;
    }

    .hero-content p {
        font-size: 1.15rem;
        margin-bottom: 2.5rem;
        opacity: 0.95;
        line-height: 1.8;
        font-weight: 400;
    }

    .hero-buttons {
        display: flex;
        gap: 1.5rem;
        justify-content: center;
        margin-bottom: 4rem;
        flex-wrap: wrap;
    }

    .btn {
        padding: 1rem 2.75rem;
        font-size: 1rem;
        font-weight: 600;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        letter-spacing: 0.5px;
    }

    .btn-primary {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        color: #fff;
        box-shadow: 0 10px 25px rgba(17, 153, 142, 0.3);
    }

    .btn-primary:hover {
        transform: translateY(-4px);
        box-shadow: 0 15px 40px rgba(17, 153, 142, 0.5);
        color: #fff;
    }

    .btn-secondary {
        background: rgba(255, 255, 255, 0.15);
        color: #fff;
        border: 2px solid rgba(255, 255, 255, 0.6);
        backdrop-filter: blur(5px);
    }

    .btn-secondary:hover {
        background: rgba(255, 255, 255, 0.25);
        border-color: #fff;
        transform: translateY(-4px);
    }

    .features {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2.5rem;
        margin-top: 3.5rem;
        padding: 0 2rem;
    }

    .feature-card {
        background: rgba(255, 255, 255, 0.12);
        border: 1px solid rgba(255, 255, 255, 0.25);
        border-radius: 16px;
        padding: 2.5rem;
        backdrop-filter: blur(12px);
        transition: all 0.4s ease;
        text-align: center;
        animation: slideIn 0.6s ease-out;
    }

    .feature-card:nth-child(2) {
        animation-delay: 0.15s;
    }

    .feature-card:nth-child(3) {
        animation-delay: 0.3s;
    }

    .feature-card:hover {
        background: rgba(255, 255, 255, 0.18);
        transform: translateY(-12px);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25);
        border-color: rgba(255, 255, 255, 0.4);
    }

    .feature-icon {
        font-size: 3.5rem;
        margin-bottom: 1.25rem;
        display: inline-block;
    }

    .feature-card h3 {
        font-size: 1.35rem;
        margin-bottom: 0.875rem;
        font-weight: 700;
        letter-spacing: -0.5px;
    }

    .feature-card p {
        font-size: 0.975rem;
        opacity: 0.92;
        line-height: 1.6;
        font-weight: 400;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(40px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes float {
        0%, 100% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(20px);
        }
    }

    @media (max-width: 768px) {
        .navbar {
            padding: 1rem 0 !important;
        }

        .navbar .container {
            padding: 0 1rem !important;
        }

        .navbar-brand {
            font-size: 1.3rem !important;
            gap: 0.5rem !important;
        }

        .brand-icon {
            width: 42px !important;
            height: 42px !important;
            font-size: 1.5rem !important;
        }

        .navbar-nav {
            gap: 1rem !important;
            font-size: 0.85rem !important;
        }

        .hero-section {
            padding: 40px 15px !important;
            min-height: 70vh !important;
        }

        .hero-content h1 {
            font-size: 2.25rem;
            margin-bottom: 1rem;
        }

        .hero-content p {
            font-size: 1rem;
            margin-bottom: 1.5rem;
        }

        .hero-buttons {
            flex-direction: column;
            gap: 1rem;
            margin-bottom: 3rem;
        }

        .btn {
            width: 100% !important;
        }

        .features {
            grid-template-columns: 1fr;
            gap: 1.75rem;
            margin-top: 2.5rem;
            padding: 0 1rem;
        }

        .feature-card {
            padding: 1.75rem;
        }

        .feature-icon {
            font-size: 3rem !important;
        }

        .feature-card h3 {
            font-size: 1.15rem;
        }
    }

    @media (max-width: 480px) {
        .navbar {
            padding: 0.75rem 0 !important;
        }

        .navbar .container {
            padding: 0 0.75rem !important;
        }

        .navbar-brand {
            font-size: 1.1rem !important;
            gap: 0.4rem !important;
        }

        .brand-icon {
            width: 38px !important;
            height: 38px !important;
            font-size: 1.3rem !important;
        }

        .navbar-nav {
            gap: 0.75rem !important;
            font-size: 0.75rem !important;
        }

        .navbar-nav a,
        .navbar-nav button {
            font-size: 0.8rem !important;
        }

        .hero-section {
            padding: 30px 12px !important;
            min-height: 60vh !important;
        }

        .hero-content h1 {
            font-size: 1.75rem !important;
            margin-bottom: 0.75rem !important;
            line-height: 1.2 !important;
        }

        .hero-content p {
            font-size: 0.9rem !important;
            margin-bottom: 1.25rem !important;
            line-height: 1.5 !important;
        }

        .hero-buttons {
            flex-direction: column;
            gap: 0.75rem;
            margin-bottom: 2rem;
        }

        .btn {
            width: 100% !important;
            padding: 0.75rem 1.5rem !important;
            font-size: 0.9rem !important;
        }

        .features {
            grid-template-columns: 1fr;
            gap: 1.25rem;
            margin-top: 2rem;
            padding: 0 0.75rem;
        }

        .feature-card {
            padding: 1.25rem;
            border-radius: 12px;
        }

        .feature-icon {
            font-size: 2.5rem !important;
            margin-bottom: 0.75rem !important;
        }

        .feature-card h3 {
            font-size: 1rem !important;
            margin-bottom: 0.5rem !important;
        }

        .feature-card p {
            font-size: 0.85rem !important;
        }
    }
</style>
@endsection

@section('navbar')
<nav class="navbar">
    <div class="container">
        <a class="navbar-brand" href="/">
            <div class="brand-icon">🅿️</div>
            <div>Parkir Manager</div>
        </a>
        @if (Route::has('login'))
            <div class="navbar-nav">
                @auth
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>
</nav>
@endsection

@section('content')
<div class="hero-section">
    <div class="hero-content">
        <h1>Sistem Manajemen Parkir Modern</h1>
        <p>Kelola parkir Anda dengan mudah, cepat, dan efisien menggunakan teknologi terkini</p>
        <div class="hero-buttons">
            <a href="{{ route('login') }}" class="btn btn-primary">Mulai Sekarang</a>
            <a href="#features" class="btn btn-secondary">Pelajari Lebih</a>
        </div>
        <div class="features" id="features">
            <div class="feature-card">
                <div class="feature-icon">⏱️</div>
                <h3>Pencatatan Otomatis</h3>
                <p>Sistem otomatis mencatat waktu masuk dan keluar kendaraan secara real-time</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">💰</div>
                <h3>Perhitungan Biaya</h3>
                <p>Perhitungan tarif parkir otomatis berdasarkan durasi parkir yang fleksibel</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">📊</div>
                <h3>Dashboard Lengkap</h3>
                <p>Dashboard intuitif dengan laporan real-time dan analitik mendalam</p>
            </div>
        </div>
    </div>
</div>
@endsection
