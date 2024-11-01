<!-- resources/views/data_pelanggan/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Data Pelanggan</h2>

    <!-- Pesan Sukses -->
    @if(session('success'))
        <div class="bg-green-500 text-white p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tombol Tambah Pelanggan -->
    <a href="{{ route('data_pelanggan.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Pelanggan</a>

    <!-- Tabel Data Pelanggan -->
    <table class="table-auto w-full bg-white shadow-md rounded mt-4">
    <thead>
        <tr class="bg-gray-200">
            <th class="px-4 py-2">ID Pelanggan</th>
            <th class="px-4 py-2">Nama</th>
            <th class="px-4 py-2">No HP</th>
            <th class="px-4 py-2">Alamat</th>
            <th class="px-4 py-2">Kode Referral</th>
            <th class="px-4 py-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dataPelanggan as $pelanggan)
            <tr>
                <td class="border px-4 py-2">{{ $pelanggan->ID_PELANGGAN }}</td>
                <td class="border px-4 py-2">{{ $pelanggan->NAMA_PELANGGAN }}</td>
                <td class="border px-4 py-2">{{ $pelanggan->NOHP_PELANGGAN }}</td>
                <td class="border px-4 py-2">{{ $pelanggan->ALAMAT_PELANGGAN }}</td>
                <td class="border px-4 py-2">{{ $pelanggan->KODE_REFERRAL ?? '-' }}</td>
                <td class="border px-4 py-2"> 
                    <a href="{{ route('data_pelanggan.edit', $pelanggan->ID_PELANGGAN) }}" class="text-yellow-600">Edit</a> 
                    <form action="{{ route('data_pelanggan.destroy', $pelanggan->ID_PELANGGAN) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
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
