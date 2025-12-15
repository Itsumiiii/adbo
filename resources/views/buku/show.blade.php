<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Detail Buku</h3>
                            
                            <div class="space-y-3">
                                <div>
                                    <p class="text-sm text-gray-500">Kode Buku</p>
                                    <p class="font-medium">{{ $buku->kode_buku }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-gray-500">Judul</p>
                                    <p class="font-medium">{{ $buku->judul }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-gray-500">Pengarang</p>
                                    <p class="font-medium">{{ $buku->pengarang }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-gray-500">Penerbit</p>
                                    <p class="font-medium">{{ $buku->penerbit }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-gray-500">Tahun Terbit</p>
                                    <p class="font-medium">{{ $buku->tahun_terbit }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-gray-500">Kategori</p>
                                    <p class="font-medium">{{ $buku->kategori }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-gray-500">ISBN</p>
                                    <p class="font-medium">{{ $buku->isbn ?: '-' }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Stok & Status</h3>
                            
                            <div class="space-y-3">
                                <div>
                                    <p class="text-sm text-gray-500">Stok Tersedia</p>
                                    <p class="font-medium">{{ $buku->stok }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-gray-500">Status</p>
                                    <p class="font-medium">
                                        <span class="px-2 py-1 text-xs rounded-full {{ $buku->status == 'tersedia' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            {{ $buku->status }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                            
                            <div class="mt-6">
                                <a href="{{ route('buku.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded inline-block">
                                    Kembali ke Daftar Buku
                                </a>
                                <a href="{{ route('buku.edit', $buku->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-block ml-2">
                                    Edit
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>