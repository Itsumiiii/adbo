<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Welcome Banner -->
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-2xl shadow-xl mb-8 p-8 text-white relative overflow-hidden">
                <div class="relative z-10">
                    <h1 class="text-3xl font-extrabold mb-2">Selamat Datang di Pustaka Cerdas! 👋</h1>
                    <p class="text-indigo-100 text-lg max-w-2xl">Sistem manajemen perpustakaan modern untuk pengelolaan buku, anggota, dan transaksi peminjaman yang lebih efisien.</p>
                </div>
                <!-- Decorative Circles -->
                <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-white opacity-10 rounded-full"></div>
                <div class="absolute bottom-0 right-20 -mb-10 w-24 h-24 bg-white opacity-10 rounded-full"></div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Buku Card -->
                <div class="bg-white overflow-hidden shadow-lg rounded-2xl border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 bg-blue-100 rounded-xl text-blue-600">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </div>
                            <span class="text-xs font-semibold px-2 py-1 bg-blue-50 text-blue-600 rounded-full">Koleksi</span>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-800 mb-1">{{ $totalBuku }}</h3>
                        <p class="text-gray-500 text-sm">Total Judul Buku</p>
                    </div>
                    <div class="h-1 w-full bg-blue-500"></div>
                </div>

                <!-- Total Anggota Card -->
                <div class="bg-white overflow-hidden shadow-lg rounded-2xl border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 bg-green-100 rounded-xl text-green-600">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <span class="text-xs font-semibold px-2 py-1 bg-green-50 text-green-600 rounded-full">Pengguna</span>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-800 mb-1">{{ $totalAnggota }}</h3>
                        <p class="text-gray-500 text-sm">Anggota Terdaftar</p>
                    </div>
                     <div class="h-1 w-full bg-green-500"></div>
                </div>

                <!-- Peminjaman Card -->
                <div class="bg-white overflow-hidden shadow-lg rounded-2xl border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                             <div class="p-3 bg-yellow-100 rounded-xl text-yellow-600">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <span class="text-xs font-semibold px-2 py-1 bg-yellow-50 text-yellow-600 rounded-full">Transaksi</span>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-800 mb-1">{{ $totalPeminjaman }}</h3>
                        <p class="text-gray-500 text-sm">Sedang Dipinjam</p>
                    </div>
                     <div class="h-1 w-full bg-yellow-500"></div>
                </div>

                <!-- Pengembalian Card -->
                <div class="bg-white overflow-hidden shadow-lg rounded-2xl border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                           <div class="p-3 bg-red-100 rounded-xl text-red-600">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <span class="text-xs font-semibold px-2 py-1 bg-red-50 text-red-600 rounded-full">Selesai</span>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-800 mb-1">{{ $totalPengembalian }}</h3>
                        <p class="text-gray-500 text-sm">Total Dikembalikan</p>
                    </div>
                     <div class="h-1 w-full bg-red-500"></div>
                </div>
            </div>

            <!-- Quick Actions Grid -->
            <div class="mb-8">
                 <h3 class="text-lg font-bold text-gray-700 mb-4 px-1">Akses Cepat</h3>
                 <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    
                    <!-- Box 1 -->
                    <a href="{{ route('peminjaman.index') }}" class="group relative bg-white p-6 rounded-2xl shadow-sm border border-gray-200 hover:shadow-lg transition-all duration-300 hover:-translate-y-1 overflow-hidden">
                        <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                             <svg class="w-24 h-24 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </div>
                        <div class="flex items-center gap-4 mb-3">
                            <div class="p-3 bg-indigo-50 text-indigo-600 rounded-lg group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                            </div>
                            <h4 class="text-lg font-bold text-gray-800">Transaksi Baru</h4>
                        </div>
                        <p class="text-gray-500 text-sm">Buat transaksi peminjaman buku baru untuk anggota.</p>
                    </a>

                    <!-- Box 2 -->
                    <a href="{{ route('anggota.index') }}" class="group relative bg-white p-6 rounded-2xl shadow-sm border border-gray-200 hover:shadow-lg transition-all duration-300 hover:-translate-y-1 overflow-hidden">
                         <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                             <svg class="w-24 h-24 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                            </svg>
                        </div>
                        <div class="flex items-center gap-4 mb-3">
                            <div class="p-3 bg-green-50 text-green-600 rounded-lg group-hover:bg-green-600 group-hover:text-white transition-colors">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                </svg>
                            </div>
                            <h4 class="text-lg font-bold text-gray-800">Tambah Anggota</h4>
                        </div>
                        <p class="text-gray-500 text-sm">Daftarkan anggota perpustakaan baru ke dalam sistem.</p>
                    </a>

                    <!-- Box 3 -->
                    <a href="{{ route('buku.index') }}" class="group relative bg-white p-6 rounded-2xl shadow-sm border border-gray-200 hover:shadow-lg transition-all duration-300 hover:-translate-y-1 overflow-hidden">
                        <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                             <svg class="w-24 h-24 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <div class="flex items-center gap-4 mb-3">
                            <div class="p-3 bg-pink-50 text-pink-600 rounded-lg group-hover:bg-pink-600 group-hover:text-white transition-colors">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </div>
                            <h4 class="text-lg font-bold text-gray-800">Tambah Buku</h4>
                        </div>
                        <p class="text-gray-500 text-sm">Masukkan koleksi buku baru ke database perpustakaan.</p>
                    </a>

                 </div>
            </div>
            
        </div>
    </div>
</x-app-layout>
