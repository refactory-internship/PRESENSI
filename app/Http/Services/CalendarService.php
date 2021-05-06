<?php


namespace App\Http\Services;


use App\Enums\CalendarStatus;
use App\Models\Calendar;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class CalendarService
{
    public function store($first_year, $last_year)
    {
        //Create dates from selected year interval
        $firstDate = Carbon::createFromDate($first_year, '01', '01')->toDateString();
        $lastDate = Carbon::createFromDate($last_year, '12', '31')->toDateString();
        $dates = CarbonPeriod::create($firstDate, $lastDate);

        //Create an empty array and save the transformed input to array
        $data = [];

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

        return $result;
    }

    public function getCurrentDates()
    {
        $thisYear = date('Y', strtotime(Carbon::now()));
        $thisMonth = date('m', strtotime(Carbon::now()));

        return Calendar::query()
            ->where('year', $thisYear)
            ->where('month', $thisMonth)
            ->get();
    }

    public function pluckYears()
    {
        return Calendar::query()
            ->groupBy('year')
            ->pluck('year', 'year');
    }

    public function pluckMonths()
    {
        return Calendar::query()
            ->pluck('month_name', 'month');
    }

    public function searchDates(Request $request)
    {
        return Calendar::query()
            ->where('year', $request->year)
            ->where('month', $request->month)
            ->get();
    }
}
