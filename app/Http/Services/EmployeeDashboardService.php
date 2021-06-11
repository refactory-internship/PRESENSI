<?php


namespace App\Http\Services;


use App\Models\Absent;
use App\Models\Leave;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;

class EmployeeDashboardService
{
    public function getTodayAttendance($currentDay, $currentMonth, $currentYear)
    {
        return DB::table('attendances')
            ->join('calendars', 'calendars.id', '=', 'attendances.calendar_id')
            ->where('attendances.user_id', auth()->id())
            ->where('calendars.day', $currentDay)
            ->where('calendars.month', $currentMonth)
            ->where('calendars.year', $currentYear)
            ->first();
    }
    public function countMonthlyAttendance($currentMonth, $currentYear)
    {
        return DB::table('attendances')
            ->join('calendars', 'calendars.id', '=', 'attendances.calendar_id')
            ->where('attendances.user_id', auth()->id())
            ->where('calendars.month', $currentMonth)
            ->where('calendars.year', $currentYear)
            ->count('attendances.id');
    }

    public function countMonthlyOvertime($currentMonth, $currentYear)
    {
        return DB::table('overtimes')
            ->join('calendars', 'calendars.id', '=', 'overtimes.calendar_id')
            ->where('overtimes.user_id', auth()->id())
            ->where('calendars.month', $currentMonth)
            ->where('calendars.year', $currentYear)
            ->sum('overtimes.duration');
    }

    public function countMonthlyAbsent($currentMonth, $currentYear)
    {
        return Absent::query()
            ->where('user_id', auth()->id())
            ->with(['calendar' => function ($query) use ($currentMonth, $currentYear) {
                $query->where('month', $currentMonth);
                $query->where('year', $currentYear);
            }])->count('id');
    }

    public function countMonthlyLeave($currentMonth)
    {
        $leave = Leave::query()
            ->where('user_id', auth()->id())
            ->get();

        $leaveDurationCounter = 0;
        foreach ($leave as $data) {
            $leaveDuration = CarbonPeriod::create($data->start_date, $data->end_date);
            foreach ($leaveDuration as $leaveDate) {
                if ($leaveDate->month == $currentMonth) {
                    $leaveDurationCounter++;
                }
            }
        }

        return $leaveDurationCounter;
    }
}
