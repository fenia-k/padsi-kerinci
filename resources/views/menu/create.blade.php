@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6 bg-[#FFF5E1] rounded-lg shadow-md">
        <h2 class="text-3xl font-semibold text-[#8B4513] mb-6" style="color: #A0522D; text-align: center;">Create Menu</h2>

        {{-- <div class="card shadow-sm rounded-lg p-4 border-0"> --}}
        <form action="{{ route('menu.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="nama_menu" class="block text-[#5e2a04] font-semibold mb-2">Menu</label>
                <input type="text" name="nama_menu" id="nama_menu"
                    class="w-full p-2 border border-[#D2B48C] rounded-lg text-black @error('nama_menu') border-red-500 @enderror"
                    value="{{ old('nama_menu') }}" placeholder="Input menu">
                @error('nama_menu')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="harga_menu" class="block text-[#5e2a04] font-semibold mb-2">Price</label>
                <input type="number" name="harga_menu" id="harga_menu"
                    class="w-full p-2 border border-[#D2B48C] rounded-lg text-black @error('harga_menu') border-red-500 @enderror"
                    value="{{ old('harga_menu') }}" placeholder="Input price">
                @error('harga_menu')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="jumlah_menu" class="block text-[#5e2a04] font-semibold mb-2">Quantity</label>
                <input type="number" name="jumlah_menu" id="jumlah_menu"
                    class="w-full p-2 border border-[#D2B48C] rounded-lg text-black @error('jumlah_menu') border-red-500 @enderror"
                    value="{{ old('jumlah_menu') }}" placeholder="Input quantity">
                @error('jumlah_menu')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="deskripsi_menu" class="block text-[#5e2a04] font-semibold mb-2">Description</label>
                <textarea name="deskripsi_menu" id="deskripsi_menu"
                    class="w-full p-2 border border-[#D2B48C] rounded-lg text-black @error('deskripsi_menu') border-red-500 @enderror"
                    placeholder="Input description">{{ old('deskripsi_menu') }}</textarea>
                @error('deskripsi_menu')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="gambar_menu" class="block text-[#5e2a04] font-semibold mb-2">Image</label>
                <input type="file" name="gambar_menu" id="gambar_menu"
                    class="w-full p-2 border border-[#D2B48C] rounded-lg @error('gambar_menu') border-red-500 @enderror">
                @error('gambar_menu')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-[#8B4513] hover:bg-[#A0522D] text-white font-bold py-2 px-4 rounded-lg">
                    Save
                </button>
            </div>
        </form>
    </div>
    </div>
@endsection

<!-- Custom CSS Styling -->
<style>
    .container {
        max-width: 600px;
        background-color: #ffffff; 
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-top: 40px;
        padding: 40px;
        border: 1px solid #A0522D;
    }

    input[type="file"] {
        color: #000000;
        /* Mengubah warna teks kecil "No file chosen" */
    }

    .bg-[#FFF5E1] {
        background-color: #FFF5E1;
        /* Light cream background */
    }

    .text-[#5e2a04] {
        color: #5e2a04;
        /* Dark brown for labels */
    }

    .form-control {
        color: #000000;
        /* Black text when typing */
    }

    .bg-[#8B4513]:hover {
        background-color: #A0522D;
        transition: background-color 0.3s ease;
    }

    .btn {
        background-color: #8B4513;
        /* Button brown */
        border-color: #8B4513;
    }

    .invalid-feedback {
        font-size: 0.875rem;
    }

    .text-red-500 {
    color: #D9534F; /* Soft red */
    font-size: 0.875rem;
}

</style>
