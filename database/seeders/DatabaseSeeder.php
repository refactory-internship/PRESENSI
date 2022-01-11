<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
//            LaravoltIndonesiaSeeder::class,
            RoleSeeder::class,
            DivisionSeeder::class,
            OfficeSeeder::class,
            TimeSettingSeeder::class,
            DivisionOfficeSeeder::class,
            UserSeeder::class,
//            ChildSeeder::class,
            CalendarSeeder::class,
//            AttendanceSeeder::class,
//            OvertimeSeeder::class,
//            AbsentSeeder::class
        ]);
    }
}
