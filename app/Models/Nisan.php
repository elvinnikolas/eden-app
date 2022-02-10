<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nisan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor',
        'nama',
        'tanggal',
        'gereja',
        'blok_nomor_nisan',
        'nama_nomor_keluarga',
        'email',
        'pembayaran_terakhir',
        'image',
    ];
}
