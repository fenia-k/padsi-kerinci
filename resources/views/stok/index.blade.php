<!-- resources/views/stok/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Data Stok</h2>

    <a href="{{ route('stok.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Stok</a>

    <table class="table-auto w-full bg-white shadow-md rounded mt-4">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2">ID Produk</th>
                <th class="px-4 py-2">Nama Produk</th>
                <th class="px-4 py-2">Jumlah</th>
                <th class="px-4 py-2">Status</th>
                <th class="px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stok as $item)
                <tr>
                    <td class="border px-4 py-2">{{ $item->ID_PRODUK }}</td>
                    <td class="border px-4 py-2">{{ $item->NAMA_PRODUK }}</td>
                    <td class="border px-4 py-2">{{ $item->QTY }}</td>
                    <td class="border px-4 py-2">{{ $item->STATUS }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('stok.edit', $item->ID_PRODUK) }}" class="text-yellow-600">Edit</a> |
                        <form action="{{ route('stok.destroy', $item->ID_PRODUK) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
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
