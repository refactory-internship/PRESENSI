<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AttendanceReportExport;
use App\Http\Controllers\Controller;
use App\Http\Services\AttendanceReportService;
use App\Http\Services\CalendarService;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;

class AttendanceReportController extends Controller
{
    private $calendarService;
    private $attendanceReportService;

    public function __construct(CalendarService $calendarService, AttendanceReportService $attendanceReportService)
    {
        $this->calendarService = $calendarService;
        $this->attendanceReportService = $attendanceReportService;
    }

    public function index()
    {
        $users = User::query()
            ->where('id', '!=', 1)
            ->get();
        $years = $this->calendarService->pluckYears();
        $months = $this->calendarService->pluckMonths();

        return view('admin.report.attendance.index', compact('users', 'years', 'months'));
    }

    public function export(Request $request, $id)
    {
        $user = User::query()->findOrFail($id);
        $month = $this->attendanceReportService->getReportMonth($request);
        $report = $this->attendanceReportService->getWholeMonth($user, $request);
        $overtimes = $this->attendanceReportService->getOvertime($user, $request);
        $attendanceCounter = $this->attendanceReportService->getAttendanceCount($user, $request);
        $reportDate = Carbon::now()->format('YmdHs');
        $xlsxFileName = $user->getFullNameAttribute() . ' ' . $month . ' ' . 'Attendance Report' . ' ' . $reportDate . '.xlsx';
        $pdf = PDF::loadView('admin.report.attendance.export', compact('user', 'month', 'report', 'overtimes', 'attendanceCounter'))
            ->stream();

        if ($request->input('action') === 'xlsx') {
            return Excel::download(new AttendanceReportExport($request, $id, $this->attendanceReportService), $xlsxFileName);
        } else {
            return $pdf;
        }
    }
}
