<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SanctumAuthController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'min:8']
        ]);

        if (!Auth::attempt($data)) {
            return response()->json([
                'message' => 'Credentials does not match!'
            ], 401);
        }

        return response()->json([
            'message' => 'Logged In Successfully',
            'token' => auth()->user()->createToken('api_token')->plainTextToken
        ]);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            'message' => 'Token Revoked'
        ]);
    }
}
