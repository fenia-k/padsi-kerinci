<?php

namespace App\Http\Controllers;

use App\Models\DataPelanggan;
use App\Models\LoyaltyProgram;
use App\Models\ReferralLog;
use Illuminate\Http\Request;

class DataPelangganController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $dataPelanggan = DataPelanggan::when($search, function ($query, $search) {
            return $query->where('nama_pelanggan', 'like', "%{$search}%");
        })->paginate(10);

        return view('data_pelanggan.index', compact('dataPelanggan', 'search'));
    }

    public function create()
    {
        return view('data_pelanggan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'alamat_pelanggan' => 'required|string',
            'noHP_pelanggan' => 'required|string|max:15',
            'kode_referal_input' => 'nullable|string|exists:data_pelanggan,kode_referal',
        ]);

        try {
            $namaDepan = strtoupper(substr(explode(' ', trim($request->nama_pelanggan))[0], 0, 3));
            $kodeReferal = $namaDepan . '-' . mt_rand(10, 99);

            $dataPelanggan = new DataPelanggan();
            $dataPelanggan->nama_pelanggan = $request->nama_pelanggan;
            $dataPelanggan->alamat_pelanggan = $request->alamat_pelanggan;
            $dataPelanggan->noHP_pelanggan = $request->noHP_pelanggan;
            $dataPelanggan->kode_referal = $kodeReferal;
            $dataPelanggan->poin = 0;
            $dataPelanggan->save();

            LoyaltyProgram::create([
                'kode_referal' => $kodeReferal,
                'batas_loyalty' => 5,
                'id_pelanggan' => $dataPelanggan->id,
            ]);

            if ($request->kode_referal_input) {
                $referrer = DataPelanggan::where('kode_referal', $request->kode_referal_input)->first();

                if ($referrer) {
                    $referrer->increment('poin', 10000);

                    ReferralLog::create([
                        'referrer_user_id' => $referrer->id,
                        'referred_user_id' => $dataPelanggan->id,
                        'poin' => 10000,
                        'used_at' => now(),
                    ]);

                    $dataPelanggan->increment('poin', 5000);
                }
            }

            return redirect()->route('data_pelanggan.index')->with('success', 'Customer data successfully added with referral code: ' . $kodeReferal);
        } catch (\Exception $e) {
            return redirect()->route('data_pelanggan.index')->with('error', 'Failed to add customer data: ' . $e->getMessage());
        }
    }

    public function edit(DataPelanggan $dataPelanggan)
    {
        return view('data_pelanggan.edit', compact('dataPelanggan'));
    }

    public function update(Request $request, DataPelanggan $dataPelanggan)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'alamat_pelanggan' => 'required|string',
            'noHP_pelanggan' => 'required|string|max:15',
        ]);

        try {
            $dataPelanggan->update($request->all());
            return redirect()->route('data_pelanggan.index')->with('success', 'Customer data updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('data_pelanggan.index')->with('error', 'Failed to update customer data: ' . $e->getMessage());
        }
    }

    public function destroy(DataPelanggan $dataPelanggan)
    {
        try {
            $dataPelanggan->delete();
            return redirect()->route('data_pelanggan.index')->with('success', 'Customer data successfully deleted');
        } catch (\Exception $e) {
            return redirect()->route('data_pelanggan.index')->with('error', 'Failed to delete customer data: ' . $e->getMessage());
        }
    }
}
