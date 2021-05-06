<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AttendanceReportExport;
use App\Http\Controllers\Controller;
use App\Http\Services\CalendarService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;

class AttendanceReportController extends Controller
{
    private $calendarService;

    public function __construct(CalendarService $calendarService)
    {
        $this->calendarService = $calendarService;
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
        $data = DB::table('attendance_master')
            ->where('user_id', $user->id)
            ->where('month', $request->month)
            ->where('year', $request->year)
            ->get();
        $month = \DateTime::createFromFormat('!m', $request->month)->format('F');

        switch ($request->input('action')) {
            case 'xlsx' :
                return Excel::download(new AttendanceReportExport($request, $id), 'report.xlsx');
            default:
                return PDF::loadView('admin.report.attendance.export', compact('user', 'data', 'month'))->stream();
        }
    }
}
