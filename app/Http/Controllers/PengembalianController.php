<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengembalianController extends Controller
{
    public function index()
    {
        $pengembalian = Pengembalian::with(['peminjaman', 'peminjaman.anggota', 'peminjaman.buku'])->paginate(10);
        return view('pengembalian.index', compact('pengembalian'));
    }

    public function create()
    {
        $peminjaman = Peminjaman::with('buku')->where('status', 'dipinjam')->get();
        return view('pengembalian.create', compact('peminjaman'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'peminjaman_id' => 'required|exists:peminjaman,id',
        ]);

        $peminjaman = Peminjaman::find($request->peminjaman_id);

        if ($peminjaman->status !== 'dipinjam' || Pengembalian::where('peminjaman_id', $request->peminjaman_id)->exists()) {
            return redirect()->back()->withErrors(['peminjaman_id' => 'Peminjaman ini sudah dikembalikan.']);
        }

        DB::transaction(function () use ($request, $peminjaman) {
            // Calculate keterlambatan and denda
            // If now() > jatuh_tempo, diff is positive. 
            // We want (now - due).
            $tanggal_kembali = now();
            // diffInDays(target, false): if target is past, result is negative?
            // Test: today(15) -> diff(due(12), false) = -3? 
            // We should use $due->diffInDays($now, false).
            $keterlambatan = max(0, $peminjaman->tanggal_jatuh_tempo->diffInDays($tanggal_kembali, false));
            $denda = $keterlambatan * 1000; // Rp 1000 per day

            // Generate unique ID for pengembalian
            $id_pengembalian = 'PKG' . date('Ymd') . sprintf('%04d', rand(1, 9999));

            // Create pengembalian record
            Pengembalian::create([
                'id_pengembalian' => $id_pengembalian,
                'peminjaman_id' => $request->peminjaman_id,
                'tanggal_kembali' => $tanggal_kembali,
                'keterlambatan' => $keterlambatan,
                'denda' => $denda,
                'status' => $denda > 0 ? 'belum_lunas' : 'lunas'
            ]);

            // Update peminjaman status
            $peminjaman->update(['status' => 'dikembalikan']);

            // Update book status and stock
            $buku = $peminjaman->buku;
            $buku->update([
                'status' => 'tersedia',
                'stok' => $buku->stok + 1
            ]);
        });

        return redirect()->route('pengembalian.index')
                         ->with('success', 'Pengembalian berhasil dicatat.');
    }

    public function hitungDenda(Request $request)
    {
        $request->validate([
            'peminjaman_id' => 'required|exists:peminjaman,id',
        ]);

        $peminjaman = Peminjaman::find($request->peminjaman_id);

        $tanggal_kembali = now();
        $keterlambatan = max(0, $tanggal_kembali->diffInDays($peminjaman->tanggal_jatuh_tempo, false));
        $denda = $keterlambatan * 1000; // Rp 1000 per day

        return response()->json([
            'keterlambatan' => $keterlambatan,
            'denda' => $denda
        ]);
    }
}
