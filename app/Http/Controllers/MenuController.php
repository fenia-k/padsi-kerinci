<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $query = Menu::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('nama_menu', 'like', '%' . $request->search . '%');
        }

        // Pagination dengan 10 item per halaman
        $menus = $query->paginate(10);

        return view('menu.index', compact('menus'));
    }

    public function create()
    {
        return view('menu.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_menu' => 'required|unique:menu,nama_menu',
            'harga_menu' => 'required|numeric',
            'jumlah_menu' => 'required|integer',
            'deskripsi_menu' => 'required|string',  // Menambahkan validasi deskripsi_menu wajib diisi
            'gambar_menu' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nama_menu.unique' => 'Menu name is already registered, please choose a different name.',
            'gambar_menu.required' => 'Menu image is required.',
            'gambar_menu.image' => 'Invalid image format. Please choose an image file in jpeg, png, jpg, or gif format.',
            'gambar_menu.max' => 'The image is too large. Maximum size is 2MB.',
            'harga_menu.required' => 'Menu price is required.',
            'harga_menu.numeric' => 'Menu price must be a number.',
            'jumlah_menu.required' => 'Menu quantity is required.',
            'jumlah_menu.integer' => 'Menu quantity must be an integer.',
            'deskripsi_menu.required' => 'Menu description is required.',
            'deskripsi_menu.string' => 'Menu description must be a string.',
        ]);
    
        $data = $request->all();
    
        if ($request->hasFile('gambar_menu')) {
            $data['gambar_menu'] = $request->file('gambar_menu')->store('menu', 'public');
        }
    
        Menu::create($data);
    
        return redirect()->route('menu.index')->with('success', 'Menu has been successfully added.');
    }
    
    

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        return view('menu.edit', compact('menu'));
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'nama_menu' => 'required|unique:menu,nama_menu,' . $menu->id,  // Menambahkan pengecekan duplikasi kecuali untuk menu yang sedang diedit
            'harga_menu' => 'required|numeric',
            'jumlah_menu' => 'required|integer',
            'deskripsi_menu' => 'nullable|string',
            'gambar_menu' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',  // Validasi gambar
        ], [
            'nama_menu.unique' => 'Menu name is already registered, please choose a different name.',
            'gambar_menu.image' => 'Invalid image format. Please choose an image file in jpeg, png, jpg, or gif format.',
            'gambar_menu.max' => 'The image is too large. Maximum size is 2MB.',
        ]);

        $data = $request->all();

        // Jika ada gambar yang diunggah
        if ($request->hasFile('gambar_menu')) {
            // Hapus gambar lama jika ada
            if ($menu->gambar_menu) {
                \Storage::disk('public')->delete($menu->gambar_menu);
            }
            // Simpan gambar baru
            $data['gambar_menu'] = $request->file('gambar_menu')->store('menu', 'public');
        }

        $menu->update($data);

        return redirect()->route('menu.index')->with('success', 'Menu has been successfully updated.');
    }

    public function destroy(Menu $menu)
    {
        // Menghapus gambar jika ada
        if ($menu->gambar_menu) {
            \Storage::disk('public')->delete($menu->gambar_menu);
        }
        
        $menu->delete();
        return redirect()->route('menu.index')->with('success', 'Menu has been successfully deleted.');
    }
}
