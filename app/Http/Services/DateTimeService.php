<?php

namespace App\Http\Services;

use App\Models\Calendar;
use Carbon\Carbon;

class DateTimeService
{
    public function getCurrentDate()
    {
        date_default_timezone_set('Asia/Jakarta');
        return Carbon::create('2021', '05', '08', '08', '45');
//        return Carbon::now();
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
