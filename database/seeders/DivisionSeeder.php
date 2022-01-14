<?php

namespace Database\Seeders;

use App\Models\Division;
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
        //        $today = Carbon::now();
        // $divisions = [
        //     'Human Resource',
        //     'Legal and Business',
        //     'Back-End Developer',
        //     'Front-End Developer',
        //     'Android Developer',
        //     'iOS Developer',
        //     'Quality Assurance',
        //     'System Analyst'
        // ];

        // foreach ($divisions as $division) {
        //     Division::query()->create([
        //         'name' => $division
        //     ]);
        // }
        Division::query()->create([
            'name' => 'Tech Division'
        ]);
        //        DB::table('divisions')->insert([
        //            [
        //                'name' => 'Human Resource',
        //                'created_at' => date($today),
        //                'updated_at' => date($today),
        //            ],
        //            [
        //                'name' => 'IT Support',
        //                'created_at' => date($today),
        //                'updated_at' => date($today),
        //            ],
        //            [
        //                'name' => 'Accounting',
        //                'created_at' => date($today),
        //                'updated_at' => date($today),
        //            ],
        //            [
        //                'name' => 'Security',
        //                'created_at' => date($today),
        //                'updated_at' => date($today),
        //            ],
        //            [
        //                'name' => 'Legal and Business',
        //                'created_at' => date($today),
        //                'updated_at' => date($today),
        //            ],
        //            [
        //                'name' => 'Trainer',
        //                'created_at' => date($today),
        //                'updated_at' => date($today),
        //            ],
        //        ]);
    }
}
