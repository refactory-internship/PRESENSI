<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\User\Store;
use App\Http\Services\UserService;
use App\Models\Division;
use App\Models\DivisionOffice;
use App\Models\Office;
use App\Models\Role;
use App\Models\TimeSetting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        // if (Cache::has('users.all')) {
        //     $users = Cache::get('users.all');
        // } else {
        //     $users = Cache::remember("users.all", 60, function () {
        //         return User::with('division_office.office', 'division_office.division', 'role', 'parent')
        //             ->where('role_id', '!=', 1)
        //             ->latest()
        //             ->get();
        //     });
        // }

        $users = User::with('division_office.office', 'division_office.division', 'role', 'parent')
            ->where('role_id', '!=', 1)
            ->latest()
            ->get();

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
        $this->userService->store($request);
        return redirect()->route('web.admin.users.index')->with('message', 'Employee Added!');
    }

    public function show(User $user)
    {
        return view('admin.user.show', compact('user'));
    }

    public function edit(User $user)
    {
        $parent = User::query()
            ->where('id', '!=', 1)
            ->where('id', '!=', $user->id)
            ->where('division_office_id', $user->division_office_id)
            ->get();
        $offices = Office::query()->with('division')->get();
        $divisionOffice = DivisionOffice::query()
            ->where('office_id', $user->division_office->office->id)
            ->get();
        $roles = Role::query()->pluck('name', 'id');
        return view('admin.user.edit', compact('offices', 'roles', 'parent', 'user', 'divisionOffice'));
    }

    public function update(Request $request, User $user)
    {
        $this->userService->update($request, $user);
        return redirect()->route('web.admin.users.show', $user->id)->with('message', 'Employee Updated!');
    }

    public function destroy(User $user)
    {
        $user->delete();
        // cache()->forget('users.all');
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
