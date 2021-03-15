<?php

namespace Database\Seeders;

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
        $email = strtolower($first_name) . '@mail.com';
        DB::table('users')->insert([
            [
                'role_id' => 1,
                'division_office_id' => 2,
                'time_setting_id' => 2,
                'first_name' => 'admin',
                'last_name' => null,
                'email' => 'admin@mail.com',
                'password' => Hash::make($password),
                'created_at' => date($today),
                'updated_at' => date($today)
            ],
            [
                'role_id' => 2,
                'division_office_id' => 2,
                'time_setting_id' => 2,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'password' => Hash::make($password),
                'created_at' => date($today),
                'updated_at' => date($today)
            ],
        ]);
    }
}
