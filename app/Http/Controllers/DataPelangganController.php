<?php

namespace App\Http\Controllers;

use App\Models\DataPelanggan;
use App\Models\LoyaltyProgram; // Model untuk program loyalti
use App\Models\ReferralLog; // Model untuk log referral
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DataPelangganController extends Controller
{
    public function index()
    {
        $dataPelanggan = DataPelanggan::all();
        return view('data_pelanggan.index', compact('dataPelanggan'));
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
            'kode_referal_input' => 'nullable|string|exists:data_pelanggan,kode_referal', // Validasi kode referral opsional
        ]);

        try {
            // Buat kode referral unik untuk pelanggan baru
            $namaDepan = strtoupper(substr(explode(' ', trim($request->nama_pelanggan))[0], 0, 3));
            $kodeReferal = $namaDepan . '-' . mt_rand(10, 99);

            // Simpan data pelanggan baru
            $dataPelanggan = new DataPelanggan();
            $dataPelanggan->nama_pelanggan = $request->nama_pelanggan;
            $dataPelanggan->alamat_pelanggan = $request->alamat_pelanggan;
            $dataPelanggan->noHP_pelanggan = $request->noHP_pelanggan;
            $dataPelanggan->kode_referal = $kodeReferal;
            $dataPelanggan->poin = 0; // Default poin awal
            $dataPelanggan->save();

            // Tambahkan program loyalti baru untuk pelanggan
            LoyaltyProgram::create([
                'kode_referral' => $kodeReferal,
                'batas_loyalty' => 5, // Set batas loyalti awal
                'id_pelanggan' => $dataPelanggan->id,
            ]);

            // Jika ada kode referral yang diinput, proses rujukan
            if ($request->kode_referal_input) {
                $referrer = DataPelanggan::where('kode_referal', $request->kode_referal_input)->first();

                if ($referrer) {
                    // Tambahkan 10,000 poin untuk referrer
                    $referrer->increment('poin', 10000);

                    // Log referral
                    ReferralLog::create([
                        'referrer_user_id' => $referrer->id,
                        'referred_user_id' => $dataPelanggan->id,
                        'poin' => 10000,
                        'used_at' => now(),
                    ]);

                    // Berikan 10,000 poin untuk pelanggan baru
                    $dataPelanggan->increment('poin', 10000);
                }
            }

            return redirect()->route('data_pelanggan.index')->with('success', 'Data pelanggan berhasil ditambahkan dengan kode referral: ' . $kodeReferal);
        } catch (\Exception $e) {
            return redirect()->route('data_pelanggan.index')->with('error', 'Gagal menambahkan data pelanggan: ' . $e->getMessage());
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
            return redirect()->route('data_pelanggan.index')->with('success', 'Data pelanggan berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->route('data_pelanggan.index')->with('error', 'Gagal memperbarui data pelanggan: ' . $e->getMessage());
        }
    }

    public function destroy(DataPelanggan $dataPelanggan)
    {
        try {
            $dataPelanggan->delete();
            return redirect()->route('data_pelanggan.index')->with('success', 'Data pelanggan berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('data_pelanggan.index')->with('error', 'Gagal menghapus data pelanggan: ' . $e->getMessage());
        }
    }
}
