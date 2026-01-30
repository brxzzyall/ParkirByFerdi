@extends('layouts.tiketapp')

@section('content')
<div style="max-width: 400px; margin: 40px auto; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
    <div style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); color: white; padding: 30px; border-radius: 16px 16px 0 0; text-align: center; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);">
        <h2 style="margin: 0; font-size: 32px; font-weight: 700;">🎫</h2>
        <h3 style="margin: 12px 0 4px 0; font-size: 22px; font-weight: 700;">TIKET PARKIR</h3>
        <p style="margin: 0; opacity: 0.9; font-size: 13px;">Simpan tiket ini hingga keluar</p>
    </div>

    <div style="background: white; padding: 30px; border-radius: 0 0 16px 16px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);">
        <!-- Vehicle Info -->
        <div style="margin-bottom: 24px; padding-bottom: 24px; border-bottom: 2px solid #e0e0e0;">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                <div>
                    <p style="margin: 0 0 6px 0; color: #999; font-size: 11px; text-transform: uppercase; letter-spacing: 1px;">Nomor Kendaraan</p>
                    <p style="margin: 0; font-size: 18px; font-weight: 700; color: #333;">{{ $parkir->nomor_kendaraan }}</p>
                </div>
                <div>
                    <p style="margin: 0 0 6px 0; color: #999; font-size: 11px; text-transform: uppercase; letter-spacing: 1px;">Jenis Kendaraan</p>
                    <p style="margin: 0; font-size: 18px; font-weight: 700; color: #333;">
                        @if($parkir->jenis_kendaraan == 'Motor') 🏍️ Motor @else 🚗 Mobil @endif
                    </p>
                </div>
            </div>
        </div>

        <!-- Check In Time -->
        <div style="margin-bottom: 24px; padding: 20px; background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%); border-radius: 12px; border-left: 5px solid #667eea;">
            <p style="margin: 0 0 8px 0; color: #999; font-size: 11px; text-transform: uppercase; letter-spacing: 1px;">Waktu Masuk</p>
            <p style="margin: 0; font-size: 16px; font-weight: 600; color: #333;">{{ \Carbon\Carbon::parse($parkir->waktu_masuk)->format('d M Y') }}</p>
            <p style="margin: 8px 0 0 0; font-size: 20px; font-weight: 700; color: #667eea;">{{ \Carbon\Carbon::parse($parkir->waktu_masuk)->format('H:i:s') }}</p>
        </div>

        <!-- Instructions -->
        <div style="background: #f8f9fa; padding: 16px; border-radius: 10px; text-align: center; margin-bottom: 24px;">
            <p style="margin: 0; font-size: 12px; color: #666; line-height: 1.6;">
                <strong>ℹ️ Penting:</strong><br>
                Simpan tiket ini dengan baik. Gunakan tiket ini saat keluar parkir untuk perhitungan biaya.
            </p>
        </div>

        <!-- Footer -->
        <div style="text-align: center; padding-top: 20px; border-top: 2px solid #e0e0e0; color: #999; font-size: 12px; line-height: 1.6;">
            <p style="margin: 0 0 8px 0;">✓ Tiket sah untuk 1 kendaraan</p>
            <p style="margin: 0;">Berikan tiket ini saat keluar parkir</p>
        </div>

        <!-- Print Button -->
        <button 
            onclick="window.print()" 
            style="width: 100%; margin-top: 24px; padding: 12px; background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); color: white; border: none; border-radius: 10px; font-weight: 600; cursor: pointer; transition: all 0.3s ease; font-size: 14px;"
            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 10px 25px rgba(17, 153, 142, 0.4)'"
            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'"
        >
            🖨️ Cetak Tiket
        </button>
    </div>
</div>

<style>
    @media print {
        body * { 
            visibility: hidden; 
        }
        div[style*="max-width: 400px"], 
        div[style*="max-width: 400px"] * { 
            visibility: visible; 
        }
        button { 
            display: none !important; 
        }
        body {
            background: white !important;
            padding: 0 !important;
            margin: 0 !important;
        }
    }
</style>
@endsection
