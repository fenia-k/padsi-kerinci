@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-3xl font-semibold text-[#8B4513] mb-6">Menu Data</h2>

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
        <form action="{{ route('menu.index') }}" method="GET" class="flex items-center w-1/3 relative" id="searchForm">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search Menu..." 
                   class="search-input w-full border border-gray-300 rounded-lg px-4 py-1 text-black placeholder-gray-500 focus:outline-none focus:border-[#8B4513] transition duration-200 ease-in-out" 
                   id="searchInput" autocomplete="off" style="font-size: 0.875rem;" />
            <button type="submit" class="absolute right-3 text-[#8B4513] p-2 search-icon">
                <i class="fas fa-search"></i> <!-- Font Awesome icon for search -->
            </button>
        </form>
        <a href="{{ route('menu.create') }}" class="bg-[#8B4513] hover:bg-[#A0522D] text-white font-bold py-2 px-4 rounded-lg shadow-lg transition duration-300 ease-in-out">
            + Add
        </a>
    </div>

    <!-- Menu Cards -->
    <div class="menu-cards grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-6">
        @forelse ($menus as $menu)
            <div class="menu-card relative border-2 border-[#8B4513] rounded-lg shadow-lg p-6 text-center bg-white">
                <div class="menu-id absolute top-2 left-2 font-bold bg-[#4A3B30] px-2 py-1 rounded">{{ $menu->id }}</div>
                <div class="menu-image rounded-full overflow-hidden bg-white mx-auto my-4" style="width: 120px; height: 120px;">
                    @if($menu->gambar_menu)
                        <img src="{{ asset('storage/' . $menu->gambar_menu) }}" alt="{{ $menu->nama_menu }}" class="w-full h-full object-cover">
                    @else
                        <p class="text-gray-500">No Image</p>
                    @endif
                </div>
                <div class="menu-info mt-4">
                    <h2 class="text-lg font-semibold text-[#8B4513] font-serif">{{ $menu->nama_menu }}</h2>
                    <p class="text-[#8B4513] font-bold">Rp {{ number_format($menu->harga_menu, 0, ',', '.') }}</p>
                    <p class="text-gray-500">{{ $menu->jumlah_menu }} Available</p>
                </div>
                <div class="menu-buttons flex justify-center gap-4 mt-4">
                    <a href="{{ route('menu.edit', $menu->id) }}" class="menuedit-btn px-4 py-1 bg-[#A0522D] text-white rounded-lg hover:bg-[#8B4513] transition-all">
                        Update
                    </a>
                    <form action="{{ route('menu.destroy', $menu->id) }}" method="POST" class="inline-block" id="deleteForm{{ $menu->id }}">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="menudelete-btn px-4 py-1 bg-[#8B0000] text-white rounded-lg hover:bg-[#B22222] transition-all"
                                onclick="confirmDelete({{ $menu->id }})">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <p class="col-span-full text-center text-gray-500">No menu data matching your search.</p>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $menus->links() }} <!-- Pagination links -->
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
// SweetAlert2 - Confirm Delete
function confirmDelete(menuId) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'This menu will be permanently deleted!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            // Submit the delete form
            document.getElementById('deleteForm' + menuId).submit();
        }
    });
}

// Auto-submit search on input change
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
