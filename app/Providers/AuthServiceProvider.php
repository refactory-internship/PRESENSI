<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('master-crud', function ($user) {
            return $user->hasRole('Admin');
        });

        Gate::define('approve-attendances', function () {
            $id = auth()->id();
            $user = User::query()->find($id);
            if ($user->children()->exists()) {
                return true;
            }
            return false;
        });

        Gate::define('manage-calendar', function () {
            if (auth()->user()->division_office->division->name === 'Human Resource') {
                return true;
            }
            return false;
        });
    }
}
