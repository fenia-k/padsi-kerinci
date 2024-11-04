@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-3xl font-semibold text-primary mb-6">Edit Data Pelanggan</h2>

    <div class="bg-white shadow-md rounded-lg p-6">
        <form action="{{ route('data_pelanggan.update', $dataPelanggan->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="nama_pelanggan" class="block text-gray-700 font-semibold mb-2">Nama Pelanggan</label>
                <input type="text" name="nama_pelanggan" id="nama_pelanggan" class="w-full p-2 border border-gray-300 rounded-lg @error('nama_pelanggan') border-red-500 @enderror" value="{{ old('nama_pelanggan', $dataPelanggan->nama_pelanggan) }}">
                @error('nama_pelanggan')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="alamat_pelanggan" class="block text-gray-700 font-semibold mb-2">Alamat Pelanggan</label>
                <textarea name="alamat_pelanggan" id="alamat_pelanggan" class="w-full p-2 border border-gray-300 rounded-lg @error('alamat_pelanggan') border-red-500 @enderror">{{ old('alamat_pelanggan', $dataPelanggan->alamat_pelanggan) }}</textarea>
                @error('alamat_pelanggan')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="noHP_pelanggan" class="block text-gray-700 font-semibold mb-2">No HP</label>
                <input type="text" name="noHP_pelanggan" id="noHP_pelanggan" class="w-full p-2 border border-gray-300 rounded-lg @error('noHP_pelanggan') border-red-500 @enderror" value="{{ old('noHP_pelanggan', $dataPelanggan->noHP_pelanggan) }}">
                @error('noHP_pelanggan')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-primary hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                    Perbarui
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
    