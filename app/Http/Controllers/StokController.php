<?php

namespace App\Http\Controllers;

use App\Models\Stok;
use Illuminate\Http\Request;

class StokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Inisialisasi query untuk model Stok
        $query = Stok::query();

        // Memfilter berdasarkan parameter pencarian
        if ($request->has('search') && $request->search != '') {
            $query->where('nama_stok', 'like', '%' . $request->search . '%');
        }

        // Mengambil data dengan pagination, 10 item per halaman
        $stok = $query->paginate(10);

        // Mengirim data stok ke view 'stok.index' bersama dengan data hasil pencarian
        return view('stok.index', compact('stok'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('stok.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi input termasuk cek nama_stok agar tidak duplikat
        $request->validate([
            'nama_stok' => 'required|unique:stok,nama_stok', // Cek nama_stok agar unik di tabel stok
            'jumlah_stok' => 'required|integer',
        ]);
    
        // Menyimpan data stok baru
        Stok::create($request->all());
    
        // Redirect ke halaman indeks stok dengan pesan sukses
        return redirect()->route('stok.index')->with('success', 'Stock has been successfully added.');
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stok  $stok
     * @return \Illuminate\Http\Response
     */
    public function edit(Stok $stok)
    {
        return view('stok.edit', compact('stok'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stok  $stok
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stok $stok)
    {
        // Validasi input
        $request->validate([
            'nama_stok' => [
                'required',
                function ($attribute, $value, $fail) use ($stok) {
                    // Jika nama stok berbeda dengan nama yang sudah ada di database dan nama stok sudah digunakan, validasi gagal
                    if ($value !== $stok->nama_stok && Stok::where('nama_stok', $value)->exists()) {
                        $fail('The stock name is already in use. Please choose another name.');
                    }
                },
            ],
            'jumlah_stok' => 'required|integer',
        ]);
    
        // Update data stok
        $stok->update($request->only(['nama_stok', 'jumlah_stok']));
    
        // Redirect ke halaman indeks stok dengan pesan sukses
        return redirect()->route('stok.index')->with('success', 'Stock updated successfully');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stok  $stok
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stok $stok)
    {
        // Menghapus data stok
        $stok->delete();

        // Redirect ke halaman indeks stok dengan pesan sukses
        return redirect()->route('stok.index')->with('success', 'Stock successfully deleted');
    }
}
