@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-3xl font-semibold text-primary mb-6">Data Loyalty Program</h2>

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

    <!-- Table -->
    <div class="bg-white shadow-md rounded-lg overflow-x-auto">
        <table class="min-w-full table-auto border-collapse border border-gray-200">
            <thead class="bg-secondary text-gray-800">
                <tr>
                    <th class="px-6 py-3 border-b font-semibold text-left text-gray-700">Pelanggan</th>
                    <th class="px-6 py-3 border-b font-semibold text-left text-gray-700">Kode Referral</th>
                    <th class="px-6 py-3 border-b font-semibold text-left text-gray-700">Batas Loyalty</th>
                    <th class="px-6 py-3 border-b font-semibold text-left text-gray-700">Diskon</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @forelse ($loyaltyPrograms as $program)
                <tr class="hover:bg-gray-100 transition-colors duration-200 ease-in-out">
                    <td class="px-6 py-4 border-b text-gray-800">{{ $program->pelanggan->nama_pelanggan ?? 'Tidak Ada' }}</td>
                    <td class="px-6 py-4 border-b text-gray-800">{{ $program->kode_referral }}</td>
                    <td class="px-6 py-4 border-b text-gray-800">{{ $program->batas_loyalty }}x</td>
                    <td class="px-6 py-4 border-b text-gray-800">Rp {{ number_format($program->diskon, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center px-6 py-4 text-gray-500">
                        Tidak ada data program loyalty yang tersedia.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
