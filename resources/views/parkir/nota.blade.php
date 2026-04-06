@extends('layouts.notaapp')

@section('content')
<div style="max-width: 420px; margin: 40px auto; font-family: 'Inter', 'Segoe UI', sans-serif;">
    {{-- Receipt Container with 3D effect --}}
    <div style="background: linear-gradient(145deg, #1a1a2e 0%, #16213e 100%); border-radius: 20px; overflow: hidden; box-shadow: 0 25px 50px rgba(0, 0, 0, 0.4), 0 0 0 1px rgba(255,255,255,0.05); position: relative;">
        {{-- Decorative top --}}
        <div style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); padding: 32px 28px 28px; text-align: center; position: relative; overflow: hidden;">
            <div style="position: absolute; top: -30px; right: -30px; width: 100px; height: 100px; background: rgba(255,255,255,0.15); border-radius: 50%;"></div>
            <div style="position: absolute; bottom: -20px; left: -20px; width: 60px; height: 60px; background: rgba(255,255,255,0.1); border-radius: 50%;"></div>
            
            <div style="font-size: 48px; margin-bottom: 8px; animation: bounce 1s ease-in-out;">🅿️</div>
            <h3 style="margin: 0 0 4px 0; font-size: 26px; font-weight: 900; letter-spacing: 1.2px;">NOTA PARKIR</h3>
            <p style="margin: 0; opacity: 0.95; font-size: 12px; font-weight: 600; letter-spacing: 0.5px;">Bukti Pembayaran Parkir Resmi</p>
            <p style="margin: 8px 0 0 0; opacity: 0.85; font-size: 11px; font-weight: 500;">Layanan Parkir Terpercaya Anda</p>
        </div>

        {{-- Perforation line --}}
        <div style="height: 8px; background: linear-gradient(90deg, transparent 0%, rgba(255,255,255,0.1) 50%, transparent 100%); position: relative;">
            <div style="position: absolute; left: -10px; top: -6px; width: 20px; height: 20px; background: #0f172a; border-radius: 50%;"></div>
            <div style="position: absolute; right: -10px; top: -6px; width: 20px; height: 20px; background: #0f172a; border-radius: 50%;"></div>
        </div>

        {{-- Content --}}
        <div style="padding: 28px;">
            <!-- Welcome Message -->
            <div style="text-align: center; margin-bottom: 24px; padding-bottom: 20px; border-bottom: 1px solid rgba(255,255,255,0.1);">
                <p style="margin: 0; font-size: 12px; color: rgba(255,255,255,0.6); line-height: 1.6;">
                    <i class="fas fa-handshake" style="color: #10f981; margin-right: 6px;"></i>
                    Selamat datang. Kami senang melayani Anda
                </p>
            </div>

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
                    <p style="margin: 0; font-size: 14px; color: rgba(255,255,255,0.8); font-weight: 500;">{{ $parkir->waktu_masuk->format('d M Y - H:i:s') }}</p>
                </div>
                @if($parkir->waktu_keluar)
                <div style="padding: 14px; background: rgba(16,185,129,0.1); border-radius: 10px; border-left: 3px solid #6ee7b7;">
                    <p style="margin: 0 0 4px 0; color: rgba(255,255,255,0.5); font-size: 10px; text-transform: uppercase; letter-spacing: 1.5px;">Waktu Keluar</p>
                    <p style="margin: 0; font-size: 14px; color: rgba(255,255,255,0.8); font-weight: 500;">{{ $parkir->waktu_keluar->format('d M Y - H:i:s') }}</p>
                </div>
                @endif
            </div>

            <!-- Cost -->
            @if($parkir->biaya)
            <div style="margin-bottom: 24px; padding: 24px; background: linear-gradient(135deg, rgba(16,185,129,0.15) 0%, rgba(56, 239, 125, 0.1) 100%); border-radius: 16px; text-align: center; border: 1px solid rgba(16,185,129,0.2); position: relative; overflow: hidden;">
                <div style="position: absolute; top: -30px; right: -30px; width: 100px; height: 100px; background: radial-gradient(circle, rgba(16,185,129,0.2) 0%, transparent 70%); pointer-events: none;"></div>
                <p style="margin: 0 0 8px 0; color: rgba(255,255,255,0.6); font-size: 11px; text-transform: uppercase; letter-spacing: 2px;">Total Biaya</p>
                <h3 style="margin: 0; font-size: 32px; font-weight: 800; color: #6ee7b7; letter-spacing: 1px;">Rp {{ number_format(abs($parkir->biaya ?? 0), 0, ',', '.') }}</h3>
            </div>
            @endif



            <!-- Duration -->
            @if($parkir->waktu_masuk && $parkir->waktu_keluar)
            <div style="text-align: center; margin-bottom: 20px; padding: 14px; background: linear-gradient(135deg, rgba(255, 193, 7, 0.12) 0%, rgba(255, 152, 0, 0.08) 100%); border-radius: 12px; border: 1px solid rgba(255, 193, 7, 0.2);">
                <p style="margin: 0; font-size: 12px; color: rgba(255,255,255,0.7); font-weight: 500;">
                    <i class="fas fa-hourglass-end" style="color: #fcd34d; margin-right: 6px;"></i>
                    <strong>Durasi Parkir:</strong> {{ $parkir->waktu_masuk->diff($parkir->waktu_keluar)->format('%H jam %I menit') }}
                </p>
            </div>
            @endif

            <!-- Service Quality Notice -->
            <div style="text-align: center; margin-bottom: 24px; padding: 16px; background: rgba(30, 144, 255, 0.08); border-radius: 12px; border: 1px dashed rgba(30, 144, 255, 0.3);">
                <p style="margin: 0; font-size: 11px; color: rgba(255,255,255,0.6); line-height: 1.6;">
                    <i class="fas fa-star" style="color: #60a5fa; margin-right: 4px;"></i>
                    <strong style="color: rgba(255,255,255,0.8);">Kepuasan Anda adalah Prioritas Kami</strong><br>
                    Terima kasih telah menggunakan layanan parkir kami dengan penuh kepercayaan
                </p>
            </div>

            <!-- Footer -->
            <div style="text-align: center; padding: 24px; background: linear-gradient(180deg, rgba(255,255,255,0.08) 0%, rgba(255,255,255,0.02) 100%); border-top: 1px solid rgba(255,255,255,0.1); border-radius: 0 0 20px 20px; color: rgba(255,255,255,0.7); font-size: 12px; line-height: 1.9;">
                <p style="margin: 0 0 12px 0; font-size: 13px; font-weight: 700;">
                    <span style="color: #6ee7b7;">✓</span> 
                    <span style="color: #10f981;">Pembayaran Berhasil</span>
                </p>

                
                <div style="height: 1px; background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent); margin: 12px 0;"></div>
                
                <p style="margin: 10px 0 0 0; font-size: 10px; opacity: 0.7;">💡 Simpan nota ini sebagai bukti pembayaran</p>
                <p style="margin: 6px 0 0 0; font-size: 10px; opacity: 0.6;">📞 Hubungi kami jika ada pertanyaan atau keluhan</p>
                <p style="margin: 10px 0 0 0; font-size: 9px; opacity: 0.6;">Semoga perjalanan Anda aman dan menyenangkan 🙏</p>
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



<style>
    @keyframes bounce {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
    }

    @media print {
        /* unhide wrapper and card container */
        main { visibility: visible !important; display: block !important; }
        div[style*="max-width: 420px"] { visibility: visible !important; display: block !important; }
    }
</style>
@endsection
