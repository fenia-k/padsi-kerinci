<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $laporan = Transaksi::with('detailTransaksi.menu', 'pelanggan', 'pengguna')->get();
        return view('laporan.index', compact('laporan'));
    }

    public function show($id)
    {
        $transaksi = Transaksi::with('detailTransaksi.menu', 'pelanggan', 'pengguna')->findOrFail($id);
        return view('laporan.show', compact('transaksi'));
    }
}
