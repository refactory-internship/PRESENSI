<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DivisionOfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $today = Carbon::now();
        for ($i = 0; $i < 6; $i++) {
            DB::table('division_office')->insert([
                'division_id' => $i + 1,
                'office_id' => 1,
                'created_at' => date($today),
                'updated_at' => date($today),
            ]);
        }

        for ($i = 0; $i < 2; $i++) {
            DB::table('division_office')->insert([
                'division_id' => $i + 1,
                'office_id' => 2,
                'created_at' => date($today),
                'updated_at' => date($today),
            ]);
        }
    }
}
