<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Laporan Peminjaman') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold">Laporan Peminjaman Buku</h3>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-4 py-2">ID Peminjaman</th>
                                    <th class="px-4 py-2">Nama Anggota</th>
                                    <th class="px-4 py-2">Judul Buku</th>
                                    <th class="px-4 py-2">Tanggal Pinjam</th>
                                    <th class="px-4 py-2">Tanggal Jatuh Tempo</th>
                                    <th class="px-4 py-2">Status</th>
                                    @if(request()->routeIs('laporan.pengembalian'))
                                        <th class="px-4 py-2">Tanggal Kembali</th>
                                        <th class="px-4 py-2">Keterlambatan</th>
                                        <th class="px-4 py-2">Denda</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($peminjaman as $item)
                                <tr class="border-b">
                                    <td class="px-4 py-2">{{ $item->id_peminjaman }}</td>
                                    <td class="px-4 py-2">{{ $item->anggota->nama }}</td>
                                    <td class="px-4 py-2">{{ $item->buku->judul }}</td>
                                    <td class="px-4 py-2">{{ $item->tanggal_pinjam->format('d/m/Y') }}</td>
                                    <td class="px-4 py-2">{{ $item->tanggal_jatuh_tempo->format('d/m/Y') }}</td>
                                    <td class="px-4 py-2">
                                        <span class="px-2 py-1 text-xs rounded-full {{ $item->status == 'dipinjam' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                            {{ $item->status }}
                                        </span>
                                    </td>
                                    @if(request()->routeIs('laporan.pengembalian'))
                                        @if($item->pengembalian)
                                            <td class="px-4 py-2">{{ $item->pengembalian->tanggal_kembali->format('d/m/Y') }}</td>
                                            <td class="px-4 py-2">{{ $item->pengembalian->keterlambatan }} hari</td>
                                            <td class="px-4 py-2">Rp {{ number_format($item->pengembalian->denda, 0, ',', '.') }}</td>
                                        @else
                                            <td class="px-4 py-2 text-gray-500">-</td>
                                            <td class="px-4 py-2 text-gray-500">-</td>
                                            <td class="px-4 py-2 text-gray-500">-</td>
                                        @endif
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $peminjaman->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>