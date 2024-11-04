@extends('layouts.app')

@section('title', 'Detail Transaksi')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white text-center">
            <h3><i class="fas fa-receipt"></i> Detail Transaksi #{{ $transaksi->id }}</h3>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <p><i class="fas fa-calendar-alt"></i> <strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d M Y') }}</p>
                    <p><i class="fas fa-user"></i> <strong>Kasir/Pegawai:</strong> {{ $transaksi->pengguna->nama_pengguna ?? 'Tidak tersedia' }}</p>
                    <p><i class="fas fa-user"></i> <strong>Pelanggan:</strong> {{ $transaksi->pelanggan->nama_pelanggan ?? 'Umum' }}</p>
                </div>
                <div class="col-md-6">
                    <p><i class="fas fa-tags"></i> <strong>Kode Referral:</strong> {{ $transaksi->kode_referal ?? 'Tidak Ada' }}</p>
                    <p><i class="fas fa-coins"></i> <strong>Diskon:</strong> Rp {{ number_format($transaksi->diskon, 0, ',', '.') }}</p>
                    <p><i class="fas fa-gift"></i> <strong>Poin Digunakan:</strong> {{ $transaksi->poin_digunakan ?? 'Tidak Ada' }}</p>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="alert alert-info">
                        <strong>Total Harga:</strong> Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="alert alert-warning">
                        <strong>Nominal Pembayaran:</strong> Rp {{ number_format($transaksi->nominal, 0, ',', '.') }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="alert alert-success">
                        <strong>Kembalian:</strong> Rp {{ number_format($transaksi->nominal - $transaksi->total_harga, 0, ',', '.') }}
                    </div>
                </div>
            </div>
            <hr>
            <h4 class="text-center mb-4"><i class="fas fa-shopping-cart"></i> Detail Menu</h4>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="bg-light">
                        <tr class="text-center">
                            <th>Gambar</th>
                            <th>Nama Menu</th>
                            <th>Harga Satuan</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">
                                <img src="{{ asset('storage/' . $transaksi->menu->gambar_menu) }}" alt="{{ $transaksi->menu->nama_menu }}" class="img-thumbnail" style="width: 80px; height: 80px;">
                            </td>
                            <td>{{ $transaksi->menu->nama_menu }}</td>
                            <td>Rp {{ number_format($transaksi->menu->harga_menu, 0, ',', '.') }}</td>
                            <td class="text-center">{{ $transaksi->jumlah }}</td>
                            <td>Rp {{ number_format($transaksi->menu->harga_menu * $transaksi->jumlah, 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-center">
            <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</div>

<style>
    .card {
        border-radius: 10px;
    }
    .btn {
        border-radius: 5px;
    }
    .img-thumbnail {
        object-fit: cover;
    }
    .alert {
        border-radius: 8px;
    }
</style>
@endsection

<!-- Pastikan Anda memiliki font-awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
