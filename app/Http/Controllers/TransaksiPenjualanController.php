<?php

namespace App\Http\Controllers;

use App\Models\TransaksiPenjualan;
use Illuminate\Http\Request;

class TransaksiPenjualanController extends Controller
{
    public function index()
    {
        $transaksiPenjualan = TransaksiPenjualan::all();
        return view('transaksi_penjualan.index', compact('transaksiPenjualan'));
    }

    public function create()
    {
        return view('transaksi_penjualan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'NOMOR_FAKTUR' => 'required|string|max:10|unique:transaksi_penjualan,NOMOR_FAKTUR',
            'ID_PELANGGAN' => 'required|string|max:10|exists:data_pelanggan,ID_PELANGGAN',
            'ID_PENGGUNA' => 'required|string|max:10|exists:data_pengguna,ID_PENGGUNA',
            'TANGGAL_PENJUALAN' => 'required|date',
            'TOTAL_HARGA' => 'required|numeric',
        ]);

        TransaksiPenjualan::create($request->all());
        return redirect()->route('transaksi_penjualan.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $transaksi = TransaksiPenjualan::findOrFail($id);
        return view('transaksi_penjualan.edit', compact('transaksi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ID_PELANGGAN' => 'required|string|max:10|exists:data_pelanggan,ID_PELANGGAN',
            'ID_PENGGUNA' => 'required|string|max:10|exists:data_pengguna,ID_PENGGUNA',
            'TANGGAL_PENJUALAN' => 'required|date',
            'TOTAL_HARGA' => 'required|numeric',
        ]);

        $transaksi = TransaksiPenjualan::findOrFail($id);
        $transaksi->update($request->all());
        return redirect()->route('transaksi_penjualan.index')->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $transaksi = TransaksiPenjualan::findOrFail($id);
        $transaksi->delete();
        return redirect()->route('transaksi_penjualan.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}
