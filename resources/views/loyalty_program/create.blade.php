@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-3xl font-semibold text-primary mb-6">Tambah Program Loyalty</h2>

    <div class="bg-white shadow-md rounded-lg p-6">
        <form action="{{ route('loyalty_program.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="kode_referral" class="block text-gray-700 font-semibold mb-2">Kode Referral</label>
                <input type="text" name="kode_referral" id="kode_referral" class="w-full p-2 border border-gray-300 rounded-lg @error('kode_referral') border-red-500 @enderror" value="{{ old('kode_referral') }}">
                @error('kode_referral')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="batas_loyalty" class="block text-gray-700 font-semibold mb-2">Batas Loyalty</label>
                <input type="number" name="batas_loyalty" id="batas_loyalty" class="w-full p-2 border border-gray-300 rounded-lg @error('batas_loyalty') border-red-500 @enderror" value="{{ old('batas_loyalty') }}">
                @error('batas_loyalty')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="diskon" class="block text-gray-700 font-semibold mb-2">Diskon (%)</label>
                <input type="number" name="diskon" id="diskon" class="w-full p-2 border border-gray-300 rounded-lg @error('diskon') border-red-500 @enderror" value="{{ old('diskon') }}">
                @error('diskon')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="id_pelanggan" class="block text-gray-700 font-semibold mb-2">Pelanggan</label>
                <select name="id_pelanggan" id="id_pelanggan" class="w-full p-2 border border-gray-300 rounded-lg @error('id_pelanggan') border-red-500 @enderror">
                    <option value="">Pilih Pelanggan</option>
                    @foreach($pelanggan as $p)
                        <option value="{{ $p->id }}" {{ old('id_pelanggan') == $p->id ? 'selected' : '' }}>{{ $p->nama_pelanggan }}</option>
                    @endforeach
                </select>
                @error('id_pelanggan')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-primary hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
