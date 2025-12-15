<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold">Daftar Buku</h3>
                        <a href="{{ route('buku.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Tambah Buku
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-4 py-2">Kode Buku</th>
                                    <th class="px-4 py-2">Judul</th>
                                    <th class="px-4 py-2">Pengarang</th>
                                    <th class="px-4 py-2">Penerbit</th>
                                    <th class="px-4 py-2">Tahun Terbit</th>
                                    <th class="px-4 py-2">Kategori</th>
                                    <th class="px-4 py-2">Stok</th>
                                    <th class="px-4 py-2">Status</th>
                                    <th class="px-4 py-2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($buku as $item)
                                <tr class="border-b">
                                    <td class="px-4 py-2">{{ $item->kode_buku }}</td>
                                    <td class="px-4 py-2">{{ $item->judul }}</td>
                                    <td class="px-4 py-2">{{ $item->pengarang }}</td>
                                    <td class="px-4 py-2">{{ $item->penerbit }}</td>
                                    <td class="px-4 py-2">{{ $item->tahun_terbit }}</td>
                                    <td class="px-4 py-2">{{ $item->kategori }}</td>
                                    <td class="px-4 py-2">{{ $item->stok }}</td>
                                    <td class="px-4 py-2">
                                        <span class="px-2 py-1 text-xs rounded-full {{ $item->status == 'tersedia' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            {{ $item->status }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('buku.show', $item->id) }}" class="text-blue-500 hover:text-blue-700">Lihat</a>
                                            <a href="{{ route('buku.edit', $item->id) }}" class="text-yellow-500 hover:text-yellow-700">Edit</a>
                                            <form action="{{ route('buku.destroy', $item->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>