@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Data Pengguna</h2>

    <!-- Tombol Tambah Pengguna -->
    <a href="{{ route('data_pengguna.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Pengguna</a>

    <!-- Tabel Data Pengguna -->
    <table class="table-auto w-full bg-white shadow-md rounded mt-4">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2">ID Pengguna</th>
                <th class="px-4 py-2">Nama Pengguna</th>
                <th class="px-4 py-2">No HP</th>
                <th class="px-4 py-2">Alamat</th>
                <th class="px-4 py-2">Role</th>
                <th class="px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataPengguna as $pengguna)
                <tr>
                    <td class="border px-4 py-2">{{ $pengguna->ID_PENGGUNA }}</td>
                    <td class="border px-4 py-2">{{ $pengguna->NAMA_PENGGUNA }}</td>
                    <td class="border px-4 py-2">{{ $pengguna->NOHP_PENGGUNA }}</td>
                    <td class="border px-4 py-2">{{ $pengguna->ALAMAT_PENGGUNA }}</td>
                    <td class="border px-4 py-2">{{ $pengguna->ID_ROLE }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('data_pengguna.edit', $pengguna->ID_PENGGUNA) }}" class="text-yellow-600">Edit</a> |
                        <form action="{{ route('data_pengguna.destroy', $pengguna->ID_PENGGUNA) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
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
