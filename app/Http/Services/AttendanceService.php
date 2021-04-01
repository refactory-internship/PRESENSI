<?php

namespace App\Http\Services;

use App\Enums\ApprovalStatus;
use App\Enums\AttendanceApprover;
use App\Http\Resources\AttendanceResource;
use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;
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

        } else {
            $approvedBy = AttendanceApprover::PARENT;
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
            'isFinished' => false,
            'approvalStatus' => null,
        ]);
    }

    public function update(Request $request, $id)
    {
        $attendance = Attendance::query()->find($id);
        $timeToday = $this->dateTimeService->getCurrentDate();

        if ($request->has('isFinished')) {
            $clockOutTime = $timeToday;
            $isFinished = true;
            $approvalStatus = ApprovalStatus::NEEDS_APPROVAL;
        } else {
            $isFinished = $attendance->isFinished;
            $clockOutTime = $attendance->clock_out_time;
            $approvalStatus = $attendance->approvalStatus;
        }

        return $attendance->update([
            'task_plan' => $request->task_plan,
            'note' => $request->note,
            'task_report' => $request->task_report,
            'clock_out_time' => $clockOutTime,
            'isFinished' => $isFinished,
            'approvalStatus' => $approvalStatus
        ]);
    }

    public function approveAttendance($id)
    {
        $attendance = Attendance::query()->find($id);

        return $attendance->update([
            'approvalStatus' => ApprovalStatus::APPROVED
        ]);
    }

    public function rejectAttendance(Request $request, $id)
    {
        $attendance = Attendance::query()->find($id);

        return $attendance->update([
            'approvalStatus' => ApprovalStatus::REJECTED,
            'rejectionNote' => $request->get('rejectionNote')
        ]);
    }
}
