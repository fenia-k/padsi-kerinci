<!-- resources/views/data_pelanggan/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Edit Data Pelanggan</h2>

    <!-- Tampilkan pesan error jika ada -->
    @if ($errors->any())
        <div class="bg-red-500 text-white p-4 rounded mb-4">
            <strong>Whoops!</strong> Ada beberapa masalah dengan input Anda.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('data_pelanggan.update', $dataPelanggan->ID_PELANGGAN) }}" method="POST">
        @csrf
        @method('PUT') <!-- Menggunakan metode PUT untuk update data -->

        <div class="mb-4">
            <label for="ID_PELANGGAN" class="block text-gray-700">ID Pelanggan</label>
            <input type="text" name="ID_PELANGGAN" id="ID_PELANGGAN" class="w-full p-2 border rounded" value="{{ $dataPelanggan->ID_PELANGGAN }}" disabled>
        </div>
        <div class="mb-4">
            <label for="NAMA_PELANGGAN" class="block text-gray-700">Nama Pelanggan</label>
            <input type="text" name="NAMA_PELANGGAN" id="NAMA_PELANGGAN" class="w-full p-2 border rounded" value="{{ $dataPelanggan->NAMA_PELANGGAN }}" required>
        </div>
        <div class="mb-4">
            <label for="NOHP_PELANGGAN" class="block text-gray-700">No HP</label>
            <input type="text" name="NOHP_PELANGGAN" id="NOHP_PELANGGAN" class="w-full p-2 border rounded" value="{{ $dataPelanggan->NOHP_PELANGGAN }}" required>
        </div>
        <div class="mb-4">
            <label for="ALAMAT_PELANGGAN" class="block text-gray-700">Alamat</label>
            <input type="text" name="ALAMAT_PELANGGAN" id="ALAMAT_PELANGGAN" class="w-full p-2 border rounded" value="{{ $dataPelanggan->ALAMAT_PELANGGAN }}" required>
        </div>
        <div class="mb-4">
            <label for="KODE_REFERRAL" class="block text-gray-700">Kode Referral (Opsional)</label>
            <input type="text" name="KODE_REFERRAL" id="KODE_REFERRAL" class="w-full p-2 border rounded" value="{{ $dataPelanggan->KODE_REFERRAL }}">
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
@endsection
