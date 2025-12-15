<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;

    protected $table = 'pengembalian';

    protected $fillable = [
        'id_pengembalian', 'peminjaman_id', 'tanggal_kembali',
        'keterlambatan', 'denda', 'status'
    ];

    protected $casts = [
        'tanggal_kembali' => 'date',
        'keterlambatan' => 'integer',
        'denda' => 'decimal:2',
        'status' => 'string'
    ];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class);
    }
}