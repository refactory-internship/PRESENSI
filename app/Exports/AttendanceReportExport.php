<?php

namespace App\Exports;

use App\Http\Services\AttendanceReportService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AttendanceReportExport implements FromView, ShouldAutoSize
{
    private $request;
    private $id;
    private $attendanceReportService;

    public function __construct(Request $request, int $id, AttendanceReportService $attendanceReportService)
    {
        $this->request = $request;
        $this->id = $id;
        $this->attendanceReportService = $attendanceReportService;
    }

    public function view(): View
    {
        $request = $this->request;
        $user = User::query()->findOrFail($this->id);
        $report = $this->attendanceReportService->getWholeMonth($user, $request);
        $overtimes = $this->attendanceReportService->getOvertime($user, $request);
        $attendanceCounter = $this->attendanceReportService->getAttendanceCount($user, $request);
        $month = $this->attendanceReportService->getReportMonth($request);

        return view('admin.report.attendance.export', compact('user', 'month', 'report', 'overtimes', 'attendanceCounter'));
    }
}
