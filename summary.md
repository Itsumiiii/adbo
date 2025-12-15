# Summary - Sistem Peminjaman & Pengembalian Buku
## Perpustakaan Digital "Pustaka Cerdas"

---

## 📋 Overview Sistem

Sistem ini adalah aplikasi perpustakaan digital yang mengelola proses peminjaman dan pengembalian buku dengan fitur validasi kartu anggota, pencatatan transaksi, dan perhitungan denda keterlambatan.

---

## 👥 Aktor Sistem

### 1. Petugas Perpustakaan
- Memvalidasi kartu anggota
- Mencatat peminjaman buku
- Mencatat pengembalian buku
- Menghitung dan mencatat denda

### 2. Anggota Perpustakaan
- Meminjam buku
- Mengembalikan buku
- Membayar denda (jika ada)

---

## 🔄 Alur Proses Bisnis

### Proses Peminjaman
1. Anggota datang ke bagian sirkulasi
2. Anggota menunjukkan kartu anggota
3. Petugas validasi kartu anggota
4. Anggota mencari dan memilih buku
5. Petugas mencatat data peminjaman
6. Anggota membawa pulang buku

### Proses Pengembalian
1. Anggota mengembalikan buku
2. Petugas cek data peminjaman
3. Sistem cek keterlambatan
4. Jika terlambat: anggota bayar denda
5. Petugas catat pengembalian
6. Buku kembali tersedia

---

## 🎯 Use Case

### UC-01: Peminjaman Buku
- **Aktor**: Anggota, Petugas
- **Precondition**: Anggota memiliki kartu valid
- **Postcondition**: Data peminjaman tercatat, buku status dipinjam

### UC-02: Pengembalian Buku
- **Aktor**: Anggota, Petugas
- **Precondition**: Buku dalam status dipinjam
- **Postcondition**: Data pengembalian tercatat, buku tersedia kembali

---

## 🗂️ Database Schema (Laravel Migration)

### 1. Tabel Buku
```php
- id (PK)
- kode_buku (unique)
- judul
- pengarang
- penerbit
- isbn
- tahun_terbit
- kategori
- stok
- status (enum: tersedia, dipinjam)
- timestamps
```

### 2. Tabel Anggota
```php
- id (PK)
- id_anggota (unique)
- nama
- alamat
- no_telepon
- email
- tanggal_daftar
- tanggal_berlaku
- tanggal_expire
- status (enum: aktif, nonaktif)
- timestamps
```

### 3. Tabel Peminjaman
```php
- id (PK)
- id_peminjaman (unique)
- anggota_id (FK)
- buku_id (FK)
- tanggal_pinjam
- tanggal_jatuh_tempo
- status (enum: dipinjam, dikembalikan)
- timestamps
```

### 4. Tabel Pengembalian
```php
- id (PK)
- id_pengembalian (unique)
- peminjaman_id (FK)
- tanggal_kembali
- keterlambatan (integer, hari)
- denda (decimal)
- status (enum: lunas, belum_lunas)
- timestamps
```

---

## 📦 Laravel Models & Relationships

### Model: Buku
```php
class Buku extends Model
{
    protected $fillable = [
        'kode_buku', 'judul', 'pengarang', 'penerbit', 
        'isbn', 'tahun_terbit', 'kategori', 'stok', 'status'
    ];
    
    public function peminjaman() {
        return $this->hasMany(Peminjaman::class);
    }
}
```

### Model: Anggota
```php
class Anggota extends Model
{
    protected $fillable = [
        'id_anggota', 'nama', 'alamat', 'no_telepon', 
        'email', 'tanggal_daftar', 'tanggal_berlaku', 
        'tanggal_expire', 'status'
    ];
    
    public function peminjaman() {
        return $this->hasMany(Peminjaman::class);
    }
}
```

### Model: Peminjaman
```php
class Peminjaman extends Model
{
    protected $fillable = [
        'id_peminjaman', 'anggota_id', 'buku_id',
        'tanggal_pinjam', 'tanggal_jatuh_tempo', 'status'
    ];
    
    public function anggota() {
        return $this->belongsTo(Anggota::class);
    }
    
    public function buku() {
        return $this->belongsTo(Buku::class);
    }
    
    public function pengembalian() {
        return $this->hasOne(Pengembalian::class);
    }
}
```

### Model: Pengembalian
```php
class Pengembalian extends Model
{
    protected $fillable = [
        'id_pengembalian', 'peminjaman_id', 'tanggal_kembali',
        'keterlambatan', 'denda', 'status'
    ];
    
    public function peminjaman() {
        return $this->belongsTo(Peminjaman::class);
    }
}
```

---

## 🎨 Struktur Menu Sistem

### Dashboard Petugas
```
📊 Dashboard
├── 📚 Manajemen Buku
│   ├── Daftar Buku
│   ├── Tambah Buku
│   ├── Edit Buku
│   └── Hapus Buku
│
├── 👥 Manajemen Anggota
│   ├── Daftar Anggota
│   ├── Tambah Anggota
│   ├── Edit Anggota
│   └── Status Anggota
│
├── 📤 Peminjaman
│   ├── Proses Peminjaman
│   ├── Daftar Peminjaman Aktif
│   └── Riwayat Peminjaman
│
├── 📥 Pengembalian
│   ├── Proses Pengembalian
│   ├── Hitung Denda
│   └── Riwayat Pengembalian
│
└── 📊 Laporan
    ├── Laporan Peminjaman
    ├── Laporan Pengembalian
    └── Laporan Denda
```

---

## 🚀 Laravel Routes

```php
// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index']);

// Buku
Route::resource('buku', BukuController::class);

// Anggota
Route::resource('anggota', AnggotaController::class);

// Peminjaman
Route::get('/peminjaman', [PeminjamanController::class, 'index']);
Route::post('/peminjaman', [PeminjamanController::class, 'store']);
Route::get('/peminjaman/riwayat', [PeminjamanController::class, 'riwayat']);

// Pengembalian
Route::get('/pengembalian', [PengembalianController::class, 'index']);
Route::post('/pengembalian', [PengembalianController::class, 'store']);
Route::post('/pengembalian/hitung-denda', [PengembalianController::class, 'hitungDenda']);

// Laporan
Route::get('/laporan/peminjaman', [LaporanController::class, 'peminjaman']);
Route::get('/laporan/pengembalian', [LaporanController::class, 'pengembalian']);
Route::get('/laporan/denda', [LaporanController::class, 'denda']);
```

---

## 💡 Business Rules

1. **Validasi Kartu**: Anggota harus memiliki kartu valid (status aktif & belum expire)
2. **Ketersediaan Buku**: Buku hanya dapat dipinjam jika status "tersedia" dan stok > 0
3. **Batas Peminjaman**: 7 hari dari tanggal peminjaman
4. **Perhitungan Denda**: Rp 1.000 per hari keterlambatan
5. **Status Buku**: Otomatis berubah saat dipinjam/dikembalikan

---

## 🛠️ Tech Stack

- **Framework**: Laravel 10.x
- **Database**: MySQL
- **Frontend**: Blade Template + Bootstrap 5
- **Authentication**: Laravel Breeze/Jetstream
- **Additional**: DataTables, Select2, SweetAlert2

---

## 📝 Catatan Implementasi

1. Gunakan **Laravel Validation** untuk setiap input form
2. Implementasikan **Soft Deletes** untuk data penting
3. Gunakan **Laravel Events** untuk update status buku otomatis
4. Implementasikan **Middleware** untuk proteksi route petugas
5. Gunakan **Laravel Seeder** untuk data dummy testing

---

**Disusun oleh:**
- Mochamad Faudzan Riga Septiandi (2306099)
- Girah Ismi Nugraha (2306123)
- Cakra Nur Ikhwan (2406177)

**Program Studi Teknik Informatika**  
**Institut Teknologi Garut - 2025**