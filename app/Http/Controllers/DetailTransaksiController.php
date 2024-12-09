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
            'jumlah_pesanan' => 'required|integer|min:1',
        ]);

        $menu = Menu::findOrFail($request->id_menu);

        // Cek ketersediaan stok
        if ($menu->jumlah_menu < $request->jumlah_pesanan) {
            return redirect()->back()->withErrors(['jumlah_pesanan' => 'Insufficient stock for products ' . $menu->nama_menu]);
        }

        // Hitung sub_total berdasarkan jumlah_pesanan dan harga_menu
        $sub_total = $request->jumlah_pesanan * $menu->harga_menu;

        // Kurangi stok menu
        $menu->decrement('jumlah_menu', $request->jumlah_pesanan);

        // Simpan detail transaksi
        DetailTransaksi::create([
            'id_transaksi' => $request->id_transaksi,
            'id_menu' => $request->id_menu,
            'jumlah_pesanan' => $request->jumlah_pesanan,
            'harga_menu' => $menu->harga_menu,
            'sub_total' => $sub_total,
        ]);

        return redirect()->route('detail_transaksi.index')->with('success', 'Transaction details successfully added');
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
            'jumlah_pesanan' => 'required|integer|min:1',
        ]);

        $menu = Menu::findOrFail($request->id_menu);

        // Hitung perbedaan jumlah pesanan dan update stok jika jumlah pesanan berubah
        $difference = $request->jumlah_pesanan - $detailTransaksi->jumlah_pesanan;

        // Cek ketersediaan stok jika pesanan bertambah
        if ($difference > 0 && $menu->jumlah_menu < $difference) {
            return redirect()->back()->withErrors(['jumlah_pesanan' => 'Insufficient stock for products ' . $menu->nama_menu]);
        }

        // Kurangi atau tambahkan stok sesuai perbedaan
        $menu->decrement('jumlah_menu', $difference);

        // Hitung ulang sub_total
        $sub_total = $request->jumlah_pesanan * $menu->harga_menu;

        // Update detail transaksi
        $detailTransaksi->update([
            'id_transaksi' => $request->id_transaksi,
            'id_menu' => $request->id_menu,
            'jumlah_pesanan' => $request->jumlah_pesanan,
            'harga_menu' => $menu->harga_menu,
            'sub_total' => $sub_total,
        ]);

        return redirect()->route('detail_transaksi.index')->with('success', 'Transaction details updated successfully');
    }

    public function destroy(DetailTransaksi $detailTransaksi)
    {
        // Kembalikan stok menu saat detail transaksi dihapus
        $menu = Menu::findOrFail($detailTransaksi->id_menu);
        $menu->increment('jumlah_menu', $detailTransaksi->jumlah_pesanan);

        // Hapus detail transaksi
        $detailTransaksi->delete();

        return redirect ()->route('detail_transaksi.index')->with('success', 'Transaction details successfully deleted');
    }
}
