@extends('layouts.notaapp')

@section('content')
<div style="max-width: 420px; margin: 40px auto; font-family: 'Inter', 'Segoe UI', sans-serif;">
    {{-- Receipt Container with 3D effect --}}
    <div style="background: linear-gradient(145deg, #1a1a2e 0%, #16213e 100%); border-radius: 20px; overflow: hidden; box-shadow: 0 25px 50px rgba(0, 0, 0, 0.4), 0 0 0 1px rgba(255,255,255,0.05); position: relative;">
        {{-- Decorative top --}}
        <div style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); padding: 28px; text-align: center; position: relative; overflow: hidden;">
            <div style="position: absolute; top: -30px; right: -30px; width: 100px; height: 100px; background: rgba(255,255,255,0.15); border-radius: 50%;"></div>
            <div style="position: absolute; bottom: -20px; left: -20px; width: 60px; height: 60px; background: rgba(255,255,255,0.1); border-radius: 50%;"></div>
            
            <div style="font-size: 48px; margin-bottom: 8px;">🅿️</div>
            <h3 style="margin: 0; font-size: 24px; font-weight: 800; letter-spacing: 1px;">NOTA PARKIR</h3>
            <p style="margin: 8px 0 0 0; opacity: 0.9; font-size: 13px; font-weight: 500;">Bukti Pembayaran Parkir</p>
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
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
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

            <!-- Time Info -->
            <div style="margin-bottom: 24px; padding-bottom: 24px; border-bottom: 1px solid rgba(255,255,255,0.1);">
                <div style="margin-bottom: 16px; padding: 14px; background: rgba(99,102,241,0.1); border-radius: 10px; border-left: 3px solid #818cf8;">
                    <p style="margin: 0 0 4px 0; color: rgba(255,255,255,0.5); font-size: 10px; text-transform: uppercase; letter-spacing: 1.5px;">Waktu Masuk</p>
                    <p style="margin: 0; font-size: 14px; color: rgba(255,255,255,0.8); font-weight: 500;">{{ \Carbon\Carbon::parse($parkir->waktu_masuk)->format('d M Y - H:i:s') }}</p>
                </div>
                @if($parkir->waktu_keluar)
                <div style="padding: 14px; background: rgba(16,185,129,0.1); border-radius: 10px; border-left: 3px solid #6ee7b7;">
                    <p style="margin: 0 0 4px 0; color: rgba(255,255,255,0.5); font-size: 10px; text-transform: uppercase; letter-spacing: 1.5px;">Waktu Keluar</p>
                    <p style="margin: 0; font-size: 14px; color: rgba(255,255,255,0.8); font-weight: 500;">{{ \Carbon\Carbon::parse($parkir->waktu_keluar)->format('d M Y - H:i:s') }}</p>
                </div>
                @endif
            </div>

            <!-- Cost -->
            @if($parkir->biaya)
            <div style="margin-bottom: 24px; padding: 24px; background: linear-gradient(135deg, rgba(16,185,129,0.15) 0%, rgba(56, 239, 125, 0.1) 100%); border-radius: 16px; text-align: center; border: 1px solid rgba(16,185,129,0.2); position: relative; overflow: hidden;">
                <div style="position: absolute; top: -30px; right: -30px; width: 100px; height: 100px; background: radial-gradient(circle, rgba(16,185,129,0.2) 0%, transparent 70%); pointer-events: none;"></div>
                <p style="margin: 0 0 8px 0; color: rgba(255,255,255,0.6); font-size: 11px; text-transform: uppercase; letter-spacing: 2px;">Total Biaya</p>
                <h3 style="margin: 0; font-size: 32px; font-weight: 800; color: #6ee7b7; letter-spacing: 1px;">Rp {{ number_format($parkir->biaya ?? 0,0,',','.') }}</h3>
            </div>
            @endif

            <!-- Barcode Section -->
            <div style="text-align: center; margin-bottom: 24px; padding: 20px; background: #ffffff; border-radius: 12px; box-shadow: inset 0 2px 4px rgba(0,0,0,0.1);">
                <svg id="barcode-nota" style="max-width: 100%;"></svg>
                <p style="margin: 8px 0 0 0; font-size: 12px; font-weight: 700; color: #1a1a2e; letter-spacing: 2px; font-family: 'Courier New', monospace;">{{ str_pad($parkir->id, 8, '0', STR_PAD_LEFT) }}</p>
            </div>

            <!-- Duration -->
            @if($parkir->waktu_masuk && $parkir->waktu_keluar)
            <div style="text-align: center; margin-bottom: 24px; padding: 12px; background: rgba(255,255,255,0.05); border-radius: 10px;">
                <p style="margin: 0; font-size: 12px; color: rgba(255,255,255,0.6);">
                    <i class="fas fa-clock" style="color: #fcd34d; margin-right: 6px;"></i>
                    Durasi: {{ \Carbon\Carbon::parse($parkir->waktu_masuk)->diff(\Carbon\Carbon::parse($parkir->waktu_keluar))->format('%H jam %I menit') }}
                </p>
            </div>
            @endif

            <!-- Footer -->
            <div style="text-align: center; padding-top: 20px; border-top: 1px solid rgba(255,255,255,0.1); color: rgba(255,255,255,0.5); font-size: 12px; line-height: 1.8;">
                <p style="margin: 0 0 6px 0;"><span style="color: #6ee7b7;">✓</span> Pembayaran telah lunas</p>
                <p style="margin: 0 0 6px 0;">Terima kasih telah menggunakan layanan kami</p>
                <p style="margin: 0; font-size: 10px; opacity: 0.6;">Simpan nota ini sebagai bukti pembayaran</p>
            </div>

            <!-- Print Button -->
            <button 
                onclick="window.print()" 
                style="width: 100%; margin-top: 20px; padding: 14px; background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); color: white; border: none; border-radius: 12px; font-weight: 700; cursor: pointer; transition: all 0.3s ease; font-size: 14px; letter-spacing: 0.5px; box-shadow: 0 8px 20px rgba(17, 153, 142, 0.3);"
                onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 12px 28px rgba(17, 153, 142, 0.45)'"
                onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 20px rgba(17, 153, 142, 0.3)'"
            >
                <i class="fas fa-print" style="margin-right: 8px;"></i>
                Cetak Nota
            </button>
        </div>
    </div>
</div>

{{-- JsBarcode Library --}}
<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>

<script>
    // Generate barcode
    JsBarcode("#barcode-nota", "{{ str_pad($parkir->id, 8, '0', STR_PAD_LEFT) }}", {
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
