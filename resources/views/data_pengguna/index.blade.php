@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-3xl font-semibold text-primary mb-6">Data Pengguna</h2>

    <!-- Button Tambah Data -->
    <div class="flex justify-end mb-4">
        <a href="{{ route('data_pengguna.create') }}" class="bg-primary hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-lg transition duration-300 ease-in-out">
            + Tambah Data
        </a>
    </div>

    <!-- Table -->
    <div class="bg-white shadow-md rounded-lg overflow-x-auto">
        <table class="min-w-full table-auto border-collapse border border-gray-200">
            <thead class="bg-secondary text-gray-800">
                <tr>
                    <th class="px-6 py-3 border-b font-semibold text-left text-gray-700">Nama Pengguna</th>
                    <th class="px-6 py-3 border-b font-semibold text-left text-gray-700">Alamat Pengguna</th>
                    <th class="px-6 py-3 border-b font-semibold text-left text-gray-700">No HP</th>
                    <th class="px-6 py-3 border-b font-semibold text-left text-gray-700">Role</th>
                    <th class="px-6 py-3 border-b font-semibold text-left text-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @forelse ($dataPengguna as $pengguna)
                <tr class="hover:bg-gray-100 transition-colors duration-200 ease-in-out">
                    <td class="px-6 py-4 border-b text-gray-800">{{ $pengguna->nama_pengguna }}</td>
                    <td class="px-6 py-4 border-b text-gray-800">{{ $pengguna->alamat_pengguna }}</td>
                    <td class="px-6 py-4 border-b text-gray-800">{{ $pengguna->noHP_pengguna }}</td>
                    <td class="px-6 py-4 border-b text-gray-800">{{ $pengguna->role->nama_role ?? 'Tidak Ada' }}</td>
                    <td class="px-6 py-4 border-b">
                        <a href="{{ route('data_pengguna.edit', $pengguna->id) }}" class="text-yellow-500 hover:text-yellow-600 font-semibold px-3 py-1 rounded-lg transition duration-300 ease-in-out">
                            Edit
                        </a>
                        <form action="{{ route('data_pengguna.destroy', $pengguna->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-danger hover:text-red-700 font-semibold px-3 py-1 rounded-lg transition duration-300 ease-in-out"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center px-6 py-4 text-gray-500">
                        Tidak ada data yang tersedia.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
