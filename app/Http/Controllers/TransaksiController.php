<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\DataPelanggan;
use App\Models\DataPengguna;
use App\Models\Menu;
use App\Models\ReferralLog;
use App\Models\LoyaltyProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    // Menampilkan daftar transaksi dengan paginasi
    public function index()
    {
        $transaksi = Transaksi::with('detailTransaksi.menu', 'pelanggan', 'pengguna')->paginate(10);
        return view('transaksi.index', compact('transaksi'));
    }

    // Menampilkan halaman untuk membuat transaksi baru
    public function create()
    {
        $pelanggan = DataPelanggan::all();
        $pengguna = DataPengguna::all();
        $menu = Menu::all();

        return view('transaksi.create', compact('pelanggan', 'pengguna', 'menu'));
    }

    // Menyimpan transaksi baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'produk' => 'required|array',
            'produk.*.id_menu' => 'required|exists:menu,id',
            'produk.*.jumlah' => 'required|numeric|min:1',
            'tanggal_transaksi' => 'required|date',
            'id_pelanggan' => 'nullable|exists:data_pelanggan,id',
            'id_pengguna' => 'required|exists:data_pengguna,id',
            'kode_referal' => 'nullable|exists:loyalty_program,kode_referral', // Disesuaikan dengan nama tabel
            'poin_digunakan' => 'nullable|numeric|min:0',
            'nominal' => 'nullable|numeric|min:0',
        ]);
    
        DB::beginTransaction();
        try {
            $totalHarga = 0;
            $totalJumlah = 0;
    
            // Validasi dan pengurangan stok menu
            foreach ($request->produk as $produk) {
                $menu = Menu::findOrFail($produk['id_menu']);
                if ($menu->jumlah_menu < $produk['jumlah']) {
                    return redirect()->back()->withErrors(['produk' => "Stok tidak mencukupi untuk produk {$menu->nama_menu}"]);
                }
    
                $totalProduk = $menu->harga_menu * $produk['jumlah'];
                $totalHarga += $totalProduk;
                $totalJumlah += $produk['jumlah'];
    
                // Mengurangi stok menu
                $menu->decrement('jumlah_menu', $produk['jumlah']);
            }
    
            // Penanganan poin pelanggan jika digunakan
            $poinYangDigunakan = min($request->poin_digunakan ?? 0, $totalHarga);
    
            if ($request->id_pelanggan && $poinYangDigunakan > 0) {
                $pelanggan = DataPelanggan::find($request->id_pelanggan);
                if ($poinYangDigunakan > $pelanggan->poin) {
                    return redirect()->back()->withErrors(['poin_digunakan' => 'Poin yang digunakan melebihi jumlah yang tersedia']);
                }
                $pelanggan->decrement('poin', $poinYangDigunakan);
            }
    
            // Penanganan kode referral
            if ($request->kode_referal) {
                $loyaltyProgram = LoyaltyProgram::where('kode_referral', $request->kode_referal)->first();
    
                if ($loyaltyProgram) {
                    if ($loyaltyProgram->batas_loyalty <= 0) {
                        return redirect()->back()->withErrors(['kode_referal' => 'Batas penggunaan kode referral telah habis.']);
                    }
    
                    // Kurangi batas loyalitas
                    $loyaltyProgram->decrement('batas_loyalty');
                }
            }
    
            // Simpan transaksi
            $transaksi = Transaksi::create([
                'id_pelanggan' => $request->id_pelanggan,
                'id_pengguna' => $request->id_pengguna,
                'tanggal_transaksi' => $request->tanggal_transaksi,
                'kode_referal' => $request->kode_referal,
                'total_harga' => $totalHarga,
                'jumlah' => $totalJumlah,
                'nominal' => $request->nominal ?? 0,
                'poin_digunakan' => $poinYangDigunakan,
            ]);
    
            // Menyimpan detail transaksi
            foreach ($request->produk as $produk) {
                $menu = Menu::findOrFail($produk['id_menu']);
                DetailTransaksi::create([
                    'id_transaksi' => $transaksi->id,
                    'id_menu' => $menu->id,
                    'jumlah_pesanan' => $produk['jumlah'],
                    'harga_menu' => $menu->harga_menu,
                    'sub_total' => $menu->harga_menu * $produk['jumlah'],
                ]);
            }
    
            DB::commit();
            return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('transaksi.index')->with('error', 'Gagal menambahkan transaksi: ' . $e->getMessage());
        }
    }
    

    // Menampilkan detail transaksi
    public function detail($id)
    {
        $transaksi = Transaksi::with('detailTransaksi.menu', 'pelanggan', 'pengguna')->findOrFail($id);
        return view('transaksi.detail', compact('transaksi'));
    }

    // Menghapus transaksi dan mengembalikan stok produk
    public function destroy(Transaksi $transaksi)
    {
        try {
            foreach ($transaksi->detailTransaksi as $detail) {
                $menu = Menu::find($detail->id_menu);
                if ($menu) {
                    $menu->increment('jumlah_menu', $detail->jumlah_pesanan);
                }
            }
            $transaksi->delete();
            return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('transaksi.index')->with('error', 'Gagal menghapus transaksi');
        }
    }
}
