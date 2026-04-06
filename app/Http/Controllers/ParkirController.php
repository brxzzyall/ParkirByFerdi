<?php

namespace App\Http\Controllers;

use App\Models\Parkir;
use Illuminate\Http\Request;
use PDF; // nanti untuk cetak nota

class ParkirController extends Controller
{
    // Cek autentikasi sederhana
    protected function ensureLoggedIn()
    {
        if (!session('is_logged_in')) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        return null;
    }

    // Halaman parkir masuk
    public function masuk()
    {
        if ($redirect = $this->ensureLoggedIn()) {
            return $redirect;
        }

        return view('parkir.masuk');
    }

    // Simpan parkir masuk
    public function simpanMasuk(Request $request)
    {
        if ($redirect = $this->ensureLoggedIn()) {
            return $redirect;
        }

    $request->validate([
        'nomor_kendaraan' => 'required',
        'jenis_kendaraan' => 'required'
    ]);

    // Cek apakah kendaraan dengan nomor yang sama sudah masuk tapi belum keluar
    $cekParkir = Parkir::where('nomor_kendaraan', $request->nomor_kendaraan)
                        ->whereNull('waktu_keluar')
                        ->first();

    if ($cekParkir) {
        // Flash error jika plat sudah masuk
        return redirect()->back()->with('error', ' Kendaraan dengan plat nomor ini sudah masuk!');
    }

    // Simpan data parkir
    Parkir::create([
        'nomor_kendaraan' => $request->nomor_kendaraan,
        'jenis_kendaraan' => $request->jenis_kendaraan,
        'waktu_masuk' => now()
    ]);

    return redirect()->back()->with('success', ' Kendaraan berhasil masuk');
}

    // Halaman keluar & hitung biaya
    public function keluar($id)
    {
        if ($redirect = $this->ensureLoggedIn()) {
            return $redirect;
        }

        $parkir = Parkir::findOrFail($id);
        return view('parkir.keluar', compact('parkir'));
    }

    public function simpanKeluar(Request $request, $id)
    {
        if ($redirect = $this->ensureLoggedIn()) {
            return $redirect;
        }

        $parkir = Parkir::findOrFail($id);

        // Cek apakah kendaraan sudah keluar
        if ($parkir->waktu_keluar) {
            return redirect()->back()->with('error', 'Kendaraan ini sudah keluar sebelumnya.');
        }

        // Pastikan waktu_masuk valid
        if (!$parkir->waktu_masuk || !($parkir->waktu_masuk instanceof \Carbon\Carbon)) {
            return redirect()->back()->with('error', 'Data waktu masuk tidak valid.');
        }

        // Simpan waktu_masuk asli untuk memastikan tidak berubah
        $waktuMasukAsli = $parkir->waktu_masuk;

        $parkir->waktu_keluar = now();

        // Hitung durasi parkir dalam jam (dibulatkan ke atas)
        try {
            $jam = ceil($parkir->waktu_masuk->diffInMinutes(now()) / 60);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan dalam perhitungan waktu: ' . $e->getMessage());
        }

        // Tentukan tarif berdasarkan jenis kendaraan
        if ($parkir->jenis_kendaraan == 'Motor') {
            $tarif = 2000;
        } elseif ($parkir->jenis_kendaraan == 'Mobil') {
            $tarif = 5000;
        } else {
            $tarif = 2000; // default
        }

        $parkir->biaya = $jam * $tarif;

        // Log untuk debug
        \Log::info('Sebelum update: waktu_masuk = ' . $parkir->waktu_masuk . ', waktu_keluar = ' . $parkir->waktu_keluar . ', biaya = ' . $parkir->biaya);

        // Update hanya field yang diperlukan
        $parkir->update([
            'waktu_keluar' => $parkir->waktu_keluar,
            'biaya' => $parkir->biaya,
        ]);

        // Log setelah update
        $parkir->refresh();
        \Log::info('Setelah update: waktu_masuk = ' . $parkir->waktu_masuk . ', waktu_keluar = ' . $parkir->waktu_keluar . ', biaya = ' . $parkir->biaya);

        return redirect()->route('parkir.nota', $parkir->id);
    }


    //CETAK TIKET
    public function tiket($id)
    {
        $parkir = Parkir::findOrFail($id);
        return view('parkir.tiket', compact('parkir'));
    }



    // Cetak nota
    public function nota($id)
    {
        $parkir = Parkir::findOrFail($id);
        return view('parkir.nota', compact('parkir'));
    }
}
