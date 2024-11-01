<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menu = Menu::all();
        return view('menu.index', compact('menu'));
    }

    public function create()
    {
        return view('menu.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ID_MENU' => 'required|string|max:10|unique:menu,ID_MENU',
            'NAMA_MENU' => 'required|string|max:25',
            'DESKRIPSI_MENU' => 'required|string|max:100',
            'HARGA_MENU' => 'required|numeric',
        ]);

        Menu::create($request->all());
        return redirect()->route('menu.index')->with('success', 'Menu berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        return view('menu.edit', compact('menu'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'NAMA_MENU' => 'required|string|max:25',
            'DESKRIPSI_MENU' => 'required|string|max:100',
            'HARGA_MENU' => 'required|numeric',
        ]);

        $menu = Menu::findOrFail($id);
        $menu->update($request->all());
        return redirect()->route('menu.index')->with('success', 'Menu berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();
        return redirect()->route('menu.index')->with('success', 'Menu berhasil dihapus.');
    }
}
