<?php


namespace App\Http\Services;


use App\Enums\AttendanceApprover;
use App\Enums\LeaveStatus;
use App\Http\Resources\LeaveResource;
use App\Models\Leave;
use App\Models\User;
use Illuminate\Http\Request;

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

        return Leave::query()->create([
            'user_id' => $user->id,
            'approvedBy' => $approvedBy,
            'approverId' => $approverId,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'note' => $request->note,
            'approvalStatus' => $approvalStatus
        ]);
    }

    public function update(Request $request, $id)
    {
        return Leave::query()->findOrFail($id)->update([
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'note' => $request->note,
        ]);
    }

    public function approveLeave($id)
    {
        return Leave::query()->findOrFail($id)->update([
            'approvalStatus' => LeaveStatus::APPROVED
        ]);
    }

    public function rejectLeave(Request $request, $id)
    {
        return Leave::query()->findOrFail($id)->update([
            'approvalStatus' => LeaveStatus::REJECTED,
            'rejectionNote' => $request->get('rejectionNote')
        ]);
    }
}
