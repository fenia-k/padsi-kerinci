@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4 text-4xl font-semibold text-[#8B4513]">Dashboard</h1>

    <!-- Statistik Utama -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-8">
        <div class="p-6 bg-blue-500 text-white rounded-lg shadow-md flex items-center">
            <i class="fas fa-users text-3xl mr-4"></i>
            <div>
                <h5 class="text-lg font-semibold">Total Pelanggan</h5>
                <h3 class="text-2xl">{{ $totalPelanggan }}</h3>
            </div>
        </div>
        <div class="p-6 bg-green-500 text-white rounded-lg shadow-md flex items-center">
            <i class="fas fa-user-shield text-3xl mr-4"></i>
            <div>
                <h5 class="text-lg font-semibold">Total Pengguna</h5>
                <h3 class="text-2xl">{{ $totalPengguna }}</h3>
            </div>
        </div>
        <div class="p-6 bg-yellow-500 text-white rounded-lg shadow-md flex items-center">
            <i class="fas fa-box text-3xl mr-4"></i>
            <div>
                <h5 class="text-lg font-semibold">Total Produk</h5>
                <h3 class="text-2xl">{{ $totalProduk }}</h3>
            </div>
        </div>
        <div class="p-6 bg-red-500 text-white rounded-lg shadow-md flex items-center">
            <i class="fas fa-gift text-3xl mr-4"></i>
            <div>
                <h5 class="text-lg font-semibold">Program Loyalitas</h5>
                <h3 class="text-2xl">{{ $totalLoyaltyProgram }}</h3>
            </div>
        </div>
    </div>

    <!-- Grafik Transaksi Bulanan -->
    <div class="mt-8">
        <h4 class="text-xl font-semibold mb-4 text-[#8B4513]">Transaksi Bulanan</h4>
        <canvas id="transaksiBulananChart"></canvas>
    </div>

    <!-- Pie Chart Distribusi Produk -->
    <div class="mt-8">
        <h4 class="text-xl font-semibold mb-4 text-[#8B4513]">Distribusi Produk Terjual</h4>
        <canvas id="produkTerjualChart"></canvas>
    </div>
</div>

<!-- Script untuk Grafik -->
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Transaksi Bulanan
    const transaksiBulananCtx = document.getElementById('transaksiBulananChart').getContext('2d');
    new Chart(transaksiBulananCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($transaksiBulanan->pluck('bulan')) !!},
            datasets: [{
                label: 'Jumlah Transaksi',
                data: {!! json_encode($transaksiBulanan->pluck('jumlah')) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true },
            }
        }
    });

    // Distribusi Produk Terjual
    const produkTerjualCtx = document.getElementById('produkTerjualChart').getContext('2d');
    new Chart(produkTerjualCtx, {
        type: 'pie',
        data: {
            labels: {!! json_encode($produkTerlaris->pluck('nama_menu')) !!},
            datasets: [{
                data: {!! json_encode($produkTerlaris->pluck('detail_transaksi_count')) !!},
                backgroundColor: [
                    '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'
                ],
            }]
        },
        options: { responsive: true }
    });
</script>
@endpush

<!-- Inline CSS -->
<style>
    .container {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .grid {
        display: grid;
        gap: 20px;
    }

    .grid-cols-4 {
        grid-template-columns: repeat(4, 1fr);
    }

    .grid-cols-2 {
        grid-template-columns: repeat(2, 1fr);
    }

    .rounded-lg {
        border-radius: 0.5rem;
    }

    .shadow-md {
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .bg-blue-500 {
        background-color: #4299e1;
    }

    .bg-green-500 {
        background-color: #48bb78;
    }

    .bg-yellow-500 {
        background-color: #ecc94b;
    }

    .bg-red-500 {
        background-color: #f56565;
    }

    .text-white {
        color: #ffffff;
    }

    .text-2xl {
        font-size: 1.5rem;
    }

    .text-lg {
        font-size: 1.125rem;
    }

    .text-xl {
        font-size: 1.25rem;
    }
</style>
@endsection
