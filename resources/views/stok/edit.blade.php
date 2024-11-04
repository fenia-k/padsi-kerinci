@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-3xl font-semibold text-primary mb-6">Edit Stok</h2>

    <div class="bg-white shadow-md rounded-lg p-6">
        <form action="{{ route('stok.update', $stok->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label for="nama_stok" class="block text-gray-700 font-semibold mb-2">Nama Stok</label>
                <input type="text" name="nama_stok" id="nama_stok" class="w-full p-2 border border-gray-300 rounded-lg @error('nama_stok') border-red-500 @enderror" value="{{ old('nama_stok', $stok->nama_stok) }}">
                @error('nama_stok')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="jumlah_stok" class="block text-gray-700 font-semibold mb-2">Jumlah Stok</label>
                <input type="number" name="jumlah_stok" id="jumlah_stok" class="w-full p-2 border border-gray-300 rounded-lg @error('jumlah_stok') border-red-500 @enderror" value="{{ old('jumlah_stok', $stok->jumlah_stok) }}">
                @error('jumlah_stok')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="harga_menu" class="block text-gray-700 font-semibold mb-2">Harga</label>
                <input type="number" name="harga_menu" id="harga_menu" class="w-full p-2 border border-gray-300 rounded-lg @error('harga_menu') border-red-500 @enderror" value="{{ old('harga_menu', $stok->harga_menu) }}">
                @error('harga_menu')
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
