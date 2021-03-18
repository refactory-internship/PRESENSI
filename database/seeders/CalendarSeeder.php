<?php

namespace Database\Seeders;

use App\Http\Services\CalendarService;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CalendarSeeder extends Seeder
{
    private $calendarService;

    public function __construct(CalendarService $calendarService)
    {
        $this->calendarService = $calendarService;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $first = Carbon::create('2021', '01', '01');
        $last = Carbon::create('2026', '12', '31');
        $this->calendarService->store($first, $last);
    }
}
