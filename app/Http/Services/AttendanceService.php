<?php

namespace App\Http\Services;

use App\Enums\ApprovalStatus;
use App\Enums\AttendanceApprover;
use App\Http\Resources\AttendanceResource;
use App\Jobs\EmailAttendanceApprovalRequest;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;

class AttendanceService
{
    private $dateTimeService;

    public function __construct(DateTimeService $dateTimeService)
    {
        $this->dateTimeService = $dateTimeService;
    }

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
        $timeToday = $this->dateTimeService->getCurrentDate();
        $calendar = $this->dateTimeService->getDateFromDatabase();

        if ($user->isAutoApproved === true) {
            $approvedBy = AttendanceApprover::SYSTEM;
            $approverId = null;
            $approvalStatus = ApprovalStatus::APPROVED;

        } else {
            $approvedBy = AttendanceApprover::PARENT;
            $approverId = $user->parent->id;
            $approvalStatus = ApprovalStatus::NEEDS_APPROVAL;
        }

        $attendance = Attendance::query()->create([
            'user_id' => $user->id,
            'calendar_id' => $calendar->id,
            'approvedBy' => $approvedBy,
            'approverId' => $approverId,
            'isQRCode' => false,
            'task_plan' => json_encode($request->task_plan),
            'clock_in_time' => date('H:i:s', strtotime($timeToday)),
            'note' => $request->note,
            'clock_out_time' => null,
            'isFinished' => false,
            'approvalStatus' => $approvalStatus,
        ]);

        cache()->forget('attendance.all');
        return $attendance;
    }

    public function update(Request $request, $id)
    {
        $attendance = Attendance::query()->findOrFail($id);
        $timeToday = $this->dateTimeService->getCurrentDate();
        $user = User::query()->findOrFail(auth()->id());

        if ($attendance->approvalStatus === '1' || $attendance->approvalStatus === '2') {
            if ($request->has('isFinished')) {
                $approvalStatus = ApprovalStatus::APPROVED;
                $clockOutTime = $timeToday;
                $isFinished = true;
            } else {
                $approvalStatus = $attendance->approvalStatus;
                $clockOutTime = $attendance->clock_out_time;
                $isFinished = $attendance->isFinished;
            }
        } else {
            $approvalStatus = ApprovalStatus::NEEDS_APPROVAL;
            $isFinished = $attendance->isFinished;
            $clockOutTime = $attendance->clock_out_time;

            if ($user->isAutoApproved === true) {
                $parentEmail = $user->parent->email;
                EmailAttendanceApprovalRequest::dispatch($parentEmail, $user, $attendance);
            }
        }

        cache()->forget('attendance.all');
        return $attendance->update([
            'task_plan' => json_encode($request->task_plan),
            'note' => $request->note,
            'task_report' => $request->task_report,
            'clock_out_time' => $clockOutTime,
            'isFinished' => $isFinished,
            'approvalStatus' => $approvalStatus
        ]);
    }

    public function approveAttendance($id)
    {
        $attendance = Attendance::query()->findOrFail($id);
        cache()->forget('attendance.all');
        return $attendance->update([
            'approvalStatus' => ApprovalStatus::APPROVED
        ]);
    }

    public function rejectAttendance(Request $request, $id)
    {
        $attendance = Attendance::query()->findOrFail($id);
        cache()->forget('attendance.all');
        return $attendance->update([
            'approvalStatus' => ApprovalStatus::REJECTED,
            'rejectionNote' => $request->get('rejectionNote')
        ]);
    }
}
