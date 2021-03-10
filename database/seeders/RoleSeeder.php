<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $today = Carbon::now();
        DB::table('roles')->insert([
            [
                'name' => 'Admin',
                'created_at' => date($today),
                'updated_at' => date($today),
            ],
            [
                'name' => 'User',
                'created_at' => date($today),
                'updated_at' => date($today),
            ]
        ]);
    }
}
