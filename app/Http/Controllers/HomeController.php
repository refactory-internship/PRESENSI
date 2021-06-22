<?php

namespace App\Http\Controllers;

use App\Http\Services\DateTimeService;
use App\Http\Services\EmployeeDashboardService;

class HomeController extends Controller
{

    protected $dateTimeService;
    protected $employeeDashboardService;

    public function __construct(DateTimeService $dateTimeService, EmployeeDashboardService $employeeDashboardService)
    {
        $this->dateTimeService = $dateTimeService;
        $this->employeeDashboardService = $employeeDashboardService;
    }

    public function index()
    {
        $currentDate = $this->dateTimeService->getCurrentDate();
        $date = $this->dateTimeService->getDateFromDatabase();
        $currentDay = date('j', strtotime($currentDate));
        $currentMonth = date('n', strtotime($currentDate));
        $currentYear = date('Y', strtotime($currentDate));
        $attendance = $this->employeeDashboardService->getTodayAttendance($currentDay, $currentMonth, $currentYear);
        $attendanceCount = $this->employeeDashboardService->countMonthlyAttendance($currentMonth, $currentYear);
        $overtimeCount = $this->employeeDashboardService->countMonthlyOvertime($currentMonth, $currentYear);
        $absentCount = $this->employeeDashboardService->countMonthlyAbsent($currentMonth, $currentYear);
        $leaveDurationCounter = $this->employeeDashboardService->countMonthlyLeave($currentMonth);

        if ($attendance === null) {
            $tasks = null;
        } else {
            $tasks = json_decode($attendance->task_plan);
        }

        return view('user.home', compact('currentDate', 'date', 'attendance', 'attendanceCount', 'overtimeCount', 'absentCount', 'leaveDurationCounter', 'tasks'));
    }
}
