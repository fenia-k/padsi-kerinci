@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-[#FFFFFF] border-[#A0522D] rounded-lg shadow-md">
    <h2 class="text-3xl font-semibold text-[#8B4513] mb-6" style="color: #A0522D; text-align: center;">Update User Data</h2>

    {{-- <div class="card shadow-sm rounded-lg p-4 border-0"> --}}
        <form action="{{ route('data_pengguna.update', $dataPengguna->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Nama Pengguna -->
            <div class="flex flex-col">
                <label for="nama_pengguna" class="block text-[#5e2a04] font-semibold">Username</label>
                <input type="text" name="nama_pengguna" id="nama_pengguna" class="form-control text-black border-[#A0522D] rounded-lg mt-2 @error('nama_pengguna') border-red-500 @enderror" value="{{ old('nama_pengguna', $dataPengguna->nama_pengguna) }}">
                @error('nama_pengguna')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Alamat Pengguna -->
            <div class="flex flex-col">
                <label for="alamat_pengguna" class="block text-[#5e2a04] font-semibold mb-2">User Address</label>
                <textarea name="alamat_pengguna" id="alamat_pengguna" class="form-control text-black border-[#A0522D] rounded-lg mt-2 @error('alamat_pengguna') border-red-500 @enderror">{{ old('alamat_pengguna', $dataPengguna->alamat_pengguna) }}</textarea>
                @error('alamat_pengguna')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- No HP Pengguna -->
            <div class="flex flex-col">
                <label for="noHP_pengguna" class="block text-[#5e2a04] font-semibold mb-2">Phone Number</label>
                <input type="text" name="noHP_pengguna" id="noHP_pengguna" class="form-control text-black border-[#A0522D] rounded-lg mt-2 @error('noHP_pengguna') border-red-500 @enderror" value="{{ old('noHP_pengguna', $dataPengguna->noHP_pengguna) }}">
                @error('noHP_pengguna')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email Pengguna -->
            <div class="flex flex-col">
                <label for="email" class="block text-[#5e2a04] font-semibold mb-2">Email</label>
                <input type="email" name="email" id="email" class="form-control text-black border-[#A0522D] rounded-lg mt-2 @error('email') border-red-500 @enderror" value="{{ old('email', $dataPengguna->email) }}">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Role -->
            <div class="flex flex-col">
                <label for="id_role" class="block text-[#5e2a04] font-semibold mb-2">Role</label>
                <select name="id_role" id="id_role" class="form-control text-black border-[#A0522D] rounded-lg mt-2 @error('id_role') border-red-500 @enderror">
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}" {{ $dataPengguna->id_role == $role->id ? 'selected' : '' }}>{{ $role->nama_role }}</option>
                    @endforeach
                </select>
                @error('id_role')
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