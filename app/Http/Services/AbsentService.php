<?php


namespace App\Http\Services;


use App\Enums\AbsentStatus;
use App\Enums\AttendanceApprover;
use App\Enums\AttendanceStatus;
use App\Http\Resources\AbsentResource;
use App\Models\Absent;
use App\Models\Calendar;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AbsentService
{
    public function getAbsent()
    {
        $absents = Absent::query()
            ->where('user_id', auth()->id())
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

        $absent =  Absent::query()->create([
            'user_id' => $user->id,
            'calendar_id' => $calendar->id,
            'approvedBy' => $approvedBy,
            'approverId' => $approverId,
            'reason' => $request->reason,
            'date' => $request->date,
            'approvalStatus' => $approvalStatus,
        ]);

        $this->insertToAttendanceMaster($absent);

        return $absent;
    }

    public function update(Request $request, $id)
    {
        return Absent::query()->findOrFail($id)->update([
            'reason' => $request->reason,
            'date' => $request->date
        ]);
    }

    public function insertToAttendanceMaster($absent)
    {
        DB::table('attendance_master')->insert([
            'user_id' => $absent->user_id,
            'absent_id' => $absent->id,
            'attendance_type' => AttendanceStatus::ABSENT,
            'month' => $absent->calendar->month,
            'year' => $absent->calendar->year,
            'created_at' => $absent->calendar->date,
            'updated_at' => $absent->calendar->date
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
