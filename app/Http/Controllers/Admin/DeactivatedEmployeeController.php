<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DeactivatedEmployeeController extends Controller
{
    public function bin()
    {
        $users = Cache::remember('user-trashed.all', 60, function () {
            return User::onlyTrashed()->get();
        });
        return view('admin.user.deactivated.bin', compact('users'));
    }

    public function restore($id)
    {
        User::onlyTrashed()->where('id', $id)->restore();
        Cache::forget('user-trashed.all');
        return redirect()->route('web.admin.deactivated-employees')->with('message', 'Employee Reactivated!');
    }

    public function destroy($id)
    {
        User::onlyTrashed()->where('id', $id)->forceDelete();
        Cache::forget('user-trashed.all');
        return redirect()->route('web.admin.deactivated-employees')->with('danger', 'Employee Deleted!');
    }
}
