@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center text-primary">Edit Transaksi</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST" class="bg-white shadow-sm rounded p-4">
        @csrf
        @method('PUT')

        <div class="row g-3">
            <!-- Tanggal Transaksi -->
            <div class="col-md-6">
                <label for="tanggal_transaksi" class="form-label">Tanggal Transaksi</label>
                <input type="date" name="tanggal_transaksi" id="tanggal_transaksi" class="form-control" value="{{ $transaksi->tanggal_transaksi }}" required>
            </div>

            <!-- Pilih Menu -->
            <div class="col-md-6">
                <label for="id_menu" class="form-label">Pilih Menu</label>
                <select name="id_menu" id="id_menu" class="form-select" required>
                    @foreach ($menu as $m)
                        <option value="{{ $m->id }}" {{ $transaksi->id_menu == $m->id ? 'selected' : '' }}>
                            {{ $m->nama_menu }} - Rp {{ number_format($m->harga_menu, 0, ',', '.') }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Jumlah -->
            <div class="col-md-6">
                <label for="jumlah" class="form-label">Jumlah</label>
                <input type="number" name="jumlah" id="jumlah" class="form-control" value="{{ $transaksi->jumlah }}" min="1" required>
            </div>

            <!-- Total Harga -->
            <div class="col-md-6">
                <label for="total_harga" class="form-label">Total Harga</label>
                <input type="text" name="total_harga" id="total_harga" class="form-control" value="Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}" readonly>
            </div>

            <!-- Pelanggan -->
            <div class="col-md-12">
                <label for="id_pelanggan" class="form-label">Pelanggan</label>
                <select name="id_pelanggan" id="id_pelanggan" class="form-select">
                    @foreach ($pelanggan as $p)
                        <option value="{{ $p->id }}" {{ $transaksi->id_pelanggan == $p->id ? 'selected' : '' }}>
                            {{ $p->nama_pelanggan }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Kasir -->
            <div class="col-md-12">
                <label for="id_pengguna" class="form-label">Kasir / Pegawai</label>
                <select name="id_pengguna" id="id_pengguna" class="form-select" required>
                    @foreach ($pengguna as $user)
                        <option value="{{ $user->id }}" {{ $transaksi->id_pengguna == $user->id ? 'selected' : '' }}>
                            {{ $user->nama_pengguna }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="d-flex gap-2 mt-4">
            <button type="submit" class="btn btn-success w-100">Simpan Perubahan</button>
            <a href="{{ route('transaksi.index') }}" class="btn btn-secondary w-100">Batal</a>
        </div>
    </form>
</div>

<style>
    .container {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }
    .form-label {
        font-weight: bold;
    }
    .btn {
        border-radius: 5px;
    }
</style>
@endsection
