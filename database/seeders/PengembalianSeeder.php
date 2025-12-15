<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pengembalian;
use App\Models\Peminjaman;

class PengembalianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get some existing data
        $bukuIds = \App\Models\Buku::pluck('id')->toArray();
        $anggotaIds = \App\Models\Anggota::pluck('id')->toArray();

        if (empty($bukuIds) || empty($anggotaIds)) {
            $this->command->info('Tidak ada data buku atau anggota. Seeding pengembalian dibatalkan.');
            return;
        }

        $faker = \Faker\Factory::create('id_ID');

        for ($i = 0; $i < 50; $i++) {
            // 1. Create a Loan (Peminjaman) that is already returned
            $pinjamDate = $faker->dateTimeBetween('-6 months', '-1 month');
            $jatuhTempo = (clone $pinjamDate)->modify('+7 days');
            
            $idPeminjaman = 'PMJ' . $pinjamDate->format('Ymd') . sprintf('%04d', rand(1, 9999)) . $i;

            $peminjaman = Peminjaman::create([
                'id_peminjaman' => $idPeminjaman,
                'anggota_id' => $faker->randomElement($anggotaIds),
                'buku_id' => $faker->randomElement($bukuIds),
                'tanggal_pinjam' => $pinjamDate,
                'tanggal_jatuh_tempo' => $jatuhTempo,
                'status' => 'dikembalikan'
            ]);

            // 2. Create correct Return (Pengembalian) logic
            // Determine if late or on time (70% on time, 30% late)
            $isLate = $faker->boolean(30); 
            
            if ($isLate) {
                // Return 1-14 days late
                $daysLate = $faker->numberBetween(1, 14);
                $kembaliDate = (clone $jatuhTempo)->modify("+$daysLate days");
                $denda = $daysLate * 1000;
            } else {
                // Return 0-5 days early/on time
                $daysEarly = $faker->numberBetween(0, 5);
                $kembaliDate = (clone $jatuhTempo)->modify("-$daysEarly days");
                $daysLate = 0;
                $denda = 0;
            }

            $idPengembalian = 'PKG' . $kembaliDate->format('Ymd') . sprintf('%04d', rand(1, 9999)) . $i;

            Pengembalian::create([
                'id_pengembalian' => $idPengembalian,
                'peminjaman_id' => $peminjaman->id,
                'tanggal_kembali' => $kembaliDate,
                'keterlambatan' => $daysLate,
                'denda' => $denda,
                'status' => 'lunas'
            ]);
        }
    }
}
