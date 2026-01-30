@extends('layouts.app')

@section('content')
<div style="min-height: 100vh; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; padding: 2rem; position: relative; overflow: hidden;">
    {{-- Animated Background Elements --}}
    <div style="position: absolute; width: 300px; height: 300px; background: rgba(255, 255, 255, 0.1); border-radius: 50%; top: -100px; left: -100px; animation: float 8s ease-in-out infinite;"></div>
    <div style="position: absolute; width: 200px; height: 200px; background: rgba(255, 255, 255, 0.05); border-radius: 50%; bottom: -50px; right: -50px; animation: float 10s ease-in-out infinite; animation-delay: 2s;"></div>

    <div style="width: 100%; max-width: 520px; position: relative; z-index: 10;">
        {{-- Alerts --}}
        @if(session('error'))
            <div style="background: rgba(241, 39, 17, 0.95); backdrop-filter: blur(10px); border: 1px solid rgba(241, 39, 17, 0.3); border-radius: 16px; padding: 18px; margin-bottom: 24px; color: white; animation: slideDown 0.4s ease;">
                <div style="display: flex; align-items: flex-start; gap: 14px;">
                    <span style="font-size: 24px; flex-shrink: 0;">⚠️</span>
                    <div style="flex-grow: 1;">
                        <strong style="font-size: 16px; display: block; margin-bottom: 4px;">Error!</strong>
                        <span style="font-size: 14px; opacity: 0.95; line-height: 1.5;">{{ session('error') }}</span>
                    </div>
                </div>
            </div>
        @endif
        
        @if(session('success'))
            <div style="background: rgba(34, 197, 94, 0.95); backdrop-filter: blur(10px); border: 1px solid rgba(34, 197, 94, 0.3); border-radius: 16px; padding: 18px; margin-bottom: 24px; color: white; animation: slideDown 0.4s ease;">
                <div style="display: flex; align-items: flex-start; gap: 14px;">
                    <span style="font-size: 24px; flex-shrink: 0;">✅</span>
                    <div style="flex-grow: 1;">
                        <strong style="font-size: 16px; display: block; margin-bottom: 4px;">Sukses!</strong>
                        <span style="font-size: 14px; opacity: 0.95; line-height: 1.5;">{{ session('success') }}</span>
                    </div>
                </div>
            </div>
        @endif

        {{-- Card Container --}}
        <div style="background: white; border-radius: 24px; box-shadow: 0 25px 80px rgba(0, 0, 0, 0.25), 0 0 1px rgba(0, 0, 0, 0.1); overflow: hidden; animation: fadeInUp 0.7s cubic-bezier(0.34, 1.56, 0.64, 1); backdrop-filter: blur(20px);">
            {{-- Header --}}
            <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 48px 40px; text-align: center; position: relative; overflow: hidden;">
                <div style="position: absolute; top: -50px; right: -50px; width: 150px; height: 150px; background: rgba(255, 255, 255, 0.1); border-radius: 50%;"></div>
                <div style="position: absolute; bottom: -30px; left: -30px; width: 100px; height: 100px; background: rgba(255, 255, 255, 0.1); border-radius: 50%;"></div>
                
                <div style="font-size: 56px; margin-bottom: 20px; animation: bounce 2s ease-in-out infinite;">🚗</div>
                <h1 style="font-size: 36px; font-weight: 800; margin: 0; letter-spacing: -0.5px; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">Kendaraan Masuk</h1>
                <p style="font-size: 16px; margin: 16px 0 0 0; opacity: 0.96; font-weight: 500; letter-spacing: 0.3px;">Daftarkan kendaraan Anda ke sistem parkir</p>
            </div>

            {{-- Form Body --}}
            <div style="padding: 48px 40px;">
                <form method="POST" action="{{ route('parkir.masuk') }}">
                    @csrf

                    {{-- Nomor Kendaraan --}}
                    <div style="margin-bottom: 32px; animation: slideIn 0.6s ease 0.1s backwards;">
                        <label style="display: block; font-weight: 700; color: #1f2937; margin-bottom: 12px; font-size: 15px; letter-spacing: 0.3px;">
                            📋 Nomor Kendaraan
                        </label>
                        <div style="position: relative;">
                            <input 
                                type="text" 
                                name="nomor_kendaraan" 
                                placeholder="Contoh: B 1234 ABC"
                                required
                                style="width: 100%; padding: 16px 18px; border: 2px solid #e5e7eb; border-radius: 14px; font-size: 15px; font-family: 'Poppins', sans-serif; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); background: #f9fafb; box-sizing: border-box; letter-spacing: 0.5px;"
                                @error('nomor_kendaraan') style="border-color: #f12711; background: rgba(241, 39, 17, 0.05);" @enderror
                                onblur="this.style.borderColor = '#e5e7eb'; this.style.boxShadow = 'none';"
                                onfocus="this.style.borderColor = '#667eea'; this.style.boxShadow = '0 0 0 3px rgba(102, 126, 234, 0.1)'; this.style.background = '#ffffff';"
                            >
                            <span style="position: absolute; right: 14px; top: 50%; transform: translateY(-50%); font-size: 18px; opacity: 0.3;">📝</span>
                        </div>
                        @error('nomor_kendaraan')
                            <small style="color: #f12711; margin-top: 10px; display: block; font-weight: 600; font-size: 13px;">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Jenis Kendaraan --}}
                    <div style="margin-bottom: 36px; animation: slideIn 0.6s ease 0.2s backwards;">
                        <label style="display: block; font-weight: 700; color: #1f2937; margin-bottom: 12px; font-size: 15px; letter-spacing: 0.3px;">
                            🚙 Jenis Kendaraan
                        </label>
                        <div style="position: relative;">
                            <select 
                                name="jenis_kendaraan" 
                                required
                                style="width: 100%; padding: 16px 18px; border: 2px solid #e5e7eb; border-radius: 14px; font-size: 15px; font-family: 'Poppins', sans-serif; background: #f9fafb; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); cursor: pointer; appearance: none; box-sizing: border-box;"
                                @error('jenis_kendaraan') style="border-color: #f12711; background: rgba(241, 39, 17, 0.05);" @enderror
                                onblur="this.style.borderColor = '#e5e7eb'; this.style.boxShadow = 'none';"
                                onfocus="this.style.borderColor = '#667eea'; this.style.boxShadow = '0 0 0 3px rgba(102, 126, 234, 0.1)'; this.style.background = '#ffffff';"
                            >
                                <option value="">-- Pilih Jenis Kendaraan --</option>
                                <option value="Motor">🏍️ Motor</option>
                                <option value="Mobil">🚗 Mobil</option>
                            </select>
                            <span style="position: absolute; right: 14px; top: 50%; transform: translateY(-50%); font-size: 16px; pointer-events: none; opacity: 0.4;">▼</span>
                        </div>
                        @error('jenis_kendaraan')
                            <small style="color: #f12711; margin-top: 10px; display: block; font-weight: 600; font-size: 13px;">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Submit Button --}}
                    <button 
                        type="submit" 
                        style="width: 100%; padding: 18px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; border-radius: 14px; font-size: 16px; font-weight: 700; cursor: pointer; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); box-shadow: 0 12px 28px rgba(102, 126, 234, 0.35); letter-spacing: 0.6px; position: relative; overflow: hidden; animation: slideIn 0.6s ease 0.3s backwards;"
                        onmouseover="this.style.transform = 'translateY(-3px)'; this.style.boxShadow = '0 18px 45px rgba(102, 126, 234, 0.5)';"
                        onmouseout="this.style.transform = 'translateY(0)'; this.style.boxShadow = '0 12px 28px rgba(102, 126, 234, 0.35)';"
                    >
                        ✓ Masuk Parkir
                    </button>
                </form>

                {{-- Info Box --}}
                <div style="margin-top: 36px; padding: 24px; background: linear-gradient(135deg, rgba(102, 126, 234, 0.12) 0%, rgba(118, 75, 162, 0.08) 100%); border-radius: 16px; border-left: 6px solid #667eea; backdrop-filter: blur(10px); animation: slideIn 0.6s ease 0.4s backwards;">
                    <p style="margin: 0; font-size: 14px; color: #374151; line-height: 1.7; font-weight: 500;">
                        <strong style="color: #1f2937; display: block; margin-bottom: 8px;">ℹ️ Catatan Penting:</strong>
                        <span style="font-size: 13px; color: #4b5563; display: block;">Pastikan nomor kendaraan sudah benar sebelum melanjutkan. Data akan tercatat dalam sistem parkir kami secara otomatis dan real-time.</span>
                    </p>
                </div>
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

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateX(-30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
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

    input, select {
        font-family: 'Poppins', sans-serif;
    }

    input:focus, select:focus {
        outline: none;
    }

    select {
        padding-right: 32px;
    }

    @media (max-width: 768px) {
        div[style*="padding: 48px 40px"] {
            padding: 32px 24px !important;
        }
        
        div[style*="padding: 48px 40px; text-align: center"] {
            padding: 32px 24px !important;
        }
        
        h1[style*="font-size: 36px"] {
            font-size: 28px !important;
        }

        div[style*="font-size: 56px"] {
            font-size: 44px !important;
        }

        button[style*="width: 100%"] {
            padding: 15px !important;
            font-size: 15px !important;
        }
    }
</style>
@endsection
