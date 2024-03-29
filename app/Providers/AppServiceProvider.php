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

        View::composer('layouts.partials.sidebar', function ($view) {
            $attendanceCounter = Attendance::query()
                ->where('approverId', auth()->id())
                ->where('approvalStatus', ApprovalStatus::NEEDS_APPROVAL)
                ->count();

            $overtimeCounter = Overtime::query()
                ->where('approverId', auth()->id())
                ->where('approvalStatus', OvertimeStatus::NEEDS_APPROVAL)
                ->count();

            $absentCounter = Absent::query()
                ->where('approverId', auth()->id())
                ->where('approvalStatus', AbsentStatus::NEEDS_APPROVAL)
                ->count();

            $leaveCounter = Leave::query()
                ->where('approverId', auth()->id())
                ->where('approvalStatus', LeaveStatus::NEEDS_APPROVAL)
                ->count();

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
    }
}
