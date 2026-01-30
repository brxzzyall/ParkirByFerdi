<?php

namespace App\Http\Controllers;

use App\Models\Parkir;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Atur detik sebelum riwayat dihapus (misal 30 detik)
        $hapusDetik = 1000; // ganti sesuai kebutuhan

        // Hitung batas waktu
        $batas = Carbon::now()->subSeconds($hapusDetik);

        // Hapus parkir yang sudah keluar lebih dari $hapusDetik detik
        Parkir::whereNotNull('waktu_keluar')
              ->where('waktu_keluar', '<', $batas)
              ->delete();

        // Ambil total kendaraan (untuk stats yang tidak berubah saat search)
        $totalKendaraan = Parkir::count();
        $sedangParkir = Parkir::whereNull('waktu_keluar')->count();
        $sudahKeluar = Parkir::whereNotNull('waktu_keluar')->count();
        $totalPendapatan = Parkir::whereNotNull('waktu_keluar')->sum('biaya');

        // Ambil parameter pencarian
        $search = request('search');

        // Query builder
        $query = Parkir::latest();

        // Filter berdasarkan nomor kendaraan jika ada pencarian
        if ($search) {
            $query->where('nomor_kendaraan', 'like', '%' . $search . '%');
        }

        // Ambil data parkir yang tersisa
        $parkirs = $query->get();

        return view('admin.dashboard', compact('parkirs', 'search', 'totalKendaraan', 'sedangParkir', 'sudahKeluar', 'totalPendapatan'));
    }
}
