<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Anggota;

class AnggotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();
        
        Anggota::create([
            'id_anggota' => 'A001',
            'nama' => 'Joko Widodo',
            'alamat' => 'Jl. Medan Merdeka Utara No. 1, Jakarta',
            'no_telepon' => '021-12345678',
            'email' => 'jokow@example.com',
            'tanggal_daftar' => '2024-01-15',
            'tanggal_berlaku' => '2024-01-15',
            'tanggal_expire' => $now->copy()->addYears(5)->format('Y-m-d'),
            'status' => 'aktif'
        ]);

        Anggota::create([
            'id_anggota' => 'A002',
            'nama' => 'Megawati Sukarnoputri',
            'alamat' => 'Jl. Teuku Umar No. 12, Jakarta',
            'no_telepon' => '021-87654321',
            'email' => 'mega@example.com',
            'tanggal_daftar' => '2024-02-20',
            'tanggal_berlaku' => '2024-02-20',
            'tanggal_expire' => $now->copy()->addYears(5)->format('Y-m-d'),
            'status' => 'aktif'
        ]);

        Anggota::create([
            'id_anggota' => 'A003',
            'nama' => 'Prabowo Subianto',
            'alamat' => 'Jl. Kuningan Raya No. 8, Jakarta',
            'no_telepon' => '021-55566677',
            'email' => 'prabowo@example.com',
            'tanggal_daftar' => '2024-03-10',
            'tanggal_berlaku' => '2024-03-10',
            'tanggal_expire' => $now->copy()->addYears(5)->format('Y-m-d'),
            'status' => 'aktif'
        ]);

        Anggota::create([
            'id_anggota' => 'A004',
            'nama' => 'Anies Baswedan',
            'alamat' => 'Jl. Pegangsaan Timur No. 1, Jakarta',
            'no_telepon' => '021-99988877',
            'email' => 'anies@example.com',
            'tanggal_daftar' => '2024-04-05',
            'tanggal_berlaku' => '2024-04-05',
            'tanggal_expire' => $now->copy()->addYears(5)->format('Y-m-d'),
            'status' => 'aktif'
        ]);

        Anggota::create([
            'id_anggota' => 'A005',
            'nama' => 'Ganjar Pranowo',
            'alamat' => 'Jl. Pandanaran No. 17, Semarang',
            'no_telepon' => '024-77788899',
            'email' => 'ganjar@example.com',
            'tanggal_daftar' => '2024-05-12',
            'tanggal_berlaku' => '2024-05-12',
            'tanggal_expire' => $now->copy()->addYears(5)->format('Y-m-d'),
            'status' => 'aktif'
        ]);
    }
}
