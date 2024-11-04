@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center text-primary">Daftar Transaksi</h2>

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

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="text-secondary">Total Transaksi: {{ $transaksi->count() }}</h5>
        <a href="{{ route('transaksi.create') }}" class="btn btn-primary btn-sm">Tambah Transaksi</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-primary">
                <tr>
                    <th scope="col" class="text-center">Menu</th>
                    <th scope="col" class="text-center">Jumlah</th>
                    <th scope="col" class="text-center">Total Harga</th>
                    <th scope="col" class="text-center">Tanggal</th>
                    <th scope="col" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksi as $trans)
                <tr>
                    <td class="text-center">{{ $trans->menu->nama_menu }}</td>
                    <td class="text-center">{{ $trans->jumlah }}</td>
                    <td class="text-end text-success">Rp {{ number_format($trans->total_harga, 0, ',', '.') }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($trans->tanggal_transaksi)->format('d M Y') }}</td>
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
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Bootstrap Icons (optional) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet">

<style>
    .container {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }
    .table th, .table td {
        vertical-align: middle;
    }
    .table-primary {
        background-color: #0d6efd;
        color: #ffffff;
    }
    .table-bordered {
        border-color: #dee2e6;
    }
    .btn {
        border-radius: 5px;
    }
    .btn-info {
        background-color: #0dcaf0;
        border-color: #0dcaf0;
        color: #ffffff;
    }
    .btn-warning {
        background-color: #ffc107;
        border-color: #ffc107;
        color: #212529;
    }
    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
        color: #ffffff;
    }
    .btn-primary {
        background-color: #0d6efd;
        border-color: #0d6efd;
        color: #ffffff;
    }
    .btn-sm {
        padding: 0.25rem 0.5rem;
    }
    .gap-2 > * {
        margin-right: 0.5rem; /* Space between buttons */
    }
</style>
@endsection
