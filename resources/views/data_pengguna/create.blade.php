@extends('layouts.app')

@section('title', 'Tambah Pengguna')

@section('content')
<div class="container">
    <h2>Tambah Pengguna</h2>

    <form action="{{ route('data_pengguna.store') }}" method="POST">
        @csrf
        <label for="nama_pengguna">Nama Pengguna</label>
        <input type="text" name="nama_pengguna" id="nama_pengguna" required>

        <label for="alamat_pengguna">Alamat Pengguna</label>
        <input type="text" name="alamat_pengguna" id="alamat_pengguna" required>

        <label for="noHP_pengguna">Nomor HP</label>
        <input type="text" name="noHP_pengguna" id="noHP_pengguna" required>

        <label for="id_role">Role</label>
        <select name="id_role" id="id_role" required>
            @if($roles->isEmpty())
                <option value="">Tidak ada role yang tersedia</option>
            @else
                @foreach($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->nama_role }}</option> <!-- Menggunakan kolom 'id' -->
                @endforeach
            @endif
        </select>

        <input type="submit" value="Simpan">
    </form>
</div>
@endsection
