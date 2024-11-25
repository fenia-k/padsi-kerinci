@extends('layouts.app')

@section('content')
<div class="container mt-4 bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-3xl font-semibold text-[#8B4513] mb-6">Laporan</h2>

    <!-- Form Filter by Date -->
    <div class="card mb-4">
        <div class="card-header bg-[#D2B48C] text-[#4A3B30] font-semibold">Filter Transaksi</div>
        <div class="card-body">
            <form method="GET" action="{{ route('laporan.index') }}">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="start_date" class="form-label">Tanggal Mulai</label>
                        <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="end_date" class="form-label">Tanggal Selesai</label>
                        <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary me-2">Filter</button>
                        <a href="{{ route('laporan.index') }}" class="btn btn-secondary me-2">Reset</a>
                        <a href="{{ route('laporan.export') }}" class="btn btn-success">Export to PDF</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Total Laporan -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="text-secondary">Total Laporan: {{ $transaksi->total() }}</h5>
        <a href="{{ route('transaksi.index') }}" class="bg-[#8B4513] hover:bg-[#A0522D] text-white font-bold py-2 px-4 rounded-lg shadow-lg transition duration-300 ease-in-out">Kembali ke Transaksi</a>
    </div>

    <!-- Table Laporan Transaksi -->
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-header text-center">
                <tr>
                    <th scope="col">Pelanggan</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Total Harga</th>
                    <th scope="col">Detail Produk</th>
                    <th scope="col">Poin Digunakan</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transaksi as $trans)
                <tr>
                    <td class="text-center" data-bs-toggle="tooltip" title="{{ $trans->pelanggan->nama_pelanggan ?? 'Umum' }}">{{ $trans->pelanggan->nama_pelanggan ?? 'Umum' }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($trans->tanggal_transaksi)->format('d M Y') }}</td>
                    <td class="text-end text-success">Rp {{ number_format($trans->total_harga, 0, ',', '.') }}</td>
                    <td>
                        @if($trans->detailTransaksi->isNotEmpty())
                            <ul class="list-unstyled mb-0">
                                @foreach ($trans->detailTransaksi as $detail)
                                    <li>{{ $detail->menu->nama_menu }} x {{ $detail->jumlah_pesanan }}</li>
                                @endforeach
                            </ul>
                        @else
                            <span class="text-muted">Tidak ada detail produk</span>
                        @endif
                    </td>
                    <td class="text-end">{{ $trans->poin_digunakan ?? 0 }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">Tidak ada data transaksi</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $transaksi->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection

<!-- Tambahkan CSS dan Penyesuaian -->
<style>
    .container {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .card-header {
        background-color: #D2B48C; /* Warna header filter transaksi sama dengan tabel */
        color: #4A3B30;
    }
    .table th, .table td {
        vertical-align: middle;
        padding: 12px 15px;
    }
    .table-header {
        background-color: #D2B48C; /* Warna header tabel */
        color: #4A3B30;
    }
    .table-hover tbody tr:hover {
        background-color: #F5DEB3;
    }
    .btn {
        border-radius: 5px;
    }
    .btn-primary {
        background-color: #8B4513;
        border-color: #8B4513;
        color: #ffffff;
    }
    .btn-primary:hover {
        background-color: #8B4520;
        border-color: #8B4520;
    }
    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
        color: #ffffff;
    }
    .btn-success:hover {
        background-color: #218838;
        border-color: #218838;
    }
    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
        color: #ffffff;
    }
    .btn-secondary:hover {
        background-color: #5a6268;
        border-color: #5a6268;
    }
</style>

<!-- Tambahkan Bootstrap Tooltip Script -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    });
</script>
