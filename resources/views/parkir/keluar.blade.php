@extends('layouts.app')

@section('content')
<div style="min-height: 100vh; background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #0f172a 100%); display: flex; align-items: center; justify-content: center; padding: 2rem; position: relative; overflow: hidden;">
    {{-- Animated Background Elements --}}
    <div style="position: absolute; width: 400px; height: 400px; background: radial-gradient(circle, rgba(99,102,241,0.15) 0%, transparent 70%); border-radius: 50%; top: -150px; left: -150px; animation: float 10s ease-in-out infinite;"></div>
    <div style="position: absolute; width: 300px; height: 300px; background: radial-gradient(circle, rgba(139,92,246,0.1) 0%, transparent 70%); border-radius: 50%; bottom: -100px; right: -100px; animation: float 12s ease-in-out infinite; animation-delay: 2s;"></div>
    <div style="position: absolute; width: 200px; height: 200px; background: radial-gradient(circle, rgba(6,182,212,0.1) 0%, transparent 70%); border-radius: 50%; top: 50%; left: 10%; animation: float 8s ease-in-out infinite; animation-delay: 4s;"></div>

    <div style="width: 100%; max-width: 520px; position: relative; z-index: 10;">
        {{-- Alerts --}}
        @if(session('error'))
            <div style="background: rgba(239, 68, 68, 0.2); backdrop-filter: blur(20px); border: 1px solid rgba(239, 68, 68, 0.3); border-radius: 16px; padding: 18px; margin-bottom: 24px; color: white; animation: slideDown 0.4s ease;">
                <div style="display: flex; align-items: flex-start; gap: 14px;">
                    <span style="font-size: 24px; flex-shrink: 0;">⚠️</span>
                    <div style="flex-grow: 1;">
                        <strong style="font-size: 16px; display: block; margin-bottom: 4px;">Error!</strong>
                        <span style="font-size: 14px; opacity: 0.95; line-height: 1.5;">{{ session('error') }}</span>
                    </div>
                </div>
            </div>
        @endif

        {{-- Card Container --}}
        <div class="glass-dark" style="border-radius: 24px; overflow: hidden; animation: fadeInUp 0.7s cubic-bezier(0.34, 1.56, 0.64, 1);">
            {{-- Header --}}
            <div style="background: linear-gradient(135deg, #ef4444 0%, #f59e0b 100%); color: white; padding: 40px; text-align: center; position: relative; overflow: hidden;">
                <div style="position: absolute; top: -60px; right: -60px; width: 180px; height: 180px; background: rgba(255, 255, 255, 0.15); border-radius: 50%;"></div>
                <div style="position: absolute; bottom: -40px; left: -40px; width: 120px; height: 120px; background: rgba(255, 255, 255, 0.1); border-radius: 50%;"></div>
                
                <div style="font-size: 56px; margin-bottom: 16px; animation: bounce 2s ease-in-out infinite;">🚪</div>
                <h1 style="font-size: 32px; font-weight: 800; margin: 0; letter-spacing: -0.5px; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.15);">Kendaraan Keluar</h1>
                <p style="font-size: 15px; margin: 12px 0 0 0; opacity: 0.96; font-weight: 500; letter-spacing: 0.3px;">Proses checkout kendaraan dari area parkir</p>
            </div>

            {{-- Card Body --}}
            <div style="padding: 36px;">
                <!-- Vehicle Info Card -->
                <div class="glass" style="padding: 24px; margin-bottom: 28px; border-radius: 16px;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div>
                            <p style="margin: 0 0 8px 0; opacity: 0.7; font-size: 11px; text-transform: uppercase; letter-spacing: 1.5px; color: rgba(255,255,255,0.6);">Nomor Kendaraan</p>
                            <h5 style="margin: 0; font-size: 20px; font-weight: 700; color: white; letter-spacing: 0.5px;">{{ $parkir->nomor_kendaraan }}</h5>
                        </div>
                        <div>
                            <p style="margin: 0 0 8px 0; opacity: 0.7; font-size: 11px; text-transform: uppercase; letter-spacing: 1.5px; color: rgba(255,255,255,0.6);">Jenis Kendaraan</p>
                            <h5 style="margin: 0; font-size: 20px; font-weight: 700; color: white;">
                                @if($parkir->jenis_kendaraan == 'Motor') 🏍️ @else 🚗 @endif
                                {{ $parkir->jenis_kendaraan }}
                            </h5>
                        </div>
                    </div>
                </div>

                <!-- Check In Time -->
                <div class="glass" style="padding: 20px; margin-bottom: 28px; border-radius: 14px; border-left: 4px solid #6366f1;">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <div style="width: 40px; height: 40px; background: rgba(99,102,241,0.2); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-clock" style="color: #818cf8; font-size: 16px;"></i>
                        </div>
                        <div>
                            <p style="margin: 0 0 4px 0; font-weight: 600; color: rgba(255,255,255,0.6); font-size: 12px; text-transform: uppercase; letter-spacing: 1px;">WAKTU MASUK</p>
                            <h6 style="margin: 0; font-size: 16px; font-weight: 700; color: white;">
                                {{ \Carbon\Carbon::parse($parkir->waktu_masuk)->format('d M Y - H:i:s') }}
                            </h6>
                        </div>
                    </div>
                </div>

                <!-- Duration -->
                <div class="glass" style="padding: 20px; margin-bottom: 28px; border-radius: 14px; border-left: 4px solid #06b6d4;">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <div style="width: 40px; height: 40px; background: rgba(6,182,212,0.2); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-hourglass-half" style="color: #67e8f9; font-size: 16px;"></i>
                        </div>
                        <div>
                            <p style="margin: 0 0 4px 0; font-weight: 600; color: rgba(255,255,255,0.6); font-size: 12px; text-transform: uppercase; letter-spacing: 1px;">DURASI PARKIR</p>
                            <h6 style="margin: 0; font-size: 16px; font-weight: 700; color: #67e8f9;">
                                {{ \Carbon\Carbon::parse($parkir->waktu_masuk)->diff(\Carbon\Carbon::now())->format('%H jam %I menit') }}
                            </h6>
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <form method="POST" action="{{ route('parkir.simpanKeluar', $parkir->id) }}">
                    @csrf

                    <div style="background: rgba(245, 158, 11, 0.1); padding: 16px; border-radius: 12px; border-left: 4px solid #f59e0b; margin-bottom: 24px;">
                        <p style="margin: 0; font-size: 13px; color: #fcd34d; line-height: 1.6;">
                            <i class="fas fa-info-circle" style="margin-right: 8px;"></i>
                            <strong>Catatan:</strong> Setelah Anda mengklik tombol submit, biaya parkir akan dihitung secara otomatis.
                        </p>
                    </div>

                    <button 
                        type="submit" 
                        style="width: 100%; padding: 16px; background: linear-gradient(135deg, #ef4444 0%, #f59e0b 100%); color: white; border: none; border-radius: 14px; font-size: 16px; font-weight: 700; cursor: pointer; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); box-shadow: 0 8px 24px rgba(239, 68, 68, 0.35); letter-spacing: 0.5px; position: relative; overflow: hidden;"
                        onmouseover="this.style.transform = 'translateY(-3px)'; this.style.boxShadow = '0 12px 32px rgba(239, 68, 68, 0.5)';"
                        onmouseout="this.style.transform = 'translateY(0)'; this.style.boxShadow = '0 8px 24px rgba(239, 68, 68, 0.35)';"
                    >
                        <i class="fas fa-sign-out-alt" style="margin-right: 10px;"></i>
                        Keluar & Hitung Biaya
                    </button>

                    <a 
                        href="/" 
                        style="width: 100%; padding: 16px; margin-top: 12px; display: inline-block; text-align: center; background: rgba(255,255,255,0.08); color: rgba(255,255,255,0.7); text-decoration: none; border-radius: 14px; font-weight: 600; transition: all 0.3s ease; border: 1px solid rgba(255,255,255,0.1);"
                        onmouseover="this.style.background='rgba(255,255,255,0.12)'; this.style.color='white';" 
                        onmouseout="this.style.background='rgba(255,255,255,0.08)'; this.style.color='rgba(255,255,255,0.7)';"
                    >
                        <i class="fas fa-arrow-left" style="margin-right: 8px;"></i>
                        Batal
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(40px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes float {
        0%, 100% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(20px);
        }
    }

    @keyframes bounce {
        0%, 100% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.1);
        }
    }

    @media (max-width: 768px) {
        div[style*="padding: 36px"] {
            padding: 24px !important;
        }
        
        div[style*="padding: 40px; text-align: center"] {
            padding: 28px 20px !important;
        }
        
        h1[style*="font-size: 32px"] {
            font-size: 26px !important;
        }

        div[style*="font-size: 56px"] {
            font-size: 44px !important;
        }

        button[style*="width: 100%"] {
            padding: 14px !important;
            font-size: 15px !important;
        }
    }
</style>
@endsection
