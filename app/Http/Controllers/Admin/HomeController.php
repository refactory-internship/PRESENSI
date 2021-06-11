<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\AdminDashboardService;
use App\Http\Services\DateTimeService;

class HomeController extends Controller
{
    protected $dateTimeService;
    protected $adminDashboardService;

    public function __construct(DateTimeService $dateTimeService, AdminDashboardService $adminDashboardService)
    {
        $this->dateTimeService = $dateTimeService;
        $this->adminDashboardService = $adminDashboardService;
    }

    public function index()
    {
        $currentDate = $this->dateTimeService->getCurrentDate();
        $date = $this->dateTimeService->getDateFromDatabase();
        $currentDay = date('j', strtotime($currentDate));
        $currentMonth = date('n', strtotime($currentDate));
        $currentYear = date('Y', strtotime($currentDate));
        $attendanceCount = $this->adminDashboardService->dailyAttendanceCount($currentDay, $currentMonth, $currentYear);
        $overtimeCount = $this->adminDashboardService->dailyOvertimeCount($currentDay, $currentMonth, $currentYear);
        $absentCount = $this->adminDashboardService->dailyAbsentCount($currentDay, $currentMonth, $currentYear);
        $leaveDurationCounter = $this->adminDashboardService->dailyLeaveCounter($currentDay, $currentMonth);

        return view('admin.home', compact('currentDate', 'date', 'attendanceCount', 'absentCount', 'overtimeCount', 'leaveDurationCounter'));
    }
}
