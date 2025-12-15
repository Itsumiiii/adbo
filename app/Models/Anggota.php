<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    protected $table = 'anggota';

    protected $fillable = [
        'id_anggota', 'nama', 'alamat', 'no_telepon',
        'email', 'tanggal_daftar', 'tanggal_berlaku',
        'tanggal_expire', 'status'
    ];

    protected $casts = [
        'tanggal_daftar' => 'date',
        'tanggal_berlaku' => 'date',
        'tanggal_expire' => 'date',
        'status' => 'string'
    ];

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }
}