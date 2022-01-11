<?php

namespace Database\Seeders;

use App\Models\Division;
use App\Models\TimeSetting;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TimeSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $today = Carbon::now();

        foreach (Division::all() as $division) {
            TimeSetting::query()->create([
                'division_id' => $division->id,
                'start_time' => date('H:i', strtotime('08:30')),
                'end_time' => date('H:i', strtotime('16:30')),
            ]);
        }

//        for ($i = 0; $i < 6; $i++) {
//            DB::table('time_settings')->insert([
//                [
//                    'division_id' => $i + 1,
//                    'start_time' => date('H:i', strtotime('08:30')),
//                    'end_time' => date('H:i', strtotime('16:30')),
//                    'created_at' => date($today),
//                    'updated_at' => date($today),
//                ],
//            ]);
//        }
    }
}
