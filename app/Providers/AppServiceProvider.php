<?php

namespace App\Providers;

use App\Models\Budget;
use App\Models\User;
use App\Policies\V1\BudgetPolicy;
use App\Policies\V1\UserPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);
        Gate::policy(Budget::class, BudgetPolicy::class);
        Gate::policy(User::class, UserPolicy::class);
    }
}