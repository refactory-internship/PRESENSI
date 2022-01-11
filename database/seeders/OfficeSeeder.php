<?php

namespace Database\Seeders;

use App\Models\Office;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        $today = Carbon::now();
        $address = 'Jalan Kaliurang KM.12.5, No. 32, Candikarang, Sardonoharjo, Ngaglik';

        Office::query()->create([
            'village_id' => null,
            'name' => 'Office Branch A',
            'address' => $address
        ]);
//        DB::table('offices')->insert([
//            [
//                'village_id' => null,
//                'name' => 'Office Branch A',
//                'address' => $address,
//                'created_at' => date($today),
//                'updated_at' => date($today)
//            ],
//            [
//                'village_id' => null,
//                'name' => 'Office Branch B',
//                'address' => $address,
//                'created_at' => date($today),
//                'updated_at' => date($today)
//            ],
//        ]);
    }
}
