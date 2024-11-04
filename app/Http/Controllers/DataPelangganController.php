<?php

namespace App\Http\Controllers;

use App\Models\DataPelanggan;
use App\Models\LoyaltyProgram;
use App\Models\ReferralLog; // Import model ReferralLog
use Illuminate\Http\Request;

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
            'nama_pelanggan' => 'required',
            'alamat_pelanggan' => 'required',
            'noHP_pelanggan' => 'required',
            'kode_referal_input' => 'nullable|exists:data_pelanggan,kode_referal', // Validasi kode referral yang diinput (opsional)
        ]);

        try {
            // Ambil 3 huruf pertama dari nama depan pelanggan
            $namaDepan = strtoupper(substr(explode(' ', trim($request->nama_pelanggan))[0], 0, 3));

            // Tambahkan 2 karakter acak (angka)
            $kodeReferal = $namaDepan . '-' . mt_rand(10, 99);

            // Simpan data pelanggan dengan kode referral
            $dataPelanggan = new DataPelanggan();
            $dataPelanggan->nama_pelanggan = $request->nama_pelanggan;
            $dataPelanggan->alamat_pelanggan = $request->alamat_pelanggan;
            $dataPelanggan->noHP_pelanggan = $request->noHP_pelanggan;
            $dataPelanggan->kode_referal = $kodeReferal;
            $dataPelanggan->poin = 0; // Set default poin untuk pelanggan baru
            $dataPelanggan->save();

            // Jika ada kode referral yang diinput
            if ($request->kode_referal_input) {
                // Cari pengguna yang memiliki kode referral tersebut
                $referrer = DataPelanggan::where('kode_referal', $request->kode_referal_input)->first();

                if ($referrer) {
                    // Tambahkan poin ke referrer
                    $referralPoints = 50; // Jumlah poin untuk setiap pendaftaran baru yang menggunakan referral
                    $referrer->increment('poin', $referralPoints);

                    // Simpan log referral dengan poin yang diberikan
                    ReferralLog::create([
                        'referrer_user_id' => $referrer->id,
                        'referred_user_id' => $dataPelanggan->id, // ID pengguna baru yang mendaftar
                        'poin' => $referralPoints,
                        'used_at' => now(),
                    ]);
                }
            }

            // Simpan program loyalty otomatis
            LoyaltyProgram::create([
                'id_pelanggan' => $dataPelanggan->id,
                'kode_referral' => $kodeReferal,
                'diskon' => 5000.00, // Diskon default Rp 5.000
                'batas_loyalty' => 5, // Batas loyalty default 5x
            ]);

            return redirect()->route('data_pelanggan.index')->with('success', 'Data pelanggan berhasil ditambahkan dengan kode referral: ' . $kodeReferal);
        } catch (\Exception $e) {
            return redirect()->route('data_pelanggan.index')->with('error', 'Gagal menambahkan data pelanggan');
        }
    }

    public function edit(DataPelanggan $dataPelanggan)
    {
        return view('data_pelanggan.edit', compact('dataPelanggan'));
    }

    public function update(Request $request, DataPelanggan $dataPelanggan)
    {
        $request->validate([
            'nama_pelanggan' => 'required',
            'alamat_pelanggan' => 'required',
            'noHP_pelanggan' => 'required',
        ]);

        try {
            $dataPelanggan->update($request->all());
            return redirect()->route('data_pelanggan.index')->with('success', 'Data pelanggan berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->route('data_pelanggan.index')->with('error', 'Gagal memperbarui data pelanggan');
        }
    }

    public function destroy(DataPelanggan $dataPelanggan)
    {
        try {
            $dataPelanggan->delete();
            return redirect()->route('data_pelanggan.index')->with('success', 'Data pelanggan berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('data_pelanggan.index')->with('error', 'Gagal menghapus data pelanggan');
        }
    }
}
