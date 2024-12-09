<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use PDF;

class LaporanTransaksiController extends Controller
{
    // Fungsi untuk menampilkan laporan transaksi
    public function index(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
    
        $query = Transaksi::with('detailTransaksi.menu', 'pelanggan', 'pengguna')
            ->orderBy('tanggal_transaksi', 'desc'); // Urutkan dari tanggal terbaru
    
        // Filter berdasarkan tanggal jika ada
        if ($startDate && $endDate) {
            $query->whereBetween('tanggal_transaksi', [$startDate, $endDate]);
        }
    
        // Ambil transaksi dengan paginasi
        $transaksi = $query->paginate(10);
    
        // Kirim data transaksi ke view
        return view('laporan.index', compact('transaksi', 'startDate', 'endDate'));
    }

    // Fungsi untuk mengekspor laporan transaksi ke PDF
    // Fungsi untuk mengekspor laporan transaksi ke PDF
public function exportPDF(Request $request)
{
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');
    
    // Query transaksi berdasarkan filter tanggal jika ada
    $query = Transaksi::with('detailTransaksi.menu', 'pelanggan', 'pengguna');
    
    // Filter transaksi berdasarkan rentang tanggal yang diberikan
    if ($startDate && $endDate) {
        $query->whereBetween('tanggal_transaksi', [$startDate, $endDate]);
    }
    
    // Ambil transaksi sesuai dengan filter
    $transaksi = $query->get();

    // Pastikan $transaksi tidak kosong
    $totalTransaksi = 0;
    if ($transaksi->isNotEmpty()) {
        // Hitung total harga secara manual
        $totalTransaksi = $transaksi->sum('total_harga');
    }

    // Membuat PDF dari view laporan
    $pdf = PDF::loadView('laporan.pdf', compact('transaksi', 'startDate', 'endDate', 'totalTransaksi'));

    // Download file PDF
    return $pdf->download('laporan-transaksi.pdf');
}


    // Fungsi untuk menampilkan detail transaksi
    public function detail($id)
    {
        $transaksi = Transaksi::with('detailTransaksi.menu', 'pelanggan', 'pengguna')->findOrFail($id);
        return view('laporan.detail', compact('transaksi'));
    }
}
