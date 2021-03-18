<?php

namespace App\Http\Services;

use App\Enums\AttendanceApprover;
use App\Enums\AttendanceStatus;
use App\Models\Attendance;
use App\Models\Calendar;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceService
{

    public function store(Request $request)
    {
        $user = User::query()->find(auth()->id());
        $timeToday = $this->getCurrentDate();
        $calendar = $this->getDateFromDatabase();

        if ($user->parent === null) {
            $approver = AttendanceApprover::SYSTEM;
            $parent = null;
            $isApproved = true;
        } else {
            $approver = AttendanceApprover::PARENT;
            $parent = $user->parent->id;
            $isApproved = false;
        }

        if ($request->has('overtimeStatus')) {
            $isOvertime = true;
            $overtimeDuration = $request->overtime_duration;
            $clockOutTime = Carbon::parse($timeToday)->addHours($request->overtime_duration)->toTimeString();
        } else {
            $isOvertime = false;
            $overtimeDuration = null;
            $clockOutTime = date('H:i:s', strtotime($request->clock_out_time));
        }

        return Attendance::query()->create([
            'user_id' => $user->id,
            'calendar_id' => $calendar->id,
            'approvedBy' => $approver,
            'approverId' => $parent,
            'status' => AttendanceStatus::PRESENT,
            'isQRCode' => false,
            'gps_lat' => null,
            'gps_long' => null,
            'clock_in_time' => date('H:i:s', strtotime($timeToday)),
            'note' => $request->note,
            'clock_out_time' => $clockOutTime,
            'task_plan' => $request->task_plan,
            'task_report' => $request->task_report,
            'isOvertime' => $isOvertime,
            'overtimeDuration' => $overtimeDuration,
            'isApproved' => $isApproved
        ]);
    }

    public function getCurrentDate()
    {
        date_default_timezone_set('Asia/Jakarta');
//        return Carbon::create('2021', '03', '18', '19', '30');
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
