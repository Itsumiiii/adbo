<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Anggota') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Detail Anggota</h3>
                            
                            <div class="space-y-3">
                                <div>
                                    <p class="text-sm text-gray-500">ID Anggota</p>
                                    <p class="font-medium">{{ $anggota->id_anggota }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-gray-500">Nama</p>
                                    <p class="font-medium">{{ $anggota->nama }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-gray-500">Alamat</p>
                                    <p class="font-medium">{{ $anggota->alamat ?: '-' }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-gray-500">No. Telepon</p>
                                    <p class="font-medium">{{ $anggota->no_telepon ?: '-' }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-gray-500">Email</p>
                                    <p class="font-medium">{{ $anggota->email ?: '-' }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Tanggal & Status</h3>
                            
                            <div class="space-y-3">
                                <div>
                                    <p class="text-sm text-gray-500">Tanggal Daftar</p>
                                    <p class="font-medium">{{ $anggota->tanggal_daftar ? $anggota->tanggal_daftar->format('d/m/Y') : '-' }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-gray-500">Tanggal Berlaku</p>
                                    <p class="font-medium">{{ $anggota->tanggal_berlaku ? $anggota->tanggal_berlaku->format('d/m/Y') : '-' }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-gray-500">Tanggal Expire</p>
                                    <p class="font-medium">{{ $anggota->tanggal_expire ? $anggota->tanggal_expire->format('d/m/Y') : '-' }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-gray-500">Status</p>
                                    <p class="font-medium">
                                        <span class="px-2 py-1 text-xs rounded-full {{ $anggota->status == 'aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $anggota->status }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                            
                            <div class="mt-6">
                                <a href="{{ route('anggota.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded inline-block">
                                    Kembali ke Daftar Anggota
                                </a>
                                <a href="{{ route('anggota.edit', $anggota) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-block ml-2">
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