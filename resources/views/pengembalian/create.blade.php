<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Proses Pengembalian') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-6">Proses Pengembalian Buku</h3>

                    <form action="{{ route('pengembalian.store') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <label for="peminjaman_id" class="block text-sm font-medium text-gray-700">Peminjaman</label>
                                <select name="peminjaman_id" id="peminjaman_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="">Pilih Peminjaman</option>
                                    @foreach($peminjaman as $item)
                                        <option value="{{ $item->id }}" data-buku-judul="{{ $item->buku->judul }}" data-anggota-nama="{{ $item->anggota->nama }}">
                                            {{ $item->id_peminjaman }} - {{ $item->buku->judul }} ({{ $item->anggota->nama }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('peminjaman_id')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div id="info-peminjaman" class="hidden bg-gray-50 p-4 rounded border">
                                <h4 class="font-medium mb-2">Info Peminjaman</h4>
                                <p><strong>Buku:</strong> <span id="info-buku"></span></p>
                                <p><strong>Anggota:</strong> <span id="info-anggota"></span></p>
                                <p><strong>Tanggal Pinjam:</strong> <span id="info-tanggal-pinjam"></span></p>
                                <p><strong>Tanggal Jatuh Tempo:</strong> <span id="info-tanggal-jatuh-tempo"></span></p>
                            </div>

                            <div id="info-denda" class="hidden bg-yellow-50 p-4 rounded border border-yellow-200">
                                <h4 class="font-medium mb-2">Info Denda</h4>
                                <p><strong>Keterlambatan:</strong> <span id="info-keterlambatan"></span> hari</p>
                                <p><strong>Denda:</strong> Rp <span id="info-denda-amount"></span></p>
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end space-x-3">
                            <a href="{{ route('pengembalian.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Batal
                            </a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Proses Pengembalian
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('peminjaman_id').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            if (selectedOption.value) {
                document.getElementById('info-peminjaman').classList.remove('hidden');
                document.getElementById('info-buku').textContent = selectedOption.dataset.bukuJudul;
                document.getElementById('info-anggota').textContent = selectedOption.dataset.anggotaNama;
                
                // In a real application, we would fetch the actual loan details
                // For now, we are just showing placeholder data
                document.getElementById('info-tanggal-pinjam').textContent = 'Tanggal Pinjam';
                document.getElementById('info-tanggal-jatuh-tempo').textContent = 'Tanggal Jatuh Tempo';
                
                // Calculate denda using AJAX
                fetch('{{ route("pengembalian.hitung-denda") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    body: JSON.stringify({
                        peminjaman_id: selectedOption.value
                    })
                })
                .then(response => response.json())
                .then(data => {
                    document.getElementById('info-denda').classList.remove('hidden');
                    document.getElementById('info-keterlambatan').textContent = data.keterlambatan;
                    document.getElementById('info-denda-amount').textContent = data.denda.toLocaleString();
                });
            } else {
                document.getElementById('info-peminjaman').classList.add('hidden');
                document.getElementById('info-denda').classList.add('hidden');
            }
        });
    </script>
</x-app-layout>