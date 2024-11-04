<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('role.index', compact('roles'));
    }

    public function create()
    {
        return view('role.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_role' => 'required|unique:role,nama_role',
        ]);

        Role::create($request->all());
        return redirect()->route('role.index')->with('success', 'Role berhasil ditambahkan');
    }

    public function edit(Role $role)
    {
        return view('role.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'nama_role' => 'required|unique:role,nama_role,' . $role->id,
        ]);

        $role->update($request->all());
        return redirect()->route('role.index')->with('success', 'Role berhasil diperbarui');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('role.index')->with('success', 'Role berhasil dihapus');
    }
}
