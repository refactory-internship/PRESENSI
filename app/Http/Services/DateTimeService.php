<?php

namespace App\Http\Services;

use App\Models\Calendar;
use Carbon\Carbon;

class DateTimeService
{
    public function getCurrentDate()
    {
        date_default_timezone_set('Asia/Jakarta');
        // return Carbon::create('2021', '10', '02', '21', '56');
        return Carbon::now();
    }

    public function getDateFromDatabase()
    {
        $today = $this->getCurrentDate();
        $dateToday = $today->toDateString();

        return Calendar::query()
            ->where('date', $dateToday)
            ->first();
    }
}
