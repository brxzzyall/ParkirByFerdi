@extends('layouts.master')

@section('title', 'ParkSmart — Input Kendaraan')

@section('styles')
<style>
    body {
        background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #0f172a 100%);
        min-height: 100vh;
    }

    /* ── Background Orbs for Entry Pages ── */
    body.masuk-page::before {
        content: '';
        position: fixed;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(17, 153, 142, 0.15) 0%, transparent 70%);
        border-radius: 50%;
        top: -150px;
        left: -150px;
        animation: float 10s ease-in-out infinite;
        pointer-events: none;
    }
    body.masuk-page::after {
        content: '';
        position: fixed;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(56, 239, 125, 0.1) 0%, transparent 70%);
        border-radius: 50%;
        bottom: -150px;
        right: -150px;
        animation: float 12s ease-in-out infinite reverse;
        pointer-events: none;
    }

    /* ── Navbar ── */
    .app-navbar {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000;
        background: rgba(15, 23, 42, 0.95);
        backdrop-filter: blur(24px);
        -webkit-backdrop-filter: blur(24px);
        border-bottom: 1px solid rgba(255,255,255,0.07);
    }
    .app-navbar .inner {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 2rem;
        height: 68px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .nav-brand {
        display: flex;
        align-items: center;
        gap: 12px;
        text-decoration: none;
        color: white;
    }
    .nav-brand-icon {
        width: 38px;
        height: 38px;
        background: var(--gradient-primary);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        box-shadow: 0 4px 12px rgba(99,102,241,0.35);
        flex-shrink: 0;
    }
    .nav-brand-name {
        font-size: 1.1rem;
        font-weight: 700;
        letter-spacing: -0.3px;
        color: white;
    }
    .nav-brand-sub {
        font-size: 0.68rem;
        color: rgba(255,255,255,0.45);
        display: block;
        margin-top: -2px;
    }
    .nav-actions {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .nav-pill {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        color: rgba(255,255,255,0.75);
        text-decoration: none;
        font-size: 0.875rem;
        font-weight: 500;
        padding: 8px 16px;
        border-radius: 8px;
        border: 1px solid rgba(255,255,255,0.12);
        background: rgba(255,255,255,0.05);
        transition: all 0.2s;
    }
    .nav-pill:hover {
        color: white;
        background: rgba(255,255,255,0.1);
        border-color: rgba(255,255,255,0.2);
    }
    .nav-pill.active {
        background: var(--gradient-primary);
        border-color: transparent;
        color: white;
        box-shadow: 0 4px 12px rgba(99,102,241,0.3);
    }

    /* ── Card Modern ── */
    .card-modern {
        background: rgba(255,255,255,0.03);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: var(--radius-xl);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card-modern:hover {
        transform: translateY(-4px);
        box-shadow: 0 24px 48px rgba(0,0,0,0.3);
    }
    .card-header-modern {
        background: var(--gradient-primary);
        padding: 24px 28px;
        color: white;
        border: none;
    }
    .card-header-modern h4 {
        margin: 0;
        font-size: 1.25rem;
        font-weight: 700;
        letter-spacing: -0.3px;
    }

    /* ── Table ── */
    .table-modern {
        width: 100%;
        border-collapse: collapse;
        margin: 0;
    }
    .table-modern thead th {
        background: rgba(99,102,241,0.08);
        color: rgba(255,255,255,0.6);
        font-size: 0.72rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        padding: 14px 16px;
        border-bottom: 1px solid rgba(255,255,255,0.07);
        white-space: nowrap;
    }
    .table-modern tbody tr {
        border-bottom: 1px solid rgba(255,255,255,0.05);
        transition: background 0.15s;
    }
    .table-modern tbody tr:hover {
        background: rgba(255,255,255,0.03);
    }
    .table-modern tbody td {
        padding: 16px;
        color: rgba(255,255,255,0.85);
        font-size: 0.9rem;
        vertical-align: middle;
    }

    /* ── Buttons ── */
    .btn-sm-modern {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 7px 14px;
        border-radius: 8px;
        font-size: 0.8rem;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        white-space: nowrap;
    }
    .btn-info-modern {
        background: rgba(99,102,241,0.15);
        color: #818cf8;
        border: 1px solid rgba(99,102,241,0.25);
    }
    .btn-info-modern:hover {
        background: rgba(99,102,241,0.25);
        color: #a5b4fc;
        transform: translateY(-1px);
    }
    .btn-warning-modern {
        background: rgba(245,158,11,0.15);
        color: #fcd34d;
        border: 1px solid rgba(245,158,11,0.25);
    }
    .btn-warning-modern:hover {
        background: rgba(245,158,11,0.25);
        color: #fde68a;
        transform: translateY(-1px);
    }
    .btn-secondary-modern {
        background: rgba(16,185,129,0.15);
        color: #6ee7b7;
        border: 1px solid rgba(16,185,129,0.25);
    }
    .btn-secondary-modern:hover {
        background: rgba(16,185,129,0.25);
        color: #a7f3d0;
        transform: translateY(-1px);
    }

    /* ── Status Badges ── */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 12px;
        border-radius: 100px;
        font-size: 0.75rem;
        font-weight: 600;
        white-space: nowrap;
    }
    .status-active {
        background: rgba(16,185,129,0.15);
        color: #6ee7b7;
        border: 1px solid rgba(16,185,129,0.25);
    }
    .status-completed {
        background: rgba(99,102,241,0.15);
        color: #a5b4fc;
        border: 1px solid rgba(99,102,241,0.25);
    }

    /* ── Pagination ── */
    .pagination-modern .page-link {
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.1);
        color: rgba(255,255,255,0.6);
        border-radius: 8px;
        margin: 0 3px;
        padding: 7px 13px;
        font-size: 0.85rem;
        transition: all 0.2s;
    }
    .pagination-modern .page-link:hover {
        background: rgba(99,102,241,0.2);
        border-color: rgba(99,102,241,0.3);
        color: white;
    }
    .pagination-modern .page-item.active .page-link {
        background: var(--gradient-primary);
        border-color: transparent;
        color: white;
        box-shadow: 0 4px 12px rgba(99,102,241,0.3);
    }

    @media (max-width: 768px) {
        .app-navbar .inner { padding: 0 1rem; }
        .nav-brand-name { font-size: 1rem; }
        .table-modern thead th { padding: 10px 12px; font-size: 0.65rem; }
        .table-modern tbody td { padding: 12px; font-size: 0.82rem; }
        .btn-sm-modern { padding: 5px 10px; font-size: 0.75rem; }
    }
</style>
@endsection

@section('navbar')
<nav class="app-navbar">
    <div class="inner">
        <a href="/" class="nav-brand">
            <div class="nav-brand-icon">
                <i class="fas fa-parking" style="color:white;"></i>
            </div>
            <div>
                <span class="nav-brand-name">ParkSmart</span>
                <span class="nav-brand-sub">Sistem Parkir</span>
            </div>
        </a>
        <div class="nav-actions">
            <a href="/Riwayat" class="nav-pill">
                <i class="fas fa-history"></i>
                Riwayat
            </a>
        </div>
    </div>
</nav>
@endsection
