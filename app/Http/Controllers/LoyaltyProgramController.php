<?php

namespace App\Http\Controllers;

use App\Models\LoyaltyProgram;
use Illuminate\Http\Request;

class LoyaltyProgramController extends Controller
{
    public function index()
    {
        $loyaltyProgram = LoyaltyProgram::all();
        return view('loyalty_program.index', compact('loyaltyProgram'));
    }

    public function create()
    {
        return view('loyalty_program.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ID_RUJUKAN' => 'required|integer|unique:loyalty_program,ID_RUJUKAN',
            'ID_PELANGGAN' => 'required|string|max:10|exists:data_pelanggan,ID_PELANGGAN',
            'KODE_REFERRAL' => 'required|string|max:5',
            'BATAS_RUJUKAN' => 'required|integer',
            'STATUS' => 'required|string|max:15',
        ]);

        LoyaltyProgram::create($request->all());
        return redirect()->route('loyalty_program.index')->with('success', 'Program loyalty berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $loyaltyProgram = LoyaltyProgram::findOrFail($id);
        return view('loyalty_program.edit', compact('loyaltyProgram'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ID_PELANGGAN' => 'required|string|max:10|exists:data_pelanggan,ID_PELANGGAN',
            'KODE_REFERRAL' => 'required|string|max:5',
            'BATAS_RUJUKAN' => 'required|integer',
            'STATUS' => 'required|string|max:15',
        ]);

        $loyaltyProgram = LoyaltyProgram::findOrFail($id);
        $loyaltyProgram->update($request->all());
        return redirect()->route('loyalty_program.index')->with('success', 'Program loyalty berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $loyaltyProgram = LoyaltyProgram::findOrFail($id);
        $loyaltyProgram->delete();
        return redirect()->route('loyalty_program.index')->with('success', 'Program loyalty berhasil dihapus.');
    }
}
