<?php


namespace App\Http\Services;

use App\Models\Leave;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceReportService
{
    public function getReportMonth(Request $request)
    {
        return DateTime::createFromFormat('!m', $request->month)->format('F');
    }

    public function getWholeMonth($user, Request $request)
    {
        $requestDate = Carbon::createFromDate($request->year, $request->month)->startOfMonth();
        $leave = [];
        foreach ($user->leave as $data) {
            $start_date = Carbon::parse($data->start_date);
            $end_date = Carbon::parse($data->end_date);
            $leavePeriod = CarbonPeriod::create($start_date, $end_date);
            foreach ($leavePeriod as $period) {
                if ($requestDate->month == $period->month && $requestDate->year == $period->year) {
                    $leave[] = [
                        'date' => $period->toDateString(),
                        'note' => $data->note
                    ];
                }
            }
        }

        $result = DB::select('SELECT calendars.date,
                                            attendances.task_plan,
                                            CASE
                                                WHEN attendances.id IS NOT NULL THEN attendances.note
                                                WHEN absents.id IS NOT NULL THEN absents.reason
                                                END AS note,
                                            CASE
                                                WHEN attendances.id IS NOT NULL THEN "Attend"
                                                WHEN absents.id IS NOT NULL THEN "Absent"
                                                END AS attendanceType
                                     FROM calendars
                                        LEFT JOIN (SELECT *
                                                    FROM attendances
                                                    WHERE user_id = :attendanceUserID) attendances ON calendars.id = attendances.calendar_id
                                        LEFT JOIN (SELECT *
                                                    FROM absents
                                                    WHERE user_id = :absentUserID) absents ON calendars.id = absents.calendar_id
                                        WHERE calendars.month = :month
                                          AND calendars.year = :year
                                     ORDER BY calendars.date',
            ['attendanceUserID' => $user->id, 'absentUserID' => $user->id, 'month' => $request->month, 'year' => $request->year]);
        $resultArray = json_decode(json_encode($result, 1));

        foreach ($resultArray as $date) {
            if ($date->task_plan !== null) {
                $date->task_plan = json_decode($date->task_plan, true);
            }
            foreach ($leave as $item) {
                $attendanceType = $date->attendanceType;
                $note = $date->note;
                if ($date->date == $item['date']) {
                    if ($date->attendanceType === 'Attend' || $date->attendanceType === 'Absent') {
                        $date->attendanceType = $attendanceType;
                        $date->note = $note;
                    } else {
                        $date->attendanceType = 'Leave';
                        $date->note = $item['note'];
                    }
                }
            }
        }

        return $resultArray;
    }

    public function getOvertime($user, Request $request)
    {
        return DB::select('SELECT calendars.date,
                                         overtimes.task_plan,
                                         overtimes.start_time,
                                         overtimes.end_time,
                                         overtimes.duration
                                  FROM calendars
                                      JOIN (SELECT *
                                            FROM overtimes
                                            WHERE user_id = :overtimesUserID) overtimes ON calendars.id = overtimes.calendar_id
                                     WHERE calendars.month = :month
                                       AND calendars.year = :year
                                  ORDER BY calendars.date',
            ['overtimesUserID' => $user->id, 'month' => $request->month, 'year' => $request->year]);
    }

    public function getAttendanceCount($user, Request $request)
    {
        $attendanceCount = DB::table('attendances')
            ->join('calendars', 'calendars.id', '=', 'attendances.calendar_id')
            ->where('attendances.user_id', $user->id)
            ->where('calendars.month', $request->month)
            ->where('calendars.year', $request->year)
            ->count('attendances.id');

        $overtimeDuration = DB::table('overtimes')
            ->join('calendars', 'calendars.id', '=', 'overtimes.calendar_id')
            ->where('overtimes.user_id', $user->id)
            ->where('calendars.month', $request->month)
            ->where('calendars.year', $request->year)
            ->sum('overtimes.duration');

        $absentCount = DB::table('absents')
            ->join('calendars', 'calendars.id', '=', 'absents.calendar_id')
            ->where('absents.user_id', $user->id)
            ->where('calendars.month', $request->month)
            ->where('calendars.year', $request->year)
            ->count('absents.id');

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

        return [
            'attendanceCount' => $attendanceCount,
            'absentCount' => $absentCount,
            'overtimeDuration' => $overtimeDuration,
            'leaveCount' => $leaveDurationCounter
        ];
    }
}
