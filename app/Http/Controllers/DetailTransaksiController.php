<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Transaksi;
use App\Models\Menu;
use Illuminate\Http\Request;

class DetailTransaksiController extends Controller
{
    public function index()
    {
        $detailTransaksi = DetailTransaksi::all();
        return view('detail_transaksi.index', compact('detailTransaksi'));
    }

    public function create()
    {
        $transaksi = Transaksi::all();
        $menu = Menu::all();
        return view('detail_transaksi.create', compact('transaksi', 'menu'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_transaksi' => 'required|exists:transaksi,id',
            'id_menu' => 'required|exists:menu,id',
            'jumlah_pesanan' => 'required|integer',
            'sub_total' => 'required|numeric',
            'harga_menu' => 'required|numeric',
        ]);

        DetailTransaksi::create($request->all());
        return redirect()->route('detail_transaksi.index')->with('success', 'Detail transaksi berhasil ditambahkan');
    }

    public function edit(DetailTransaksi $detailTransaksi)
    {
        $transaksi = Transaksi::all();
        $menu = Menu::all();
        return view('detail_transaksi.edit', compact('detailTransaksi', 'transaksi', 'menu'));
    }

    public function update(Request $request, DetailTransaksi $detailTransaksi)
    {
        $request->validate([
            'id_transaksi' => 'required|exists:transaksi,id',
            'id_menu' => 'required|exists:menu,id',
            'jumlah_pesanan' => 'required|integer',
            'sub_total' => 'required|numeric',
            'harga_menu' => 'required|numeric',
        ]);

        $detailTransaksi->update($request->all());
        return redirect()->route('detail_transaksi.index')->with('success', 'Detail transaksi berhasil diperbarui');
    }

    public function destroy(DetailTransaksi $detailTransaksi)
    {
        $detailTransaksi->delete();
        return redirect()->route('detail_transaksi.index')->with('success', 'Detail transaksi berhasil dihapus');
    }
}
