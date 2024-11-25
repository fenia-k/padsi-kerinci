<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use PDF;

class LaporanTransaksiController extends Controller
{
    // Fungsi untuk menampilkan laporan transaksi
  // Contoh penggunaan di LaporanTransaksiController
  public function index(Request $request)
  {
      $startDate = $request->input('start_date');
      $endDate = $request->input('end_date');
  
      $query = Transaksi::with('detailTransaksi.menu', 'pelanggan', 'pengguna')
          ->orderBy('tanggal_transaksi', 'desc'); // Urutkan dari tanggal terbaru
  
      if ($startDate && $endDate) {
          $query->whereBetween('tanggal_transaksi', [$startDate, $endDate]);
      }
  
      $transaksi = $query->paginate(10);
  
      return view('laporan.index', compact('transaksi', 'startDate', 'endDate'));
  }
  

public function exportPDF()
{
    $transaksi = Transaksi::with('detailTransaksi.menu', 'pelanggan', 'pengguna')->get();

    $pdf = PDF::loadView('laporan.pdf', compact('transaksi'));
    return $pdf->download('laporan-transaksi.pdf');
}
public function detail($id)
{
    $transaksi = Transaksi::with('detailTransaksi.menu', 'pelanggan', 'pengguna')->findOrFail($id);
    return view('laporan.detail', compact('transaksi'));
}

}