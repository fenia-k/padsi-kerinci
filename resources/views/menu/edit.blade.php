@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-[#FFFFFF] border-[#A0522D] rounded-lg shadow-md">
    <h2 class="text-3xl font-semibold text-[#8B4513] mb-6">Update Menu</h2>

    <div class="bg-[#FFF5E1] shadow-md rounded-lg p-6">
        <form action="{{ route('menu.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="nama_menu" class="block text-[#5e2a04] font-semibold mb-2">Menu</label>
                <input type="text" name="nama_menu" id="nama_menu" class="w-full p-2 border border-[#D2B48C] rounded-lg text-black placeholder-gray-500 focus:outline-none focus:border-[#8B4513] @error('nama_menu') border-red-500 @enderror" value="{{ old('nama_menu', $menu->nama_menu) }}">
                @error('nama_menu')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="harga_menu" class="block text-[#5e2a04] font-semibold mb-2">Price</label>
                <input type="number" name="harga_menu" id="harga_menu" class="w-full p-2 border border-[#D2B48C] rounded-lg text-black placeholder-gray-500 focus:outline-none focus:border-[#8B4513] @error('harga_menu') border-red-500 @enderror" value="{{ old('harga_menu', $menu->harga_menu) }}">
                @error('harga_menu')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="jumlah_menu" class="block text-[#5e2a04] font-semibold mb-2">Quantity</label>
                <input type="number" name="jumlah_menu" id="jumlah_menu" class="w-full p-2 border border-[#D2B48C] rounded-lg text-black placeholder-gray-500 focus:outline-none focus:border-[#8B4513] @error('jumlah_menu') border-red-500 @enderror" value="{{ old('jumlah_menu', $menu->jumlah_menu) }}">
                @error('jumlah_menu')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="deskripsi_menu" class="block text-[#5e2a04] font-semibold mb-2">Description</label>
                <textarea name="deskripsi_menu" id="deskripsi_menu" class="w-full p-2 border border-[#D2B48C] rounded-lg text-black placeholder-gray-500 focus:outline-none focus:border-[#8B4513] @error('deskripsi_menu') border-red-500 @enderror">{{ old('deskripsi_menu', $menu->deskripsi_menu) }}</textarea>
                @error('deskripsi_menu')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="gambar_menu" class="block text-[#5e2a04] font-semibold mb-2">Image</label>
                @if($menu->gambar_menu)
                    <img src="{{ asset('storage/' . $menu->gambar_menu) }}" alt="Gambar Menu" class="w-24 h-24 object-cover rounded mb-2">
                @endif
                <input type="file" name="gambar_menu" id="gambar_menu" class="w-full p-2 border border-[#D2B48C] rounded-lg @error('gambar_menu') border-red-500 @enderror">
                @error('gambar_menu')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-[#8B4513] hover:bg-[#A0522D] text-white font-bold py-2 px-4 rounded-lg">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

<!-- Custom CSS Styling -->
<!-- Custom CSS Styling -->
<style>
    .container {
        max-width: 800px;
        background-color: #fffffe; /* Light cream background */
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-top: 40px;
        padding: 40px;
        border: 1px solid #A0522D;
        border-radius: 8px;
    }

    /* Input styling */
    .form-input {
        width: 100%;
        padding: 0.5rem;
        background-color: #ffffff;
        border: 1px solid #A0522D;
        border-radius: 8px;
        font-size: 1rem;
        color: #4A3B30;
    }

    .form-input:focus {
        border-color: #8B4513;
        outline: none;
    }

    /* Submit button styling */
    .btn-submit {
        background-color: #A0522D;
        color: #FFFFFF;
        font-size: 1rem;
        font-weight: bold;
        padding: 10px 20px;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-submit:hover {
        background-color: #8B4513;
    }

    /* Label styling */
    label {
        font-size: 1rem;
        color: #4A3B30;
        font-weight: bold;
    }

    /* Spacing between form elements */
    .space-y-6 > * + * {
        margin-top: 1.5rem;
    }
</style>
