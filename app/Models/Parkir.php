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
}