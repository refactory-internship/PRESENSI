<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $today = Carbon::now();
        DB::table('divisions')->insert([
            [
                'name' => 'Human Resource',
                'created_at' => date($today),
                'updated_at' => date($today),
            ],
            [
                'name' => 'IT Support',
                'created_at' => date($today),
                'updated_at' => date($today),
            ],
            [
                'name' => 'Accounting',
                'created_at' => date($today),
                'updated_at' => date($today),
            ],
            [
                'name' => 'Security',
                'created_at' => date($today),
                'updated_at' => date($today),
            ],
            [
                'name' => 'Legal and Business',
                'created_at' => date($today),
                'updated_at' => date($today),
            ],
            [
                'name' => 'Trainer',
                'created_at' => date($today),
                'updated_at' => date($today),
            ],
        ]);
    }
}
