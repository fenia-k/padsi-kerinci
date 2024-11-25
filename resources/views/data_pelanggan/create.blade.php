@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-3xl font-weight-bold text-[#8B4513] mb-4">Tambah Data Pelanggan</h2>

    <div class="card shadow-sm rounded-lg p-4 border-0">
        <form action="{{ route('data_pelanggan.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nama_pelanggan" class="form-label fw-bold text-[#5e2a04]">Nama Pelanggan</label>
                <input type="text" name="nama_pelanggan" id="nama_pelanggan" class="form-control text-black border border-[#D2B48C] rounded-lg @error('nama_pelanggan') is-invalid @enderror" value="{{ old('nama_pelanggan') }}" placeholder="Masukkan nama pelanggan" required>
                @error('nama_pelanggan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="alamat_pelanggan" class="form-label fw-bold text-[#5e2a04]">Alamat Pelanggan</label>
                <textarea name="alamat_pelanggan" id="alamat_pelanggan" class="form-control text-black border border-[#D2B48C] rounded-lg @error('alamat_pelanggan') is-invalid @enderror" placeholder="Masukkan alamat pelanggan" required>{{ old('alamat_pelanggan') }}</textarea>
                @error('alamat_pelanggan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="noHP_pelanggan" class="form-label fw-bold text-[#5e2a04]">No HP</label>
                <input type="text" name="noHP_pelanggan" id="noHP_pelanggan" class="form-control text-black border border-[#D2B48C] rounded-lg @error('noHP_pelanggan') is-invalid @enderror" value="{{ old('noHP_pelanggan') }}" placeholder="Masukkan nomor HP pelanggan" required>
                @error('noHP_pelanggan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="kode_referal_input" class="form-label fw-bold text-[#5e2a04]">Kode Referral <small class="text-muted">(opsional)</small></label>
                <input type="text" name="kode_referal_input" id="kode_referal_input" class="form-control text-black border border-[#D2B48C] rounded-lg @error('kode_referal_input') is-invalid @enderror" value="{{ old('kode_referal_input') }}" placeholder="Masukkan kode referral">
                @error('kode_referal_input')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-end mt-4">
                <button type="submit" class="btn text-white font-bold px-4 py-2" style="background-color: #8B4513; border-color: #8B4513;">Simpan</button>
            </div>
        </form>
    </div>
</div>

<style>
    .container {
        max-width: 800px;
    }
    .card {
        background-color: #ffffff;
    }
    .form-label {
        font-size: 1rem;
    }
    .form-control {
        color: #000000;
    }
    .form-control:focus {
        border-color: #8B4513;
        box-shadow: none;
    }
    .invalid-feedback {
        font-size: 0.875rem;
    }
    .text-[#8B4513] {
        color: #8B4513;
    }
    .text-[#5e2a04] {
        color: #5e2a04;
    }
    .btn:hover {
        background-color: #A0522D;
        border-color: #A0522D;
    }
</style>
@endsection
