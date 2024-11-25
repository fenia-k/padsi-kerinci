@extends('layouts.app')

@section('title', 'Tambah Pengguna')

@section('content')
<div class="container mx-auto p-6 bg-[#FFF5E1] rounded-lg shadow-md">
    <h2 class="text-3xl font-semibold text-[#8B4513] mb-6">Tambah Pengguna</h2>

    <form action="{{ route('data_pengguna.store') }}" method="POST" class="space-y-6">
        @csrf
        
        <!-- Nama Pengguna -->
        <div class="flex flex-col">
            <label for="nama_pengguna" class="text-[#4A3B30] font-semibold">Nama Pengguna</label>
            <input type="text" name="nama_pengguna" id="nama_pengguna" class="form-input text-black border-[#A0522D] rounded-lg mt-2" value="{{ old('nama_pengguna') }}" placeholder="Masukkan nama pengguna" required>
        </div>

        <!-- Email -->
        <div class="flex flex-col">
            <label for="email" class="text-[#4A3B30] font-semibold">Email</label>
            <input type="email" name="email" id="email" class="form-input text-black border-[#A0522D] rounded-lg mt-2" value="{{ old('email') }}" placeholder="Masukkan email" required>
        </div>

        <!-- Alamat Pengguna -->
        <div class="flex flex-col">
            <label for="alamat_pengguna" class="text-[#4A3B30] font-semibold">Alamat Pengguna</label>
            <input type="text" name="alamat_pengguna" id="alamat_pengguna" class="form-input text-black border-[#A0522D] rounded-lg mt-2" value="{{ old('alamat_pengguna') }}" placeholder="Masukkan alamat pengguna" required>
        </div>

        <!-- Nomor HP -->
        <div class="flex flex-col">
            <label for="noHP_pengguna" class="text-[#4A3B30] font-semibold">Nomor HP</label>
            <input type="text" name="noHP_pengguna" id="noHP_pengguna" class="form-input text-black border-[#A0522D] rounded-lg mt-2" value="{{ old('noHP_pengguna') }}" placeholder="Masukkan nomor HP pengguna" required>
        </div>

        <!-- Role -->
        <div class="flex flex-col">
            <label for="id_role" class="text-[#4A3B30] font-semibold">Role</label>
            <select name="id_role" id="id_role" class="form-input text-black border-[#A0522D] rounded-lg mt-2" required>
                @if($roles->isEmpty())
                    <option value="">Tidak ada role yang tersedia</option>
                @else
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->nama_role }}</option>
                    @endforeach
                @endif
            </select>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
            <input type="submit" value="Simpan" class="btn-submit">
        </div>
    </form>
</div>
@endsection

<!-- CSS untuk form styling -->
<style>
    /* Container styling */
    .container {
        max-width: 600px;
        background-color: #FFF5E1; /* Light cream background */
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-top: 40px;
        padding: 30px;
    }

    /* Input styling */
    .form-input {
        width: 100%;
        padding: 0.5rem;
        background-color: #FFF5E1;
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
