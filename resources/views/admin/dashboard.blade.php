@extends('layouts.adminapp')

@section('content')

{{-- Page Header --}}
<div class="animate-fadeInUp" style="margin-bottom: 32px;">
    <div style="display:flex; align-items:center; gap:12px; margin-bottom:8px;">
        <div style="width:4px; height:28px; background:var(--gradient-primary); border-radius:4px;"></div>
        <h1 style="font-size:1.75rem; font-weight:800; color:white; margin:0; letter-spacing:-0.5px;">Dashboard Parkir</h1>
    </div>
    <p style="color:rgba(255,255,255,0.45); margin:0 0 0 16px; font-size:0.875rem;">
        Pantau dan kelola semua kendaraan yang parkir secara real-time
    </p>
</div>

{{-- Stats Cards --}}
<div class="row g-3 mb-4">
    <div class="col-6 col-lg-3">
        <div class="stat-card animate-fadeInUp delay-1">
            <div class="stat-card-icon" style="background:rgba(99,102,241,0.15);">
                <i class="fas fa-car" style="color:#818cf8;"></i>
            </div>
            <div class="stat-card-body">
                <div class="stat-card-value">{{ $totalKendaraan }}</div>
                <div class="stat-card-label">Total Kendaraan</div>
            </div>
            <div class="stat-card-trend up">
                <i class="fas fa-arrow-trend-up"></i>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="stat-card animate-fadeInUp delay-2">
            <div class="stat-card-icon" style="background:rgba(16,185,129,0.15);">
                <i class="fas fa-circle-check" style="color:#6ee7b7;"></i>
            </div>
            <div class="stat-card-body">
                <div class="stat-card-value" style="color:#6ee7b7;">{{ $sedangParkir }}</div>
                <div class="stat-card-label">Sedang Parkir</div>
            </div>
            <div class="stat-card-trend" style="color:rgba(110,231,183,0.6);">
                <i class="fas fa-circle" style="font-size:8px; animation:pulse-ring 2s infinite;"></i>
                Live
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="stat-card animate-fadeInUp delay-3">
            <div class="stat-card-icon" style="background:rgba(6,182,212,0.15);">
                <i class="fas fa-flag-checkered" style="color:#67e8f9;"></i>
            </div>
            <div class="stat-card-body">
                <div class="stat-card-value" style="color:#67e8f9;">{{ $sudahKeluar }}</div>
                <div class="stat-card-label">Sudah Keluar</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="stat-card animate-fadeInUp delay-4">
            <div class="stat-card-icon" style="background:rgba(245,158,11,0.15);">
                <i class="fas fa-coins" style="color:#fcd34d;"></i>
            </div>
            <div class="stat-card-body">
                <div class="stat-card-value" style="color:#fcd34d; font-size:1.1rem;">Rp {{ number_format(abs($totalPendapatan), 0, ',', '.') }}</div>
                <div class="stat-card-label">Total Pendapatan</div>
            </div>
        </div>
    </div>
</div>

{{-- Table Card --}}
<div class="card-modern animate-fadeInUp delay-2">
    {{-- Card Header --}}
    <div class="card-header-modern" style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px;">
        <div style="display:flex; align-items:center; gap:10px;">
            <div style="width:36px; height:36px; background:rgba(99,102,241,0.2); border-radius:10px; display:flex; align-items:center; justify-content:center;">
                <i class="fas fa-table-list" style="color:#818cf8; font-size:14px;"></i>
            </div>
            <div>
                <h4 style="margin:0; font-size:1rem; font-weight:700; color:white;">Daftar Kendaraan</h4>
                <span style="font-size:0.72rem; color:rgba(255,255,255,0.4);">{{ $parkirs->count() }} data ditampilkan</span>
            </div>
        </div>
        <div style="display:flex; gap:8px; align-items:center; flex-wrap:wrap;">
            {{-- Search --}}
            <form method="GET" action="{{ route('admin.dashboard') }}" id="searchForm" style="display:flex; align-items:center;">
                <div style="position:relative;">
                    <i class="fas fa-search" style="position:absolute; left:12px; top:50%; transform:translateY(-50%); color:rgba(255,255,255,0.3); font-size:13px; pointer-events:none;"></i>
                    <input
                        type="text"
                        name="search"
                        id="searchInput"
                        placeholder="Cari plat kendaraan..."
                        value="{{ $search ?? '' }}"
                        style="background:rgba(255,255,255,0.07); border:1px solid rgba(255,255,255,0.1); color:white; padding:8px 14px 8px 36px; border-radius:8px; font-size:0.85rem; width:220px; font-family:inherit; outline:none; transition:all 0.2s;"
                        onfocus="this.style.borderColor='rgba(99,102,241,0.5)'; this.style.background='rgba(99,102,241,0.1)';"
                        onblur="this.style.borderColor='rgba(255,255,255,0.1)'; this.style.background='rgba(255,255,255,0.07)';"
                    >
                </div>
            </form>
        </div>
    </div>

    {{-- Table --}}
    <div style="overflow-x:auto; max-height:620px; overflow-y:auto;">
        <table class="table-modern" id="tableResults">
            <thead>
                <tr>
                    <th style="width:4%;">#</th>
                    <th style="width:14%;">Nomor Plat</th>
                    <th style="width:10%;">Jenis</th>
                    <th style="width:18%;">Waktu Masuk</th>
                    <th style="width:18%;">Waktu Keluar</th>
                    <th style="width:12%;">Biaya</th>
                    <th style="width:8%;">Status</th>
                    <th style="width:16%;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($parkirs as $index => $parkir)
                <tr>
                    <td style="color:rgba(255,255,255,0.35); font-size:0.8rem;">{{ $index + 1 }}</td>
                    <td>
                        <div style="display:flex; align-items:center; gap:8px;">
                            <div style="width:32px; height:32px; background:rgba(99,102,241,0.15); border-radius:8px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                                @if($parkir->jenis_kendaraan == 'Motor')
                                    <i class="fas fa-motorcycle" style="color:#818cf8; font-size:13px;"></i>
                                @else
                                    <i class="fas fa-car" style="color:#818cf8; font-size:13px;"></i>
                                @endif
                            </div>
                            <span style="font-weight:700; color:white; font-size:0.9rem; letter-spacing:0.5px;">{{ $parkir->nomor_kendaraan }}</span>
                        </div>
                    </td>
                    <td>
                        @if($parkir->jenis_kendaraan == 'Motor')
                            <span style="display:inline-flex; align-items:center; gap:5px; background:rgba(99,102,241,0.12); color:#a5b4fc; padding:4px 10px; border-radius:6px; font-size:0.75rem; font-weight:600; border:1px solid rgba(99,102,241,0.2);">
                                <i class="fas fa-motorcycle" style="font-size:11px;"></i> Motor
                            </span>
                        @else
                            <span style="display:inline-flex; align-items:center; gap:5px; background:rgba(139,92,246,0.12); color:#c4b5fd; padding:4px 10px; border-radius:6px; font-size:0.75rem; font-weight:600; border:1px solid rgba(139,92,246,0.2);">
                                <i class="fas fa-car" style="font-size:11px;"></i> Mobil
                            </span>
                        @endif
                    </td>
                    <td>
                        <div style="line-height:1.4;">
                            <div style="font-size:0.82rem; font-weight:600; color:rgba(255,255,255,0.85);">
                                {{ \Carbon\Carbon::parse($parkir->waktu_masuk)->format('d M Y') }}
                            </div>
                            <div style="font-size:0.95rem; font-weight:700; color:#818cf8;">
                                {{ \Carbon\Carbon::parse($parkir->waktu_masuk)->format('H:i') }}
                                <span style="font-size:0.75rem; font-weight:400; color:rgba(255,255,255,0.3);">{{ \Carbon\Carbon::parse($parkir->waktu_masuk)->format(':s') }}</span>
                            </div>
                            <div style="font-size:0.7rem; color:rgba(255,255,255,0.3); margin-top:2px;">
                                {{ \Carbon\Carbon::parse($parkir->waktu_masuk)->diffForHumans() }}
                            </div>
                        </div>
                    </td>
                    <td>
                        @if($parkir->waktu_keluar)
                            <div style="line-height:1.4;">
                                <div style="font-size:0.82rem; font-weight:600; color:rgba(255,255,255,0.85);">
                                    {{ \Carbon\Carbon::parse($parkir->waktu_keluar)->format('d M Y') }}
                                </div>
                                <div style="font-size:0.95rem; font-weight:700; color:#6ee7b7;">
                                    {{ \Carbon\Carbon::parse($parkir->waktu_keluar)->format('H:i') }}
                                    <span style="font-size:0.75rem; font-weight:400; color:rgba(255,255,255,0.3);">{{ \Carbon\Carbon::parse($parkir->waktu_keluar)->format(':s') }}</span>
                                </div>
                                <div style="font-size:0.7rem; color:rgba(255,255,255,0.3); margin-top:2px;">
                                    <i class="fas fa-clock" style="font-size:9px;"></i>
                                    {{ \Carbon\Carbon::parse($parkir->waktu_masuk)->diff(\Carbon\Carbon::parse($parkir->waktu_keluar))->format('%H j %I m') }}
                                </div>
                            </div>
                        @else
                            <div style="display:inline-flex; align-items:center; gap:6px; background:rgba(245,158,11,0.1); border:1px solid rgba(245,158,11,0.2); padding:6px 12px; border-radius:8px;">
                                <span style="width:6px; height:6px; background:#fcd34d; border-radius:50%; animation:pulse-ring 2s infinite; flex-shrink:0;"></span>
                                <div>
                                    <div style="font-size:0.72rem; font-weight:700; color:#fcd34d;">AKTIF</div>
                                    <div style="font-size:0.68rem; color:rgba(255,255,255,0.4);">
                                        {{ \Carbon\Carbon::parse($parkir->waktu_masuk)->diff(\Carbon\Carbon::now())->format('%H j %I m') }}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </td>
                    <td>
                        @if($parkir->biaya)
                            <div style="font-weight:700; color:#fcd34d; font-size:0.9rem;">
                                Rp {{ number_format($parkir->biaya, 0, ',', '.') }}
                            </div>
                        @else
                            <span style="color:rgba(255,255,255,0.2); font-size:0.85rem;">—</span>
                        @endif
                    </td>
                    <td>
                        @if(!$parkir->waktu_keluar)
                            <span class="status-badge status-active">
                                <i class="fas fa-circle" style="font-size:6px;"></i>
                                Aktif
                            </span>
                        @else
                            <span class="status-badge status-completed">
                                <i class="fas fa-check" style="font-size:9px;"></i>
                                Selesai
                            </span>
                        @endif
                    </td>
                    <td>
                        <div style="display:flex; gap:6px; flex-wrap:wrap;">
                            @if(!$parkir->waktu_keluar)
                                <a class="btn-sm-modern btn-info-modern" href="{{ route('parkir.tiket', $parkir->id) }}" target="_blank">
                                    <i class="fas fa-ticket"></i> Tiket
                                </a>
                                <a class="btn-sm-modern btn-warning-modern" href="{{ route('parkir.keluar', $parkir->id) }}" target="_blank">
                                    <i class="fas fa-door-open"></i> Keluar
                                </a>
                            @else
                                <a class="btn-sm-modern btn-secondary-modern" href="{{ route('parkir.nota', $parkir->id) }}" target="_blank">
                                    <i class="fas fa-receipt"></i> Nota
                                </a>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" style="text-align:center; padding:60px 20px;">
                        <div style="color:rgba(255,255,255,0.2);">
                            <i class="fas fa-car-burst" style="font-size:3rem; margin-bottom:16px; display:block;"></i>
                            <p style="font-size:1rem; font-weight:600; margin-bottom:6px; color:rgba(255,255,255,0.4);">Tidak ada data kendaraan</p>
                            <p style="font-size:0.82rem; margin:0;">Mulai dengan menginputkan kendaraan baru</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<style>
    /* Enhanced Stat Cards with Glassmorphism */
    .stat-card {
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 16px;
        padding: 20px;
        display: flex;
        align-items: center;
        gap: 14px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
    }
    .stat-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(99,102,241,0.4), transparent);
        opacity: 0;
        transition: opacity 0.3s;
    }
    .stat-card:hover {
        background: rgba(255,255,255,0.08);
        border-color: rgba(99,102,241,0.3);
        transform: translateY(-4px);
        box-shadow: 0 16px 40px rgba(0,0,0,0.35);
    }
    .stat-card:hover::before {
        opacity: 1;
    }
    .stat-card-icon {
        width: 52px; height: 52px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        flex-shrink: 0;
        transition: transform 0.3s ease;
    }
    .stat-card:hover .stat-card-icon {
        transform: scale(1.1) rotate(5deg);
    }
    .stat-card-body {
        flex: 1;
        min-width: 0;
    }
    .stat-card-value {
        font-size: 1.6rem;
        font-weight: 800;
        color: white;
        line-height: 1.2;
        letter-spacing: -0.5px;
    }
    .stat-card-label {
        font-size: 0.75rem;
        color: rgba(255,255,255,0.45);
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-top: 4px;
    }
    .stat-card-trend {
        font-size: 0.7rem;
        font-weight: 600;
        color: rgba(110,231,183,0.6);
        display: flex;
        align-items: center;
        gap: 4px;
    }
    
    /* Enhanced Table Row Hover */
    .table-modern tbody tr {
        position: relative;
    }
    .table-modern tbody tr::after {
        content: '';
        position: absolute;
        left: 0; top: 0; bottom: 0;
        width: 3px;
        background: var(--gradient-primary);
        opacity: 0;
        transition: opacity 0.2s;
        border-radius: 0 4px 4px 0;
    }
    .table-modern tbody tr:hover::after {
        opacity: 1;
    }
    
    /* Enhanced Button Hover */
    .btn-sm-modern {
        position: relative;
        overflow: hidden;
    }
    .btn-sm-modern::before {
        content: '';
        position: absolute;
        top: 0; left: -100%;
        width: 100%; height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.4s ease;
    }
    .btn-sm-modern:hover::before {
        left: 100%;
    }
    
    /* Pulse Animation for Live Status */
    @keyframes live-pulse {
        0%, 100% { box-shadow: 0 0 0 0 rgba(110, 231, 183, 0.4); }
        50% { box-shadow: 0 0 0 8px rgba(110, 231, 183, 0); }
    }
    
    /* Number Counter Animation */
    .count-up {
        animation: fadeInUp 0.5s ease both;
    }
    
    /* Glass Card Effect */
    .card-modern {
        position: relative;
    }
    .card-modern::before {
        content: '';
        position: absolute;
        inset: 0;
        border-radius: inherit;
        padding: 1px;
        background: linear-gradient(135deg, rgba(255,255,255,0.1), rgba(255,255,255,0.02));
        -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
        -webkit-mask-composite: xor;
        mask-composite: exclude;
        pointer-events: none;
    }
    
    /* Search Input Enhancement */
    #searchInput {
        background: rgba(255,255,255,0.05) !important;
        border: 1px solid rgba(255,255,255,0.1) !important;
    }
    #searchInput:focus {
        background: rgba(99,102,241,0.1) !important;
        border-color: rgba(99,102,241,0.5) !important;
        box-shadow: 0 0 0 3px rgba(99,102,241,0.1) !important;
    }
</style>