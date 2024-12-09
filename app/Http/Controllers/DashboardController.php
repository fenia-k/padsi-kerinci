<?php

namespace App\Http\Controllers;

use App\Models\DataPelanggan;
use App\Models\DataPengguna;
use App\Models\Transaksi;
use App\Models\Menu;
use App\Models\LoyaltyProgram;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik utama
        $totalPelanggan = DataPelanggan::count();
        $totalPengguna = DataPengguna::count();
        $totalTransaksi = Transaksi::count();
        $totalProduk = Menu::count();
        $totalLoyaltyProgram = LoyaltyProgram::count();

        // Total Pendapatan
        $totalPendapatan = Transaksi::sum('total_harga');  // Menjumlahkan semua total_harga pada tabel Transaksi

        // Top Produk Terjual
        $produkTerlaris = Menu::withCount('detailTransaksi') // Asumsi ada relasi 'detailTransaksi' pada model Menu
            ->orderByDesc('detail_transaksi_count')
            ->take(5)
            ->get(); 

        // Total Pendapatan Bulanan
        $pendapatanBulanan = Transaksi::select(
            DB::raw('MONTH(tanggal_transaksi) as bulan'), // Menggunakan MONTH() untuk MySQL
            DB::raw('SUM(total_harga) as total_pendapatan') // Menghitung total pendapatan per bulan
        )
        ->groupBy(DB::raw('MONTH(tanggal_transaksi)')) // Group berdasarkan bulan
        ->orderBy('bulan')
        ->get()
        ->transform(function ($item) {
            $item->bulan = date('F', mktime(0, 0, 0, $item->bulan, 10)); // Ubah angka bulan ke nama bulan
            return $item;
        });


        // Loyalty Program Aktif
        $loyaltyAktif = LoyaltyProgram::where('batas_loyalty', '>', 0)->count();

        return view('dashboard', compact(
            'totalPelanggan',
            'totalPengguna',
            'totalTransaksi',
            'totalProduk',
            'totalLoyaltyProgram',
            'totalPendapatan',  // Menambahkan total pendapatan ke view
            'produkTerlaris',
            'pendapatanBulanan', // Menambahkan data pendapatan bulanan ke view
            'loyaltyAktif'
        ));
    }
}
