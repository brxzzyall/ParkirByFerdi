<?php

namespace App\Http\Controllers;

use App\Models\Parkir;
use Illuminate\Http\Request;
use PDF; // nanti untuk cetak nota

class ParkirController extends Controller
{
    // Halaman parkir masuk
    public function masuk()
    {
        return view('parkir.masuk');
    }

    // Simpan parkir masuk
    public function simpanMasuk(Request $request)
{
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
        return redirect()->back()->with('error', '🚨 Kendaraan dengan plat nomor ini sudah masuk!');
    }

    // Simpan data parkir
    Parkir::create([
        'nomor_kendaraan' => $request->nomor_kendaraan,
        'jenis_kendaraan' => $request->jenis_kendaraan,
        'waktu_masuk' => now()
    ]);

    return redirect()->back()->with('success', '✅ Kendaraan berhasil masuk');
}

    // Halaman keluar & hitung biaya
    public function keluar($id)
    {
        $parkir = Parkir::findOrFail($id);
        return view('parkir.keluar', compact('parkir'));
    }

    public function simpanKeluar(Request $request, $id)
    {
        $parkir = Parkir::findOrFail($id);
        $parkir->waktu_keluar = now();

        // Hitung durasi parkir dalam jam (dibulatkan ke atas)
        $jam = ceil(now()->diffInMinutes($parkir->waktu_masuk) / 60);

        // Tentukan tarif berdasarkan jenis kendaraan
        if ($parkir->jenis_kendaraan == 'Motor') {
            $tarif = 2000;
        } elseif ($parkir->jenis_kendaraan == 'Mobil') {
            $tarif = 5000;
        } else {
            $tarif = 2000; // default
        }

        $parkir->biaya = $jam * $tarif;
        $parkir->save();

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
