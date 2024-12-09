@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-[#FFF5E1] rounded-lg shadow-md">
    <h2 class="text-3xl font-semibold text-[#8B4513] mb-6" style="color: #A0522D; text-align: center;">Create Stock</h2>
    
    <form action="{{ route('stok.store') }}" method="POST" class="space-y-6">
        @csrf

        <!-- Nama Stok -->
        <div class="flex flex-col">
            <label for="nama_stok" class="text-[#4A3B30] font-semibold">Stock Name</label>
            <input type="text" name="nama_stok" id="nama_stok" class="form-input text-black border-[#A0522D] rounded-lg mt-2 @error('nama_stok') border-red-500 @enderror" value="{{ old('nama_stok') }}" placeholder="Input Stock Name" required>
            @error('nama_stok')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Jumlah Stok -->
        <div class="flex flex-col">
            <label for="jumlah_stok" class="text-[#4A3B30] font-semibold">Quantity</label>
            <input type="number" name="jumlah_stok" id="jumlah_stok" class="form-input text-black border-[#A0522D] rounded-lg mt-2 @error('jumlah_stok') border-red-500 @enderror" value="{{ old('jumlah_stok') }}" placeholder="Input Quantity" required>
            @error('jumlah_stok')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
            <button type="submit" class="btn-submit text-white font-bold" style="background-color: #8B4513; border-color: #8B4513;">
                Save
            </button>
        </div>
    </form>
</div>
@endsection

<style>
    /* Container styling */
    .container {
        max-width: 600px;
        background-color: #ffffff; 
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-top: 40px;
        padding: 40px;
        border: 1px solid #A0522D;
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
    .space-y-6>*+* {
        margin-top: 1.5rem;
    }
</style>
