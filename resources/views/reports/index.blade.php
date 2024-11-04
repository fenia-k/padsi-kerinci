<!-- resources/views/reports/referral.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-3xl font-semibold mb-6">Laporan Referral</h2>

    <p>Total Poin yang Diberikan: {{ $totalPoin }} poin</p>
    <p>Total Penggunaan Referral: {{ $totalReferralUsed }} kali</p>

    <div class="bg-white shadow-md rounded-lg overflow-x-auto mt-4">
        <table class="min-w-full table-auto border-collapse border border-gray-200">
            <thead class="bg-secondary text-gray-800">
                <tr>
                    <th class="px-6 py-3 border-b font-semibold text-left">Referrer</th>
                    <th class="px-6 py-3 border-b font-semibold text-left">Pengguna Baru</th>
                    <th class="px-6 py-3 border-b font-semibold text-left">Poin Diberikan</th>
                    <th class="px-6 py-3 border-b font-semibold text-left">Tanggal Penggunaan</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach ($referrals as $referral)
                    <tr class="hover:bg-gray-100">
                        <td class="px-6 py-4 border-b">{{ $referral->referrer->nama_pelanggan }}</td>
                        <td class="px-6 py-4 border-b">{{ $referral->referred->nama_pelanggan }}</td>
                        <td class="px-6 py-4 border-b">{{ $referral->poin }} poin</td>
                        <td class="px-6 py-4 border-b">{{ $referral->used_at->format('d-m-Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
