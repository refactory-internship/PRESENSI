<?php


namespace App\Http\Services;


use App\Enums\AttendanceApprover;
use App\Enums\OvertimeStatus;
use App\Models\Calendar;
use App\Models\Overtime;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OvertimeService
{
    public function store(Request $request)
    {
        $timeToday = $this->getCurrentDate();
        $calendar = $this->getDateFromDatabase();
        $overtimeDuration = $request->duration;
        $startTime = Carbon::parse($timeToday)->toTimeString();
        $endTime = Carbon::parse($timeToday)->addHours($overtimeDuration)->toTimeString();
        $user = User::query()->find(auth()->id());

        if ($user->parent === null) {
            $approver = AttendanceApprover::SYSTEM;
            $parent = null;
            $approvalStatus = OvertimeStatus::APPROVED;
        } else {
            $approver = AttendanceApprover::PARENT;
            $parent = $user->parent->id;
            $approvalStatus = OvertimeStatus::NEEDS_APPROVAL;
        }

        return Overtime::query()->create([
            'user_id' => auth()->id(),
            'calendar_id' => $calendar->id,
            'approvedBy' => $approver,
            'approverId' => $parent,
            'start_time' => $startTime,
            'duration' => $overtimeDuration,
            'end_time' => $endTime,
            'task_plan' => $request->task_plan,
            'note' => $request->note,
            'approvalStatus' => $approvalStatus,
        ]);
    }

    public function update(Request $request, $id)
    {
        $overtime = Overtime::query()->find($id);
        $endTime = Carbon::parse($overtime->start_time)->addHours($request->duration)->toTimeString();
        $overtime->update([
            'task_plan' => $request->task_plan,
            'duration' => $request->duration,
            'end_time' => $endTime,
            'note' => $request->note,
            'approvalStatus'=> OvertimeStatus::NEEDS_APPROVAL
        ]);
        return $overtime;
    }

    public function updateOvertimeProgress(Request $request, $id)
    {
        return Overtime::query()->find($id)->update([
           'task_report' => $request->get('modal_task_report')
        ]);
    }

    public function approveOvertime($id)
    {
        return Overtime::query()->find($id)->update([
            'approvalStatus' => OvertimeStatus::APPROVED
        ]);
    }

    public function rejectOvertime(Request $request, $id)
    {
        return Overtime::query()->find($id)->update([
           'approvalStatus' => OvertimeStatus::REJECTED,
           'rejectionNote' => $request->get('rejectionNote')
        ]);
    }

    public function getCurrentDate()
    {
        date_default_timezone_set('Asia/Jakarta');
        return Carbon::create('2021', '03', '29', '16', '45');
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
