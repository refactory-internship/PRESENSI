<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\API\ResetPassword;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class PasswordController extends Controller
{
    public function sendEmailToAdmin(Request $request)
    {
        $userId = User::query()
            ->where('email', $request->email)
            ->value('id');
        $token = bin2hex(openssl_random_pseudo_bytes(16));

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::to('admin@mail.com')->send(new ResetPassword($userId, $token));

        return response()->json([
            'message' => 'An email has been sent to Administrator'
        ]);
    }

    public function resetPassword($id, $token)
    {
        $user = User::query()->findOrFail($id);
        $tokenFromDB = DB::table('password_resets')
            ->where('email', $user->email)
            ->value('token');

        if ($token === $tokenFromDB) {
            $user->update([
                'password' => Hash::make('password')
            ]);

            DB::table('password_resets')->where('email', $user->email)->delete();

            return response()->json([
                'message' => 'Password has been reset successfully'
            ]);
        } else {
            return response()->json([
                'message' => 'Token does not match'
            ]);
        }
    }
}
