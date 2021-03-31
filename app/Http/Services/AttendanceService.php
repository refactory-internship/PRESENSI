<?php

namespace App\Http\Services;

use App\Enums\AttendanceApprovalStatus;
use App\Enums\AttendanceApprover;
use App\Http\Resources\AttendanceResource;
use App\Models\Attendance;
use App\Models\Calendar;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceService
{
    public function getAttendance()
    {
        $user = auth()->id();
        $attendances = Attendance::query()
            ->where('user_id', $user)
            ->latest()
            ->get();
        return AttendanceResource::collection($attendances);
    }

    public function store(Request $request)
    {
        $user = User::query()->find(auth()->id());
        $timeToday = $this->getCurrentDate();
        $calendar = $this->getDateFromDatabase();

        if ($user->isAutoApproved === true) {
            $approvedBy = AttendanceApprover::SYSTEM;
            $approvalStatus = AttendanceApprovalStatus::APPROVED;
            $approverId = null;

        } else {
            $approvedBy = AttendanceApprover::PARENT;
            $approvalStatus = AttendanceApprovalStatus::NEEDS_APPROVAL;
            $approverId = $user->parent->id;
        }

        return Attendance::query()->create([
            'user_id' => $user->id,
            'calendar_id' => $calendar->id,
            'approvedBy' => $approvedBy,
            'approverId' => $approverId,
            'isQRCode' => false,
            'task_plan' => $request->task_plan,
            'clock_in_time' => date('H:i:s', strtotime($timeToday)),
            'note' => $request->note,
            'clock_out_time' => null,
            'approvalStatus' => $approvalStatus,
        ]);
    }

    public function update(Request $request, $id)
    {
        $attendance = Attendance::query()->find($id);

        if ($attendance->approvalStatus === '1' || $attendance->approvalStatus === '4') {
            $approvalStatus = AttendanceApprovalStatus::NEEDS_APPROVAL;
        } else {
            $approvalStatus = $attendance->approvalStatus;
        }

        return $attendance->update([
            'task_plan' => $request->task_plan,
            'note' => $request->note,
            'approvalStatus' => $approvalStatus
        ]);
    }

    public function submitClockOut(Request $request, $id)
    {
        $clockOutTime = $this->getCurrentDate();
        $timeToday = Carbon::parse($clockOutTime)->toTimeString();
        $attendance = Attendance::query()->find($id);

        if ($attendance->user->isAutoApproved === true) {
            $approvalStatus = AttendanceApprovalStatus::APPROVED;
        } else {
            $approvalStatus = AttendanceApprovalStatus::NEEDS_APPROVAL;
        }

        if ($request->has('note')) {
            $note = $request->note;
        } else {
            $note = $attendance->note;
        }

        return $attendance->update([
            'task_report' => $request->task_report,
            'clock_out_time' => $timeToday,
            'note' => $note,
            'approvalStatus' => $approvalStatus
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
//        return Carbon::create('2021', '03', '30', '08', '45');
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
