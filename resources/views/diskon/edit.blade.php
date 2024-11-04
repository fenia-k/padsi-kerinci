@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-3xl font-semibold text-primary mb-6">Edit Diskon</h2>

    <div class="bg-white shadow-md rounded-lg p-6">
        <form action="{{ route('diskon.update', $diskon->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="harga_diskon" class="block text-gray-700 font-semibold mb-2">Harga Diskon</label>
                <input type="number" name="harga_diskon" id="harga_diskon" class="w-full p-2 border border-gray-300 rounded-lg @error('harga_diskon') border-red-500 @enderror" value="{{ old('harga_diskon', $diskon->harga_diskon) }}">
                @error('harga_diskon')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="batas_pemakaian" class="block text-gray-700 font-semibold mb-2">Batas Pemakaian</label>
                <input type="number" name="batas_pemakaian" id="batas_pemakaian" class="w-full p-2 border border-gray-300 rounded-lg @error('batas_pemakaian') border-red-500 @enderror" value="{{ old('batas_pemakaian', $diskon->batas_pemakaian) }}">
                @error('batas_pemakaian')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="id_pelanggan" class="block text-gray-700 font-semibold mb-2">Pelanggan</label>
                <select name="id_pelanggan" id="id_pelanggan" class="w-full p-2 border border-gray-300 rounded-lg @error('id_pelanggan') border-red-500 @enderror">
                    <option value="">Pilih Pelanggan</option>
                    @foreach($pelanggan as $p)
                        <option value="{{ $p->id }}" {{ old('id_pelanggan', $diskon->id_pelanggan) == $p->id ? 'selected' : '' }}>{{ $p->nama_pelanggan }}</option>
                    @endforeach
                </select>
                @error('id_pelanggan')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-primary hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                    Perbarui
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
