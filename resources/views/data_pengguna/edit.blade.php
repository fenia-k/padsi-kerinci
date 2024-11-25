@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-3xl font-semibold text-[#8B4513] mb-6">Edit Data Pengguna</h2>

    <div class="bg-[#FFF5E1] shadow-md rounded-lg p-6">
        <form action="{{ route('data_pengguna.update', $dataPengguna->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Nama Pengguna -->
            <div class="mb-4">
                <label for="nama_pengguna" class="block text-[#5e2a04] font-semibold mb-2">Nama Pengguna</label>
                <input type="text" name="nama_pengguna" id="nama_pengguna" class="w-full p-2 border border-[#D2B48C] rounded-lg text-black placeholder-gray-500 focus:outline-none focus:border-[#8B4513] @error('nama_pengguna') border-red-500 @enderror" value="{{ old('nama_pengguna', $dataPengguna->nama_pengguna) }}">
                @error('nama_pengguna')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Alamat Pengguna -->
            <div class="mb-4">
                <label for="alamat_pengguna" class="block text-[#5e2a04] font-semibold mb-2">Alamat Pengguna</label>
                <textarea name="alamat_pengguna" id="alamat_pengguna" class="w-full p-2 border border-[#D2B48C] rounded-lg text-black placeholder-gray-500 focus:outline-none focus:border-[#8B4513] @error('alamat_pengguna') border-red-500 @enderror">{{ old('alamat_pengguna', $dataPengguna->alamat_pengguna) }}</textarea>
                @error('alamat_pengguna')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- No HP Pengguna -->
            <div class="mb-4">
                <label for="noHP_pengguna" class="block text-[#5e2a04] font-semibold mb-2">No HP</label>
                <input type="text" name="noHP_pengguna" id="noHP_pengguna" class="w-full p-2 border border-[#D2B48C] rounded-lg text-black placeholder-gray-500 focus:outline-none focus:border-[#8B4513] @error('noHP_pengguna') border-red-500 @enderror" value="{{ old('noHP_pengguna', $dataPengguna->noHP_pengguna) }}">
                @error('noHP_pengguna')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email Pengguna -->
            <div class="mb-4">
                <label for="email" class="block text-[#5e2a04] font-semibold mb-2">Email</label>
                <input type="email" name="email" id="email" class="w-full p-2 border border-[#D2B48C] rounded-lg text-black placeholder-gray-500 focus:outline-none focus:border-[#8B4513] @error('email') border-red-500 @enderror" value="{{ old('email', $dataPengguna->email) }}">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Role -->
            <div class="mb-4">
                <label for="id_role" class="block text-[#5e2a04] font-semibold mb-2">Role</label>
                <select name="id_role" id="id_role" class="w-full p-2 border border-[#D2B48C] rounded-lg text-black placeholder-gray-500 focus:outline-none focus:border-[#8B4513] @error('id_role') border-red-500 @enderror">
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
