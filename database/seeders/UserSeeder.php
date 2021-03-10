<?php

namespace Database\Seeders;

use Carbon\Carbon;
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
                'name' => 'admin',
                'email' => 'admin@mail.com',
                'password' => Hash::make($password),
                'role_id' => 1,
                'created_at' => date($today),
                'updated_at' => date($today)
            ],
            [
                'name' => 'fajar',
                'email' => 'fajar@mail.com',
                'password' => Hash::make($password),
                'role_id' => 2,
                'created_at' => date($today),
                'updated_at' => date($today)
            ]
        ]);
    }
}
