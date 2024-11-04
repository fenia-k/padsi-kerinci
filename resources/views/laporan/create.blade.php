@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-3xl font-semibold text-primary mb-6">Tambah Laporan</h2>

    <div class="bg-white shadow-md rounded-lg p-6">
        <form action="{{ route('laporan.store') }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label for="judul_laporan" class="block text-gray-700 font-semibold mb-2">Judul Laporan</label>
                <input type="text" name="judul_laporan" id="judul_laporan" class="w-full p-2 border border-gray-300 rounded-lg @error('judul_laporan') border-red-500 @enderror" value="{{ old('judul_laporan') }}">
                @error('judul_laporan')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="deskripsi_laporan" class="block text-gray-700 font-semibold mb-2">Deskripsi Laporan</label>
                <textarea name="deskripsi_laporan" id="deskripsi_laporan" class="w-full p-2 border border-gray-300 rounded-lg @error('deskripsi_laporan') border-red-500 @enderror">{{ old('deskripsi_laporan') }}</textarea>
                @error('deskripsi_laporan')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="tanggal_laporan" class="block text-gray-700 font-semibold mb-2">Tanggal Laporan</label>
                <input type="date" name="tanggal_laporan" id="tanggal_laporan" class="w-full p-2 border border-gray-300 rounded-lg @error('tanggal_laporan') border-red-500 @enderror" value="{{ old('tanggal_laporan') }}">
                @error('tanggal_laporan')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="total_pendapatan" class="block text-gray-700 font-semibold mb-2">Total Pendapatan</label>
                <input type="number" name="total_pendapatan" id="total_pendapatan" class="w-full p-2 border border-gray-300 rounded-lg @error('total_pendapatan') border-red-500 @enderror" value="{{ old('total_pendapatan') }}">
                @error('total_pendapatan')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-primary hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
