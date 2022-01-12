<?php

namespace App\Providers;

use App\Models\Users\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
        Gate::define('admin', function (User $user) {
            return $user->name === 'Coach Tigue';
        });

        Gate::define('coach', function (User $user) {
            return $user->role->name === 'coach';
        });
    }
}
