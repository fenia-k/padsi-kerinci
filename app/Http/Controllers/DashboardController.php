<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataPelanggan;
use App\Models\DataPengguna;
use App\Models\Laporan;
use App\Models\LoyaltyProgram;
use App\Models\Menu;
use App\Models\Role;
use App\Models\Stok;
use App\Models\Transaksi;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'data_pelanggan' => DataPelanggan::all(),
            'data_pengguna' => DataPengguna::all(),
            'laporan' => Laporan::all(),
            'loyalty_program' => LoyaltyProgram::all(),
            'menu' => Menu::all(),
            'role' => Role::all(),
            'stok' => Stok::all(),
            'transaksi' => Transaksi::all(),
        ]);
    }
}
