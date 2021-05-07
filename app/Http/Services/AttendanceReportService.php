<?php


namespace App\Http\Services;


use App\Models\Absent;
use App\Models\Attendance;
use App\Models\Leave;
use App\Models\Overtime;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceReportService
{
    public function getAttendanceTotal($user, Request $request)
    {
        return DB::table('attendances')
            ->join('calendars', 'calendars.id', '=', 'attendances.calendar_id')
            ->where('attendances.user_id', $user->id)
            ->where('calendars.month', $request->month)
            ->where('calendars.year', $request->year)
            ->count('attendances.id');
    }

    public function getOvertimeHours($user, Request $request)
    {
        return DB::table('overtimes')
            ->join('calendars', 'calendars.id', '=', 'overtimes.calendar_id')
            ->where('overtimes.user_id', $user->id)
            ->where('calendars.month', $request->month)
            ->where('calendars.year', $request->year)
            ->sum('overtimes.duration');
    }

    public function getAbsentTotal($user, Request $request)
    {
        return Absent::query()
            ->where('user_id', $user->id)
            ->with(['calendar' => function ($query) use ($request) {
                $query->where('month', $request->month);
                $query->where('year', $request->year);
            }])->count('id');
    }

    public function getLeaveDuration($user, Request $request)
    {
        $leave = Leave::query()
            ->where('user_id', $user->id)
            ->get();

        $leaveDurationCounter = 0;
        foreach ($leave as $data) {
            $leaveDuration = CarbonPeriod::create($data->start_date, $data->end_date);
            foreach ($leaveDuration as $date) {
                if ($date->month == $request->month) {
                    $leaveDurationCounter++;
                }
            }
        }

        return $leaveDurationCounter;
    }

    public function getReportMonth(Request $request)
    {
        return \DateTime::createFromFormat('!m', $request->month)->format('F');
    }
}
