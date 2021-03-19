<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DeactivatedEmployeeController extends Controller
{
    public function bin()
    {
        $users = User::onlyTrashed()->get();
        return view('admin.user.deactivated.bin', compact('users'));
    }

    public function restore($id)
    {
        User::onlyTrashed()->where('id', $id)->restore();
        return redirect()->route('web.admin.deactivated-employees')->with('message', 'Employee Reactivated!');
    }

    public function destroy($id)
    {
        User::onlyTrashed()->where('id', $id)->forceDelete();
        return redirect()->route('web.admin.deactivated-employees')->with('danger', 'Employee Deleted!');
    }
}
