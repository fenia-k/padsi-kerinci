@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Loyalty Program</h2>

    <a href="{{ route('loyalty_program.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Program Loyalty</a>

    <table class="table-auto w-full bg-white shadow-md rounded mt-4">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2">ID Rujukan</th>
                <th class="px-4 py-2">ID Pelanggan</th>
                <th class="px-4 py-2">Kode Referral</th>
                <th class="px-4 py-2">Batas Rujukan</th>
                <th class="px-4 py-2">Status</th>
                <th class="px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($loyaltyProgram as $program)
                <tr>
                    <td class="border px-4 py-2">{{ $program->ID_RUJUKAN }}</td>
                    <td class="border px-4 py-2">{{ $program->ID_PELANGGAN }}</td>
                    <td class="border px-4 py-2">{{ $program->KODE_REFERRAL }}</td>
                    <td class="border px-4 py-2">{{ $program->BATAS_RUJUKAN }}</td>
                    <td class="border px-4 py-2">{{ $program->STATUS }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('loyalty_program.edit', $program->ID_RUJUKAN) }}" class="text-yellow-600">Edit</a> |
                        <form action="{{ route('loyalty_program.destroy', $program->ID_RUJUKAN) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
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
