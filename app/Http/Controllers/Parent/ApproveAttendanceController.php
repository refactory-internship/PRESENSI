<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use App\Models\Attendance;

class ApproveAttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::query()
            ->where('approverId', auth()->id())
            ->get();
        return view('user.parent.approve-attendance.index', compact('attendances'));
    }

    public function show($id)
    {
        $attendance = Attendance::query()->find($id);
        return view('user.parent.approve-attendance.show', compact('attendance'));
    }

    public function approve($id)
    {
        Attendance::query()->find($id)->update([
           'isApproved' => true
        ]);
        return redirect()->route('web.employee.approve-attendances.index')->with('message', 'Attendance Approved!');
    }

    public function reject($id)
    {
        Attendance::query()->find($id)->update([
            'isApproved' => false
        ]);
        return redirect()->route('web.employee.approve-attendances.index')->with('danger', 'Attendance Rejected!');
    }
}
