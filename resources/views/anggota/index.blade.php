<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Anggota') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold">Daftar Anggota</h3>
                        <a href="{{ route('anggota.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Tambah Anggota
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
                                    <th class="px-4 py-2">ID Anggota</th>
                                    <th class="px-4 py-2">Nama</th>
                                    <th class="px-4 py-2">Alamat</th>
                                    <th class="px-4 py-2">No. Telepon</th>
                                    <th class="px-4 py-2">Email</th>
                                    <th class="px-4 py-2">Tanggal Berlaku</th>
                                    <th class="px-4 py-2">Tanggal Expire</th>
                                    <th class="px-4 py-2">Status</th>
                                    <th class="px-4 py-2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($anggota as $item)
                                <tr class="border-b">
                                    <td class="px-4 py-2">{{ $item->id_anggota }}</td>
                                    <td class="px-4 py-2">{{ $item->nama }}</td>
                                    <td class="px-4 py-2">{{ $item->alamat }}</td>
                                    <td class="px-4 py-2">{{ $item->no_telepon }}</td>
                                    <td class="px-4 py-2">{{ $item->email }}</td>
                                    <td class="px-4 py-2">{{ $item->tanggal_berlaku->format('d/m/Y') }}</td>
                                    <td class="px-4 py-2">{{ $item->tanggal_expire->format('d/m/Y') }}</td>
                                    <td class="px-4 py-2">
                                        <span class="px-2 py-1 text-xs rounded-full {{ $item->status == 'aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $item->status }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('anggota.show', $item->id) }}" class="text-blue-500 hover:text-blue-700">Lihat</a>
                                            <a href="{{ route('anggota.edit', $item->id) }}" class="text-yellow-500 hover:text-yellow-700">Edit</a>
                                            <form action="{{ route('anggota.destroy', $item->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Apakah Anda yakin ingin menghapus anggota ini?')">Hapus</button>
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