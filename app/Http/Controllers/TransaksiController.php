<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\DataPelanggan;
use App\Models\DataPengguna;
use App\Models\Menu;
use App\Models\ReferralLog;
use App\Models\LoyaltyProgram; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::with('menu', 'pelanggan', 'pengguna')->get();
        return view('transaksi.index', compact('transaksi'));
    }

    public function create()
    {
        $pelanggan = DataPelanggan::all();
        $pengguna = DataPengguna::all();
        $menu = Menu::all();

        return view('transaksi.create', compact('pelanggan', 'pengguna', 'menu'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_menu' => 'required|exists:menu,id',
            'jumlah' => 'required|numeric|min:1',
            'nominal' => 'nullable|numeric',
            'tanggal_transaksi' => 'required|date',
            'id_pelanggan' => 'nullable|exists:data_pelanggan,id',
            'id_pengguna' => 'required|exists:data_pengguna,id',
            'kode_referal' => 'nullable|exists:data_pelanggan,kode_referal',
            'poin_digunakan' => 'nullable|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            $menu = Menu::find($request->id_menu);
            $totalHarga = $menu->harga_menu * $request->jumlah;
            $diskonPoin = 0;

            if ($request->id_pelanggan && $request->poin_digunakan) {
                $pelanggan = DataPelanggan::find($request->id_pelanggan);

                if ($request->poin_digunakan > $pelanggan->poin) {
                    return redirect()->back()->withErrors(['poin_digunakan' => 'Jumlah poin yang digunakan melebihi jumlah poin yang tersedia']);
                }

                $diskonPoin = $request->poin_digunakan;
                $pelanggan->decrement('poin', $diskonPoin);
            }

            $totalHargaAkhir = max(0, $totalHarga - $diskonPoin);

            $transaksi = new Transaksi();
            $transaksi->fill([
                'id_menu' => $request->id_menu,
                'jumlah' => $request->jumlah,
                'total_harga' => $totalHargaAkhir,
                'nominal' => $request->nominal ?? 0, // Default to 0 if null
                'tanggal_transaksi' => $request->tanggal_transaksi,
                'id_pelanggan' => $request->id_pelanggan,
                'id_pengguna' => $request->id_pengguna,
                'diskon' => $diskonPoin,
                'poin_digunakan' => $diskonPoin,
                'kode_referal' => $request->kode_referal,
            ]);
            $transaksi->save();

        // Proses referral dan update batas pemakaian di LoyaltyProgram
        if ($request->kode_referal) {
            $referrer = DataPelanggan::where('kode_referal', $request->kode_referal)->first();
            if ($referrer) {
                // Update LoyaltyProgram
                $loyaltyProgram = LoyaltyProgram::where('id_pelanggan', $referrer->id)->first();
                if ($loyaltyProgram) {
                    $loyaltyProgram->decrement('batas_loyalty', 1); // Mengurangi batas loyalty
                }

                // Log referral
                ReferralLog::create([
                    'referrer_user_id' => $referrer->id,
                    'referred_user_id' => $request->id_pelanggan,
                    'transaction_id' => $transaksi->id,
                    'poin' => 5000,
                    'used_at' => now(),
                ]);

                $referrer->increment('poin', 5000);

                if ($request->id_pelanggan) {
                    $referredPelanggan = DataPelanggan::find($request->id_pelanggan);
                    $referredPelanggan->increment('poin', 3000);
                }
            }
        }

        DB::commit();
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->route('transaksi.index')->with('error', 'Gagal menambahkan transaksi: ' . $e->getMessage());
    }
}

    public function edit(Transaksi $transaksi)
    {
        $pelanggan = DataPelanggan::all();
        $pengguna = DataPengguna::all();
        $menu = Menu::all();

        return view('transaksi.edit', compact('transaksi', 'pelanggan', 'pengguna', 'menu'));
    }

    public function update(Request $request, Transaksi $transaksi)
    {
        $request->validate([
            'id_menu' => 'required|exists:menu,id',
            'jumlah' => 'required|numeric|min:1',
            'nominal' => 'nullable|numeric',
            'tanggal_transaksi' => 'required|date',
            'id_pelanggan' => 'nullable|exists:data_pelanggan,id',
            'id_pengguna' => 'required|exists:data_pengguna,id',
            'kode_referal' => 'nullable|exists:data_pelanggan,kode_referal',
            'poin_digunakan' => 'nullable|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            $menu = Menu::find($request->id_menu);
            $totalHarga = $menu->harga_menu * $request->jumlah;
            $diskonPoin = $request->poin_digunakan ?? $transaksi->poin_digunakan;

            $transaksi->update([
                'id_menu' => $request->id_menu,
                'jumlah' => $request->jumlah,
                'total_harga' => $totalHarga,
                'nominal' => $request->nominal ?? 0,
                'tanggal_transaksi' => $request->tanggal_transaksi,
                'id_pelanggan' => $request->id_pelanggan,
                'id_pengguna' => $request->id_pengguna,
                'poin_digunakan' => $diskonPoin,
                'kode_referal' => $request->kode_referal,
            ]);

            if ($request->kode_referal && $request->kode_referal !== $transaksi->kode_referal) {
                $referrer = DataPelanggan::where('kode_referal', $request->kode_referal)->first();
                if ($referrer) {
                    ReferralLog::updateOrCreate(
                        ['transaction_id' => $transaksi->id],
                        [
                            'referrer_user_id' => $referrer->id,
                            'referred_user_id' => $request->id_pelanggan,
                            'poin' => 5000,
                            'used_at' => now(),
                        ]
                    );

                    $referrer->increment('poin', 5000);
                    if ($request->id_pelanggan) {
                        $referredPelanggan = DataPelanggan::find($request->id_pelanggan);
                        $referredPelanggan->increment('poin', 3000);
                    }
                }
            }

            DB::commit();
            return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('transaksi.index')->with('error', 'Gagal memperbarui transaksi: ' . $e->getMessage());
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

    public function detail($id)
    {
        $transaksi = Transaksi::with('menu', 'pelanggan', 'pengguna')->findOrFail($id);
        return view('transaksi.detail', compact('transaksi'));
    }
}
