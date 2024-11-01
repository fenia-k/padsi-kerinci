<!-- resources/views/transaksi_penjualan/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Transaksi Penjualan</h2>

    <a href="{{ route('transaksi_penjualan.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Transaksi</a>

    <table class="table-auto w-full bg-white shadow-md rounded mt-4">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2">Nomor Faktur</th>
                <th class="px-4 py-2">ID Pelanggan</th>
                <th class="px-4 py-2">ID Pengguna</th>
                <th class="px-4 py-2">Tanggal Penjualan</th>
                <th class="px-4 py-2">Total Harga</th>
                <th class="px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksiPenjualan as $transaksi)
                <tr>
                    <td class="border px-4 py-2">{{ $transaksi->NOMOR_FAKTUR }}</td>
                    <td class="border px-4 py-2">{{ $transaksi->ID_PELANGGAN }}</td>
                    <td class="border px-4 py-2">{{ $transaksi->ID_PENGGUNA }}</td>
                    <td class="border px-4 py-2">{{ $transaksi->TANGGAL_PENJUALAN }}</td>
                    <td class="border px-4 py-2">{{ $transaksi->TOTAL_HARGA }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('transaksi_penjualan.edit', $transaksi->NOMOR_FAKTUR) }}" class="text-yellow-600">Edit</a> |
                        <form action="{{ route('transaksi_penjualan.destroy', $transaksi->NOMOR_FAKTUR) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
