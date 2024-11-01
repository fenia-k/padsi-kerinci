<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $laporan = Laporan::all();
        return view('laporan.index', compact('laporan'));
    }

    public function create()
    {
        return view('laporan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ID_LAPORAN' => 'required|string|max:10|unique:laporan,ID_LAPORAN',
            'NOMOR_FAKTUR' => 'required|string|max:10|exists:transaksi_penjualan,NOMOR_FAKTUR',
            'JENIS_LAPORAN' => 'required|string|max:50',
            'TANGGAL_LAPORAN' => 'required|date',
        ]);

        Laporan::create($request->all());
        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $laporan = Laporan::findOrFail($id);
        return view('laporan.edit', compact('laporan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'NOMOR_FAKTUR' => 'required|string|max:10|exists:transaksi_penjualan,NOMOR_FAKTUR',
            'JENIS_LAPORAN' => 'required|string|max:50',
            'TANGGAL_LAPORAN' => 'required|date',
        ]);

        $laporan = Laporan::findOrFail($id);
        $laporan->update($request->all());
        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $laporan = Laporan::findOrFail($id);
        $laporan->delete();
        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil dihapus.');
    }
}
