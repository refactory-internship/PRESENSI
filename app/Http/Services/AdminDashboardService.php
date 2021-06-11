<?php


namespace App\Http\Services;


use App\Models\Absent;
use App\Models\Leave;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;

class AdminDashboardService
{
    public function dailyAttendanceCount($currentDay, $currentMonth, $currentYear)
    {
        return DB::table('attendances')
            ->join('calendars', 'calendars.id', '=', 'attendances.calendar_id')
            ->where('calendars.day', $currentDay)
            ->where('calendars.month', $currentMonth)
            ->where('calendars.year', $currentYear)
            ->count('attendances.id');
    }

    public function dailyOvertimeCount($currentDay, $currentMonth, $currentYear)
    {
        return DB::table('overtimes')
            ->join('calendars', 'calendars.id', '=', 'overtimes.calendar_id')
            ->where('calendars.day', $currentDay)
            ->where('calendars.month', $currentMonth)
            ->where('calendars.year', $currentYear)
            ->sum('overtimes.duration');
    }

    public function dailyAbsentCount($currentDay, $currentMonth, $currentYear)
    {
        return Absent::query()
            ->where('user_id', auth()->id())
            ->with(['calendar' => function ($query) use ($currentDay, $currentMonth, $currentYear) {
                $query->where('day', $currentDay);
                $query->where('month', $currentMonth);
                $query->where('year', $currentYear);
            }])->count('id');
    }

    public function dailyLeaveCounter($currentDay, $currentMonth)
    {
        $leave = Leave::all();

        $leaveDurationCounter = 0;
        foreach ($leave as $data) {
            $leaveDuration = CarbonPeriod::create($data->start_date, $data->end_date);
            foreach ($leaveDuration as $leaveDate) {
                if ($leaveDate->day == $currentDay && $leaveDate->month == $currentMonth) {
                    $leaveDurationCounter++;
                }
            }
        }

        return $leaveDurationCounter;
    }
}
