<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\DataPelanggan;
use App\Models\DataPengguna;
use App\Models\ReferralLog; // Tambahkan model ReferralLog
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::all();
        return view('transaksi.index', compact('transaksi'));
    }

    public function create()
    {
        $pelanggan = DataPelanggan::all();
        $pengguna = DataPengguna::all();
        return view('transaksi.create', compact('pelanggan', 'pengguna'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'total_harga' => 'required|numeric',
            'nominal' => 'required|numeric',
            'tanggal_transaksi' => 'required|date',
            'id_pelanggan' => 'nullable|exists:data_pelanggan,id',
            'id_pengguna' => 'required|exists:data_pengguna,id',
            'kode_referal' => 'nullable|exists:data_pelanggan,kode_referal', // Validasi kode referral (opsional)
        ]);

        try {
            $transaksi = new Transaksi();
            $transaksi->total_harga = $request->total_harga;
            $transaksi->nominal = $request->nominal;
            $transaksi->tanggal_transaksi = $request->tanggal_transaksi;
            $transaksi->id_pelanggan = $request->id_pelanggan;
            $transaksi->id_pengguna = $request->id_pengguna;

            // Jika ada kode referral yang digunakan
            if ($request->kode_referal) {
                $referrer = DataPelanggan::where('kode_referal', $request->kode_referal)->first();
                if ($referrer) {
                    // Berikan diskon, misalnya 10% dari total harga
                    $transaksi->diskon = $request->total_harga * 0.1;
                    $transaksi->kode_referal = $request->kode_referal;

                    // Simpan log referral
                    ReferralLog::create([
                        'referrer_user_id' => $referrer->id,
                        'referred_user_id' => $request->id_pelanggan,
                        'transaction_id' => $transaksi->id, // ID transaksi
                        'used_at' => now(),
                    ]);
                }
            }

            $transaksi->save();

            return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->route('transaksi.index')->with('error', 'Gagal menambahkan transaksi');
        }
    }

    public function edit(Transaksi $transaksi)
    {
        $pelanggan = DataPelanggan::all();
        $pengguna = DataPengguna::all();
        return view('transaksi.edit', compact('transaksi', 'pelanggan', 'pengguna'));
    }

    public function update(Request $request, Transaksi $transaksi)
    {
        $request->validate([
            'total_harga' => 'required|numeric',
            'nominal' => 'required|numeric',
            'tanggal_transaksi' => 'required|date',
            'id_pelanggan' => 'nullable|exists:data_pelanggan,id',
            'id_pengguna' => 'required|exists:data_pengguna,id',
            'kode_referal' => 'nullable|exists:data_pelanggan,kode_referal', // Validasi kode referral (opsional)
        ]);

        try {
            $transaksi->total_harga = $request->total_harga;
            $transaksi->nominal = $request->nominal;
            $transaksi->tanggal_transaksi = $request->tanggal_transaksi;
            $transaksi->id_pelanggan = $request->id_pelanggan;
            $transaksi->id_pengguna = $request->id_pengguna;

            // Logika diskon referral hanya jika kode referral berubah
            if ($request->kode_referal && $request->kode_referal !== $transaksi->kode_referal) {
                $referrer = DataPelanggan::where('kode_referal', $request->kode_referal)->first();
                if ($referrer) {
                    $transaksi->diskon = $request->total_harga * 0.1;
                    $transaksi->kode_referal = $request->kode_referal;

                    // Update atau buat log referral baru
                    ReferralLog::updateOrCreate(
                        ['transaction_id' => $transaksi->id],
                        [
                            'referrer_user_id' => $referrer->id,
                            'referred_user_id' => $request->id_pelanggan,
                            'used_at' => now(),
                        ]
                    );
                }
            }

            $transaksi->save();

            return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->route('transaksi.index')->with('error', 'Gagal memperbarui transaksi');
        }
    }

    public function destroy(Transaksi $transaksi)
    {
        try {
            $transaksi->delete();
            return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('transaksi.index')->with('error', 'Gagal menghapus transaksi');
        }
    }
}
