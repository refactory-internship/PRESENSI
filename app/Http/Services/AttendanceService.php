<?php

namespace App\Http\Services;

use App\Enums\AttendanceApprovalStatus;
use App\Enums\AttendanceApprover;
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
            $approvalStatus = AttendanceApprovalStatus::APPROVED;
        } else {
            $approver = AttendanceApprover::PARENT;
            $parent = $user->parent->id;
            $approvalStatus = AttendanceApprovalStatus::NEEDS_APPROVAL;
        }

        if ($request->has('overtimeStatus')) {
            $isOvertime = true;
            $overtimeDuration = $request->overtime_duration;
            $clockOutTime = Carbon::parse($timeToday)->addHours($overtimeDuration)->toTimeString();
        } else {
            $isOvertime = false;
            $overtimeDuration = null;
            $clockOutTime = null;
        }

        return Attendance::query()->create([
            'user_id' => $user->id,
            'calendar_id' => $calendar->id,
            'approvedBy' => $approver,
            'approverId' => $parent,
            'isQRCode' => false,
            'task_plan' => $request->task_plan,
            'clock_in_time' => date('H:i:s', strtotime($timeToday)),
            'note' => $request->note,
            'clock_out_time' => $clockOutTime,
            'isOvertime' => $isOvertime,
            'overtimeDuration' => $overtimeDuration,
            'approvalStatus' => $approvalStatus,
        ]);
    }

    public function submitClockOut(Request $request, $id)
    {
        $clockOutTime = $this->getCurrentDate();
        $timeToday = Carbon::parse($clockOutTime)->toTimeString();

        return Attendance::query()->find($id)->update([
            'task_report' => $request->task_report,
            'clock_out_time' => $timeToday,
            'note' => $request->note,
            'approvalStatus' => AttendanceApprovalStatus::NEEDS_APPROVAL
        ]);
    }

    public function approveAttendance($id)
    {
        $attendance = Attendance::query()->find($id);

        if ($attendance->approvalStatus === '1') {
            if ($attendance->clock_out_time !== null) {
                $approvalStatus = AttendanceApprovalStatus::APPROVED;
            } else {
                $approvalStatus = AttendanceApprovalStatus::CLOCK_OUT_ALLOWED;
            }
        } else {
            $approvalStatus = AttendanceApprovalStatus::APPROVED;
        }

        return $attendance->update([
            'approvalStatus' => $approvalStatus
        ]);
    }

    public function rejectAttendance(Request $request, $id)
    {
        $attendance = Attendance::query()->find($id);

        return $attendance->update([
            'approvalStatus' => AttendanceApprovalStatus::REJECTED,
            'rejectionNote' => $request->get('rejectionNote')
        ]);
    }

    public function getCurrentDate()
    {
        date_default_timezone_set('Asia/Jakarta');
        return Carbon::create('2021', '03', '30', '19', '30');
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
