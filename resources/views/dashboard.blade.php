@extends('layouts.app')

@section('content')
<div class="container min-h-screen mx-auto p-6 bg-white">
    <h2 class="text-3xl font-semibold text-[#8B4513] mb-6">Dashboard</h2>

    <!-- Notifications -->
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <!-- Key Statistics (Four Columns) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <!-- Total Customers -->
        <div class="bg-white border-2 border-[#8B4513] p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold text-[#8B4513]">Total Customers</h3>
            <p class="text-2xl font-bold text-red-700">{{ $totalPelanggan }}</p>
        </div>

        <!-- Active Loyalty Programs -->
        <div class="bg-white border-2 border-[#8B4513] p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold text-[#8B4513]">Active Loyalty Programs</h3>
            <p class="text-2xl font-bold text-red-700">{{ $loyaltyAktif }}</p>
        </div>
        
        <!-- Total Transactions -->
        <div class="bg-white border-2 border-[#8B4513] p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold text-[#8B4513]">Total Transactions</h3>
            <p class="text-2xl font-bold text-red-700">{{ $totalTransaksi }}</p>
        </div>

        <!-- Total Revenue -->
        <div class="bg-white border-2 border-[#8B4513] p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold text-[#8B4513]">Total Revenue</h3>
            <p class="text-2xl font-bold text-red-700">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
        </div>
    </div>

    <!-- Top Products and Monthly Revenue Graphs -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Top Selling Products -->
        <div class="bg-white border-2 border-[#8B4513] p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold text-[#8B4513] mb-4">Top 5 Best-Selling Menu</h3>
            <canvas id="produkTerlarisChart"></canvas>
        </div>

        <!-- Monthly Revenue -->
        <div class="bg-white border-2 border-[#8B4513] p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold text-[#8B4513] mb-4">Monthly Revenue</h3>
            <canvas id="pendapatanBulananChart"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Top Selling Products Chart
    const produkTerlarisCtx = document.getElementById('produkTerlarisChart').getContext('2d');
    const produkTerlarisData = {
        labels: @json($produkTerlaris->pluck('nama_menu')), // Get product names
        datasets: [{
            label: 'Quantity Sold',
            data: @json($produkTerlaris->pluck('detail_transaksi_count')), // Get quantity sold
            backgroundColor: '#8B4513',  // Brown bar
            borderColor: '#8B4513',  // Brown border
            borderWidth: 1
        }]
    };
    const produkTerlarisConfig = {
        type: 'bar',
        data: produkTerlarisData,
        options: {
            responsive: true,
            scales: {
                x: { 
                    beginAtZero: true 
                },
                y: { 
                    beginAtZero: true 
                }
            }
        }
    };
    new Chart(produkTerlarisCtx, produkTerlarisConfig);

    // Monthly Revenue Chart
    const pendapatanBulananCtx = document.getElementById('pendapatanBulananChart').getContext('2d');
    const pendapatanBulananData = {
        labels: @json($pendapatanBulanan->pluck('bulan')), // Get month names
        datasets: [{
            label: 'Total Revenue',
            data: @json($pendapatanBulanan->pluck('total_pendapatan')), // Get total revenue per month
            backgroundColor: '#8B4513',  // Brown bar
            borderColor: '#8B4513',  // Brown border
            borderWidth: 1
        }]
    };
    const pendapatanBulananConfig = {
        type: 'line',
        data: pendapatanBulananData,
        options: {
            responsive: true,
            scales: {
                x: { 
                    beginAtZero: true 
                },
                y: { 
                    beginAtZero: true 
                }
            }
        }
    };
    new Chart(pendapatanBulananCtx, pendapatanBulananConfig);
</script>
@endsection