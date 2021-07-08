<?php


namespace App\Http\Services;


use App\Enums\AttendanceApprover;
use App\Enums\AttendanceStatus;
use App\Enums\LeaveStatus;
use App\Http\Resources\LeaveResource;
use App\Models\Leave;
use App\Models\User;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeaveService
{
    public function getLeave()
    {
        $leaves = Leave::query()
            ->where('user_id', auth()->id())
            ->latest()
            ->get();
        return LeaveResource::collection($leaves);
    }

    public function store(Request $request)
    {
        $user = User::query()->find(auth()->id());

        if ($user->isAutoApproved === true) {
            $approvedBy = AttendanceApprover::SYSTEM;
            $approverId = null;
            $approvalStatus = LeaveStatus::APPROVED;
        } else {
            $approvedBy = AttendanceApprover::PARENT;
            $approverId = $user->parent->id;
            $approvalStatus = LeaveStatus::NEEDS_APPROVAL;
        }

        $leave = Leave::query()->create([
            'user_id' => $user->id,
            'approvedBy' => $approvedBy,
            'approverId' => $approverId,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'note' => $request->note,
            'approvalStatus' => $approvalStatus
        ]);

        $dates = CarbonPeriod::create($request->start_date, $request->end_date);

        foreach ($dates as $key => $date) {
            DB::table('attendance_master')->insert([
                'user_id' => $user->id,
                'leave_id' => $leave->id,
                'attendance_type' => AttendanceStatus::LEAVE,
                'month' => $date->month,
                'year' => $date->year,
                'created_at' => $date,
                'updated_at' => $date
            ]);
        }

        return $leave;
    }

    public function update(Request $request, $id)
    {
        cache()->forget('leave.all');
        return Leave::query()->findOrFail($id)->update([
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'note' => $request->note,
        ]);
    }

    public function approveLeave($id)
    {
        cache()->forget('leave.all');
        cache()->forget('leaveCounter');
        cache()->forget('approve_leave.all');
        return Leave::query()->findOrFail($id)->update([
            'approvalStatus' => LeaveStatus::APPROVED
        ]);
    }

    public function rejectLeave(Request $request, $id)
    {
        cache()->forget('leave.all');
        cache()->forget('leaveCounter');
        cache()->forget('approve_leave.all');
        return Leave::query()->findOrFail($id)->update([
            'approvalStatus' => LeaveStatus::REJECTED,
            'rejectionNote' => $request->get('rejectionNote')
        ]);
    }
}
