<?php

namespace App\Http\Controllers;

use App\Models\DataPengguna;
use App\Models\Role;
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
        $roles = Role::all(['id', 'nama_role']);
        return view('data_pengguna.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pengguna' => 'required',
            'alamat_pengguna' => 'required',
            'noHP_pengguna' => 'required',
            'id_role' => 'required|exists:role,id',
        ]);

        DataPengguna::create($request->all());
        return redirect()->route('data_pengguna.index')->with('success', 'Data pengguna berhasil ditambahkan');
    }

    public function edit(DataPengguna $dataPengguna)
    {
        $roles = Role::all(['id', 'nama_role']);
        return view('data_pengguna.edit', compact('dataPengguna', 'roles'));
    }

    public function update(Request $request, DataPengguna $dataPengguna)
    {
        $request->validate([
            'nama_pengguna' => 'required',
            'alamat_pengguna' => 'required',
            'noHP_pengguna' => 'required',
            'id_role' => 'required|exists:roles,id',
        ]);

        $dataPengguna->update($request->all());
        return redirect()->route('data_pengguna.index')->with('success', 'Data pengguna berhasil diperbarui');
    }

    public function destroy(DataPengguna $dataPengguna)
    {
        $dataPengguna->delete();
        return redirect()->route('data_pengguna.index')->with('success', 'Data pengguna berhasil dihapus');
    }
}
