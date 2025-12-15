<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Anggota;
use App\Models\Peminjaman;
use App\Models\Pengembalian;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBuku = Buku::count();
        $totalAnggota = Anggota::count();
        $totalPeminjaman = Peminjaman::where('status', 'dipinjam')->count();
        $totalPengembalian = Pengembalian::count();

        return view('dashboard', compact('totalBuku', 'totalAnggota', 'totalPeminjaman', 'totalPengembalian'));
    }
}
