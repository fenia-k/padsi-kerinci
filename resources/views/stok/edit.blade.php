@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-3xl font-semibold text-[#8B4513] mb-6">Edit Stok</h2>

    <div class="bg-[#FFF5E1] shadow-md rounded-lg p-6">
        <form action="{{ route('stok.update', $stok->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label for="nama_stok" class="block text-[#5e2a04] font-semibold mb-2">Nama Stok</label>
                <input type="text" name="nama_stok" id="nama_stok" class="w-full p-2 border border-[#D2B48C] rounded-lg text-black placeholder-gray-500 focus:outline-none focus:border-[#8B4513] @error('nama_stok') border-red-500 @enderror" value="{{ old('nama_stok', $stok->nama_stok) }}">
                @error('nama_stok')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="jumlah_stok" class="block text-[#5e2a04] font-semibold mb-2">Jumlah Stok</label>
                <input type="number" name="jumlah_stok" id="jumlah_stok" class="w-full p-2 border border-[#D2B48C] rounded-lg text-black placeholder-gray-500 focus:outline-none focus:border-[#8B4513] @error('jumlah_stok') border-red-500 @enderror" value="{{ old('jumlah_stok', $stok->jumlah_stok) }}">
                @error('jumlah_stok')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-[#8B4513] hover:bg-[#A0522D] text-white font-bold py-2 px-4 rounded-lg">
                    Perbarui
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

<!-- Custom CSS Styling -->
<style>
    .container {
        max-width: 800px;
    }

    .bg-[#FFF5E1] {
        background-color: #FFF5E1; /* Light cream background */
    }

    .text-[#5e2a04] {
        color: #5e2a04; /* Dark brown for labels */
    }

    .form-control {
        color: #000000; /* Black text when typing */
    }

    .btn:hover {
        background-color: #A0522D;
        border-color: #A0522D;
    }

    .btn {
        background-color: #8B4513; /* Button brown */
        border-color: #8B4513;
    }

    .invalid-feedback {
        font-size: 0.875rem;
    }
</style>
