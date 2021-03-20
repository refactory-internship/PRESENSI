<?php

namespace App\Providers;

use App\Models\Attendance;
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
        ]);

        View::composer('*', function ($view) {
            $counter = Attendance::query()
                ->where('approverId', auth()->id())
                ->where('isApproved', false)
                ->count();

            $view->with([
                'counter' => $counter
            ]);
        });
    }
}
