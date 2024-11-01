<!-- resources/views/menu/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Data Menu</h2>

    <a href="{{ route('menu.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Menu</a>

    <table class="table-auto w-full bg-white shadow-md rounded mt-4">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2">ID Menu</th>
                <th class="px-4 py-2">Nama Menu</th>
                <th class="px-4 py-2">Deskripsi</th>
                <th class="px-4 py-2">Harga</th>
                <th class="px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($menu as $item)
                <tr>
                    <td class="border px-4 py-2">{{ $item->ID_MENU }}</td>
                    <td class="border px-4 py-2">{{ $item->NAMA_MENU }}</td>
                    <td class="border px-4 py-2">{{ $item->DESKRIPSI_MENU }}</td>
                    <td class="border px-4 py-2">{{ $item->HARGA_MENU }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('menu.edit', $item->ID_MENU) }}" class="text-yellow-600">Edit</a> |
                        <form action="{{ route('menu.destroy', $item->ID_MENU) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
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
