<?php

namespace App\Http\Controllers;

use App\Models\DataPelanggan;
use Illuminate\Http\Request;

class DataPelangganController extends Controller
{
    public function index()
    {
        $dataPelanggan = DataPelanggan::all();
        return view('data_pelanggan.index', compact('dataPelanggan'));
    }

    public function create()
    {
        return view('data_pelanggan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ID_PELANGGAN' => 'required|string|max:10|unique:data_pelanggan',
            'NAMA_PELANGGAN' => 'required|string|max:50',
            'NOHP_PELANGGAN' => 'required|string|max:15',
            'ALAMAT_PELANGGAN' => 'required|string|max:50',
            'KODE_REFERRAL' => 'nullable|string|max:5',
        ]);

        DataPelanggan::create($request->all());
        return redirect()->route('data_pelanggan.index')->with('success', 'Data pelanggan berhasil ditambahkan.');
    }

    public function show($id)
    {
        $dataPelanggan = DataPelanggan::findOrFail($id);
        return view('data_pelanggan.show', compact('dataPelanggan'));
    }

    public function edit($id)
    {
        $dataPelanggan = DataPelanggan::findOrFail($id);
        return view('data_pelanggan.edit', compact('dataPelanggan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'NAMA_PELANGGAN' => 'required|string|max:50',
            'NOHP_PELANGGAN' => 'required|string|max:15',
            'ALAMAT_PELANGGAN' => 'required|string|max:50',
            'KODE_REFERRAL' => 'nullable|string|max:5',
        ]);

        $dataPelanggan = DataPelanggan::findOrFail($id);
        $dataPelanggan->update($request->all());
        return redirect()->route('data_pelanggan.index')->with('success', 'Data pelanggan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $dataPelanggan = DataPelanggan::findOrFail($id);
        $dataPelanggan->delete();
        return redirect()->route('data_pelanggan.index')->with('success', 'Data pelanggan berhasil dihapus.');
    }
}
