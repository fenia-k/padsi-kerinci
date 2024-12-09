@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-[#FFFFFF] border-[#A0522D] rounded-lg shadow-md">
    <h2 class="text-3xl font-semibold text-[#8B4513] mb-6" style="color: #A0522D; text-align: center;">Update Stock</h2>

    <div class="bg-[#FFF5E1] shadow-md rounded-lg p-6">
        <form action="{{ route('stok.update', $stok->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label for="nama_stok" class="block text-[#5e2a04] font-semibold mb-2">Stock Name</label>
                <input type="text" name="nama_stok" id="nama_stok" class="w-full p-2 border border-[#D2B48C] rounded-lg text-black placeholder-gray-500 focus:outline-none focus:border-[#8B4513] @error('nama_stok') border-red-500 @enderror" value="{{ old('nama_stok', $stok->nama_stok) }}">
                @error('nama_stok')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="jumlah_stok" class="block text-[#5e2a04] font-semibold mb-2">Quantity</label>
                <input type="number" name="jumlah_stok" id="jumlah_stok" class="w-full p-2 border border-[#D2B48C] rounded-lg text-black placeholder-gray-500 focus:outline-none focus:border-[#8B4513] @error('jumlah_stok') border-red-500 @enderror" value="{{ old('jumlah_stok', $stok->jumlah_stok) }}">
                @error('jumlah_stok')
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