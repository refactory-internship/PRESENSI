<?php

namespace App\Providers;

use App\Enums\ApprovalStatus;
use App\Enums\OvertimeStatus;
use App\Models\Attendance;
use App\Models\Overtime;
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

        View::composer('*', function ($view) {
            $attendanceCounter = Attendance::query()
                ->where('approverId', auth()->id())
                ->where('approvalStatus', ApprovalStatus::NEEDS_APPROVAL)
                ->count();

            $overtimeCounter = Overtime::query()
                ->where('approverId', auth()->id())
                ->where('approvalStatus', OvertimeStatus::NEEDS_APPROVAL)
                ->count();

            $view->with([
                'attendanceCounter' => $attendanceCounter,
                'overtimeCounter' => $overtimeCounter
            ]);
        });
    }
}
