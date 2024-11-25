@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-3xl font-semibold text-[#8B4513] mb-6">Data Pengguna</h2>

    <!-- Notifikasi Pesan -->
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <!-- Form Pencarian dan Button Tambah Data -->
    <div class="flex justify-between items-center mb-4">
        <form method="GET" action="{{ route('data_pengguna.index') }}" class="flex items-center w-1/3 relative" id="searchForm">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search users..." 
                   class="search-input w-full border border-gray-300 rounded-lg px-4 py-1 text-black placeholder-gray-500 focus:outline-none focus:border-[#8B4513] transition duration-200 ease-in-out" 
                   id="searchInput" autocomplete="off" style="font-size: 0.875rem;" />
            <button type="submit" class="absolute right-3 text-[#8B4513] p-2 search-icon">
                <i class="fas fa-search"></i> <!-- Font Awesome icon for search -->
            </button>
        </form>
        
        <a href="{{ route('data_pengguna.create') }}" class="bg-[#8B4513] hover:bg-[#A0522D] text-white font-bold py-2 px-4 rounded-lg shadow-lg transition duration-300 ease-in-out">
            + Tambah Data
        </a>
    </div>

    <!-- Table -->
    <div class="bg-[#FFF5E1] shadow-md rounded-lg overflow-x-auto">
        <table class="min-w-full table-auto border-collapse border border-[#D2B48C]">
            <thead class="bg-[#D2B48C] text-[#5e2a04]">
                <tr>
                    <th class="px-6 py-3 border-b font-semibold text-left text-[#5e2a04]">Nama Pengguna</th>
                    <th class="px-6 py-3 border-b font-semibold text-left text-[#5e2a04]">Email</th>
                    <th class="px-6 py-3 border-b font-semibold text-left text-[#5e2a04]">No HP</th>
                    <th class="px-6 py-3 border-b font-semibold text-left text-[#5e2a04]">Alamat Pengguna</th>
                    <th class="px-6 py-3 border-b font-semibold text-left text-[#5e2a04]">Role</th>
                    <th class="px-6 py-3 border-b font-semibold text-left text-[#5e2a04]">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-[#FFF5E1]">
                @forelse ($dataPengguna as $pengguna)
                <tr class="hover:bg-[#F5DEB3] transition-colors duration-200 ease-in-out">
                    <td class="px-6 py-4 border-b text-[#5e2a04]">{{ $pengguna->nama_pengguna }}</td>
                    <td class="px-6 py-4 border-b text-[#5e2a04]">{{ $pengguna->email }}</td>
                    <td class="px-6 py-4 border-b text-[#5e2a04]">{{ $pengguna->noHP_pengguna }}</td>
                    <td class="px-6 py-4 border-b text-[#5e2a04]">{{ $pengguna->alamat_pengguna }}</td>
                    <td class="px-6 py-4 border-b text-[#5e2a04]">{{ $pengguna->role->nama_role ?? 'Tidak Ada' }}</td>
                    <td class="px-6 py-4 border-b flex space-x-2">
                        <a href="{{ route('data_pengguna.edit', $pengguna->id) }}" class="bg-[#8B4513] hover:bg-[#A0522D] text-white font-semibold px-3 py-1 rounded-lg transition duration-300 ease-in-out">
                            Edit
                        </a>
                        <form action="{{ route('data_pengguna.destroy', $pengguna->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-[#8B0000] hover:bg-[#B22222] text-white font-semibold px-3 py-1 rounded-lg transition duration-300 ease-in-out"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center px-6 py-4 text-gray-500">
                        {{ request('search') ? 'Pengguna dengan nama "' . request('search') . '" tidak ditemukan.' : 'Tidak ada data yang tersedia.' }}
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $dataPengguna->links() }}
    </div>
</div>

<script>
document.getElementById('searchInput').addEventListener('input', function() {
    clearTimeout(this.delay);
    this.delay = setTimeout(() => {
        document.getElementById('searchForm').submit();
    }, 500);
});
</script>

<!-- Inline CSS for Coffee-Themed Colors -->
<style>
     .container {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }
    .search-input {
        border-radius: 0.5rem;
    }

    .search-icon {
        background: transparent;
        border: none;
    }
    .search-icon:hover {
        background: transparent;
        cursor: pointer;
    }
</style>
@endsection
