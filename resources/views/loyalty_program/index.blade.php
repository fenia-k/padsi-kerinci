@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-3xl font-semibold text-[#8B4513] mb-6">Data Loyalty Program</h2>

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

    <!-- Search Bar and Create Button -->
    <div class="flex justify-between items-center mb-4">
        <form action="{{ route('loyalty_program.index') }}" method="GET" class="flex items-center w-1/3 relative" id="searchForm">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search ..." 
                   class="search-input w-full border border-gray-300 rounded-lg px-4 py-1 text-black placeholder-gray-500 focus:outline-none focus:border-[#8B4513] transition duration-200 ease-in-out" 
                   id="searchInput" autocomplete="off" style="font-size: 0.875rem;" />
            <button type="submit" class="absolute right-3 text-[#8B4513] p-2 search-icon">
                <i class="fas fa-search"></i> <!-- Font Awesome icon for search -->
            </button>
        </form>
    </div>

    <!-- Table -->
    <div class="bg-white shadow-md rounded-lg overflow-x-auto">
        <table class="min-w-full table-auto border-collapse border border-gray-200">
            <thead class="bg-secondary text-gray-800">
                <tr>
                    <th class="px-6 py-3 border-b font-semibold text-left text-gray-900">Pelanggan</th>
                    <th class="px-6 py-3 border-b font-semibold text-left text-gray-900">Kode Referral</th>
                    <th class="px-6 py-3 border-b font-semibold text-left text-gray-900">Batas Loyalty</th>
                    <th class="px-6 py-3 border-b font-semibold text-left text-gray-900">Aksi</th> <!-- Add action column -->
                </tr>
            </thead>
            <tbody class="bg-white">
                @forelse ($loyaltyPrograms as $program)
                <tr class="hover:bg-gray-100 transition-colors duration-200 ease-in-out">
                    <td class="px-6 py-4 border-b text-gray-800">{{ $program->pelanggan->nama_pelanggan ?? 'Tidak Ada' }}</td>
                    <td class="px-6 py-4 border-b text-gray-800">{{ $program->kode_referral }}</td>
                    <td class="px-6 py-4 border-b text-gray-800">{{ $program->batas_loyalty }}x</td>
                    <td class="px-6 py-4 border-b text-gray-800">
                        <!-- Delete Button -->
                        <form action="{{ route('loyalty_program.destroy', $program->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus program loyalty ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-white-500 hover:text-white-700">
                                <i class="fas fa-trash-alt"></i> 
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center px-6 py-4 text-gray-500">
                        Tidak ada data program loyalty yang tersedia.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $loyaltyPrograms->links() }}
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

<!-- Style -->
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
