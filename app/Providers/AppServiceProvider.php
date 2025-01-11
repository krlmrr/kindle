<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Gate::define('use_services', function (User $user) {
            return in_array($user->role, [
                'admin',
                'super_admin',
            ]);
        });
    }
}
