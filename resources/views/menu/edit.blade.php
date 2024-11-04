@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-3xl font-semibold text-primary mb-6">Edit Menu</h2>

    <div class="bg-white shadow-md rounded-lg p-6">
        <form action="{{ route('menu.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="nama_menu" class="block text-gray-700 font-semibold mb-2">Nama Menu</label>
                <input type="text" name="nama_menu" id="nama_menu" class="w-full p-2 border border-gray-300 rounded-lg @error('nama_menu') border-red-500 @enderror" value="{{ old('nama_menu', $menu->nama_menu) }}">
                @error('nama_menu')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="harga_menu" class="block text-gray-700 font-semibold mb-2">Harga</label>
                <input type="number" name="harga_menu" id="harga_menu" class="w-full p-2 border border-gray-300 rounded-lg @error('harga_menu') border-red-500 @enderror" value="{{ old('harga_menu', $menu->harga_menu) }}">
                @error('harga_menu')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="jumlah_menu" class="block text-gray-700 font-semibold mb-2">Jumlah</label>
                <input type="number" name="jumlah_menu" id="jumlah_menu" class="w-full p-2 border border-gray-300 rounded-lg @error('jumlah_menu') border-red-500 @enderror" value="{{ old('jumlah_menu', $menu->jumlah_menu) }}">
                @error('jumlah_menu')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="deskripsi_menu" class="block text-gray-700 font-semibold mb-2">Deskripsi</label>
                <textarea name="deskripsi_menu" id="deskripsi_menu" class="w-full p-2 border border-gray-300 rounded-lg @error('deskripsi_menu') border-red-500 @enderror">{{ old('deskripsi_menu', $menu->deskripsi_menu) }}</textarea>
                @error('deskripsi_menu')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="gambar_menu" class="block text-gray-700 font-semibold mb-2">Gambar Menu</label>
                @if($menu->gambar_menu)
                    <img src="{{ asset('storage/' . $menu->gambar_menu) }}" alt="Gambar Menu" class="w-24 h-24 object-cover rounded mb-2">
                @endif
                <input type="file" name="gambar_menu" id="gambar_menu" class="w-full p-2 border border-gray-300 rounded-lg @error('gambar_menu') border-red-500 @enderror">
                @error('gambar_menu')
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
