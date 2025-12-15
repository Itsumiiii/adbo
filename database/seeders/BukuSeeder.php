<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Buku;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Buku::create([
            'kode_buku' => 'B001',
            'judul' => 'Pemrograman Laravel untuk Pemula',
            'pengarang' => 'Ahmad Fauzi',
            'penerbit' => 'Elex Media',
            'isbn' => '978-1234-5678-9',
            'tahun_terbit' => 2023,
            'kategori' => 'Pemrograman',
            'stok' => 5,
            'status' => 'tersedia'
        ]);

        Buku::create([
            'kode_buku' => 'B002',
            'judul' => 'Desain Web Responsif',
            'pengarang' => 'Siti Nurhaliza',
            'penerbit' => 'Andi Offset',
            'isbn' => '978-2345-6789-0',
            'tahun_terbit' => 2022,
            'kategori' => 'Desain Web',
            'stok' => 3,
            'status' => 'tersedia'
        ]);

        Buku::create([
            'kode_buku' => 'B003',
            'judul' => 'Machine Learning dengan Python',
            'pengarang' => 'Budi Santoso',
            'penerbit' => 'Gramedia',
            'isbn' => '978-3456-7890-1',
            'tahun_terbit' => 2024,
            'kategori' => 'AI',
            'stok' => 4,
            'status' => 'tersedia'
        ]);

        Buku::create([
            'kode_buku' => 'B004',
            'judul' => 'Kamus Bahasa Indonesia',
            'pengarang' => 'Pusat Bahasa',
            'penerbit' => 'Balai Pustaka',
            'isbn' => '978-4567-8901-2',
            'tahun_terbit' => 2021,
            'kategori' => 'Kamus',
            'stok' => 7,
            'status' => 'tersedia'
        ]);

        Buku::create([
            'kode_buku' => 'B005',
            'judul' => 'Algoritma dan Struktur Data',
            'pengarang' => 'Rizki Pratama',
            'penerbit' => 'Informatika',
            'isbn' => '978-5678-9012-3',
            'tahun_terbit' => 2023,
            'kategori' => 'Ilmu Komputer',
            'stok' => 2,
            'status' => 'tersedia'
        ]);
    }
}
