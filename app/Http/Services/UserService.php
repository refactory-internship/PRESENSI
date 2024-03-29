<?php


namespace App\Http\Services;


use App\Http\Requests\User\Store;
use App\Models\DivisionOffice;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;

class UserService
{
    public function store(Store $request)
    {
        $division_office_id = DivisionOffice::query()
            ->where('division_id', $request->division)
            ->where('office_id', $request->office)
            ->value('id');

        $parent = $request->parent;
        $isAutoApproved = false;

        if ($request->parent === null || $request->parent === '0') {
            $parent = null;
            $isAutoApproved = true;
        }

        // cache()->forget('users.all');
        $user =  User::query()->create([
            'role_id' => $request->role,
            'division_office_id' => $division_office_id,
            'time_setting_id' => $request->shift,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'parent_id' => $parent,
            'isAutoApproved' => $isAutoApproved
        ]);

        Mail::to($user->email)->send(new WelcomeEmail($user->id, $request->password));

        return $user;
    }

    public function update(Request $request, User $user)
    {
        $division_office_id = DivisionOffice::query()
            ->where('division_id', $request->division)
            ->where('office_id', $request->office)
            ->value('id');

        $parent = $request->parent;
        $isAutoApproved = false;

        if ($request->parent === null || $request->parent === '0') {
            $parent = null;
            $isAutoApproved = true;
        }

        // cache()->forget('users.all');
        return $user->update([
            'role_id' => $request->role,
            'division_office_id' => $division_office_id,
            'time_setting_id' => $request->shift,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'parent_id' => $parent,
            'isAutoApproved' => $isAutoApproved
        ]);
    }
}
