@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-3xl font-semibold text-primary mb-6">Data Menu</h2>

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
        <a href="{{ route('menu.create') }}" class="bg-primary hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-lg transition duration-300 ease-in-out">
            + Tambah Menu
        </a>
    </div>

    <!-- Table -->
    <div class="bg-white shadow-md rounded-lg overflow-x-auto">
        <table class="min-w-full table-auto border-collapse border border-gray-200">
            <thead class="bg-secondary text-gray-800">
                <tr>
                    <th class="px-6 py-3 border-b font-semibold text-left text-gray-700">Gambar</th>
                    <th class="px-6 py-3 border-b font-semibold text-left text-gray-700">Nama Menu</th>
                    <th class="px-6 py-3 border-b font-semibold text-left text-gray-700">Deskripsi</th>
                    <th class="px-6 py-3 border-b font-semibold text-left text-gray-700">Harga</th>
                    <th class="px-6 py-3 border-b font-semibold text-left text-gray-700">Jumlah</th>
                    <th class="px-6 py-3 border-b font-semibold text-left text-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @forelse ($menus as $menu)
                <tr class="hover:bg-gray-100 transition-colors duration-200 ease-in-out">
                    <td class="px-6 py-4 border-b text-gray-800">
                        @if($menu->gambar_menu)
                            <img src="{{ asset('storage/' . $menu->gambar_menu) }}" alt="Gambar Menu" class="w-16 h-16 object-cover rounded">
                        @else
                            Tidak ada gambar
                        @endif
                    </td>
                    <td class="px-6 py-4 border-b text-gray-800">{{ $menu->nama_menu }}</td>
                    <td class="px-6 py-4 border-b text-gray-800">{{ $menu->deskripsi_menu }}</td>
                    <td class="px-6 py-4 border-b text-gray-800">{{ $menu->harga_menu }}</td>
                    <td class="px-6 py-4 border-b text-gray-800">{{ $menu->jumlah_menu }}</td>
                    <td class="px-6 py-4 border-b">
                        <a href="{{ route('menu.edit', $menu->id) }}" class="text-yellow-500 hover:text-yellow-600 font-semibold px-3 py-1 rounded-lg transition duration-300 ease-in-out">
                            Edit
                        </a>
                        <form action="{{ route('menu.destroy', $menu->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-danger hover:text-red-700 font-semibold px-3 py-1 rounded-lg transition duration-300 ease-in-out"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus menu ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center px-6 py-4 text-gray-500">
                        Tidak ada data menu yang tersedia.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
