<?php

namespace App\Http\Controllers;

use App\Models\DataPengguna;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class DataPenggunaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $dataPengguna = DataPengguna::when($search, function ($query, $search) {
            return $query->where('nama_pengguna', 'like', "%{$search}%");
        })->paginate(10);

        return view('data_pengguna.index', compact('dataPengguna', 'search'));
    }

    public function create()
    {
        $roles = Role::all(['id', 'nama_role']);
        return view('data_pengguna.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pengguna' => 'required',
            'alamat_pengguna' => 'required',
            'noHP_pengguna' => 'required',
            'id_role' => 'required|exists:role,id',
            'email' => 'required|email|unique:data_pengguna,email',
        ]);

        if (Role::find($request->id_role)->nama_role === 'owner' && DataPengguna::where('id_role', $request->id_role)->exists()) {
            return back()->withErrors(['error' => 'Hanya satu Owner yang diizinkan.'])->withInput();
        }

        $dataPengguna = DataPengguna::create($request->all());

        if (!User::where('email', $dataPengguna->email)->exists()) {
            $this->createUserAccount($dataPengguna);
        }

        return redirect()->route('data_pengguna.index')->with('success', 'User data and account successfully added');
    }

    public function edit(DataPengguna $dataPengguna)
    {
        $roles = Role::all(['id', 'nama_role']);
        return view('data_pengguna.edit', compact('dataPengguna', 'roles'));
    }

    public function update(Request $request, DataPengguna $dataPengguna)
    {
        $request->validate([
            'nama_pengguna' => 'required',
            'alamat_pengguna' => 'required',
            'noHP_pengguna' => 'required',
            'id_role' => 'required|exists:role,id',
            'email' => 'required|email|unique:data_pengguna,email,' . $dataPengguna->id,
        ]);

        $dataPengguna->update($request->all());
        return redirect()->route('data_pengguna.index')->with('success', 'User data updated successfully');
    }

    public function destroy(DataPengguna $dataPengguna)
    {
        $dataPengguna->delete();
        return redirect()->route('data_pengguna.index')->with('success', 'User data successfully deleted');
    }

    protected function createUserAccount(DataPengguna $dataPengguna)
    {
        $username = strtolower(str_replace(' ', '_', $dataPengguna->nama_pengguna));
    
        $email = $dataPengguna->email ?? $username . '@example.com';
        while (User::where('email', $email)->exists()) {
            $email = $username . '_' . rand(1000, 9999) . '@example.com';
        }
    
        $password = Str::random(8);
    
        $role = $dataPengguna->role->nama_role ?? Role::find($dataPengguna->id_role)->nama_role;
    
        User::create([
            'name' => $dataPengguna->nama_pengguna,
            'email' => $email,
            'password' => bcrypt($password),
            'role' => $role,
        ]);
    
        Log::info("Akun untuk {$dataPengguna->nama_pengguna} dibuat dengan email: {$email} dan password: {$password}");
    }    
}
