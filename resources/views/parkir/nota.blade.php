@extends('layouts.notaapp')

@section('content')
<div style="max-width: 400px; margin: 40px auto; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
    <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 30px; border-radius: 16px 16px 0 0; text-align: center; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);">
        <h2 style="margin: 0; font-size: 32px; font-weight: 700;">🅿️</h2>
        <h3 style="margin: 12px 0 4px 0; font-size: 22px; font-weight: 700;">NOTA PARKIR</h3>
        <p style="margin: 0; opacity: 0.9; font-size: 13px;">Bukti Pembayaran Parkir</p>
    </div>

    <div style="background: white; padding: 30px; border-radius: 0 0 16px 16px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);">
        <!-- Vehicle Info -->
        <div style="margin-bottom: 24px; padding-bottom: 24px; border-bottom: 2px solid #e0e0e0;">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
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

        <!-- Time Info -->
        <div style="margin-bottom: 24px; padding-bottom: 24px; border-bottom: 2px solid #e0e0e0;">
            <div style="margin-bottom: 12px;">
                <p style="margin: 0 0 6px 0; color: #999; font-size: 11px; text-transform: uppercase; letter-spacing: 1px;">Waktu Masuk</p>
                <p style="margin: 0; font-size: 15px; color: #333;">{{ \Carbon\Carbon::parse($parkir->waktu_masuk)->format('d M Y - H:i:s') }}</p>
            </div>
            @if($parkir->waktu_keluar)
            <div>
                <p style="margin: 0 0 6px 0; color: #999; font-size: 11px; text-transform: uppercase; letter-spacing: 1px;">Waktu Keluar</p>
                <p style="margin: 0; font-size: 15px; color: #333;">{{ \Carbon\Carbon::parse($parkir->waktu_keluar)->format('d M Y - H:i:s') }}</p>
            </div>
            @endif
        </div>

        <!-- Cost -->
        @if($parkir->biaya)
        <div style="margin-bottom: 24px; padding: 20px; background: linear-gradient(135deg, rgba(17, 153, 142, 0.1) 0%, rgba(56, 239, 125, 0.1) 100%); border-radius: 12px; text-align: center; border-left: 5px solid #11998e;">
            <p style="margin: 0 0 8px 0; color: #999; font-size: 11px; text-transform: uppercase; letter-spacing: 1px;">Total Biaya</p>
            <h3 style="margin: 0; font-size: 28px; font-weight: 700; color: #11998e;">Rp {{ number_format($parkir->biaya ?? 0,0,',','.') }}</h3>
        </div>
        @endif

        <!-- Footer -->
        <div style="text-align: center; padding-top: 20px; border-top: 2px solid #e0e0e0; color: #999; font-size: 12px; line-height: 1.6;">
            <p style="margin: 0 0 12px 0;">✓ Pembayaran telah lunas</p>
            <p style="margin: 0 0 12px 0;">Terima kasih telah menggunakan layanan parkir kami</p>
            <p style="margin: 0; font-size: 10px; opacity: 0.7;">Simpan nota ini sebagai bukti pembayaran</p>
        </div>

        <!-- Print Button -->
        <button 
            onclick="window.print()" 
            style="width: 100%; margin-top: 24px; padding: 12px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; border-radius: 10px; font-weight: 600; cursor: pointer; transition: all 0.3s ease; font-size: 14px;"
            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 10px 25px rgba(102, 126, 234, 0.4)'"
            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'"
        >
            🖨️ Cetak Nota
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
