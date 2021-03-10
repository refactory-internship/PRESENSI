<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('admin.role.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.role.create');
    }

    public function store(Request $request)
    {
        Role::query()->create([
            'name' => $request->name
        ]);
        return redirect()->route('web.admin.roles.index')->with('message', 'Role Added!');
    }

    public function show(Role $role)
    {
        return view('admin.role.show', compact('role'));
    }

    public function edit(Role $role)
    {
        return view('admin.role.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $role->update([
           'name' => $request->name
        ]);
        return redirect()->route('web.admin.roles.index')->with('message', 'Role Updated!');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('web.admin.roles.index')->with('danger', 'Role Deleted!');
    }
}
