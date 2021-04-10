<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        return view('auth.profile.show', compact('user'));
    }

    public function update(Request $request, $id)
    {
        User::query()->find($id)->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email
        ]);
        return redirect()->back()->with('message', 'Profile Updated');
    }

    public function editPassword()
    {
        $user = auth()->user();
        return view('auth.profile.password', compact('user'));
    }

    public function updatePassword(Request $request, $id)
    {
        $user = User::query()->find($id);

        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'password_confirmation' => ['required']
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('danger', 'Current password does not match');
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);
        return redirect()->back()->with('message', 'Password updated');
    }
}
