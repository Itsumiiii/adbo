<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Anggota;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::with(['anggota', 'buku'])->where('status', 'dipinjam')->paginate(10);
        return view('peminjaman.index', compact('peminjaman'));
    }

    public function create()
    {
        $anggota = Anggota::where('status', 'aktif')->get();
        $buku = Buku::where('status', 'tersedia')->where('stok', '>', 0)->get();
        return view('peminjaman.create', compact('anggota', 'buku'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'anggota_id' => 'required|exists:anggota,id',
            'buku_id' => 'required|exists:buku,id',
        ]);

        $anggota = Anggota::find($request->anggota_id);

        // Validate member is active and not expired
        if ($anggota->status !== 'aktif' || $anggota->tanggal_expire < now()) {
            return redirect()->back()->withErrors(['anggota_id' => 'Anggota tidak valid atau kartu sudah kadaluarsa.']);
        }

        $buku = Buku::find($request->buku_id);

        // Validate book is available
        if ($buku->status !== 'tersedia' || $buku->stok <= 0) {
            return redirect()->back()->withErrors(['buku_id' => 'Buku tidak tersedia untuk dipinjam.']);
        }

        DB::transaction(function () use ($request, $buku) {
            // Generate unique ID for peminjaman
            $id_peminjaman = 'PMJ' . date('Ymd') . sprintf('%04d', rand(1, 9999));

            $peminjaman = Peminjaman::create([
                'id_peminjaman' => $id_peminjaman,
                'anggota_id' => $request->anggota_id,
                'buku_id' => $request->buku_id,
                'tanggal_pinjam' => now(),
                'tanggal_jatuh_tempo' => now()->addDays(7), // 7 days loan period
                'status' => 'dipinjam'
            ]);

            // Update book status and stock
            $buku->update([
                'status' => 'dipinjam',
                'stok' => $buku->stok - 1
            ]);
        });

        return redirect()->route('peminjaman.index')
                         ->with('success', 'Peminjaman berhasil dicatat.');
    }

    public function show(Peminjaman $peminjaman)
    {
        return view('peminjaman.show', compact('peminjaman'));
    }

    public function riwayat()
    {
        $peminjaman = Peminjaman::with(['anggota', 'buku', 'pengembalian'])->paginate(10);
        return view('peminjaman.riwayat', compact('peminjaman'));
    }
}
