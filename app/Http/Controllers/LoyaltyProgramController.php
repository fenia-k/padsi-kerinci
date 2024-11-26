<?php

namespace App\Http\Controllers;

use App\Models\LoyaltyProgram;
use App\Models\DataPelanggan;
use Illuminate\Http\Request;

class LoyaltyProgramController extends Controller
{
    /**
     * Display a listing of the loyalty programs.
     */
    public function index(Request $request)
    {
        $query = LoyaltyProgram::with('pelanggan');

        // Filter pencarian
        if ($request->has('search') && $request->search != '') {
            $query->whereHas('pelanggan', function($q) use ($request) {
                $q->where('nama_pelanggan', 'like', '%' . $request->search . '%');
            });
        }

        // Pagination dengan 10 item per halaman
        $loyaltyPrograms = $query->paginate(10);

        return view('loyalty_program.index', compact('loyaltyPrograms'));
    }

    /**
     * Show the form for creating a new loyalty program.
     */
    public function create()
    {
        $pelanggan = DataPelanggan::all();
        return view('loyalty_program.create', compact('pelanggan'));
    }

    /**
     * Store a newly created loyalty program in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_pelanggan' => 'required|exists:data_pelanggan,id',
        ]);

        try {
            $dataPelanggan = DataPelanggan::findOrFail($request->id_pelanggan);

            // Check if the customer already has a loyalty program
            if (LoyaltyProgram::where('id_pelanggan', $dataPelanggan->id)->exists()) {
                return redirect()->route('loyalty_program.index')->with('error', 'Pelanggan ini sudah memiliki program loyalti.');
            }

            LoyaltyProgram::create([
                'id_pelanggan' => $dataPelanggan->id,
                'kode_referral' => $dataPelanggan->kode_referal,
                'batas_loyalty' => 5, // Set batas loyalty otomatis
            ]);

            return redirect()->route('loyalty_program.index')->with('success', 'Loyalty Program berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->route('loyalty_program.index')->with('error', 'Gagal menambahkan Loyalty Program: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified loyalty program.
     */
    public function edit(LoyaltyProgram $loyaltyProgram)
    {
        return view('loyalty_program.edit', compact('loyaltyProgram'));
    }

    /**
     * Update the specified loyalty program in storage.
     */
    public function update(Request $request, LoyaltyProgram $loyaltyProgram)
    {
        $request->validate([
            'batas_loyalty' => 'required|integer|min:0',
        ]);

        try {
            $loyaltyProgram->update([
                'batas_loyalty' => $request->batas_loyalty,
            ]);

            return redirect()->route('loyalty_program.index')->with('success', 'Loyalty Program berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->route('loyalty_program.index')->with('error', 'Gagal memperbarui Loyalty Program: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified loyalty program from storage.
     */
    public function destroy(LoyaltyProgram $loyaltyProgram)
    {
        try {
            $loyaltyProgram->delete();
            return redirect()->route('loyalty_program.index')->with('success', 'Loyalty Program berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('loyalty_program.index')->with('error', 'Gagal menghapus Loyalty Program');
        }
    }
}
