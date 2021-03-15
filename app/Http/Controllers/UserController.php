<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\Store;
use App\Models\DivisionOffice;
use App\Models\Office;
use App\Models\Role;
use App\Models\TimeSetting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        $parent = User::all();
        $offices = Office::query()->pluck('name', 'id');
        $roles = Role::query()->pluck('name', 'id');
        return view('admin.user.create', compact('offices', 'roles', 'parent'));
    }

    public function store(Store $request)
    {
        $division_office_id = DivisionOffice::query()
            ->where('division_id', $request->division)
            ->where('office_id', $request->office)
            ->value('id');

        User::query()->create([
            'role_id' => $request->role,
            'division_office_id' => $division_office_id,
            'time_setting_id' => $request->shift,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'parent_id' => $request->parent,
            'isAutoApproved' => $request->has('auto_approve') ? true : false
        ]);
        return redirect()->route('web.admin.users.index')->with('message', 'Employee Added!');
    }

    public function show(User $user)
    {
        return view('admin.user.show', compact('user'));
    }

    public function edit(User $user)
    {
        $parent = User::all();
        $offices = Office::query()->pluck('name', 'id');
        $roles = Role::query()->pluck('name', 'id');
        return view('admin.user.edit', compact('offices', 'roles', 'parent', 'user'));
    }

    public function update(Request $request, User $user)
    {
        $division_office_id = DivisionOffice::query()
            ->where('division_id', $request->division)
            ->where('office_id', $request->office)
            ->value('id');

        $user->update([
            'role_id' => $request->role,
            'division_office_id' => $division_office_id,
            'time_setting_id' => $request->shift,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'parent_id' => $request->parent,
            'isAutoApproved' => $request->has('auto_approve') ? true : false
        ]);
        return redirect()->route('web.admin.users.show', $user->id)->with('message', 'Employee Updated!');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('web.admin.users.index')->with('danger', 'Employee Deactivated!');
    }

    public function getDivision($id)
    {
        $office = Office::query()->with('division')->find($id);
        $division = $office->division->pluck('name', 'id');
        return response()->json($division);
    }

    public function getShift($id)
    {
        $time_setting = TimeSetting::query()
            ->where('division_id', $id)
            ->get(['start_time', 'end_time', 'id'])
            ->pluck('shift', 'id');

        return response()->json($time_setting);
    }

    public function getParent($office, $division)
    {
        $division_office_id = DivisionOffice::query()
            ->where('office_id', $office)
            ->where('division_id', $division)
            ->value('id');

        $user = User::query()
            ->where('division_office_id', $division_office_id)
            ->get(['first_name', 'last_name', 'id'])
            ->pluck('full_name', 'id');

        return response()->json($user);
    }
}
