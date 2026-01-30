@extends('layouts.adminapp')

@section('content')
<div style="margin-bottom: 32px;">
    <h2 style="font-size: 32px; font-weight: 700; color: white; margin: 0 0 8px 0;">📊 Dashboard Parkir</h2>
    <p style="color: rgba(255, 255, 255, 0.9); margin: 0; font-size: 14px;">Kelola dan pantau semua kendaraan yang parkir</p>
</div>

<!-- Stats Cards -->
<div class="row mb-5">
    <div class="col-md-3 mb-3">
        <div style="background: rgba(255, 255, 255, 0.1); border-radius: 16px; padding: 24px; backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2);">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <p style="margin: 0 0 8px 0; color: rgba(255, 255, 255, 0.9); font-size: 12px; text-transform: uppercase; letter-spacing: 1px; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);">Total Kendaraan</p>
                    <h3 style="margin: 0; font-size: 32px; font-weight: 700; color: #ffffff; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);">{{ $totalKendaraan }}</h3>
                </div>
                <div style="font-size: 40px;">🚗</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div style="background: rgba(255, 255, 255, 0.1); border-radius: 16px; padding: 24px; backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2);">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <p style="margin: 0 0 8px 0; color: rgba(255, 255, 255, 0.9); font-size: 12px; text-transform: uppercase; letter-spacing: 1px; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);">Sedang Parkir</p>
                    <h3 style="margin: 0; font-size: 32px; font-weight: 700; color: #ffffff; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);">{{ $sedangParkir }}</h3>
                </div>
                <div style="font-size: 40px;">✓</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div style="background: rgba(255, 255, 255, 0.1); border-radius: 16px; padding: 24px; backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2);">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <p style="margin: 0 0 8px 0; color: rgba(255, 255, 255, 0.9); font-size: 12px; text-transform: uppercase; letter-spacing: 1px; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);">Sudah Keluar</p>
                    <h3 style="margin: 0; font-size: 32px; font-weight: 700; color: #ffffff; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);">{{ $sudahKeluar }}</h3>
                </div>
                <div style="font-size: 40px;">🔒</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div style="background: rgba(255, 255, 255, 0.1); border-radius: 16px; padding: 24px; backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2);">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <p style="margin: 0 0 8px 0; color: rgba(255, 255, 255, 0.9); font-size: 12px; text-transform: uppercase; letter-spacing: 1px; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);">Pendapatan</p>
                    <h3 style="margin: 0; font-size: 28px; font-weight: 700; color: #11998e; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
                </div>
                <div style="font-size: 40px;">💰</div>
            </div>
        </div>
    </div>
</div>
            </div>
        </div>
    </div>
</div>

<!-- Table Card -->
<div class="card card-modern" style="background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2);">
    <div class="card-header-modern" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px; padding: 24px; border-bottom: 1px solid rgba(255, 255, 255, 0.2);">
        <h4 style="margin: 0; font-size: 24px; font-weight: 700; color: white; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);">📋 Daftar Kendaraan</h4>
        <div style="display: flex; gap: 8px; flex-wrap: wrap; align-items: center;">
            <!-- Form Pencarian -->
            <form method="GET" action="{{ route('admin.dashboard') }}" style="display: flex; gap: 8px; align-items: center; flex-wrap: wrap;" id="searchForm">
                <div style="display: flex; gap: 8px;">
                    <input type="text" name="search" id="searchInput" placeholder="Cari plat kendaraan..." value="{{ $search ?? '' }}" style="padding: 8px 16px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px; width: 220px;">
                </div>
            </form>
            <a href="/" style="background: rgba(255, 255, 255, 0.2); color: white; padding: 8px 16px; border-radius: 8px; text-decoration: none; font-size: 14px; font-weight: 600; transition: all 0.3s ease;" onmouseover="this.style.background='rgba(255, 255, 255, 0.3)'" onmouseout="this.style.background='rgba(255, 255, 255, 0.2)'">
                + Masukan Baru
            </a>
        </div>
    </div>
    <div class="card-body" style="padding: 0; overflow-x: auto; max-height: 600px; overflow-y: auto;">
        <table class="table-modern" style="width: 100%;" id="tableResults">
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 15%;">🔢 Nomor Kendaraan</th>
                    <th style="width: 12%;">🚙 Jenis</th>
                    <th style="width: 18%;">🕐 Masuk</th>
                    <th style="width: 18%;">🕑 Keluar</th>
                    <th style="width: 15%;">💰 Biaya</th>
                    <th style="width: 8%;">Status</th>
                    <th style="width: 20%;">⚙️ Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($parkirs as $index => $parkir)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        <strong style="font-size: 16px;">{{ $parkir->nomor_kendaraan }}</strong>
                    </td>
                    <td>
                        @if($parkir->jenis_kendaraan == 'Motor')
                            <span style="display: inline-block; background: #e3f2fd; color: #1976d2; padding: 4px 8px; border-radius: 6px; font-size: 12px; font-weight: 600;">🏍️ Motor</span>
                        @else
                            <span style="display: inline-block; background: #f3e5f5; color: #7b1fa2; padding: 4px 8px; border-radius: 6px; font-size: 12px; font-weight: 600;">🚗 Mobil</span>
                        @endif
                    </td>
                    <td>
                        <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 12px 14px; border-radius: 12px; color: white; box-shadow: 0 4px 12px rgba(102, 126, 234, 0.2);">
                            <div style="font-weight: 700; font-size: 12px; opacity: 0.9; letter-spacing: 0.5px;">📥 MASUK</div>
                            <div style="font-size: 13px; font-weight: 600; margin-top: 6px;">{{ \Carbon\Carbon::parse($parkir->waktu_masuk)->format('d M Y') }}</div>
                            <div style="font-size: 15px; font-weight: 700; margin-top: 4px;">🕐 {{ \Carbon\Carbon::parse($parkir->waktu_masuk)->format('H:i:s') }}</div>
                            <div style="font-size: 11px; margin-top: 6px; opacity: 0.85;">{{ \Carbon\Carbon::parse($parkir->waktu_masuk)->diffForHumans() }}</div>
                        </div>
                    </td>
                    <td>
                        @if($parkir->waktu_keluar)
                            <div style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); padding: 12px 14px; border-radius: 12px; color: white; box-shadow: 0 4px 12px rgba(17, 153, 142, 0.2);">
                                <div style="font-weight: 700; font-size: 12px; opacity: 0.9; letter-spacing: 0.5px;">📤 KELUAR</div>
                                <div style="font-size: 13px; font-weight: 600; margin-top: 6px;">{{ \Carbon\Carbon::parse($parkir->waktu_keluar)->format('d M Y') }}</div>
                                <div style="font-size: 15px; font-weight: 700; margin-top: 4px;">🕑 {{ \Carbon\Carbon::parse($parkir->waktu_keluar)->format('H:i:s') }}</div>
                                <div style="font-size: 11px; margin-top: 6px; opacity: 0.85;">{{ \Carbon\Carbon::parse($parkir->waktu_keluar)->diffForHumans() }}</div>
                                <div style="font-size: 10px; margin-top: 8px; padding-top: 8px; border-top: 1px solid rgba(255, 255, 255, 0.3); font-weight: 600;">⏱️ {{ \Carbon\Carbon::parse($parkir->waktu_masuk)->diff(\Carbon\Carbon::parse($parkir->waktu_keluar))->format('%H jam %I menit') }}</div>
                            </div>
                        @else
                            <div style="background: linear-gradient(135deg, #f5a033 0%, #f12711 100%); padding: 12px 14px; border-radius: 12px; color: white; box-shadow: 0 4px 12px rgba(245, 160, 51, 0.2);">
                                <div style="font-weight: 700; font-size: 12px; letter-spacing: 0.5px;">⏳ AKTIF PARKIR</div>
                                <div style="font-size: 11px; margin-top: 8px; opacity: 0.9;">Durasi: <strong>{{ \Carbon\Carbon::parse($parkir->waktu_masuk)->diff(\Carbon\Carbon::now())->format('%H jam %I menit') }}</strong></div>
                                <div style="font-size: 10px; margin-top: 6px; opacity: 0.85;">Masih parkir di sistem</div>
                            </div>
                        @endif
                    </td>
                    <td>
                        @if($parkir->biaya)
                            <div style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); padding: 12px 16px; border-radius: 12px; box-shadow: 0 8px 16px rgba(17, 153, 142, 0.3);">
                                <strong style="color: white; font-size: 18px; font-weight: 700; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);">Rp {{ number_format($parkir->biaya,0,',','.') }}</strong>
                            </div>
                        @else
                            <span style="color: #999; font-style: italic;">-</span>
                        @endif
                    </td>
                    <td>
                        @if(!$parkir->waktu_keluar)
                            <span class="status-badge status-active" style="padding: 10px 16px; font-size: 14px; font-weight: 700; background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); color: white; border-radius: 12px; box-shadow: 0 8px 16px rgba(17, 153, 142, 0.3); display: inline-block; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);">🟢 Aktif</span>
                        @else
                            <span class="status-badge status-completed" style="padding: 10px 16px; font-size: 14px; font-weight: 700; background: linear-gradient(135deg, #2196f3 0%, #00bcd4 100%); color: white; border-radius: 12px; box-shadow: 0 8px 16px rgba(33, 150, 243, 0.3); display: inline-block; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);">🔵 Selesai</span>
                        @endif
                    </td>
                    <td>
                        <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                            @if(!$parkir->waktu_keluar)
                                <a class="btn btn-sm-modern btn-info-modern" href="{{ route('parkir.tiket', $parkir->id) }}" target="_blank" style="text-decoration: none;">🎫 Tiket</a>
                                <a class="btn btn-sm-modern btn-warning-modern" href="{{ route('parkir.keluar', $parkir->id) }}" target="_blank" style="text-decoration: none;">🚪 Keluar</a>
                            @else
                                <a class="btn btn-sm-modern btn-secondary-modern" href="{{ route('parkir.nota', $parkir->id) }}" target="_blank" style="text-decoration: none;">📄 Nota</a>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" style="text-align: center; padding: 40px 20px; color: #999;">
                        <p style="font-size: 18px; margin-bottom: 10px;">📭 Tidak ada data kendaraan</p>
                        <p style="font-size: 13px;">Mulai dengan menginputkan kendaraan baru</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<style>
    @media (max-width: 768px) {
        table {
            font-size: 12px;
        }
        
        .btn-sm-modern {
            padding: 4px 8px !important;
            font-size: 11px !important;
        }
    }

    .table-modern tbody {
        animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<script>
document.getElementById('searchInput').addEventListener('keyup', function() {
    // Tambahkan delay untuk debounce agar tidak search terlalu cepat
    clearTimeout(window.searchTimeout);
    window.searchTimeout = setTimeout(function() {
        document.getElementById('searchForm').submit();
    }, 500);
});
</script>
@endsection