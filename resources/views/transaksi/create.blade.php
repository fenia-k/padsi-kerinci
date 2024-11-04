@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-3xl font-semibold text-primary mb-6">Tambah Transaksi</h2>

    <div class="bg-white shadow-md rounded-lg p-6">
        <form action="{{ route('transaksi.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="total_harga" class="block text-gray-700 font-semibold mb-2">Total Harga</label>
                <input type="number" name="total_harga" id="total_harga" class="w-full p-2 border border-gray-300 rounded-lg @error('total_harga') border-red-500 @enderror" value="{{ old('total_harga') }}" placeholder="Masukkan total harga transaksi">
                @error('total_harga')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="nominal" class="block text-gray-700 font-semibold mb-2">Nominal yang Dibayarkan</label>
                <input type="number" name="nominal" id="nominal" class="w-full p-2 border border-gray-300 rounded-lg @error('nominal') border-red-500 @enderror" value="{{ old('nominal') }}" placeholder="Masukkan nominal pembayaran">
                @error('nominal')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="tanggal_transaksi" class="block text-gray-700 font-semibold mb-2">Tanggal Transaksi</label>
                <input type="date" name="tanggal_transaksi" id="tanggal_transaksi" class="w-full p-2 border border-gray-300 rounded-lg @error('tanggal_transaksi') border-red-500 @enderror" value="{{ old('tanggal_transaksi') }}">
                @error('tanggal_transaksi')
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

            <div class="mb-4">
                <label for="id_pengguna" class="block text-gray-700 font-semibold mb-2">Pengguna (Kasir)</label>
                <select name="id_pengguna" id="id_pengguna" class="w-full p-2 border border-gray-300 rounded-lg @error('id_pengguna') border-red-500 @enderror">
                    <option value="">Pilih Pengguna</option>
                    @foreach($pengguna as $u)
                        <option value="{{ $u->id }}" {{ old('id_pengguna') == $u->id ? 'selected' : '' }}>{{ $u->nama_pengguna }}</option>
                    @endforeach
                </select>
                @error('id_pengguna')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tambahan Kode Referral -->
            <div class="mb-4">
                <label for="kode_referal" class="block text-gray-700 font-semibold mb-2">Kode Referral (opsional)</label>
                <input type="text" name="kode_referal" id="kode_referal" class="w-full p-2 border border-gray-300 rounded-lg @error('kode_referal') border-red-500 @enderror" value="{{ old('kode_referal') }}" placeholder="Masukkan kode referral jika ada">
                @error('kode_referal')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-primary hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                    Simpan
                </button>
                <a href="{{ route('transaksi.index') }}" class="ml-3 text-gray-700 font-semibold py-2 px-4 rounded-lg border border-gray-300 hover:bg-gray-100 transition duration-300">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
