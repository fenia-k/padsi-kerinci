<style>
    /* Sidebar Styling with Light Brown Text */
    aside {
        background: linear-gradient(90deg, #d2a679, #b98b5e); /* Gradasi dari warna lebih terang (#d2a679) ke warna lebih gelap (#b98b5e) */
        color: #4B3621; /* Warna teks cokelat gelap untuk sidebar */
    }

    aside nav a {
        transition: background-color 0.3s ease; /* Transisi smooth */
    }

    aside nav a:hover {
        background-color: #8B5E3C; /* Warna cokelat lebih gelap saat hover */
        color: #ffffff; /* Warna teks saat hover */
    }

    aside nav a.active {
        background-color: #6B3E2B; /* Warna cokelat lebih tua untuk link aktif */
        color: #ffffff; /* Warna teks pada link aktif */
    }

    /* Sidebar link colors */
    aside nav a {
        color: #e9e1d6; /* Teks cokelat muda */
    }

    /* Sidebar logo background */
    aside .p-4 {
        background-color: #A0522D; /* Warna latar belakang logo */
    }

    aside nav {
        background-color: rgba(0, 0, 0, 0.1); /* Sedikit transparansi di area navigasi */
    }

    aside nav .mb-6 h3 {
        color: #e9e1d6; /* Warna teks header navigation (cokelat muda) */
    }

    aside nav a {
        background-color: transparent; /* Pastikan link tidak punya background default */
    }

    aside nav a:hover {
        background-color: #6B3E2B; /* Warna gelap saat hover */
        color: #fff; /* Teks putih saat hover */
    }

    /* Customizing the logout button */
    form button {
        background-color: #A0522D; /* Warna latar belakang logout */
        color: #fff;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    form button:hover {
        background-color: #8B4513; /* Warna saat hover */
    }
</style>

<aside class="w-64 h-screen bg-gradient-to-b from-[#e9e1d6] to-[#B98B5E] text-[#4b3621] flex flex-col fixed top-0 left-0">
    <!-- Logo Section -->
    <div class="p-4 text-2xl font-bold border-b border-[#e9e1d6] flex items-center justify-center">
        <img src="{{ asset('logo kerinci.jpg') }}" alt="Kerinci Logo" class="w-12 h-12 rounded-full">
    </div>

    <!-- Sidebar Navigation -->
    <nav class="flex-1 p-4 overflow-y-auto">
        <!-- Dashboard Section -->
        <div class="mb-6">
            <h3 class="text-xs font-semibold text-[#e9e1d6] uppercase tracking-wide mb-1">Dashboard</h3>
            <a href="{{ route('dashboard') }}" class="block p-2 rounded {{ Route::currentRouteName() == 'dashboard' ? 'active' : 'inactive' }} flex items-center">
                <i class="fas fa-tachometer-alt text-sm mr-5"></i>
                <span>Dashboard</span>
            </a>
        </div>

        <!-- Transactions & Reports Section -->
        <div class="mb-6">
            <h3 class="text-xs font-semibold text-[#e9e1d6] uppercase tracking-wide mb-1">Transactions & Reports</h3>
            <a href="{{ route('transaksi.index') }}" class="block p-2 rounded {{ Route::currentRouteName() == 'transaksi.index' ? 'active' : 'inactive' }} flex items-center">
                <i class="fas fa-exchange-alt text-sm mr-5"></i>
                <span>Transaction</span>
            </a>
            @if(auth()->user()->role === 'owner')
            <a href="{{ route('laporan.index') }}" class="block p-2 rounded {{ Route::currentRouteName() == 'laporan.index' ? 'active' : 'inactive' }} flex items-center">
                <i class="fas fa-file-alt text-sm mr-5"></i>
                <span>Report</span>
            </a>
            @endif
        </div>

        <!-- Internal Section -->
        <div class="mb-6">
            <h3 class="text-xs font-semibold text-[#e9e1d6] uppercase tracking-wide mb-1">Internal</h3>
            <a href="{{ route('data_pelanggan.index') }}" class="block p-2 rounded {{ Route::currentRouteName() == 'data_pelanggan.index' ? 'active' : 'inactive' }} flex items-center">
                <i class="fas fa-users text-sm mr-5"></i>
                <span>Customer</span>
            </a>
            @if(auth()->user()->role === 'owner')
            <a href="{{ route('data_pengguna.index') }}" class="block p-2 rounded {{ Route::currentRouteName() == 'data_pengguna.index' ? 'active' : 'inactive' }} flex items-center">
                <i class="fas fa-user-shield text-sm mr-5"></i>
                <span>Users</span>
            </a>
            @endif
            <a href="{{ route('loyalty_program.index') }}" class="block p-2 rounded {{ Route::currentRouteName() == 'loyalty_program.index' ? 'active' : 'inactive' }} flex items-center">
                <i class="fas fa-gift text-sm mr-5"></i>
                <span>Loyalty Program</span>
            </a>
            <a href="{{ route('menu.index') }}" class="block p-2 rounded {{ Route::currentRouteName() == 'menu.index' ? 'active' : 'inactive' }} flex items-center">
                <i class="fas fa-book-open text-sm mr-5"></i>
                <span>Menu</span>
            </a>
            <a href="{{ route('stok.index') }}" class="block p-2 rounded {{ Route::currentRouteName() == 'stok.index' ? 'active' : 'inactive' }} flex items-center">
                <i class="fas fa-boxes text-sm mr-5"></i>
                <span>Stock</span>
            </a>
        </div>
    </nav>

    <!-- Logout Button -->
    <form method="POST" action="{{ route('logout') }}" class="p-4 border-t ">
        @csrf
        <button type="submit" class="w-full text-left p-2 rounded flex items-center">
            <i class="fas fa-sign-out-alt text-sm mr-5"></i>
            <span>Logout</span>
        </button>
    </form>
</aside>
