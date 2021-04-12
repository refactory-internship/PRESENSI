<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        return response()->json(new UserResource(auth()->user()));
    }

    public function update(Request $request, $id)
    {
        User::query()->findOrFail($id)->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email
        ]);
        return response()->json([
            'data' => new UserResource(User::query()->findOrFail($id)),
            'message' => 'Profile Updated'
        ]);
    }

    public function updatePassword(Request $request, $id)
    {
        $user = User::query()->findOrFail($id);

        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'password_confirmation' => ['required']
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'message' => 'Current password does not match'
            ]);
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);
        return response()->json([
            'data' => new UserResource($user),
            'message' => 'Password Updated'
        ]);
    }
}
