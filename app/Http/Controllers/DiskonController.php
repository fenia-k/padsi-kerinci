<?php

namespace App\Http\Controllers;

use App\Models\Diskon;
use App\Models\DataPelanggan;
use Illuminate\Http\Request;

class DiskonController extends Controller
{
    public function index()
    {
        $diskon = Diskon::all();
        return view('diskon.index', compact('diskon'));
    }

    public function create()
    {
        $pelanggan = DataPelanggan::all();
        return view('diskon.create', compact('pelanggan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'harga_diskon' => 'required|numeric',
            'batas_pemakaian' => 'required|integer',
            'id_pelanggan' => 'required|exists:data_pelanggan,id',
        ]);

        Diskon::create($request->all());
        return redirect()->route('diskon.index')->with('success', 'Diskon berhasil ditambahkan');
    }

    public function edit(Diskon $diskon)
    {
        $pelanggan = DataPelanggan::all();
        return view('diskon.edit', compact('diskon', 'pelanggan'));
    }

    public function update(Request $request, Diskon $diskon)
    {
        $request->validate([
            'harga_diskon' => 'required|numeric',
            'batas_pemakaian' => 'required|integer',
            'id_pelanggan' => 'required|exists:data_pelanggan,id',
        ]);

        $diskon->update($request->all());
        return redirect()->route('diskon.index')->with('success', 'Diskon berhasil diperbarui');
    }

    public function destroy(Diskon $diskon)
    {
        $diskon->delete();
        return redirect()->route('diskon.index')->with('success', 'Diskon berhasil dihapus');
    }
}
