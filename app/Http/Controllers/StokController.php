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
        // Validasi input
        $request->validate([
            'nama_stok' => 'required',
            'jumlah_stok' => 'required|integer',
        ]);

        // Menyimpan data stok baru
        Stok::create($request->all());

        // Redirect ke halaman indeks stok dengan pesan sukses
        return redirect()->route('stok.index')->with('success', 'Stok berhasil ditambahkan');
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
            'nama_stok' => 'required',
            'jumlah_stok' => 'required|integer',
        ]);

        // Update data stok
        $stok->update($request->all());

        // Redirect ke halaman indeks stok dengan pesan sukses
        return redirect()->route('stok.index')->with('success', 'Stok berhasil diperbarui');
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
        return redirect()->route('stok.index')->with('success', 'Stok berhasil dihapus');
    }
}
