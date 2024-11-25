@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-3xl font-semibold text-[#8B4513] mb-6">Edit Data Pelanggan</h2>

    <div class="bg-[#FFF5E1] shadow-md rounded-lg p-6">
        <form action="{{ route('data_pelanggan.update', $dataPelanggan->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label for="nama_pelanggan" class="block text-[#5e2a04] font-semibold mb-2">Nama Pelanggan</label>
                <input type="text" name="nama_pelanggan" id="nama_pelanggan" class="w-full p-2 border border-[#D2B48C] rounded-lg text-black placeholder-gray-500 focus:outline-none focus:border-[#8B4513] @error('nama_pelanggan') border-red-500 @enderror" value="{{ old('nama_pelanggan', $dataPelanggan->nama_pelanggan) }}">
                @error('nama_pelanggan')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="alamat_pelanggan" class="block text-[#5e2a04] font-semibold mb-2">Alamat Pelanggan</label>
                <textarea name="alamat_pelanggan" id="alamat_pelanggan" class="w-full p-2 border border-[#D2B48C] rounded-lg text-black placeholder-gray-500 focus:outline-none focus:border-[#8B4513] @error('alamat_pelanggan') border-red-500 @enderror">{{ old('alamat_pelanggan', $dataPelanggan->alamat_pelanggan) }}</textarea>
                @error('alamat_pelanggan')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="noHP_pelanggan" class="block text-[#5e2a04] font-semibold mb-2">No HP</label>
                <input type="text" name="noHP_pelanggan" id="noHP_pelanggan" class="w-full p-2 border border-[#D2B48C] rounded-lg text-black placeholder-gray-500 focus:outline-none focus:border-[#8B4513] @error('noHP_pelanggan') border-red-500 @enderror" value="{{ old('noHP_pelanggan', $dataPelanggan->noHP_pelanggan) }}">
                @error('noHP_pelanggan')
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
