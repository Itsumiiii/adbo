<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Peminjaman;
use App\Models\Anggota;
use App\Models\Buku;

class PeminjamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $anggota1 = Anggota::where('id_anggota', 'A001')->first();
        $anggota2 = Anggota::where('id_anggota', 'A002')->first();
        $buku1 = Buku::where('kode_buku', 'B001')->first();
        $buku2 = Buku::where('kode_buku', 'B002')->first();
        $buku3 = Buku::where('kode_buku', 'B003')->first();

        if($anggota1 && $buku1) {
            Peminjaman::create([
                'id_peminjaman' => 'PMJ202412150001',
                'anggota_id' => $anggota1->id,
                'buku_id' => $buku1->id,
                'tanggal_pinjam' => '2024-12-01',
                'tanggal_jatuh_tempo' => '2024-12-08',
                'status' => 'dipinjam'
            ]);
        }

        if($anggota2 && $buku2) {
            Peminjaman::create([
                'id_peminjaman' => 'PMJ202412150002',
                'anggota_id' => $anggota2->id,
                'buku_id' => $buku2->id,
                'tanggal_pinjam' => '2024-12-05',
                'tanggal_jatuh_tempo' => '2024-12-12',
                'status' => 'dipinjam'
            ]);
        }

        if($anggota1 && $buku3) {
            Peminjaman::create([
                'id_peminjaman' => 'PMJ202412150003',
                'anggota_id' => $anggota1->id,
                'buku_id' => $buku3->id,
                'tanggal_pinjam' => '2024-11-20',
                'tanggal_jatuh_tempo' => '2024-11-27',
                'status' => 'dipinjam'
            ]);
        }
    }
}
