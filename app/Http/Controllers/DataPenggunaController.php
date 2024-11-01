<?php

namespace App\Http\Controllers;

use App\Models\DataPengguna;
use Illuminate\Http\Request;

class DataPenggunaController extends Controller
{
    public function index()
    {
        $dataPengguna = DataPengguna::all();
        return view('data_pengguna.index', compact('dataPengguna'));
    }

    public function create()
    {
        return view('data_pengguna.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ID_PENGGUNA' => 'required|string|max:10|unique:data_pengguna,ID_PENGGUNA',
            'ID_ROLE' => 'required|string|max:8',
            'NOHP_PENGGUNA' => 'required|string|max:15',
            'ALAMAT_PENGGUNA' => 'required|string|max:100',
            'NAMA_PENGGUNA' => 'required|string|max:50',
            'PASSWORD' => 'required|string|max:100',
        ]);

        DataPengguna::create($request->all());
        return redirect()->route('data_pengguna.index')->with('success', 'Data pengguna berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $dataPengguna = DataPengguna::findOrFail($id);
        return view('data_pengguna.edit', compact('dataPengguna'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ID_ROLE' => 'required|string|max:8',
            'NOHP_PENGGUNA' => 'required|string|max:15',
            'ALAMAT_PENGGUNA' => 'required|string|max:100',
            'NAMA_PENGGUNA' => 'required|string|max:50',
        ]);

        $dataPengguna = DataPengguna::findOrFail($id);
        $dataPengguna->update($request->all());
        return redirect()->route('data_pengguna.index')->with('success', 'Data pengguna berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $dataPengguna = DataPengguna::findOrFail($id);
        $dataPengguna->delete();
        return redirect()->route('data_pengguna.index')->with('success', 'Data pengguna berhasil dihapus.');
    }
}
