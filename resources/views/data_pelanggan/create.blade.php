@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-[#FFF5E1] border-[#A0522D] rounded-lg shadow-md">
    <h2 class="text-3xl font-semibold text-[#8B4513] mb-6" style="color: #A0522D; text-align: center;">Create Customer Data</h2>

    {{-- <div class="card shadow-sm rounded-lg p-4 border-0"> --}}
        <form action="{{ route('data_pelanggan.store') }}" method="POST">
            @csrf

            <div class="flex flex-col">
                <label for="nama_pelanggan" class="text-[#4A3B30] font-semibold">Customer Name</label>
                <input type="text" name="nama_pelanggan" id="nama_pelanggan" class="form-control text-black border-[#A0522D] rounded-lg mt-2 @error('nama_pelanggan') is-invalid @enderror" value="{{ old('nama_pelanggan') }}" placeholder="Input customer name" required>
                @error('nama_pelanggan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex flex-col">
                <label for="alamat_pelanggan" class="text-[#4A3B30] font-semibold">Customer Address</label>
                <textarea name="alamat_pelanggan" id="alamat_pelanggan" class="form-control text-black border-[#A0522D] rounded-lg mt-2 @error('alamat_pelanggan') is-invalid @enderror" placeholder="Input customer address" required>{{ old('alamat_pelanggan') }}</textarea>
                @error('alamat_pelanggan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex flex-col">
                <label for="noHP_pelanggan" class="text-[#4A3B30] font-semibold">Phone Number</label>
                <input type="text" name="noHP_pelanggan" id="noHP_pelanggan" class="form-control text-black border-[#A0522D] rounded-lg mt-2 @error('noHP_pelanggan') is-invalid @enderror" value="{{ old('noHP_pelanggan') }}" placeholder="Input customer phone number" required>
                @error('noHP_pelanggan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex flex-col">
                <label for="kode_referal_input" class="text-[#4A3B30] font-semibold">Referral Code<small class="text-muted">(optional)</small></label>
                <input type="text" name="kode_referal_input" id="kode_referal_input" class="form-control text-black border-[#A0522D] rounded-lg mt-2 @error('kode_referal_input') is-invalid @enderror" value="{{ old('kode_referal_input') }}" placeholder="Input referral code">
                @error('kode_referal_input')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" value="Simpan" class="btn-submit text-white font-bold" style="background-color: #8B4513; border-color: #8B4513;">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    .container {
        max-width: 2000px;
        background-color: #ffffff; /* Light cream background */
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
    /* .card {
        background-color: #ffffff;
    } */
    .form-label {
        font-size: 1rem;
        color: #4A3B30;
        font-weight: bold;
    }
    /* .form-control {
        color: #000000; */
    /* } */ 
    /* .form-control:focus {
        border-color: #fa1d09;
        box-shadow: none; */
    /* } */
    .invalid-feedback {
        font-size: 0.875rem;
    }
    /* .text-[#8B4513] {
        color: #8B4513;
    } */
    /* .text-[#5e2a04] {
        color: #5e2a04; */
    /* }  */
    .btn:hover {
        background-color: #A0522D;
        border-color: #A0522D;
    }
    /* Spacing between form elements */
    .space-y-6 > * + * {
        margin-top: 1.5rem;
    }
</style>
@endsection