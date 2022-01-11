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
        $faker = Factory::create();
        $first_name = $faker->firstName;
        $last_name = $faker->lastName;
        $email = strtolower($first_name) . '@company.mail';
        DB::table('users')->insert([
            [
                'role_id' => 1,
                'division_office_id' => null,
                'time_setting_id' => null,
                'first_name' => 'admin',
                'last_name' => null,
                'email' => 'admin@mail.com',
                'password' => Hash::make($password),
                'isAutoApproved' => false,
                'created_at' => date($today),
                'updated_at' => date($today)
            ],
//            [
//                'role_id' => 2,
//                'division_office_id' => 2,
//                'time_setting_id' => 2,
//                'first_name' => $first_name,
//                'last_name' => $last_name,
//                'email' => $email,
//                'password' => Hash::make($password),
//                'isAutoApproved' => true,
//                'created_at' => date($today),
//                'updated_at' => date($today)
//            ],
        ]);

        foreach (DivisionOffice::all() as $division_office) {
            $lead = User::query()->create([
                'role_id' => 2,
                'division_office_id' => $division_office->id,
                'time_setting_id' => $division_office->division->time_settings[0]->id,
                'first_name' => $division_office->division->name,
                'last_name' => 'Lead',
                'email' => $division_office->division->initials . '.lead@company.mail',
                'password' => Hash::make($password),
                'isAutoApproved' => true,
            ]);

            User::query()->create([
                'role_id' => 3,
                'division_office_id' => $division_office->id,
                'time_setting_id' => $division_office->division->time_settings[0]->id,
                'first_name' => $division_office->division->name,
                'last_name' => 'Employee',
                'email' => $division_office->division->initials . '.emp@company.mail',
                'password' => Hash::make($password),
                'isAutoApproved' => false,
                'parent_id' => $lead->id
            ]);
        }
    }
}
