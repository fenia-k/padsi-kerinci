<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return view('menu.index', compact('menus'));
    }

    public function create()
    {
        return view('menu.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'nama_menu' => 'required',
        'harga_menu' => 'required|numeric',
        'jumlah_menu' => 'required|integer',
        'deskripsi_menu' => 'nullable|string',
        'gambar_menu' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk gambar
    ]);

    $data = $request->all();

    if ($request->hasFile('gambar_menu')) {
        $data['gambar_menu'] = $request->file('gambar_menu')->store('menu', 'public');
    }

    Menu::create($data);

    return redirect()->route('menu.index')->with('success', 'Menu berhasil ditambahkan');
}

public function edit($id)
{
    // Temukan data menu berdasarkan id
    $menu = Menu::findOrFail($id);
    
    // Kirim data menu ke view edit
    return view('menu.edit', compact('menu'));
}

public function update(Request $request, Menu $menu)
{
    $request->validate([
        'nama_menu' => 'required',
        'harga_menu' => 'required|numeric',
        'jumlah_menu' => 'required|integer',
        'deskripsi_menu' => 'nullable|string',
        'gambar_menu' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk gambar
    ]);

    $data = $request->all();

    if ($request->hasFile('gambar_menu')) {
        if ($menu->gambar_menu) {
            Storage::disk('public')->delete($menu->gambar_menu);
        }
        $data['gambar_menu'] = $request->file('gambar_menu')->store('menu', 'public');
    }

    $menu->update($data);

    return redirect()->route('menu.index')->with('success', 'Menu berhasil diperbarui');
}


    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('menu.index')->with('success', 'Menu berhasil dihapus');
    }
}
