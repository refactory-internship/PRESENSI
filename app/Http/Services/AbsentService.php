<?php


namespace App\Http\Services;


use App\Enums\AbsentStatus;
use App\Enums\AttendanceApprover;
use App\Http\Resources\AbsentResource;
use App\Models\Absent;
use App\Models\Calendar;
use App\Models\User;
use Illuminate\Http\Request;

class AbsentService
{
    public function getAbsent()
    {
        $user = auth()->id();
        $absents = Absent::query()
            ->where('user_id', $user)
            ->latest()
            ->get();
        return AbsentResource::collection($absents);
    }
    public function store(Request $request)
    {
        $user = User::query()->find(auth()->id());
        $calendar = Calendar::query()
            ->where('date', $request->date)
            ->first();

        if ($user->isAutoApproved === true) {
            $approvedBy = AttendanceApprover::SYSTEM;
            $approverId = null;
            $approvalStatus = AbsentStatus::APPROVED;
        } else {
            $approvedBy = AttendanceApprover::PARENT;
            $approverId = $user->parent->id;
            $approvalStatus = AbsentStatus::NEEDS_APPROVAL;
        }

        return Absent::query()->create([
            'user_id' => $user->id,
            'calendar_id' => $calendar->id,
            'approvedBy' => $approvedBy,
            'approverId' => $approverId,
            'reason' => $request->reason,
            'date' => $request->date,
            'approvalStatus' => $approvalStatus,
        ]);
    }

    public function update(Request $request, $id)
    {
        return Absent::query()->findOrFail($id)->update([
            'reason' => $request->reason,
            'date' => $request->date
        ]);
    }

    public function approveAbsent($id)
    {
        return Absent::query()->findOrFail($id)->update([
           'approvalStatus' => AbsentStatus::APPROVED
        ]);
    }

    public function rejectAbsent(Request $request, $id)
    {
        return Absent::query()->findOrFail($id)->update([
           'approvalStatus' => AbsentStatus::REJECTED,
           'rejectionNote' => $request->get('rejectionNote')
        ]);
    }
}
