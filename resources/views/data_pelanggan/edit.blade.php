@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-[#FFFFFF] border-[#A0522D] rounded-lg shadow-md">
    <h2 class="text-3xl font-semibold text-[#8B4513] mb-6" style="color: #A0522D; text-align: center;">Update Customer Data</h2>

    {{-- <div class="card shadow-sm rounded-lg p-4 border-0"> --}}
        <form action="{{ route('data_pelanggan.update', $dataPelanggan->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label for="nama_pelanggan" class="block text-[#5e2a04] font-semibold mb-2">Customer Name</label>
                <input type="text" name="nama_pelanggan" id="nama_pelanggan" class="form-control text-black border-[#A0522D] rounded-lg mt-2 @error('nama_pelanggan') border-red-500 @enderror" value="{{ old('nama_pelanggan', $dataPelanggan->nama_pelanggan) }}">
                @error('nama_pelanggan')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="alamat_pelanggan" class="block text-[#5e2a04] font-semibold mb-2">Customer Address</label>
                <textarea name="alamat_pelanggan" id="alamat_pelanggan" class="form-control text-black border-[#A0522D] rounded-lg mt-2  @error('alamat_pelanggan') border-red-500 @enderror">{{ old('alamat_pelanggan', $dataPelanggan->alamat_pelanggan) }}</textarea>
                @error('alamat_pelanggan')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="noHP_pelanggan" class="block text-[#5e2a04] font-semibold mb-2">Phone Number</label>
                <input type="text" name="noHP_pelanggan" id="noHP_pelanggan" class="form-control text-black border-[#A0522D] rounded-lg mt-2 @error('noHP_pelanggan') border-red-500 @enderror" value="{{ old('noHP_pelanggan', $dataPelanggan->noHP_pelanggan) }}">
                @error('noHP_pelanggan')
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
        background-color: #ffffff; /* Light cream background */
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