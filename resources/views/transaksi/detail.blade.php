@extends('layouts.app')

@section('title', 'Detail Transaksi')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white text-center">
            <h3><i class="fas fa-receipt"></i> Detail Transaksi #{{ $transaksi->id }}</h3>
        </div>
        <div class="card-body">
            <!-- Informasi Transaksi -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <p><i class="fas fa-calendar-alt"></i> <strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d M Y') }}</p>
                    <p><i class="fas fa-user"></i> <strong>Kasir/Pegawai:</strong> {{ $transaksi->pengguna->nama_pengguna ?? 'Tidak tersedia' }}</p>
                    <p><i class="fas fa-user"></i> <strong>Pelanggan:</strong> {{ $transaksi->pelanggan->nama_pelanggan ?? 'Umum' }}</p>
                </div>
                <div class="col-md-6">
                    <p><i class="fas fa-tags"></i> <strong>Kode Referral:</strong> {{ $transaksi->kode_referal ?? 'Tidak Ada' }}</p>
                    <p><i class="fas fa-gift"></i> <strong>Poin Digunakan:</strong> {{ $transaksi->poin_digunakan ?? 'Tidak Ada' }}</p>
                </div>
            </div>

            <!-- Ringkasan Pembayaran -->
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
                        <strong>Kembalian:</strong>
                        @if($transaksi->nominal >= $transaksi->total_harga && $transaksi->nominal > 0)
                            Rp {{ number_format($transaksi->nominal - $transaksi->total_harga, 0, ',', '.') }}
                        @else
                            <span class="text-danger">Nominal pembayaran kurang</span>
                        @endif
                    </div>
                </div>
            </div>

            <hr>

            <!-- Detail Menu dalam Transaksi -->
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
                        @foreach($transaksi->detailTransaksi as $detail)
                            <tr>
                                <td class="text-center">
                                    @if($detail->menu && $detail->menu->gambar_menu)
                                        <img src="{{ asset('storage/' . $detail->menu->gambar_menu) }}" alt="{{ $detail->menu->nama_menu }}" class="img-thumbnail" style="width: 80px; height: 80px;">
                                    @else
                                        <p>Tidak ada gambar</p>
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

<!-- Pastikan Anda memiliki font-awesome untuk ikon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
