<?php


namespace App\Http\Services;


use App\Enums\CalendarStatus;
use App\Models\Calendar;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class CalendarService
{
    public function store($first, $last)
    {
        //Truncate all records
        Calendar::query()->truncate();

        //Create an empty array and save the transformed input to array
        $data = [];

        //Get the date range
        $dates = CarbonPeriod::create($first, $last);

        //For each dates create a transformed data
        foreach ($dates as $date) {
            $data[] = [
                'date' => $date->format('Y-m-d'),
                'day' => $date->day,
                'day_name' => $date->dayName,
                'month' => $date->month,
                'month_name' => $date->monthName,
                'status' => $this->dayStatus($date)['status'],
                'description' => $this->dayStatus($date)['description'],
                'year' => $date->year,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        //Create chunks for faster insertion
        $chunks = collect($data)->chunk(50);

        //Using chunks to insert the data
        foreach ($chunks as $chunk) {
            Calendar::query()->insert($chunk->toArray());
        }
    }

    public function dayStatus($date)
    {
        //parse date to get the month and date
        $dayMonth = Carbon::parse($date)->format('m-d');

        //store status and the description in a variable

        //check if the date is WEEK_END
        if ($date->dayName === 'Saturday' || $date->dayName === 'Sunday') {
            $result = [
                'status' => CalendarStatus::WEEK_END,
                'description' => 'WEEK_END'
            ];
        } else {
            $result = [
                'status' => CalendarStatus::WEEK_DAY,
                'description' => 'WEEK_DAY'
            ];
        }

        //check for HOLIDAY
        if ($dayMonth === '01-01') {
            $result = [
                'status' => CalendarStatus::HOLIDAY,
                'description' => 'Tahun Baru Masehi'
            ];
        } else if ($dayMonth === '02-12') {
            $result = [
                'status' => CalendarStatus::HOLIDAY,
                'description' => 'Tahun Baru Imlek'
            ];
        } else if ($dayMonth === '03-11') {
            $result = [
                'status' => CalendarStatus::HOLIDAY,
                'description' => 'Isra\' Mi\'raj Nabi Muhammad SAW'
            ];
        } else if ($dayMonth === '03-14') {
            $result = [
                'status' => CalendarStatus::HOLIDAY,
                'description' => 'Hari Raya Nyepi'
            ];
        } else if ($dayMonth === '04-02') {
            $result = [
                'status' => CalendarStatus::HOLIDAY,
                'description' => 'Wafat Isa Al Masih'
            ];
        } else if ($dayMonth === '05-01') {
            $result = [
                'status' => CalendarStatus::HOLIDAY,
                'description' => 'Hari Buruh Internasional'
            ];
        } else if ($dayMonth === '05-26') {
            $result = [
                'status' => CalendarStatus::HOLIDAY,
                'description' => 'Kenaikan Isa Al Masih'
            ];
        } else if ($dayMonth === '06-01') {
            $result = [
                'status' => CalendarStatus::HOLIDAY,
                'description' => 'Hari Lahir Pancasila'
            ];
        } else if ($dayMonth === '08-17') {
            $result = [
                'status' => CalendarStatus::HOLIDAY,
                'description' => 'Hari Kemerdekaan Republik Indonesia'
            ];
        } else if ($dayMonth === '12-24') {
            $result = [
                'status' => CalendarStatus::HOLIDAY,
                'description' => 'Cuti Bersama Hari Raya Natal'
            ];
        } else if ($dayMonth === '12-25') {
            $result = [
                'status' => CalendarStatus::HOLIDAY,
                'description' => 'Hari Raya Natal'
            ];
        }

        return $result;
    }
}
