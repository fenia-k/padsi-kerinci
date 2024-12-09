@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-3xl font-semibold text-[#8B4513] mb-6">Loyalty Program Data</h2>

    <!-- Notification Message -->
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
            <thead class="bg-[#D2B48C] text-[#4A3B30]">
                <tr>
                    <th class="px-6 py-3 border-b font-semibold text-left text-[#5e2a04]">Customer</th>
                    <th class="px-6 py-3 border-b font-semibold text-left text-[#5e2a04]">Referral Code</th>
                    <th class="px-6 py-3 border-b font-semibold text-left text-[#5e2a04]">Loyalty Limit</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @forelse ($loyaltyPrograms as $program)
                <tr class="hover:bg-[#F5DEB3] transition-colors duration-200 ease-in-out">
                    <td class="px-6 py-4 border-b text-[#5e2a04]">{{ $program->pelanggan->nama_pelanggan ?? 'None' }}</td>
                    <td class="px-6 py-4 border-b text-[#5e2a04]">{{ $program->kode_referal }}</td>
                    <td class="px-6 py-4 border-b text-[#5e2a04]">{{ $program->batas_loyalty }}x</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center px-6 py-4 text-gray-500">
                        No loyalty program data available.
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
