@extends('layouts.tiketapp')

@section('content')
<div style="max-width: 420px; margin: 40px auto; font-family: 'Inter', 'Segoe UI', sans-serif;">
    {{-- Ticket Container with 3D effect --}}
    <div style="background: linear-gradient(145deg, #1a1a2e 0%, #16213e 100%); border-radius: 20px; overflow: hidden; box-shadow: 0 25px 50px rgba(0, 0, 0, 0.4), 0 0 0 1px rgba(255,255,255,0.05); position: relative;">
        {{-- Decorative top --}}
        <div style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); padding: 28px; text-align: center; position: relative; overflow: hidden;">
            <div style="position: absolute; top: -30px; right: -30px; width: 100px; height: 100px; background: rgba(255,255,255,0.15); border-radius: 50%;"></div>
            <div style="position: absolute; bottom: -20px; left: -20px; width: 60px; height: 60px; background: rgba(255,255,255,0.1); border-radius: 50%;"></div>
            
            <div style="font-size: 48px; margin-bottom: 8px; animation: bounce 2s ease-in-out infinite;">🎫</div>
            <h3 style="margin: 0; font-size: 24px; font-weight: 800; letter-spacing: 1px;">TIKET PARKIR</h3>
            <p style="margin: 8px 0 0 0; opacity: 0.9; font-size: 13px; font-weight: 500;">Simpan tiket ini hingga keluar</p>
        </div>

        {{-- Perforation line --}}
        <div style="height: 8px; background: linear-gradient(90deg, transparent 0%, rgba(255,255,255,0.1) 50%, transparent 100%); position: relative;">
            <div style="position: absolute; left: -10px; top: -6px; width: 20px; height: 20px; background: #0f172a; border-radius: 50%;"></div>
            <div style="position: absolute; right: -10px; top: -6px; width: 20px; height: 20px; background: #0f172a; border-radius: 50%;"></div>
        </div>

        {{-- Content --}}
        <div style="padding: 28px;">
            <!-- Vehicle Info -->
            <div style="margin-bottom: 24px; padding-bottom: 24px; border-bottom: 1px solid rgba(255,255,255,0.1);">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                    <div>
                        <p style="margin: 0 0 6px 0; color: rgba(255,255,255,0.5); font-size: 11px; text-transform: uppercase; letter-spacing: 1.5px;">Nomor Kendaraan</p>
                        <p style="margin: 0; font-size: 20px; font-weight: 700; color: white; letter-spacing: 0.5px;">{{ $parkir->nomor_kendaraan }}</p>
                    </div>
                    <div>
                        <p style="margin: 0 0 6px 0; color: rgba(255,255,255,0.5); font-size: 11px; text-transform: uppercase; letter-spacing: 1.5px;">Jenis</p>
                        <p style="margin: 0; font-size: 20px; font-weight: 700; color: white;">
                            @if($parkir->jenis_kendaraan == 'Motor') 🏍️ Motor @else 🚗 Mobil @endif
                        </p>
                    </div>
                </div>
            </div>

            <!-- Check In Time -->
            <div style="margin-bottom: 24px; padding: 20px; background: rgba(99,102,241,0.1); border-radius: 14px; border-left: 4px solid #818cf8; position: relative; overflow: hidden;">
                <div style="position: absolute; top: 0; right: 0; width: 80px; height: 80px; background: radial-gradient(circle, rgba(99,102,241,0.2) 0%, transparent 70%); pointer-events: none;"></div>
                <p style="margin: 0 0 8px 0; color: rgba(255,255,255,0.5); font-size: 11px; text-transform: uppercase; letter-spacing: 1.5px;">Waktu Masuk</p>
                <p style="margin: 0; font-size: 15px; font-weight: 600; color: rgba(255,255,255,0.8);">{{ \Carbon\Carbon::parse($parkir->waktu_masuk)->format('d M Y') }}</p>
                <p style="margin: 6px 0 0 0; font-size: 26px; font-weight: 700; color: #818cf8;">{{ \Carbon\Carbon::parse($parkir->waktu_masuk)->format('H:i:s') }}</p>
            </div>

            <!-- Barcode Section -->
            <div style="text-align: center; margin-bottom: 24px; padding: 20px; background: #ffffff; border-radius: 12px; box-shadow: inset 0 2px 4px rgba(0,0,0,0.1);">
                <svg id="barcode-tiket" style="max-width: 100%;"></svg>
                <p style="margin: 8px 0 0 0; font-size: 12px; font-weight: 700; color: #1a1a2e; letter-spacing: 2px; font-family: 'Courier New', monospace;">{{ str_pad($parkir->id, 8, '0', STR_PAD_LEFT) }}</p>
            </div>

            <!-- ID -->
            <div style="text-align: center; margin-bottom: 24px;">
                <p style="margin: 0 0 6px 0; color: rgba(255,255,255,0.4); font-size: 10px; text-transform: uppercase; letter-spacing: 2px;">ID Tiket</p>
                <p style="margin: 0; font-size: 14px; font-weight: 700; color: rgba(255,255,255,0.6); font-family: monospace; letter-spacing: 2px;">#{{ str_pad($parkir->id, 6, '0', STR_PAD_LEFT) }}</p>
            </div>

            <!-- Instructions -->
            <div style="background: rgba(255,255,255,0.05); padding: 16px; border-radius: 12px; text-align: center; margin-bottom: 20px; border: 1px solid rgba(255,255,255,0.08);">
                <p style="margin: 0; font-size: 12px; color: rgba(255,255,255,0.6); line-height: 1.6;">
                    <i class="fas fa-info-circle" style="color: #818cf8; margin-right: 6px;"></i>
                    <strong style="color: rgba(255,255,255,0.8);">Penting:</strong> Simpan tiket dengan baik. Gunakan saat keluar untuk perhitungan biaya.
                </p>
            </div>

            <!-- Footer -->
            <div style="text-align: center; padding-top: 16px; border-top: 1px solid rgba(255,255,255,0.1); color: rgba(255,255,255,0.5); font-size: 11px; line-height: 1.8;">
                <p style="margin: 0 0 4px 0;"><span style="color: #6ee7b7;">✓</span> Tiket sah untuk 1 kendaraan</p>
                <p style="margin: 0;">Berikan tiket saat keluar parkir</p>
            </div>

            <!-- Print Button -->
            <button 
                onclick="window.print()" 
                style="width: 100%; margin-top: 20px; padding: 14px; background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); color: white; border: none; border-radius: 12px; font-weight: 700; cursor: pointer; transition: all 0.3s ease; font-size: 14px; letter-spacing: 0.5px; box-shadow: 0 8px 20px rgba(17, 153, 142, 0.3);"
                onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 12px 28px rgba(17, 153, 142, 0.45)'"
                onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 20px rgba(17, 153, 142, 0.3)'"
            >
                <i class="fas fa-print" style="margin-right: 8px;"></i>
                Cetak Tiket
            </button>
        </div>
    </div>
</div>

{{-- JsBarcode Library --}}
<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>

<script>
    // Generate barcode
    JsBarcode("#barcode-tiket", "{{ str_pad($parkir->id, 8, '0', STR_PAD_LEFT) }}", {
        format: "CODE128",
        width: 2,
        height: 60,
        displayValue: false,
        background: "#ffffff",
        lineColor: "#000000",
        margin: 0
    });
</script>

<style>
    @keyframes bounce {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.08); }
    }
    
    @media print {
        body * { 
            visibility: hidden; 
        }
        div[style*="max-width: 420px"], 
        div[style*="max-width: 420px"] * { 
            visibility: visible; 
        }
        div[style*="max-width: 420px"] {
            position: absolute;
            left: 0;
            top: 0;
            margin: 0 !important;
            padding: 0 !important;
            max-width: 100% !important;
            box-shadow: none !important;
            border-radius: 0 !important;
        }
        button { 
            display: none !important; 
        }
        body {
            background: white !important;
            padding: 20px !important;
            margin: 0 !important;
        }
    }
</style>
@endsection
