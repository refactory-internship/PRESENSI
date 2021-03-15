<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ChildSeeder extends Seeder
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
        $supervisor_first_name = $faker->firstName;
        $supervisor_last_name = $faker->lastName;
        $supervisor_email = strtolower($supervisor_first_name) . '@mail.com';
        $employee_first_name = $faker->firstName;
        $employee_last_name = $faker->lastName;
        $employee_email = strtolower($employee_first_name) . '@mail.com';
        DB::table('users')->insert([
            [
                'role_id' => 3,
                'division_office_id' => 2,
                'time_setting_id' => 2,
                'first_name' => $supervisor_first_name,
                'last_name' => $supervisor_last_name,
                'email' => $supervisor_email,
                'password' => Hash::make($password),
                'created_at' => date($today),
                'updated_at' => date($today),
                'parent_id' => 2,
            ],
            [
                'role_id' => 4,
                'division_office_id' => 2,
                'time_setting_id' => 2,
                'first_name' => $employee_first_name,
                'last_name' => $employee_last_name,
                'email' => $employee_email,
                'password' => Hash::make($password),
                'created_at' => date($today),
                'updated_at' => date($today),
                'parent_id' => 3,
            ],
        ]);
    }
}
