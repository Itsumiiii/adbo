<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function peminjaman()
    {
        $peminjaman = Peminjaman::with(['anggota', 'buku'])->paginate(10);
        return view('laporan.peminjaman', compact('peminjaman'));
    }

    public function pengembalian()
    {
        $pengembalian = Pengembalian::with(['peminjaman', 'peminjaman.anggota', 'peminjaman.buku'])->paginate(10);
        return view('laporan.pengembalian', compact('pengembalian'));
    }

    public function denda()
    {
        $pengembalian = Pengembalian::with(['peminjaman', 'peminjaman.anggota'])->where('denda', '>', 0)->paginate(10);
        return view('laporan.denda', compact('pengembalian'));
    }
}
