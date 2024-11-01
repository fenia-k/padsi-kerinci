@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Laporan</h2>

    <a href="{{ route('laporan.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Laporan</a>

    <table class="table-auto w-full bg-white shadow-md rounded mt-4">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2">ID Laporan</th>
                <th class="px-4 py-2">Nomor Faktur</th>
                <th class="px-4 py-2">Jenis Laporan</th>
                <th class="px-4 py-2">Tanggal Laporan</th>
                <th class="px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laporan as $item)
                <tr>
                    <td class="border px-4 py-2">{{ $item->ID_LAPORAN }}</td>
                    <td class="border px-4 py-2">{{ $item->NOMOR_FAKTUR }}</td>
                    <td class="border px-4 py-2">{{ $item->JENIS_LAPORAN }}</td>
                    <td class="border px-4 py-2">{{ $item->TANGGAL_LAPORAN }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('laporan.edit', $item->ID_LAPORAN) }}" class="text-yellow-600">Edit</a> |
                        <form action="{{ route('laporan.destroy', $item->ID_LAPORAN) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
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
