<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // For Local Install Telescope
        // if ($this->app->environment('local')) {
        //     $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
        //     $this->app->register(TelescopeServiceProvider::class);
        // }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $currentRoute = Request::route() ? Request::route()->getName() : null;
            $view->with('currentRoute', $currentRoute);
        });

        view()->composer('*', function ($view) {
            $view->with('userRoles', User::ROLES);
        });

        Blade::directive('role', function ($allowedRoles) {
            return "<?php if (auth()->check() && (in_array(auth()->user()->role, $allowedRoles)) ): ?>";
        });

        Blade::directive('endrole', function () {
            return "<?php endif; ?>";
        });

        Blade::directive('exceptrole', function ($forbiddenRoles) {
            return "<?php if (auth()->check() && !in_array(auth()->user()->role, $forbiddenRoles)): ?>";
        });

        Blade::directive('endexceptrole', function () {
            return "<?php endif; ?>";
        });
        Blade::directive('rolegroup', function ($group) {
            $roles = config("role.groups.$group");

            return "<?php if (auth()->check() && in_array(auth()->user()->role, $roles)): ?>";
        });

        Blade::directive('endrolegroup', function () {
            return "<?php endif; ?>";
        });
    }
}
