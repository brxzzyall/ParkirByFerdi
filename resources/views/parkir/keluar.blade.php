@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6 col-md-8">
        <div class="card card-modern" style="background: white;">
            <div class="card-header-modern" style="text-align: center;">
                <h4 style="margin: 0; font-size: 28px; font-weight: 700;">🚪 Kendaraan Keluar</h4>
                <p style="margin: 8px 0 0 0; opacity: 0.9; font-size: 14px;">Proses keluar parkir</p>
            </div>

            <div class="card-body" style="padding: 40px;">
                <!-- Vehicle Info Card -->
                <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 24px; border-radius: 12px; margin-bottom: 32px;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div>
                            <p style="margin: 0 0 8px 0; opacity: 0.9; font-size: 12px; text-transform: uppercase; letter-spacing: 1px;">Nomor Kendaraan</p>
                            <h5 style="margin: 0; font-size: 22px; font-weight: 700;">{{ $parkir->nomor_kendaraan }}</h5>
                        </div>
                        <div>
                            <p style="margin: 0 0 8px 0; opacity: 0.9; font-size: 12px; text-transform: uppercase; letter-spacing: 1px;">Jenis Kendaraan</p>
                            <h5 style="margin: 0; font-size: 22px; font-weight: 700;">
                                @if($parkir->jenis_kendaraan == 'Motor') 🏍️ @else 🚗 @endif
                                {{ $parkir->jenis_kendaraan }}
                            </h5>
                        </div>
                    </div>
                </div>

                <!-- Check In Time -->
                <div style="margin-bottom: 32px; padding: 20px; background: #f8f9fa; border-radius: 12px;">
                    <p style="margin: 0 0 8px 0; font-weight: 600; color: #666; font-size: 13px;">⏱️ WAKTU MASUK</p>
                    <h6 style="margin: 0; font-size: 18px; font-weight: 600; color: #333;">
                        {{ \Carbon\Carbon::parse($parkir->waktu_masuk)->format('d M Y - H:i:s') }}
                    </h6>
                </div>

                <!-- Form -->
                <form method="POST" action="{{ route('parkir.simpanKeluar', $parkir->id) }}">
                    @csrf

                    <div style="background: linear-gradient(135deg, rgba(241, 39, 17, 0.05) 0%, rgba(245, 175, 25, 0.05) 100%); padding: 16px; border-radius: 12px; border-left: 5px solid #f12711; margin-bottom: 24px;">
                        <p style="margin: 0; font-size: 13px; color: #666; line-height: 1.6;">
                            <strong>⚠️ Catatan:</strong> Setelah Anda mengklik tombol dibawah, biaya parkir akan dihitung secara otomatis.
                        </p>
                    </div>

                    <button 
                        type="submit" 
                        class="btn-modern btn-warning-modern"
                        style="width: 100%; padding: 14px 0; font-size: 18px;"
                    >
                        ✓ Keluar & Hitung Biaya
                    </button>

                    <a 
                        href="/" 
                        class="btn btn-modern"
                        style="width: 100%; padding: 14px 0; font-size: 18px; margin-top: 12px; display: inline-block; text-align: center; background: #e0e0e0; color: #333; text-decoration: none; border-radius: 12px; font-weight: 600; transition: all 0.3s ease;"
                        onmouseover="this.style.background='#d0d0d0'" 
                        onmouseout="this.style.background='#e0e0e0'"
                    >
                        ← Batal
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    @media (max-width: 768px) {
        .card-body {
            padding: 24px !important;
        }
        
        .card-header-modern h4 {
            font-size: 22px !important;
        }
    }
</style>
@endsection
