@extends('layouts.master')

@section('title', 'ParkSmart — Sistem Parkir Modern')

@section('styles')
<style>
    /* Override main container for welcome page */
    body > main {
        padding: 0 !important;
        max-width: 100% !important;
    }
    
    .app-footer {
        display: none !important;
    }

    body {
        background: var(--dark);
        color: white;
        min-height: 100vh;
    }

    /* ── Navbar ── */
    .site-navbar {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000;
        background: rgba(15, 23, 42, 0.9);
        backdrop-filter: blur(24px);
        -webkit-backdrop-filter: blur(24px);
        border-bottom: 1px solid rgba(255,255,255,0.07);
        padding: 0;
    }
    .site-navbar .inner {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 2rem;
        height: 68px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .brand {
        display: flex;
        align-items: center;
        gap: 12px;
        text-decoration: none;
        color: white;
    }
    .brand-logo {
        width: 42px;
        height: 42px;
        background: var(--gradient-primary);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        box-shadow: 0 4px 14px rgba(99,102,241,0.4);
        flex-shrink: 0;
    }
    .brand-text {
        font-size: 1.25rem;
        font-weight: 700;
        letter-spacing: -0.5px;
    }
    .brand-sub {
        font-size: 0.7rem;
        color: rgba(255,255,255,0.5);
        font-weight: 400;
        display: block;
        margin-top: -2px;
    }
    .nav-links {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .nav-link-item {
        color: rgba(255,255,255,0.75);
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 500;
        padding: 8px 16px;
        border-radius: 8px;
        transition: all 0.2s;
    }
    .nav-link-item:hover {
        color: white;
        background: rgba(255,255,255,0.08);
    }
    .nav-btn {
        background: var(--gradient-primary);
        color: white !important;
        padding: 8px 20px;
        border-radius: 8px;
        font-weight: 600;
        box-shadow: 0 4px 12px rgba(99,102,241,0.3);
        transition: all 0.2s;
    }
    .nav-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(99,102,241,0.45);
    }
    .nav-btn-ghost {
        border: 1px solid rgba(255,255,255,0.2);
        color: rgba(255,255,255,0.85) !important;
    }
    .nav-btn-ghost:hover {
        border-color: rgba(255,255,255,0.4);
        background: rgba(255,255,255,0.06);
    }

    /* ── Hero ── */
    .hero {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 100px 20px 60px;
        position: relative;
        overflow: hidden;
        text-align: center;
    }
    .hero-bg {
        position: absolute;
        inset: 0;
        background: radial-gradient(ellipse 80% 60% at 50% 0%, rgba(99,102,241,0.25) 0%, transparent 70%),
                    radial-gradient(ellipse 60% 50% at 80% 80%, rgba(139,92,246,0.15) 0%, transparent 60%),
                    radial-gradient(ellipse 50% 40% at 20% 70%, rgba(6,182,212,0.1) 0%, transparent 60%);
        pointer-events: none;
    }
    .hero-orb {
        position: absolute;
        border-radius: 50%;
        filter: blur(60px);
        pointer-events: none;
        opacity: 0.5;
    }
    .hero-orb-1 {
        width: 500px; height: 500px;
        background: rgba(99,102,241,0.2);
        top: -200px; right: -100px;
        animation: float 8s ease-in-out infinite;
    }
    .hero-orb-2 {
        width: 350px; height: 350px;
        background: rgba(139,92,246,0.15);
        bottom: -100px; left: -80px;
        animation: float 10s ease-in-out infinite reverse;
    }
    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(99,102,241,0.15);
        border: 1px solid rgba(99,102,241,0.3);
        color: var(--primary-light);
        padding: 6px 16px;
        border-radius: 100px;
        font-size: 0.8rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        margin-bottom: 28px;
        animation: fadeInUp 0.6s ease both;
    }
    .hero-badge .dot {
        width: 6px; height: 6px;
        background: var(--primary-light);
        border-radius: 50%;
        animation: pulse-ring 2s infinite;
    }
    .hero-title {
        font-size: clamp(2.5rem, 6vw, 4.5rem);
        font-weight: 900;
        line-height: 1.1;
        letter-spacing: -2px;
        margin-bottom: 24px;
        animation: fadeInUp 0.6s ease 0.1s both;
    }
    .hero-title .highlight {
        background: linear-gradient(135deg, #818cf8 0%, #c084fc 50%, #67e8f9 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .hero-desc {
        font-size: 1.1rem;
        color: rgba(255,255,255,0.65);
        max-width: 560px;
        margin: 0 auto 40px;
        line-height: 1.8;
        font-weight: 400;
        animation: fadeInUp 0.6s ease 0.2s both;
    }
    .hero-actions {
        display: flex;
        gap: 14px;
        justify-content: center;
        flex-wrap: wrap;
        margin-bottom: 80px;
        animation: fadeInUp 0.6s ease 0.3s both;
    }
    .btn-hero-primary {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: var(--gradient-primary);
        color: white;
        padding: 14px 32px;
        border-radius: 12px;
        font-size: 1rem;
        font-weight: 600;
        text-decoration: none;
        box-shadow: 0 8px 24px rgba(99,102,241,0.35);
        transition: all 0.25s;
        border: none;
        cursor: pointer;
    }
    .btn-hero-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 14px 36px rgba(99,102,241,0.5);
        color: white;
    }
    .btn-hero-secondary {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: rgba(255,255,255,0.06);
        color: rgba(255,255,255,0.85);
        padding: 14px 32px;
        border-radius: 12px;
        font-size: 1rem;
        font-weight: 600;
        text-decoration: none;
        border: 1px solid rgba(255,255,255,0.15);
        transition: all 0.25s;
        backdrop-filter: blur(10px);
    }
    .btn-hero-secondary:hover {
        background: rgba(255,255,255,0.1);
        border-color: rgba(255,255,255,0.3);
        color: white;
        transform: translateY(-3px);
    }

    /* ── Stats ── */
    .hero-stats {
        display: flex;
        gap: 40px;
        justify-content: center;
        flex-wrap: wrap;
        animation: fadeInUp 0.6s ease 0.4s both;
    }
    .stat-item {
        text-align: center;
    }
    .stat-number {
        font-size: 2rem;
        font-weight: 800;
        background: var(--gradient-primary);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        line-height: 1;
        margin-bottom: 4px;
    }
    .stat-label {
        font-size: 0.8rem;
        color: rgba(255,255,255,0.45);
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .stat-divider {
        width: 1px;
        background: rgba(255,255,255,0.1);
        align-self: stretch;
    }

    /* ── Features ── */
    .features-section {
        padding: 80px 20px;
        max-width: 1100px;
        margin: 0 auto;
    }
    .section-label {
        display: inline-block;
        background: rgba(99,102,241,0.12);
        color: var(--primary-light);
        padding: 5px 14px;
        border-radius: 100px;
        font-size: 0.78rem;
        font-weight: 600;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 16px;
    }
    .section-title {
        font-size: clamp(1.75rem, 4vw, 2.5rem);
        font-weight: 800;
        letter-spacing: -1px;
        margin-bottom: 16px;
        color: white;
    }
    .section-desc {
        color: rgba(255,255,255,0.5);
        font-size: 1rem;
        max-width: 500px;
        margin: 0 auto 56px;
        line-height: 1.7;
    }
    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 24px;
    }
    .feature-card {
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 20px;
        padding: 32px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    .feature-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(99,102,241,0.5), transparent);
        opacity: 0;
        transition: opacity 0.3s;
    }
    .feature-card:hover {
        background: rgba(255,255,255,0.07);
        border-color: rgba(99,102,241,0.3);
        transform: translateY(-6px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.3);
    }
    .feature-card:hover::before { opacity: 1; }
    .feature-icon-wrap {
        width: 56px;
        height: 56px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 20px;
    }
    .feature-icon-wrap.purple { background: rgba(99,102,241,0.15); }
    .feature-icon-wrap.teal { background: rgba(6,182,212,0.15); }
    .feature-icon-wrap.green { background: rgba(16,185,129,0.15); }
    .feature-icon-wrap.orange { background: rgba(245,158,11,0.15); }
    .feature-card h3 {
        font-size: 1.15rem;
        font-weight: 700;
        color: white;
        margin-bottom: 10px;
        letter-spacing: -0.3px;
    }
    .feature-card p {
        font-size: 0.9rem;
        color: rgba(255,255,255,0.5);
        line-height: 1.7;
        margin: 0;
    }

    /* ── CTA ── */
    .cta-section {
        padding: 80px 20px;
        text-align: center;
    }
    .cta-card {
        max-width: 700px;
        margin: 0 auto;
        background: linear-gradient(135deg, rgba(99,102,241,0.15) 0%, rgba(139,92,246,0.1) 100%);
        border: 1px solid rgba(99,102,241,0.25);
        border-radius: 28px;
        padding: 60px 40px;
        position: relative;
        overflow: hidden;
    }
    .cta-card::before {
        content: '';
        position: absolute;
        top: -50%; left: -50%;
        width: 200%; height: 200%;
        background: radial-gradient(circle, rgba(99,102,241,0.08) 0%, transparent 60%);
        pointer-events: none;
    }
    .cta-card h2 {
        font-size: clamp(1.5rem, 4vw, 2.25rem);
        font-weight: 800;
        letter-spacing: -1px;
        margin-bottom: 16px;
        color: white;
    }
    .cta-card p {
        color: rgba(255,255,255,0.6);
        margin-bottom: 36px;
        font-size: 1rem;
        line-height: 1.7;
    }

    /* Footer override for dark bg */
    .app-footer {
        background: rgba(0,0,0,0.3) !important;
        border-top: 1px solid rgba(255,255,255,0.05) !important;
        margin-top: 0 !important;
    }

    @media (max-width: 768px) {
        .hero { padding: 60px 16px 40px; }
        .hero-title { letter-spacing: -1px; }
        .hero-actions { flex-direction: column; align-items: center; }
        .btn-hero-primary, .btn-hero-secondary { width: 100%; max-width: 320px; justify-content: center; }
        .hero-stats { gap: 24px; }
        .stat-divider { display: none; }
        .features-section { padding: 60px 16px; }
        .features-grid { grid-template-columns: 1fr; }
        .cta-card { padding: 40px 24px; }
        .site-navbar .inner { padding: 0 1rem; }
        .nav-links { gap: 4px; }
        .nav-link-item { padding: 6px 10px; font-size: 0.82rem; }
    }
</style>
@endsection

@section('navbar')
<nav class="site-navbar">
    <div class="inner">
        <a class="brand" href="/">
            <div class="brand-logo">
                <i class="fas fa-parking" style="color:white;"></i>
            </div>
            <div>
                <span class="brand-text">ParkSmart</span>
                <span class="brand-sub">Sistem Parkir Modern</span>
            </div>
        </a>
        @if (Route::has('login'))
        <div class="nav-links">
            @auth
                <a href="{{ url('/dashboard') }}" class="nav-link-item">
                    <i class="fas fa-chart-line" style="margin-right:6px;"></i>Dashboard
                </a>
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="nav-link-item" style="background:none;border:none;cursor:pointer;font-family:inherit;">
                        <i class="fas fa-sign-out-alt" style="margin-right:6px;"></i>Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="nav-link-item nav-btn nav-btn-ghost">Masuk</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="nav-link-item nav-btn">Daftar</a>
                @endif
            @endauth
        </div>
        @endif
    </div>
</nav>
@endsection

@section('content')
<!-- Hero -->
<section class="hero">
    <div class="hero-bg"></div>
    <div class="hero-orb hero-orb-1"></div>
    <div class="hero-orb hero-orb-2"></div>

    <div class="hero-badge">
        <span class="dot"></span>
        Sistem Parkir Generasi Baru
    </div>

    <h1 class="hero-title">
        Kelola Parkir<br>
        <span class="highlight">Lebih Cerdas</span>
    </h1>

    <p class="hero-desc">
        Platform manajemen parkir modern yang memudahkan pencatatan kendaraan masuk & keluar, perhitungan biaya otomatis, dan laporan real-time.
    </p>

    <div class="hero-actions">
        <a href="/Masuk" class="btn-hero-primary">
            <i class="fas fa-car"></i>
            Kendaraan Masuk
        </a>
        <a href="/Riwayat" class="btn-hero-secondary">
            <i class="fas fa-history"></i>
            Lihat Riwayat
        </a>
    </div>

    <div class="hero-stats">
        <div class="stat-item">
            <div class="stat-number">100%</div>
            <div class="stat-label">Otomatis</div>
        </div>
        <div class="stat-divider"></div>
        <div class="stat-item">
            <div class="stat-number">Real-time</div>
            <div class="stat-label">Monitoring</div>
        </div>
        <div class="stat-divider"></div>
        <div class="stat-item">
            <div class="stat-number">24/7</div>
            <div class="stat-label">Tersedia</div>
        </div>
    </div>
</section>

<!-- Features -->
<section class="features-section">
    <div style="text-align:center;">
        <span class="section-label">Fitur Unggulan</span>
        <h2 class="section-title">Semua yang Anda Butuhkan</h2>
        <p class="section-desc">Dirancang untuk kemudahan operator parkir dengan antarmuka yang intuitif dan modern.</p>
    </div>

    <div class="features-grid">
        <div class="feature-card animate-fadeInUp delay-1">
            <div class="feature-icon-wrap purple">
                <i class="fas fa-car-side" style="color:#818cf8;"></i>
            </div>
            <h3>Pencatatan Kendaraan</h3>
            <p>Catat kendaraan masuk dan keluar dengan cepat. Mendukung motor dan mobil dengan nomor plat yang terverifikasi.</p>
        </div>
        <div class="feature-card animate-fadeInUp delay-2">
            <div class="feature-icon-wrap teal">
                <i class="fas fa-calculator" style="color:#67e8f9;"></i>
            </div>
            <h3>Hitung Biaya Otomatis</h3>
            <p>Biaya parkir dihitung secara otomatis berdasarkan durasi dan jenis kendaraan. Tidak perlu hitung manual lagi.</p>
        </div>
        <div class="feature-card animate-fadeInUp delay-3">
            <div class="feature-icon-wrap green">
                <i class="fas fa-receipt" style="color:#6ee7b7;"></i>
            </div>
            <h3>Tiket & Nota Digital</h3>
            <p>Cetak tiket masuk dan nota pembayaran langsung dari sistem. Tersedia dalam format yang rapi dan profesional.</p>
        </div>
        <div class="feature-card animate-fadeInUp delay-4">
            <div class="feature-icon-wrap orange">
                <i class="fas fa-chart-bar" style="color:#fcd34d;"></i>
            </div>
            <h3>Dashboard Analitik</h3>
            <p>Pantau statistik parkir secara real-time. Lihat total kendaraan, pendapatan, dan riwayat lengkap dalam satu tampilan.</p>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta-section">
    <div class="cta-card animate-fadeInUp">
        <h2>Siap Mulai Sekarang?</h2>
        <p>Mulai kelola parkir Anda dengan lebih efisien dan modern. Gratis, cepat, dan mudah digunakan.</p>
        <div style="display:flex; gap:14px; justify-content:center; flex-wrap:wrap;">
            <a href="/Masuk" class="btn-hero-primary">
                <i class="fas fa-plus-circle"></i>
                Mulai Sekarang
            </a>
            <a href="/Riwayat" class="btn-hero-secondary">
                <i class="fas fa-table"></i>
                Lihat Dashboard
            </a>
        </div>
    </div>
</section>
@endsection
