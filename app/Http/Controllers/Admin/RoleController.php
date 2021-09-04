<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class RoleController extends Controller
{
    public function index()
    {
        if (Cache::has('roles.all')) {
            $roles = Cache::get('roles.all');
        } else {
            $roles = Cache::remember('roles.all', 60, function () {
                return Role::all();
            });
        }
        return view('admin.role.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.role.create');
    }

    public function store(Request $request)
    {
        Role::query()->create([
            'name' => $request->name,
        ]);
        cache()->forget('roles.all');
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
        cache()->forget('roles.all');
        return redirect()->route('web.admin.roles.index')->with('message', 'Role Updated!');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        cache()->forget('roles.all');
        return redirect()->route('web.admin.roles.index')->with('danger', 'Role Deleted!');
    }
}
