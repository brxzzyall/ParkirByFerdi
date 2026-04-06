<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parkir extends Model
{
    protected $fillable = [
        'nomor_kendaraan',
        'jenis_kendaraan',
        'waktu_masuk',
        'waktu_keluar',
        'biaya',
    ];

    protected $casts = [
        'waktu_masuk' => 'datetime',
        'waktu_keluar' => 'datetime',
        'biaya' => 'decimal:2',
    ];

    // Mencegah perubahan waktu_masuk saat update
    protected static function boot()
    {
        parent::boot();

        static::updating(function ($parkir) {
            // Jika waktu_masuk akan diubah, kembalikan ke nilai asli
            if ($parkir->isDirty('waktu_masuk') && $parkir->getOriginal('waktu_masuk')) {
                $parkir->waktu_masuk = $parkir->getOriginal('waktu_masuk');
            }
        });
    }
}