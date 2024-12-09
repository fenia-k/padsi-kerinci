@extends('layouts.app')

@section('title', 'Detail Transaksi')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white text-center">
            <h3><i class="fas fa-receipt"></i> Transaction Detail #{{ $transaksi->id }}</h3>
        </div>
        <div class="card-body">
            <!-- Informasi Transaksi -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <p><i class="fas fa-calendar-alt"></i> <strong>Date:</strong> {{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d M Y') }}</p>
                    <p><i class="fas fa-user"></i> <strong>Cashier/Staff:</strong> {{ $transaksi->pengguna->nama_pengguna ?? 'Not Available' }}</p>
                    <p><i class="fas fa-user"></i> <strong>Customer:</strong> {{ $transaksi->pelanggan->nama_pelanggan ?? 'General' }}</p>
                </div>
                <div class="col-md-6">
                    <p><i class="fas fa-tags"></i> <strong>Referral Code:</strong> {{ $transaksi->kode_referal ?? 'There is no code' }}</p>
                    <p><i class="fas fa-gift"></i> <strong>Point Used:</strong> {{ $transaksi->poin_digunakan ?? 'There is no code' }}</p>
                </div>
            </div>

            <!-- Ringkasan Pembayaran -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="alert alert-info">
                        <strong>Total Price:</strong> Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="alert alert-warning">
                        <strong>Nominal Payment:</strong> Rp {{ number_format($transaksi->nominal, 0, ',', '.') }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="alert alert-success">
                        <strong>Change:</strong>
                        @if($transaksi->nominal >= $transaksi->total_harga && $transaksi->nominal > 0)
                            Rp {{ number_format($transaksi->nominal - $transaksi->total_harga, 0, ',', '.') }}
                        @else
                            <span class="text-danger">Nominal value less</span>
                        @endif
                    </div>
                </div>
            </div>

            <hr>

            <!-- Detail Menu dalam Transaksi -->
            <h4 class="text-center mb-4"><i class="fas fa-shopping-cart"></i> Menu Detail</h4>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="bg-light">
                        <tr class="text-center">
                            <th>Image</th>
                            <th>Menu</th>
                            <th>Unit price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transaksi->detailTransaksi as $detail)
                            <tr>
                                <td class="text-center">
                                    @if($detail->menu && $detail->menu->gambar_menu)
                                        <img src="{{ asset('storage/' . $detail->menu->gambar_menu) }}" alt="{{ $detail->menu->nama_menu }}" class="img-thumbnail" style="width: 80px; height: 80px;">
                                    @else
                                        <p>There is no image</p>
                                    @endif
                                </td>
                                <td>{{ $detail->menu->nama_menu ?? 'Menu tidak ditemukan' }}</td>
                                <td>Rp {{ number_format($detail->menu->harga_menu ?? 0, 0, ',', '.') }}</td>
                                <td class="text-center">{{ $detail->jumlah_pesanan }}</td>
                                <td>Rp {{ number_format(($detail->menu->harga_menu ?? 0) * $detail->jumlah_pesanan, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tombol Kembali -->
        <div class="card-footer text-center">
            <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back
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

<!-- Pastikan Anda memiliki font-awesome untuk ikon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
