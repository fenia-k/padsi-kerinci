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

        // Top Produk Terjual
        $produkTerlaris = Menu::withCount('detailTransaksi')
            ->orderBy('detail_transaksi_count', 'desc')
            ->take(5)
            ->get();

        // Transaksi Bulanan
        $transaksiBulanan = Transaksi::select(
                DB::raw('strftime("%m", tanggal_transaksi) as bulan'), // Untuk SQLite
                DB::raw('COUNT(*) as jumlah')
            )
            ->groupBy('bulan')
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
            'produkTerlaris',
            'transaksiBulanan',
            'loyaltyAktif'
        ));
    }
}
