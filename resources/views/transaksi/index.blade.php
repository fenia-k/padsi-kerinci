@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="text-3xl font-semibold text-[#8B4513] mb-6">Transaksi Penjualan</h2>

    <!-- Notifikasi Pesan -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Button Tambah Transaksi dan Jumlah Total Transaksi -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="text-secondary">Total Transaksi: {{ $transaksi->total() }}</h5>
        <a href="{{ route('transaksi.create') }}" class="bg-[#8B4513] hover:bg-[#A0522D] text-white font-bold py-2 px-4 rounded-lg shadow-lg transition duration-300 ease-in-out">
            Tambah Transaksi
        </a>
    </div>

    <!-- Tabel Transaksi -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-primary">
                <tr>
                    <th scope="col" class="text-center" style="width: 20%;">Pelanggan</th>
                    <th scope="col" class="text-center" style="width: 15%;">Tanggal</th>
                    <th scope="col" class="text-center" style="width: 15%;">Total Harga</th>
                    <th scope="col" class="text-center" style="width: 35%;">Detail Produk</th>
                    <th scope="col" class="text-center" style="width: 15%;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transaksi as $trans)
                <tr>
                    <td class="text-center">
                        {{ $trans->pelanggan->nama_pelanggan ?? 'Umum' }}
                    </td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($trans->tanggal_transaksi)->format('d M Y') }}</td>
                    <td class="text-end text-success">Rp {{ number_format($trans->total_harga, 0, ',', '.') }}</td>
                    <td>
                        <ul class="list-unstyled">
                            @forelse ($trans->detailTransaksi as $detail)
                                <li>{{ $detail->menu->nama_menu }} x {{ $detail->jumlah_pesanan }}</li>
                            @empty
                                <li class="text-danger">Detail tidak tersedia</li>
                            @endforelse
                        </ul>
                    </td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('transaksi.detail', $trans->id) }}" class="btn btn-info btn-sm" title="Detail">
                                <i class="bi bi-eye"></i>
                            </a>
                        
                            <form action="{{ route('transaksi.destroy', $trans->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')" title="Hapus" style="min-width: 2.5rem;">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data transaksi.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $transaksi->links() }}
    </div>
</div>

<!-- Bootstrap Icons (optional) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet">

<!-- Styling -->
<style>
    .container {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }
    .table th, .table td {
        vertical-align: middle;
        padding: 8px 10px;
    }
    .table-primary {
        background-color: #fd0de9;
        color: #ffffff;
    }
    .btn {
        border-radius: 5px;
    }
    .btn-info {
        background-color: #0dcaf0;
        border-color: #0dcaf0;
        color: #ffffff;
    }
    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
        color: #ffffff;
    }
    .btn-sm {
        padding: 0.25rem 0.5rem;
    }
    .gap-2 > * {
        margin-right: 0.5rem;
    }
</style>
@endsection
