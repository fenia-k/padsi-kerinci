<?php

namespace App\Http\Controllers;

use App\Models\LoyaltyProgram;
use App\Models\DataPelanggan;
use Illuminate\Http\Request;

class LoyaltyProgramController extends Controller
{
    public function index()
{
    $loyaltyPrograms = LoyaltyProgram::with('pelanggan')->get(); // Pastikan nama relasi sesuai dengan method di model
    return view('loyalty_program.index', compact('loyaltyPrograms'));
}


    public function create()
    {
        $pelanggan = DataPelanggan::all();
        return view('loyalty_program.create', compact('pelanggan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pelanggan' => 'required|exists:data_pelanggan,id',
        ]);

        try {
            $dataPelanggan = DataPelanggan::findOrFail($request->id_pelanggan);

            LoyaltyProgram::create([
                'id_pelanggan' => $dataPelanggan->id,
                'kode_referral' => $dataPelanggan->kode_referal, // Mengambil kode referral dari data pelanggan
                'diskon' => 5000, // Set diskon otomatis
                'batas_loyalty' => 5, // Set batas loyalty otomatis
            ]);

            return redirect()->route('loyalty_program.index')->with('success', 'Loyalty Program berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->route('loyalty_program.index')->with('error', 'Gagal menambahkan Loyalty Program');
        }
    }

    public function edit(LoyaltyProgram $loyaltyProgram)
    {
        $pelanggan = DataPelanggan::all();
        return view('loyalty_program.edit', compact('loyaltyProgram', 'pelanggan'));
    }

    public function update(Request $request, LoyaltyProgram $loyaltyProgram)
    {
        $request->validate([
            'id_pelanggan' => 'required|exists:data_pelanggan,id',
            'kode_referral' => 'required|unique:loyalty_programs,kode_referral,' . $loyaltyProgram->id,
            'batas_loyalty' => 'required|integer',
            'diskon' => 'required|numeric',
        ]);

        try {
            $dataPelanggan = DataPelanggan::findOrFail($request->id_pelanggan);

            $loyaltyProgram->update([
                'id_pelanggan' => $dataPelanggan->id,
                'kode_referral' => $dataPelanggan->kode_referal, // Mengambil kode referral dari data pelanggan
                'diskon' => $request->diskon,
                'batas_loyalty' => $request->batas_loyalty,
            ]);

            return redirect()->route('loyalty_program.index')->with('success', 'Loyalty Program berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->route('loyalty_program.index')->with('error', 'Gagal memperbarui Loyalty Program');
        }
    }

    public function destroy(LoyaltyProgram $loyaltyProgram)
    {
        $loyaltyProgram->delete();
        return redirect()->route('loyalty_program.index')->with('success', 'Loyalty Program berhasil dihapus');
    }
}
