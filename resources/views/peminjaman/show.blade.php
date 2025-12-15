<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Peminjaman') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Detail Peminjaman</h3>
                            
                            <div class="space-y-3">
                                <div>
                                    <p class="text-sm text-gray-500">ID Peminjaman</p>
                                    <p class="font-medium">{{ $peminjaman->id_peminjaman }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-gray-500">Nama Anggota</p>
                                    <p class="font-medium">{{ $peminjaman->anggota->nama }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-gray-500">Judul Buku</p>
                                    <p class="font-medium">{{ $peminjaman->buku->judul }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-gray-500">Tanggal Pinjam</p>
                                    <p class="font-medium">{{ $peminjaman->tanggal_pinjam->format('d/m/Y') }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-gray-500">Tanggal Jatuh Tempo</p>
                                    <p class="font-medium">{{ $peminjaman->tanggal_jatuh_tempo->format('d/m/Y') }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Status & Pengembalian</h3>
                            
                            <div class="space-y-3">
                                <div>
                                    <p class="text-sm text-gray-500">Status</p>
                                    <p class="font-medium">
                                        <span class="px-2 py-1 text-xs rounded-full {{ $peminjaman->status == 'dipinjam' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                            {{ $peminjaman->status }}
                                        </span>
                                    </p>
                                </div>
                                
                                @if($peminjaman->pengembalian)
                                    <div>
                                        <p class="text-sm text-gray-500">Tanggal Kembali</p>
                                        <p class="font-medium">{{ $peminjaman->pengembalian->tanggal_kembali->format('d/m/Y') }}</p>
                                    </div>
                                    
                                    <div>
                                        <p class="text-sm text-gray-500">Keterlambatan</p>
                                        <p class="font-medium">{{ $peminjaman->pengembalian->keterlambatan }} hari</p>
                                    </div>
                                    
                                    <div>
                                        <p class="text-sm text-gray-500">Denda</p>
                                        <p class="font-medium">Rp {{ number_format($peminjaman->pengembalian->denda, 0, ',', '.') }}</p>
                                    </div>
                                    
                                    <div>
                                        <p class="text-sm text-gray-500">Status Pembayaran</p>
                                        <p class="font-medium">
                                            <span class="px-2 py-1 text-xs rounded-full {{ $peminjaman->pengembalian->status == 'lunas' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $peminjaman->pengembalian->status }}
                                            </span>
                                        </p>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="mt-6">
                                <a href="{{ route('peminjaman.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded inline-block">
                                    Kembali ke Daftar Peminjaman
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>