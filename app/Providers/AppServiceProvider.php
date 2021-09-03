<?php

namespace App\Providers;

use App\Enums\AbsentStatus;
use App\Enums\ApprovalStatus;
use App\Enums\LeaveStatus;
use App\Enums\OvertimeStatus;
use App\Models\Absent;
use App\Models\Attendance;
use App\Models\Leave;
use App\Models\Overtime;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::share([
            'dateStatus' => 'status',
            'pageTitle' => 'title'
        ]);

        View::composer(['user.*', 'layouts.partials.sidebar'], function ($view) {
            $attendanceCounter = Cache::remember('attendanceCounter', 5, function () {
                return Attendance::query()
                    ->where('approverId', auth()->id())
                    ->where('approvalStatus', ApprovalStatus::NEEDS_APPROVAL)
                    ->count();
            });

            $overtimeCounter = Cache::remember('overtimeCounter', 5, function () {
                return Overtime::query()
                    ->where('approverId', auth()->id())
                    ->where('approvalStatus', OvertimeStatus::NEEDS_APPROVAL)
                    ->count();
            });

            $absentCounter = Cache::remember('absentCounter', 5, function () {
                return Absent::query()
                    ->where('approverId', auth()->id())
                    ->where('approvalStatus', AbsentStatus::NEEDS_APPROVAL)
                    ->count();
            });

            $leaveCounter = Cache::remember('leaveCounter', 5, function () {
                return Leave::query()
                    ->where('approverId', auth()->id())
                    ->where('approvalStatus', LeaveStatus::NEEDS_APPROVAL)
                    ->count();
            });

            return $view->with([
                'attendanceCounter' => $attendanceCounter,
                'overtimeCounter' => $overtimeCounter,
                'absentCounter' => $absentCounter,
                'leaveCounter' => $leaveCounter,
            ]);
        });

        View::composer('admin.calendar.*', function ($view) {
            if (auth()->user()->hasRole('Admin')) {
                $calendarRoutes = 'web.admin.calendars';
            } else {
                $calendarRoutes = 'web.employee.calendars';
            }

            $view->with([
                'calendarRoutes' => $calendarRoutes
            ]);
        });

        View::composer('admin.report.attendance.*', function ($view) {
           if (auth()->user()->hasRole('Admin')) {
               $reportRoutes = 'web.admin.attendance-report';
           } else {
               $reportRoutes = 'web.employee.attendance-report';
           }

           $view->with([
              'reportRoutes' => $reportRoutes
           ]);
        });
    }
}
