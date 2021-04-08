<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use App\Http\Services\AttendanceService;
use App\Models\Attendance;
use Illuminate\Http\Request;

class ApproveAttendanceController extends Controller
{
    private $attendanceService;

    public function __construct(AttendanceService $attendanceService)
    {
        $this->attendanceService = $attendanceService;
    }

    public function index()
    {
        $attendances = Attendance::query()
            ->where('approverId', auth()->id())
            ->where('isFinished', true)
            ->latest()
            ->get();
        return view('user.parent.approve-attendance.index', compact('attendances'));
    }

    public function show($id)
    {
        $attendance = Attendance::query()->findOrFail($id);
        return view('user.parent.approve-attendance.show', compact('attendance'));
    }

    public function approve($id)
    {
        $this->attendanceService->approveAttendance($id);
        return redirect()->back()->with('message', 'Attendance Approved!');
    }

    public function reject(Request $request, $id)
    {
        $this->attendanceService->rejectAttendance($request, $id);
        return redirect()->back()->with('danger', 'Attendance Rejected!');
    }
}
