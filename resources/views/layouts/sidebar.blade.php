<aside class="w-64 h-screen bg-gray-800 text-white flex flex-col">
    <!-- Logo / Nama Aplikasi -->
    <div class="p-4 text-2xl font-bold border-b border-gray-700">
        {{ config('app.name', 'Laravel') }}
    </div>

    <!-- Navigasi Sidebar -->
    <nav class="flex-1 p-4 space-y-2">
        <a href="{{ route('dashboard') }}" class="block p-2 rounded hover:bg-gray-700">
            Dashboard
        </a>
        <a href="{{ route('data_pelanggan.index') }}" class="block p-2 rounded hover:bg-gray-700">
            Data Pelanggan
        </a>
        <a href="{{ route('data_pengguna.index') }}" class="block p-2 rounded hover:bg-gray-700">
            Data Pengguna
        </a>
        <a href="{{ route('laporan.index') }}" class="block p-2 rounded hover:bg-gray-700">
            Laporan
        </a>
        <a href="{{ route('loyalty_program.index') }}" class="block p-2 rounded hover:bg-gray-700">
            Loyalty Program
        </a>
        <a href="{{ route('menu.index') }}" class="block p-2 rounded hover:bg-gray-700">
            Menu
        </a>
        <a href="{{ route('stok.index') }}" class="block p-2 rounded hover:bg-gray-700">
            Stok
        </a>
        <a href="{{ route('transaksi_penjualan.index') }}" class="block p-2 rounded hover:bg-gray-700">
            Transaksi Penjualan
        </a>
    </nav>

    <!-- Tombol Logout -->
    <form method="POST" action="{{ route('logout') }}" class="p-4 border-t border-gray-700">
        @csrf
        <button type="submit" class="w-full text-left p-2 rounded hover:bg-gray-700">
            Logout
        </button>
    </form>
</aside>
