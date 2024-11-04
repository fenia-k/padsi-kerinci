@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-3xl font-semibold text-primary mb-6">Data Transaksi</h2>

    <!-- Notifikasi Pesan -->
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <!-- Button Tambah Data -->
    <div class="flex justify-end mb-4">
        <a href="{{ route('transaksi.create') }}" class="bg-primary hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-lg transition duration-300 ease-in-out">
            + Tambah Transaksi
        </a>
    </div>

    <!-- Table -->
    <div class="bg-white shadow-md rounded-lg overflow-x-auto">
        <table class="min-w-full table-auto border-collapse border border-gray-200">
            <thead class="bg-secondary text-gray-800">
                <tr>
                    <th class="px-6 py-3 border-b font-semibold text-left text-gray-700">Pelanggan</th>
                    <th class="px-6 py-3 border-b font-semibold text-left text-gray-700">Pengguna</th>
                    <th class="px-6 py-3 border-b font-semibold text-left text-gray-700">Tanggal Transaksi</th>
                    <th class="px-6 py-3 border-b font-semibold text-left text-gray-700">Total Harga</th>
                    <th class="px-6 py-3 border-b font-semibold text-left text-gray-700">Diskon</th>
                    <th class="px-6 py-3 border-b font-semibold text-left text-gray-700">Nominal Akhir</th>
                    <th class="px-6 py-3 border-b font-semibold text-left text-gray-700">Kode Referral</th>
                    <th class="px-6 py-3 border-b font-semibold text-left text-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @forelse ($transaksi as $item)
                <tr class="hover:bg-gray-100 transition-colors duration-200 ease-in-out">
                    <td class="px-6 py-4 border-b text-gray-800">{{ $item->pelanggan->nama_pelanggan ?? 'Tidak Ada' }}</td>
                    <td class="px-6 py-4 border-b text-gray-800">{{ $item->pengguna->nama_pengguna ?? 'Tidak Ada' }}</td>
                    <td class="px-6 py-4 border-b text-gray-800">{{ \Carbon\Carbon::parse($item->tanggal_transaksi)->format('d-m-Y') }}</td>
                    <td class="px-6 py-4 border-b text-gray-800">Rp {{ number_format($item->total_harga, 2) }}</td>
                    <td class="px-6 py-4 border-b text-gray-800">Rp {{ number_format($item->diskon ?? 0, 2) }}</td>
                    <td class="px-6 py-4 border-b text-gray-800">Rp {{ number_format($item->total_harga - ($item->diskon ?? 0), 2) }}</td>
                    <td class="px-6 py-4 border-b text-gray-800">{{ $item->kode_referal ?? '-' }}</td>
                    <td class="px-6 py-4 border-b">
                        <a href="{{ route('transaksi.edit', $item->id) }}" class="text-yellow-500 hover:text-yellow-600 font-semibold px-3 py-1 rounded-lg transition duration-300 ease-in-out">
                            Edit
                        </a>
                        <form action="{{ route('transaksi.destroy', $item->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-danger hover:text-red-700 font-semibold px-3 py-1 rounded-lg transition duration-300 ease-in-out"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center px-6 py-4 text-gray-500">
                        Tidak ada data transaksi yang tersedia.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
