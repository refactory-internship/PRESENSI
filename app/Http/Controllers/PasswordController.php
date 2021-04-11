<?php

namespace App\Http\Controllers;

use App\Mail\ResetPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class PasswordController extends Controller
{
    public function sendEmailToAdmin(Request $request)
    {
        $userId = User::query()
            ->where('email', $request->email)
            ->value('id');
        Mail::to('admin@mail.com')->send(new ResetPassword($userId));

        return redirect()->back()->with('message', 'An email has been sent to Administrator');
    }

    public function resetPassword($id)
    {
        User::query()->findOrFail($id)->update([
            'password' => Hash::make('password')
        ]);

        return redirect()->route('login')->with('message', 'Password has been reset successfully');
    }
}
