<?php

namespace Database\Seeders;

use App\Http\Services\CalendarService;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
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
        $first_year = '2021';
        $last_year = '2021';
        $this->calendarService->store($first_year, $last_year);


    }
}
