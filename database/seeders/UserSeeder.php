<?php

namespace Database\Seeders;

use App\Models\Division;
use App\Models\DivisionOffice;
use App\Models\User;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = 'password';
        $today = Carbon::now();

        DB::table('users')->insert([
            [
                'role_id' => 1,
                'division_office_id' => null,
                'time_setting_id' => null,
                'first_name' => 'admin',
                'last_name' => null,
                'email' => 'fajarpratama.dev@gmail.com',
                'password' => Hash::make($password),
                'isAutoApproved' => false,
                'created_at' => date($today),
                'updated_at' => date($today)
            ],
        ]);

        foreach (DivisionOffice::all() as $division_office) {
            User::query()->create([
                'role_id' => 2,
                'division_office_id' => $division_office->id,
                'time_setting_id' => $division_office->division->time_settings[0]->id,
                'first_name' => 'Tech',
                'last_name' => 'Lead',
                'email' => 'tech.lead@mail.com',
                'password' => Hash::make($password),
                'isAutoApproved' => true,
            ]);
        }
    }
}
